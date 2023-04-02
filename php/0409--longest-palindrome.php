<?php
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
class Solution
{
    /**
     * @param String $s
     * @return Integer
     */
    function longestPalindrome(string $string): int {
        $longestPalindrome = 0;
        foreach (count_chars($string) as $val) {
            $longestPalindrome += floor($val / 2) * 2;
            if ($longestPalindrome % 2 == 0 && $val % 2 == 1) {
                $longestPalindrome++;
            }
        }
        return (int)$longestPalindrome;
    }

    function longestPalindrome___2(string $s): int {
        $length = strlen($s);
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[$s[$i]]++;
        }
        $result = 0;
        $hasOdd = false;
        foreach ($arr as $key => $value) {
            if ($value % 2 == 0) {
                $result += $value;
            } else {
                $hasOdd = true;
                $result += $value - 1;
            }
        }
        if ($hasOdd) {
            $result++;
        }
        return $result;
    }
}


$cases = [];
$cases[0]['Input']['str1'] = 'abccccdd';
$cases[0]['Output'] = 7;

$cases[1]['Input']['str1'] = 'a';
$cases[1]['Output'] = 1;

$cases[2]['Input']['str1'] = 'abcdaaa';
$cases[2]['Output'] = 3;

$run = new Solution();
foreach ($cases as $case) {
    $result = $run->longestPalindrome($case['Input']['str1']);
    printResult($result, $case);
}


function printResult($result, $case) {
    echo '<pre>' . '--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    var_export($case['Output']);
    echo '</pre>' . PHP_EOL;
}