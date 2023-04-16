//  1639. Number of Ways to Form a Target String Given a Dictionary
//  https://leetcode.com/problems/number-of-ways-to-form-a-target-string-given-a-dictionary/
//  Hard
//  
//    You are given a list of strings of the same length words and a string target.
//    Your task is to form target using the given words under the following rules:
//    target should be formed from left to right.
//    To form the ith character (0-indexed) of target, you can choose the kth character of the jth string in words if target[i] = words[j][k].
//    Once you use the kth character of the jth string of words, you can no longer use the xth character of any string in words where x &lt;= k. In other words, all characters to the left of or at index k become unusuable for every string.
//    Repeat the process until you form the string target.
//    Notice that you can use multiple characters from the same string in words provided the conditions above are met.
//    Return the number of ways to form target from words. Since the answer may be too large, return it modulo 109 + 7.
//    Example 1:
//    Input: words = ["acca","bbbb","caca"], target = "aba"
//    Output: 6
//    Explanation: There are 6 ways to form target.
//    "aba" -&gt; index 0 ("acca"), index 1 ("bbbb"), index 3 ("caca")
//    "aba" -&gt; index 0 ("acca"), index 2 ("bbbb"), index 3 ("caca")
//    "aba" -&gt; index 0 ("acca"), index 1 ("bbbb"), index 3 ("acca")
//    "aba" -&gt; index 0 ("acca"), index 2 ("bbbb"), index 3 ("acca")
//    "aba" -&gt; index 1 ("caca"), index 2 ("bbbb"), index 3 ("acca")
//    "aba" -&gt; index 1 ("caca"), index 2 ("bbbb"), index 3 ("caca")
//    Example 2:
//    Input: words = ["abba","baab"], target = "bab"
//    Output: 4
//    Explanation: There are 4 ways to form target.
//    "bab" -&gt; index 0 ("baab"), index 1 ("baab"), index 2 ("abba")
//    "bab" -&gt; index 0 ("baab"), index 1 ("baab"), index 3 ("baab")
//    "bab" -&gt; index 0 ("baab"), index 2 ("baab"), index 3 ("baab")
//    "bab" -&gt; index 1 ("abba"), index 2 ("baab"), index 3 ("baab")
//    Constraints:
//    1 &lt;= words.length &lt;= 1000
//    1 &lt;= words[i].length &lt;= 1000
//    All strings in words have the same length.
//    1 &lt;= target.length &lt;= 1000
//    words[i] and target contain only lowercase English letters.

/**
 * @param {string[]} words
 * @param {string} target
 * @return {number}
 */
var numWays = function (words, target) {
    const mod = 1e9 + 7;
    const result = new Array(target.length + 1).fill(0);
    result[0] = 1;

    for (let i = 0; i < words[0].length; i++) {
        let count = new Array(26).fill(0);
        for (let word of words) {
            count[word.charCodeAt(i) - 97]++;
        }
        for (let j = target.length - 1; j >= 0; --j) {
            result[j + 1] += result[j] * count[target.charCodeAt(j) - 97] % mod;
        }
    }
    return result[target.length] % mod;
};