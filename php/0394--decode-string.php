<?php
// 394. Decode String
// https://leetcode.com/problems/decode-string/
// Medium
//     Given an encoded string, return its decoded string.
//     The encoding rule is: k[encoded_string], where the encoded_string inside the square brackets is being repeated exactly k times. Note that k is guaranteed to be a positive integer.
//     You may assume that the input string is always valid; there are no extra white spaces, square brackets are well-formed, etc. Furthermore, you may assume that the original data does not contain any digits and that digits are only for those repeat numbers, k. For example, there will not be input like 3a or 2[4].
//     The test cases are generated so that the length of the output will never exceed 105.
//
//         Example 1:
//         Input: s = "3[a]2[bc]"
//         Output: "aaabcbc"
//         Example 2:
//         Input: s = "3[a2[c]]"
//         Output: "accaccacc"
//         Example 3:
//         Input: s = "2[abc]3[cd]ef"
//         Output: "abcabccdcdcdef"
//
//     Constraints:
//     1 <= s.length <= 30
//     s consists of lowercase English letters, digits, and square brackets '[]'.
//     s is guaranteed to be a valid input.
//     All the integers in s are in the range [1, 300].

class Solution
{
    /**
     * @param String $s
     * @return String
     */
    function decodeString(string $s): string {
        do $s = preg_replace_callback('/(\d+)\[([a-z]+)\]/', fn($match) => str_repeat($match[2], $match[1]), $s, -1, $count);
        while ($count > 0);
        return preg_replace('/(\d+)/', '', $s);
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['s'] = "100[leetcode]";
$cases[0]['expectedOutput'] = "leetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcodeleetcode";
$cases[1]['Input']['s'] = "3[a2[c]]";
$cases[1]['expectedOutput'] = "accaccacc";
$cases[2]['Input']['s'] = "2[abc]3[cd]ef";
$cases[2]['expectedOutput'] = "abcabccdcdcdef";
$cases[3]['Input']['s'] = "3[a]2[bc]";
$cases[3]['expectedOutput'] = "aaabcbc";
$cases[4]['Input']['s'] = "3";
$cases[4]['expectedOutput'] = "";


// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->decodeString($case['Input']['s']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo PHP_EOL . '<pre>' . '--------' . PHP_EOL . 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL;
    if ($result != $expectedOutput) {
        echo 'FAIL!!!' . PHP_EOL;
        echo PHP_EOL . 'Valid/Expected Output is:' . PHP_EOL;
        var_export($expectedOutput);
    } else echo 'OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}

