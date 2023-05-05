//  1456. Maximum Number of Vowels in a Substring of Given Length
//  https://leetcode.com/problems/maximum-number-of-vowels-in-a-substring-of-given-length/
//  Medium
//  
//    Given a string s and an integer k, return the maximum number of vowel letters in any substring of s with length k.
//    Vowel letters in English are 'a', 'e', 'i', 'o', and 'u'.
//    Example 1:
//    Input: s = "abciiidef", k = 3
//    Output: 3
//    Explanation: The substring "iii" contains 3 vowel letters.
//    Example 2:
//    Input: s = "aeiou", k = 2
//    Output: 2
//    Explanation: Any substring of length 2 contains 2 vowels.
//    Example 3:
//    Input: s = "leetcode", k = 3
//    Output: 2
//    Explanation: "lee", "eet" and "ode" contain 2 vowels.
//    Constraints:
//    1 &lt;= s.length &lt;= 105
//    s consists of lowercase English letters.
//    1 &lt;= k &lt;= s.length


/**
 * @param {string} s
 * @param {number} k
 * @return {number}
 */
var maxVowels = function (s, k) {
    let maxVowelsResult = 0;
    // const vowels = ['a', 'e', 'i', 'o', 'u'];
    const isVowel = s => s === 'a' || s === 'e' || s === 'i' || s === 'o' || s === 'u';

    // use sliding window
    let left = 0;
    let right = 0;
    let currentVowels = 0;

    while (right < s.length) {
        // if (vowels.includes(s[right])) {
        if (isVowel(s[right])) {
            currentVowels++;
        }
        if (right - left + 1 === k) {
            maxVowelsResult = Math.max(maxVowelsResult, currentVowels);
            // if (vowels.includes(s[left])) {
            if (isVowel(s[left])) {
                currentVowels--;
            }
            left++;
        }
        right++;
    }

    return maxVowelsResult;
};