<?php
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


class Solution
{

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix____2($strs) {
        $prefix = '';
        $strsCount = count($strs);
        if ($strsCount == 0) return $prefix;
        $strsLength = strlen($strs[0]);
        for ($i = 0; $i < $strsLength; $i++) {
            $char = $strs[0][$i];
            for ($j = 1; $j < $strsCount; $j++) {
                if ($strs[$j][$i] != $char) {
                    return $prefix;
                }
            }
            $prefix .= $char;
        }
        return $prefix;
    }

    function longestCommonPrefix($strs) {
        $strsCount = count($strs);
        if ($strsCount == 0) return '';

        $prefix = $strs[0];
        for ($i = 1; $i < $strsCount; $i++) {
            while (!str_starts_with($strs[$i], $prefix)) {
                $prefix = substr($prefix, 0, -1);
                if ($prefix == '') return '';
            }
        }
        return $prefix;
    }

}