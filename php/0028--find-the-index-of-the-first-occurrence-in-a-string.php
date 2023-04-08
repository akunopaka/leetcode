<?php
// 28. Find the Index of the First Occurrence in a String
// https://leetcode.com/problems/find-the-index-of-the-first-occurrence-in-a-string/
// Medium
// Given two strings needle and haystack, return the index of the first occurrence of needle in haystack, or -1 if needle is not part of haystack.
//
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

// Solution #1 - Built-in function strpos()
//Use the strpos() Built-in function to find the position of the substring in the string. If the substring is not found, return -1.
//
//Solution #2 - Find Substring Position with Regex
//Create a pattern based on the needle and use preg_match() function to compare the haystack and needle and return the index position. If the substring is not found, return -1.
//
//Solution #3 - Brute Force Substring Search
//Create a loop to iterate through the haystack and compare the substrings of the haystack and needle using the substr() function. Return the index position of the needle or -1 if not found.
//
//Solution #4 - Tracking Loop Search - Time: O(N), Space: O(1)
//Loop through the haystack string and compare each character of the substring to the corresponding character in the haystack. If all characters match, the index is returned. If the substring is not found, return -1.
//
//Solution #5 - KMP - Time: O(N+M) | KMP - Knuth-Morris-Pratt String Matching Algorithm
//Preprocess the needle to form an array to store the occurs before.
//Loop through the haystack and compare with needle. If mismatch occurs, move the haystack index by the occurs before array.
//https://en.wikipedia.org/wiki/Knuth–Morris–Pratt_algorithm


class Solution
{
    /**
     * @param String $haystack
     * @param String $needle
     * @return Integer
     */
    function strStr(string $haystack, string $needle): int {
        // Solution #1 - Built-in function
        $pos = strpos($haystack, $needle);
        return $pos === false ? -1 : $pos;


        // Solution #2 - Regular Expression
        $pattern = '/' . $needle . '/';
        $result = preg_match($pattern, $haystack, $matches, PREG_OFFSET_CAPTURE);
        return $result ? $matches[0][1] : -1;


        // Solution #3 - Loop through haystack and compare substrings
        $haystackLength = strlen($haystack);
        $needleLength = strlen($needle);
        if ($haystackLength < $needleLength) return -1;

        for ($i = 0; $i <= $haystackLength - $needleLength; $i++) {
            if (substr($haystack, $i, $needleLength) == $needle) return $i;
        }
        return -1;


        // Solution #4 - Loop through haystack and compare characters one by one - no substr or strpos used
        $haystackLength = strlen($haystack);
        $needleLength = strlen($needle);
        if ($haystackLength < $needleLength) return -1;

        $matchingIndex = 0;
        for ($i = 0; $i < $haystackLength; $i++) {
            if ($needle[$i - $matchingIndex] != $haystack[$i]) {
                $i = $matchingIndex;
                $matchingIndex = $i + 1;
            } elseif (($i - $matchingIndex) == ($needleLength - 1)) {
                return $matchingIndex;
            }
        }
        return -1;


        // Solution #5 -- KMP - Knuth-Morris-Pratt String Matching Algorithm
        $haystackLength = strlen($haystack);
        $needleLength = strlen($needle);
        if ($needleLength == 0) return 0;
        if ($haystackLength < $needleLength) return -1;

        // LPS - Longest Prefix Suffix / Prefix table https://iq.opengenus.org/prefix-table-lps/
        $lps = array_fill(0, $needleLength, 0);
        $prevLPS = 0;
        $i = 1;
        while ($i < $needleLength) {
            if ($needle[$i] == $needle[$prevLPS]) {
                $lps[$i] = $prevLPS + 1;
                $prevLPS++;
                $i++;
            } elseif ($prevLPS == 0) {
                $lps[$i] = 0;
                $i++;
            } else {
                $prevLPS = $lps[$prevLPS - 1];
            }
        }

        $i = 0; // for haystack
        $j = 0; // for needle
        while ($i < $haystackLength) {
            if ($haystack[$i] == $needle[$j]) {
                $i++;
                $j++;
            } else {
                if ($j == 0) {
                    $i++;
                } else {
                    $j = $lps[$j - 1];
                }
            }
            if ($j == $needleLength) {
                return $i - $needleLength;
            }
        }
        return -1;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['haystack'] = 'sadbutsad';
$cases[0]['Input']['needle'] = 'sad';
$cases[0]['expectedOutput'] = 0;
$cases[1]['Input']['haystack'] = 'leetcode';
$cases[1]['Input']['needle'] = 'leeto';
$cases[1]['expectedOutput'] = -1;
$cases[2]['Input']['haystack'] = 'a';
$cases[2]['Input']['needle'] = 'a';
$cases[2]['expectedOutput'] = 0;

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->strStr($case['Input']['haystack'], $case['Input']['needle']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}