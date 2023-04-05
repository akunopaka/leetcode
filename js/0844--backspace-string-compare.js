// 844. Backspace String Compare
// https://leetcode.com/problems/backspace-string-compare/
// Easy
//    Given two strings s and t, return true if they are equal when both are typed into empty text editors. '#' means a backspace character.
//    Note that after backspacing an empty text, the text will continue empty.
//
//    Example 1:
//    Input: s = "ab#c", t = "ad#c"
//    Output: true
//    Explanation: Both s and t become "ac".
//    Example 2:
//    Input: s = "ab##", t = "c#d#"
//    Output: true
//    Explanation: Both s and t become "".
//    Example 3:
//    Input: s = "a#c", t = "b"
//    Output: false
//    Explanation: s becomes "c" while t becomes "b".
//
//    Constraints:
//    1 <= s.length, t.length <= 200
//    s and t only contain lowercase letters and '#' characters.
//    Follow up: Can you solve it in O(n) time and O(1) space?

/**
 * @param {string} s
 * @param {string} t
 * @return {boolean}
 */
var backspaceCompare = function (s, t) {
    // Create a function that takes a string and returns a new string with backspaces removed
    function backspacing(str) {
        let result = '';
        let backspaces = 0;

        for (let i = str.length - 1; i >= 0; i -= 1) {
            if (str[i] === '#') {
                backspaces += 1;
            } else if (backspaces > 0) {
                backspaces -= 1;
            } else {
                result = str[i] + result;
            }
        }
        return result;
    }

    return backspacing(s) === backspacing(t);
};