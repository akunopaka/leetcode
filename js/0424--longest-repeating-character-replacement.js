// 424. Longest Repeating Character Replacement
// https://leetcode.com/problems/longest-repeating-character-replacement/
// Medium
//     You are given a string s and an integer k. You can choose any character of the string and change it to any other uppercase English character. You can perform this operation at most k times.
//     Return the length of the longest substring containing the same letter you can get after performing the above operations.
//
//     Example 1:
//     Input: s = "ABAB", k = 2
//     Output: 4
//     Explanation: Replace the two 'A's with two 'B's or vice versa.
//     Example 2:
//     Input: s = "AABABBA", k = 1
//     Output: 4
//     Explanation: Replace the one 'A' in the middle with 'B' and form "AABBBBA".
//     The substring "BBBB" has the longest repeating letters, which is 4.
//     Constraints:
//     1 <= s.length <= 105
//     s consists of only uppercase English letters.
//     0 <= k <= s.length

/**
 * @param {string} s
 * @param {number} k
 * @return {number}
 */
var characterReplacement = function (s, k) {
    const length = s.length;
    let dic = {};
    let leftIndex = 0;
    let max = 0;
    let longest = 0;
    for (let rightIndex = 0; rightIndex < length; rightIndex++) {
        const char = s[rightIndex];
        // (dic[char] === undefined) ? dic[char] = 1 : dic[char]++;
        dic[char] ? dic[char]++ : dic[char] = 1;
        if (dic[char] > max) max = dic[char];

        while ((rightIndex - leftIndex + 1 - max) > k) {
            dic[s[leftIndex]]--;
            leftIndex++;
        }
        longest = Math.max(longest, rightIndex - leftIndex + 1);
    }
    return longest
};

let res = characterReplacement('ACABABBA', 2);
console.log(res);