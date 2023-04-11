//  14. Longest Common Prefix
//  https://leetcode.com/problems/longest-common-prefix/
//  Easy
//  
//    Write a function to find the longest common prefix string amongst an array of strings.
//    If there is no common prefix, return an empty string "".
//    Example 1:
//    Input: strs = ["flower","flow","flight"]
//    Output: "fl"
//    Example 2:
//    Input: strs = ["dog","racecar","car"]
//    Output: ""
//    Explanation: There is no common prefix among the input strings.
//    Constraints:
//    1 &lt;= strs.length &lt;= 200
//    0 &lt;= strs[i].length &lt;= 200
//    strs[i] consists of only lowercase English letters.

/**
 * @param {string[]} strs
 * @return {string}
 */
var longestCommonPrefix1 = function (strs) {
    let res = '';
    if (strs.length === 0) return "";
    if (strs.length === 1) return strs[0];
    for (let i = 0; i < strs[0].length; i++) {
        for (let j = 1; j < strs.length; j++) {
            if (strs[j][i] !== strs[0][i]) {
                return res;
            }
        }
        res += strs[0][i];
    }
    return res;
};
var longestCommonPrefix = function (strs) {
    strs.sort();
    let res = '';
    if (strs.length === 0) return "";
    if (strs.length === 1) return strs[0];
    for (let i = 0; i < strs[0].length; i++) {
        if (strs[strs.length - 1][i] !== strs[0][i]) {
            return res;
        }
        res += strs[0][i];
    }
    return res;
}

var longestCommonPrefix______3 = function (strs) {
    let prefix = strs[0];
    let i = 1;
    while (i < strs.length) {
        if (!strs[i].startsWith(prefix)) {
            prefix = prefix.slice(0, -1);
        } else {
            i++;
        }
    }
    return prefix;
};


let strs1 = ["flower", "flow", "flight"];
let strs = ["dog", "racecar", "car"];
strs.sort();
console.log(strs);
console.log(longestCommonPrefix(strs1));
