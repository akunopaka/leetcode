<?php
// 2390. Removing Stars From a String
// https://leetcode.com/problems/removing-stars-from-a-string/description/
// Medium
//
//   My Solution on LeetCode:
//   https://leetcode.com/discuss/topic/3402285/phpjavascript-beats-100/
//
//     You are given a string s, which contains stars *.
//     In one operation, you can:
//     Choose a star in s.
//     Remove the closest non-star character to its left, as well as remove the star itself.
//     Return the string after all stars have been removed.
//     Note:
//     The input will be generated such that the operation is always possible.
//     It can be shown that the resulting string will always be unique.
//
//     Example 1:
//     Input: s = "leet**cod*e"
//     Output: "lecoe"
//     Explanation: Performing the removals from left to right:
//     - The closest character to the 1st star is 't' in "leet**cod*e". s becomes "lee*cod*e".
//     - The closest character to the 2nd star is 'e' in "lee*cod*e". s becomes "lecod*e".
//     - The closest character to the 3rd star is 'd' in "lecod*e". s becomes "lecoe".
//     There are no more stars, so we return "lecoe".
//     Example 2:
//     Input: s = "erase*****"
//     Output: ""
//     Explanation: The entire string is removed, so we return an empty string.
//
//     Constraints:
//     1 <= s.length <= 105
//     s consists of lowercase English letters and stars *.
//     The operation above can be performed on s.


class Solution
{

    /**
     * @param String $s
     * @return String
     */
    function removeStars(string $s): string {
        $backspaceCount = 0;
        $result = '';
        $sLength = strlen($s);
        for ($i = $sLength; $i--;) {
            if ($s[$i] === "*") {
                $backspaceCount++;
            } elseif ($backspaceCount > 0) {
                $backspaceCount--;
            } else {
                $result = $s[$i] . $result;
            }
        }
        return $result;
    }
}