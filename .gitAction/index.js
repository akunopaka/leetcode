const core = require("@actions/core");
const {Octokit} = require('@octokit/core');

// const process = require('./config');
// const GITHUB_TOKEN = process.env.GITHUB_TOKEN;
// const GITHUB_REPOSITORY = process.env.GITHUB_REPOSITORY;
const GITHUB_TOKEN = core.getInput('GITHUB_TOKEN', {required: true});
const GITHUB_REPOSITORY = core.getInput('GITHUB_REPOSITORY', {required: true});

const octokit = new Octokit({auth: GITHUB_TOKEN});
const getRequest = async (url) => {
    console.log('Get Request. ' + url);
    try {
        const res = await octokit.request(url);
        console.log('Get Request successful.' + url);
        // console.log(res);
        return res;
    } catch (e) {
        console.error("Get Request failed, with error: ", e.message);
        core.setFailed("Failed: " + e.message);
        throw new Error(e.message);
    }
}
const updateReadme = async (url, requestOptions) => {
    console.log('Update readme. ' + url);
    try {
        await octokit.request(url, requestOptions);
        // core.setOutput("repositories", 'done');
        console.log('Update readme successful.');
    } catch (e) {
        console.error("Update readme failed with error: ", e.message);
        core.setFailed("Failed: " + e.message);
        throw new Error(e.message);
    }
}

const toTitleCase = (phrase) => {
    return phrase
        .toLowerCase()
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
};

const getSolvedProblemArray = async (url, checkFolderArr = ['php', 'js']) => {
    const solvedProblemsArray = {};
    for (const lang of checkFolderArr) {
        const filesList = await getRequest(`${url}/${lang}/`);
        const {data = {}} = filesList;

        for (const value of data) {
            let fileName = value.name;
            let fileUrl = value.html_url;

            var rowSplit = fileName.split("--");
            var num = String(rowSplit[0].replace(/^0+/, ''));
            var leetURL = String(rowSplit[1]).replace('.' + lang, '');
            var name = toTitleCase(rowSplit[1].replace(/\-/g, ' ').replace('.' + lang, '').toUpperCase());
            if (Object.keys(solvedProblemsArray).indexOf(num) === -1) {
                solvedProblemsArray[num] = {};
                solvedProblemsArray[num]['num'] = num.padStart(4, '0');
                solvedProblemsArray[num]['name'] = name;
                solvedProblemsArray[num]['leetURL'] = leetURL;
            }
            solvedProblemsArray[num][lang] = true;
            solvedProblemsArray[num][lang + 'URL'] = fileUrl;
        }
    }
    return solvedProblemsArray;
}

(async () => {
    try {
        const username = GITHUB_REPOSITORY.split("/")[0];
        const repo = GITHUB_REPOSITORY.split("/")[1];
        const readmePath = GITHUB_REPOSITORY.split("/")[2];

        console.log(`Job begin at: ${new Date()}`);
        const lastCommits = await getRequest(`GET /repos/${username}/${repo}/commits`)
        for (const value of lastCommits.data) {
            let lastCommit = value.commit.message;
            let lastCommitDate = value.commit.author.date;
            let lastCommitUrl = value.html_url;
        }

        let solvedProblems = await getSolvedProblemArray(`GET /repos/${username}/${repo}/contents`);
        let readmeContentData = '\n' +
            '|   #   | Name  | JS   | PHP  |\n' +
            '|-------|-------|------|------|\n';
        for (const problemID in solvedProblems) {
            let row = solvedProblems[problemID];
            if (!row['js']) {
                row['jsURL'] = 'x';
            } else row['jsURL'] = '[JS](' + row['jsURL'] + ')';
            if (!row['php']) {
                row['phpURL'] = 'x';
            } else row['phpURL'] = '[PHP](' + row['phpURL'] + ')';
            let rowStr = `| ${row['num']} |   [${row['name']}](https://leetcode.com/problems/${row['leetURL']}/)   |  ${row['jsURL']}  |  ${row['phpURL']}  |\n`;
            readmeContentData += rowStr;
        }

        // Add last update time
        let currentTime = new Date();
        readmeContentData += '\n' + `<sup>Last update:  ${currentTime.toUTCString()}</sub>` + '\n';

        console.log('Get README.md.');
        const readmeTextSource = await getRequest(`GET /repos/${username}/${repo}/contents/${readmePath}`);
        const sha1 = readmeTextSource.data.sha;

        let decodedContent = Buffer.from(readmeTextSource.data.content, "base64").toString('utf8');
        readmeContentData = decodedContent.replace(/<!-- LeetCode Solutions Table -->[\s\S]*<!-- End LeetCode Solutions of Table -->/, `<!-- LeetCode Solutions Table -->${readmeContentData}<!-- End LeetCode Solutions of Table -->`);

        console.log('Update README.md.');
        await updateReadme(`PUT /repos/${username}/${repo}/contents/${readmePath}`, {
            message: '(Automated) Update README.md',
            content: Buffer.from(readmeContentData, "utf8").toString('base64'),
            sha: sha1,
        });
        console.log('Update README.md successful.');

        console.log(`Job complete at: ${new Date()}`);
    } catch (e) {
        console.error("Error occrence with error: ", e.message)
        core.setFailed("Failed: ", e.message)
    }
})()