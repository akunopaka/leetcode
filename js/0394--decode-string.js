// 394. Decode String
// https://leetcode.com/problems/decode-string/
// Medium
//     Given an encoded string, return its decoded string.
//     The encoding rule is: k[encoded_string], where the encoded_string inside the square brackets is being repeated exactly k times. Note that k is guaranteed to be a positive integer.
//     You may assume that the input string is always valid; there are no extra white spaces, square brackets are well-formed, etc. Furthermore, you may assume that the original data does not contain any digits and that digits are only for those repeat numbers, k. For example, there will not be input like 3a or 2[4].
//     The test cases are generated so that the length of the output will never exceed 105.
//
//         Example 1:
//         Input: s = "3[a]2[bc]"
//         Output: "aaabcbc"
//         Example 2:
//         Input: s = "3[a2[c]]"
//         Output: "accaccacc"
//         Example 3:
//         Input: s = "2[abc]3[cd]ef"
//         Output: "abcabccdcdcdef"
//
//     Constraints:
//     1 <= s.length <= 30
//     s consists of lowercase English letters, digits, and square brackets '[]'.
//     s is guaranteed to be a valid input.
//     All the integers in s are in the range [1, 300].

/**
 * @param {string} s
 * @return {string}
 */
var decodeString = function (s) {
    let stack = [];
    let num = 0;
    let str = '';
    for (let i = 0; i < s.length; i++) {
        let c = s[i];
        if (c === '[') {
            stack.push(str);
            stack.push(num);
            num = 0;
            str = '';
        } else if (c === ']') {
            let n = stack.pop();
            let prevStr = stack.pop();
            str = prevStr + str.repeat(n);
        } else if (c >= '0' && c <= '9') {
            num = num * 10 + Number(c);
        } else {
            str += c;
        }
    }
    return str;
};