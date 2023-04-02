//    409. Longest Palindrome
//    https://leetcode.com/problems/longest-palindrome/description/
//    Easy
//    Given a string s which consists of lowercase or uppercase letters, return the length of the longest palindrome that can be built with those letters.
//    Letters are case sensitive, for example, "Aa" is not considered a palindrome here.
//
//    Example 1:
//    Input: s = "abccccdd"
//    Output: 7
//    Explanation: One longest palindrome that can be built is "dccaccd", whose length is 7.
//    Example 2:
//    Input: s = "a"
//    Output: 1
//    Explanation: The longest palindrome that can be built is "a", whose length is 1.
//    Constraints:
//    1 <= s.length <= 2000
//    s consists of lowercase and/or uppercase English letters only.

var longestPalindrome = function (s) {
    let t = 0;
    let chars = {};
    for (let i = 0; i < s.length; i++) {
        if (chars[s[i]]) {
            chars[s[i]]++;
        } else {
            chars[s[i]] = 1;
        }
    }
    for (let val in chars) {
        t += Math.floor(chars[val] / 2) * 2;
        if (t % 2 == 0 && chars[val] % 2 == 1) {
            t++;
        }
    }
    return parseInt(t);
};