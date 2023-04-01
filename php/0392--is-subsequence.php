<?php
//    392. Is Subsequence
//    https://leetcode.com/problems/is-subsequence/
//    Easy
//    Given two strings s and t, return true if s is a subsequence of t, or false otherwise.
//    A subsequence of a string is a new string that is formed from the original string by deleting some (can be none) of the characters without disturbing the relative positions of the remaining characters. (i.e., "ace" is a subsequence of "abcde" while "aec" is not).
//
//    Example 1:
//    Input: s = "abc", t = "ahbgdc"
//    Output: true
//    Example 2:
//    Input: s = "axc", t = "ahbgdc"
//    Output: false
//
//    Constraints:
//    0 <= s.length <= 100
//    0 <= t.length <= 104
//    s and t consist only of lowercase English letters.
//
//    Follow up: Suppose there are lots of incoming s, say s1, s2, ..., sk where k >= 109, and you want to check one by one to see if t has its subsequence. In this scenario, how would you change your code?


class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */

    // 3ms
//    function isSubsequence(string $s, string $t): bool
//        if($s == $t) {
//            return true;
//        }
//        $length = strlen($t);
//        for($i = 0; $i < $length; $i++){
//            if($s[0] == $t[$i]){
//                $s = substr($s, 1);
//            }
//            if($s == ''){
//                return true;
//            }
//        }
//        return false;
//    }


    function isSubsequence(string $s, string $t): bool
    {
        if ($s == $t) {
            return true;
        }
        $lengthS = strlen($s);
        $lengthT = strlen($t);
        if ($lengthS > $lengthT) {
            return false;
        }
        $j = 0;
        for ($i = 0; $i < $lengthT; $i++) {
            if ($s[$j] == $t[$i]) {
                $j++;
            }
            if ($j == $lengthS) {
                return true;
            }
        }
        return false;
    }
}


$cases = [];
$cases[0]['Input']['str1'] = 'abc';
$cases[0]['Input']['str2'] = 'ahbgdc';
$cases[0]['Output'] = true;

$cases[1]['Input']['str1'] = 'axc';
$cases[1]['Input']['str2'] = 'ahbgdc';
$cases[1]['Output'] = false;


$run = new Solution();
foreach ($cases as $case) {
    $result = $run->isSubsequence($case['Input']['str1'], $case['Input']['str2']);
    printResult($result, $case);
}




