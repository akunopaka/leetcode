const core = require("@actions/core");
const {Octokit} = require('@octokit/core');
const fs = require('fs');

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

// function get all Leetcode Problems from API or local json leetcode.problems.json file
const getLeetcodeProblemsListJsonData = async (url) => {
    url = url || 'https://leetcode.com/api/problems/all/';
    let localPathToLeetcodeProblems = '../leetcode.problems.all.json';
    // try to open file from url first https://leetcode.com/api/problems/all/
    // if not found, try to open file from local
    let leetcodeProblemsJsonData;
    console.log('Get leetcode problems. ' + url);
    try {
        res = await octokit.request(url, {
            headers: {
                'Accept': 'application/json',
            }
        });
        console.log('Get leetcode problems successful.' + url);
    } catch (e) {
        console.error("Get leetcode problems failed, with error: ", e.message);
    }
    if (res.status !== 200) {
        console.log('Get leetcode problems failed. ' + url);
        // open file from local
        // read file FS
        leetcodeProblemsJsonData = fs.readFileSync(localPathToLeetcodeProblems, 'utf8');
        // leetcodeProblemsJsonData = await new Promise((done, reject) => {
        //     fs.readFile(localPathToLeetcodeProblems, 'utf8', (err, data) => {
        //         done(data);
        //     });
        // });
    } else {
        leetcodeProblemsJsonData = res.data;
    }
    return leetcodeProblemsJsonData;
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

const getSolvedProblemArray = async (url, checkFolderArr = ['php', 'js', 'solutions']) => {
    const solvedProblemsArray = {};
    for (const lang of checkFolderArr) {
        const filesList = await getRequest(`${url}/${lang}/`);
        const {data = {}} = filesList;

        for (const value of data) {
            let fileName = value.name;
            let fileUrl = value.html_url;

            let rowSplit = fileName.split("--");
            let num = String(rowSplit[0].replace(/^0+/, ''));
            let leetURL = String(rowSplit[1]).replace('.' + lang, '');
            let name = toTitleCase(rowSplit[1].replace(/-/g, ' ').replace('.' + lang, '').toUpperCase());
            console.log(name);
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

async function getProblemMetaInfo(problemsMetaJson, problemID) {
    let res = {
        question_id: 0,
        question_title: '',
        question_title_slug: '',
        difficulty: '',
    };
    let problemMeta = null;
    if (problemsMetaJson && problemID) {
        problemMeta = await problemsMetaJson.stat_status_pairs.find(element => element.stat.frontend_question_id === parseInt(problemID));
    }
    if (!problemMeta) {
        return res;
    }
    res.question_id = problemMeta.stat.frontend_question_id;
    res.question_title = problemMeta.stat.question__title;
    res.question_title_slug = problemMeta.stat.question__title_slug;
    res.difficulty = problemMeta.difficulty.level;
    return res;
}

const getLeetCodeStats = async () => {
    try {
        const res = await octokit.request("POST https://leetcode.com/graphql", {
            query: `{ matchedUser(username: "akunopaka") { username submitStats: submitStatsGlobal { acSubmissionNum { difficulty count submissions } } } }`
        });
        if (res.status !== 200) {
            console.error("Get Request failed, with error: ", res.status);
        }
        return res;
    } catch (e) {
        console.error("Get Request failed, with error: ", e.message);
        core.setFailed("Failed: " + e.message);
        throw new Error(e.message);
    }
}

(async () => {
    try {
        const username = GITHUB_REPOSITORY.split("/")[0];
        const repo = GITHUB_REPOSITORY.split("/")[1];
        const readmePath = GITHUB_REPOSITORY.split("/")[2];

        console.log(`Job begin at: ${new Date()}`);
        // const lastCommits = await getRequest(`GET /repos/${username}/${repo}/commits`)
        // for (const value of lastCommits.data) {
        //     let lastCommit = value.commit.message;
        //     let lastCommitDate = value.commit.author.date;
        //     let lastCommitUrl = value.html_url;
        // }


        let leetCodeStat = await getLeetCodeStats();

        leetCodeStat = leetCodeStat.data.data.matchedUser.submitStats.acSubmissionNum;
        console.log(leetCodeStat);
        // let statString = "| Difficulty | Count |  \n|-------|-------|\n";
        let statString1 = "| Difficulty  | ";
        let statString2 = "| Count | ";
        for (const value of leetCodeStat) {
            statString1 += ` ${value.difficulty} |`;
            statString2 += ` ${value.count} | `;
        }
        let statString = statString1 + "\n" + statString2 + "\n";

        const problemsMetaJson = JSON.parse(await getLeetcodeProblemsListJsonData());
        // console.log(problemsMetaJson);
        console.log('Get solved problems.');

        //  variable 1= easy, 2= medium, 3= hard
        const Difficulty = {
            1: 'Easy',
            2: 'Medium',
            3: 'Hard'
        };

        let solvedProblems = await getSolvedProblemArray(`GET /repos/${username}/${repo}/contents`);
        let readmeContentData = '\n' + '|   #   | Name  | Difficulty | Solutions | JS | PHP  |\n' + '|-------|-------|-------|------|------|------|\n';
        for (const problemID in solvedProblems) {
            let problemInfoData = await getProblemMetaInfo(problemsMetaJson, problemID);

            let row = solvedProblems[problemID];
            let problemName = problemInfoData.question_title ? problemInfoData.question_title : row['name'];
            // let problemSlug = problemInfoData.question_title_slug ? problemInfoData.question_title_slug : row['leetURL'];
            let problemDifficulty = problemInfoData.difficulty ? Difficulty[problemInfoData.difficulty] : '';


            row['jsURL'] = (row['js']) ? '[JS](' + row['jsURL'] + ')' : 'x';
            row['phpURL'] = (row['php']) ? '[PHP](' + row['phpURL'] + ')' : 'x';
            row['solutionsURL'] = (row['solutions']) ? '[Git Solution](' + row['solutionsURL'] + ')' : '';

            let rowStr = `|<sup>${row['num']}</sup>|<sup>[${problemName}](https://leetcode.com/problems/${row['leetURL']}/)</sup>|<sup>\`${problemDifficulty}\`</sup>|<sup>${row['solutionsURL']}</sup>|<sup>${row['jsURL']}</sup>|<sup>${row['phpURL']}</sup>|\n`;
            readmeContentData += rowStr;
        }

        // Add last update time
        let currentTime = new Date();
        readmeContentData += '\n' + `<sup>Last update:  ${currentTime.toUTCString()}</sub>` + '\n';
        readmeContentData = '\n' + `My LeetCode Stats: \n ${statString}` + '\n' + readmeContentData;
        console.log('Get README.md.');
        const readmeTextSource = await getRequest(`GET /repos/${username}/${repo}/contents/${readmePath}`);
        const sha1 = readmeTextSource.data.sha;
        // replace Solutions Table in README.md
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
        console.error("Error occurrence with error: ", e.message)
        core.setFailed("Failed: " + e.message)
    }
})()
