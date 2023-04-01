// 205. Isomorphic Strings
// https://leetcode.com/problems/isomorphic-strings
// Easy
// Given two strings s and t, determine if they are isomorphic.
// Two strings s and t are isomorphic if the characters in s can be replaced to get t.
// All occurrences of a character must be replaced with another character while preserving the order of characters.
// No two characters may map to the same character, but a character may map to itself.
//
// Example 1:
// Input: s = "egg", t = "add"
// Output: true
// Example 2:
// Input: s = "foo", t = "bar"
// Output: false
// Example 3:
// Input: s = "paper", t = "title"
// Output: true
//
// Constraints:
// 1 <= s.length <= 5 * 104
// t.length == s.length
// s and t consist of any valid ascii character.
var isIsomorphic = function (s, t) {
    for (var i = 0; i < s.length; i++) {
        if (s.indexOf(s[i]) !== t.indexOf(t[i])) return false;
    }
    return true;
};

// OR
var isIsomorphic = function (s, t) {
    if (s.length !== t.length) return false;
    let mapS = {};
    let mapT = {};
    for (let i = 0; i < s.length; i++) {
        if (mapS[s[i]] === undefined) {
            mapS[s[i]] = t[i];
        } else {
            if (mapS[s[i]] !== t[i]) return false;
        }
        if (mapT[t[i]] === undefined) {
            mapT[t[i]] = s[i];
        } else {
            if (mapT[t[i]] !== s[i]) return false;
        }
    }
    return true;
};