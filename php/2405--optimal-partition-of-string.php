<?php
// 2405. Optimal Partition of String
// https://leetcode.com/problems/optimal-partition-of-string/
// Medium
// Given a string s, partition the string into one or more substrings such that the characters in each substring are unique. That is, no letter appears in a single substring more than once.
// Return the minimum number of substrings in such a partition.
// Note that each character should belong to exactly one substring in a partition.
//
// Example 1:
// Input: s = "abacaba"
// Output: 4
// Explanation:
// Two possible partitions are ("a","ba","cab","a") and ("ab","a","ca","ba").
// It can be shown that 4 is the minimum number of substrings needed.
// Example 2:
// Input: s = "ssssss"
// Output: 6
// Explanation:
// The only valid partition is ("s","s","s","s","s","s").
// Constraints:
// 1 <= s.length <= 105
// s consists of only English lowercase letters.


class Solution
{
    /**
     * @param String $s
     * @return Integer
     */
    function partitionString(string $s): int {
        $substringsCountResult = 1;
        $stringLength = strlen($s);
        var_export($s);
        $map = [];
//        foreach (range('a', 'z') as $char) {
//            $map[$char] = 0;
//        }
        for ($i = 0; $i < $stringLength; $i++) {
            if (isset($map[$s[$i]])) {
                $map = [];
                $substringsCountResult++;
            }
            $map[$s[$i]] = 1;
        }

        return $substringsCountResult;
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['s'] = "abacaba";
$cases[0]['expectedOutput'] = 4;
$cases[1]['Input']['s'] = "ssssss";
$cases[1]['expectedOutput'] = 6;

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->partitionString($case['Input']['s']);
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