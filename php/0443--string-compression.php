<?php
// 443. String Compression
// https://leetcode.com/problems/string-compression/
// Medium
//
//    Given an array of characters chars, compress it using the following algorithm:
//    Begin with an empty string s. For each group of consecutive repeating characters in chars:
//    If the group's length is 1, append the character to s.
//    Otherwise, append the character followed by the group's length.
//    The compressed string s should not be returned separately, but instead, be stored in the input character array chars. Note that group lengths that are 10 or longer will be split into multiple characters in chars.
//    After you are done modifying the input array, return the new length of the array.
//    You must write an algorithm that uses only constant extra space.
//
//    Example 1:
//    Input: chars = ["a","a","b","b","c","c","c"]
//    Output: Return 6, and the first 6 characters of the input array should be: ["a","2","b","2","c","3"]
//    Explanation: The groups are "aa", "bb", and "ccc". This compresses to "a2b2c3".
//    Example 2:
//    Input: chars = ["a"]
//    Output: Return 1, and the first character of the input array should be: ["a"]
//    Explanation: The only group is "a", which remains uncompressed since it's a single character.
//    Example 3:
//    Input: chars = ["a","b","b","b","b","b","b","b","b","b","b","b","b"]
//    Output: Return 4, and the first 4 characters of the input array should be: ["a","b","1","2"].
//    Explanation: The groups are "a" and "bbbbbbbbbbbb". This compresses to "ab12".
//
//    Constraints:
//    1 <= chars.length <= 2000
//    chars[i] is a lowercase English letter, uppercase English letter, digit, or symbol.

class Solution
{
    /**
     * @param String[] $chars
     * @return Integer
     */

    // My solution
    function compress1(array &$chars): int {
        if (count($chars) < 2) return count($chars);
        $countIndex = 0;
        $count = 0;
        foreach ($chars as $i => $char) {
            if ($i == 0) {
                $prev = $char;
                continue;
            }
            if ($char == $prev) {
                if ($countIndex == 0) {
                    $countIndex = $i;
                    $chars[$countIndex] = (string)'2';
                    $count = 2;
                } else {
                    if (count(str_split($count)) == count(str_split($count++))) {
                        unset($chars[$i]);
                    }
                    $j = 0;
                    foreach (str_split($count) as $digit) {
                        $chars[$countIndex + $j++] = (string)$digit;
                    }
                }
            } else {
                $countIndex = 0;
                $count = 0;
                $prev = $char;
            }
        }
        ksort($chars);
        return count($chars);
    }

    // #2 solution
    function compress(array &$chars): int {
        $s = '';
        $count = 1;
        $char = $chars[0];
        $len = count($chars);
        for ($i = 1; $i < $len; $i++) {
            if ($chars[$i] == $char) {
                $count++;
            } else {
                $s .= $char;
                if ($count > 1) $s .= $count;
                $char = $chars[$i];
                $count = 1;
            }
        }
        $s .= $char;
        if ($count > 1) $s .= $count;
        $chars = str_split($s);
        return count($chars);
    }
}


// Test Cases
$cases = [];
//$cases[0]['Input']['chars'] = ["a", "a", "b", "b", "c", "c", "c"];
//$cases[0]['expectedOutput'] = 6;
//$cases[1]['Input']['chars'] = ["a"];
//$cases[1]['expectedOutput'] = 1;
//$cases[2]['Input']['chars'] = ["a", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b"];
//$cases[2]['expectedOutput'] = 4;
$cases[3]['Input']['chars'] = ["a", "a", "a", "a", "a", "a", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "b", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c"];
$cases[3]['expectedOutput'] = 8;
//$cases[3]['expectedOutput']['expectedarray'] = ["a", "6", "b", "2", "1", "c", "1", "4"];
// $cases[4]['Input']['chars'] = '';
// $cases[4]['Input'][''] = '';
// $cases[4]['expectedOutput'] = '';


// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->compress($case['Input']['chars']);
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
    echo PHP_EOL . '<pre>' . '-------' . PHP_EOL . 'Result:' . PHP_EOL;
    var_export($result);
    if ($result != $expectedOutput) {
        echo PHP_EOL . '!!! >>FAIL<< !!!';
        echo PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL;
        var_export($expectedOutput);
    } else echo ' << OK!' . PHP_EOL;
    echo '</pre>';
}