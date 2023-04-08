// 28. Find the Index of the First Occurrence in a String
// https://leetcode.com/problems/find-the-index-of-the-first-occurrence-in-a-string/
// Medium
//
//   My Solution on LeetCode:
//   https://leetcode.com/problems/find-the-index-of-the-first-occurrence-in-a-string/solutions/3253386/javascript-php-6-solutions-with-explanation-simple-and-understandable/
//
// Given two strings needle and haystack, return the index of the first occurrence of needle in haystack, or -1 if needle is not part of haystack.
//Example 1:
//Input: haystack = "sadbutsad", needle = "sad"
//Output: 0
//Explanation: "sad" occurs at index 0 and 6.
//The first occurrence is at index 0, so we return 0.
//Example 2:
//Input: haystack = "leetcode", needle = "leeto"
//Output: -1
//Explanation: "leeto" did not occur in "leetcode", so we return -1.
//
//Constraints:
//1 <= haystack.length, needle.length <= 104
//haystack and needle consist of only lowercase English characters.
//

// STRING MATCHING ALGORITHMS
// http://www-igm.univ-mlv.fr/~lecroq/string/index.html

// Solution #1 - Built-in function strpos()
// Use the strpos() Built-in function to find the position of the substring in the string. If the substring is not found, return -1.
//
// Solution #2 - Find Substring Position with Regex
// Create a pattern based on the needle and use preg_match() function to compare the haystack and needle and return the index position. If the substring is not found, return -1.
//
// Solution #3 - Brute Force
// Loop through the haystack. For each character, loop through the needle and compare. If they are all equal, return the index of the haystack
//
// Solution #4 - Brute Force Substring Search
// Create a loop to iterate through the haystack and compare the substrings of the haystack and needle using the substr() function. Return the index position of the needle or -1 if not found.
//
// Solution #5 - Tracking Loop Search - Time: O(N), Space: O(1)
// Loop through the haystack string and compare each character of the substring to the corresponding character in the haystack. If all characters match, the index is returned. If the substring is not found, return -1.
//
// Solution #6 - KMP - Time: O(N+M) | KMP - Knuth-Morris-Pratt String Matching Algorithm
// Preprocess the needle to form an array to store the occurs before.
// Loop through the haystack and compare with needle. If mismatch occurs, move the haystack index by the occurs before array.
// https://en.wikipedia.org/wiki/Knuth–Morris–Pratt_algorithm


//
/**
 * Solution #1 - Built-in function
 *
 * @param {string} haystack
 * @param {string} needle
 * @return {number}
 */
var strStr = function (haystack, needle) {
    return haystack.indexOf(needle);
};

/**
 * Solution #2 - RegExp
 *
 * @param {string} haystack
 * @param {string} needle
 * @return {number}
 */
var strStr = function (haystack, needle) {
    const regex = new RegExp(needle);
    return haystack.search(regex);
};

/**
 * Solution #3 - Brute Force - Time: O(N*M), Space: O(1)
 * Loop through the haystack. For each character, loop through the needle and compare.
 * If they are all equal, return the index of the haystack
 *
 * @param {string} haystack
 * @param {string} needle
 * @return {number}
 */
var strStr = function (haystack, needle) {
    if (!needle) return 0;
    for (let i = 0; i < haystack.length; i++) {
        let isMatch = true;
        for (let j = 0; j < needle.length; j++) {
            if (haystack[i + j] !== needle[j]) {
                isMatch = false;
                break;
            }
        }
        if (isMatch) return i;
    }
    return -1;
};

/**
 * Solution #4 - Loop through haystack and compare substrings - Time: O(N), Space: O(1)
 * Loop through the haystack. For each character, loop through the needle and compare.
 * If they are all equal, return the index of the haystack
 *
 * @param {string} haystack
 * @param {string} needle
 * @return {number}
 */
var strStr = function (haystack, needle) {
    let haystackLength = haystack.length;
    let needleLength = needle.length;
    if (haystackLength < needleLength) return -1;

    for (let i = 0; i <= haystackLength - needleLength; i++) {
        if (haystack.substr(i, needleLength) === needle) return i;
    }
    return -1;
};

/**
 * Solution #5 - Loop through haystack and compare characters one by one - Time: O(N), Space: O(1)
 * Loop through the haystack string and compare each character of the substring to the corresponding character in the haystack. If all characters match, the index is returned. If the substring is not found, return -1.
 *
 * @param {string} haystack
 * @param {string} needle
 * @return {number}
 */
var strStr = function (haystack, needle) {
    let haystackLength = haystack.length;
    let needleLength = needle.length;
    if (haystackLength < needleLength) return -1;

    let matchingIndex = 0;
    for (let i = 0; i < haystackLength; i++) {
        if (needle[i - matchingIndex] !== haystack[i]) {
            i = matchingIndex;
            matchingIndex = i + 1;
        } else if (i - matchingIndex == needleLength - 1) {
            return matchingIndex;
        }
    }
    return -1;
};

/**
 * Solution #6: KMP - Time: O(N+M) | KMP - Knuth-Morris-Pratt String Matching Algorithm
 * Preprocess the needle to form an array to store the occurs before.
 * Loop through the haystack and compare with needle.
 * If mismatch occurs, move the haystack index by the occurs before array.
 *
 * Explanation
 * https://www.youtube.com/watch?v=JoF0Z7nVSrA
 *
 * @param {string} haystack
 * @param {string} needle
 * @return {number}
 */
var strStr = function (haystack, needle) {
    const needleLength = needle.length;
    let i = 0, j = -1;

    // LPS - Longest Prefix Suffix / Prefix table https://iq.opengenus.org/prefix-table-lps/
    const lps = [-1];
    while (i < needleLength - 1) {
        if (j === -1 || needle[i] === needle[j]) {
            i++;
            j++;
            lps[i] = j;
        } else {
            j = lps[j];
        }
    }

    i = 0, j = 0;
    while (i < haystack.length && j < needleLength) {
        if (haystack[i] === needle[j]) {
            i++;
            j++;
        } else {
            j = lps[j];
            if (j < 0) {
                i++;
                j++;
            }
        }
    }
    if (j === needleLength) {
        return i - j;
    }
    return -1;
}


//
//
// var strStr = function (haystack, needle) {
//     let haystackLength = haystack.length;
//     let needleLength = needle.length;
//     if (needleLength === 0) return 0;
//     if (haystackLength < needleLength) return -1;
//
//     // LPS - Longest Prefix Suffix / Prefix table https://iq.opengenus.org/prefix-table-lps/
//     let lps = [];
//     for (let i = 0; i < needleLength; i++) lps.push(0);
//     let prevLPS = 0;
//     let i = 1;
//     while (i < needleLength) {
//         if (needle[i] === needle[prevLPS]) {
//             lps[i] = prevLPS + 1;
//             prevLPS++;
//             i++;
//         } else if (prevLPS === 0) {
//             lps[i] = 0;
//             i++;
//         } else {
//             prevLPS = lps[prevLPS - 1];
//         }
//     }
//
//     i = 0; // for haystack
//     j = 0; // for needle
//     while (i < haystackLength) {
//         if (haystack[i] === needle[j]) {
//             i++;
//             j++;
//         } else {
//             if (j === 0) {
//                 i++;
//             } else {
//                 j = lps[j - 1];
//             }
//         }
//         if (j === needleLength) {
//             return i - needleLength;
//         }
//     }
//     return -1;
// };