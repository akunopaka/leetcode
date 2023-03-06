<?php
// 1539. Kth Missing Positive Number
// https://leetcode.com/problems/kth-missing-positive-number/
// Easy
// Given an array arr of positive integers sorted in a strictly increasing order, and an integer k.
// Return the kth positive integer that is missing from this array.
//
// Example 1:
// Input: arr = [2,3,4,7,11], k = 5
// Output: 9
// Explanation: The missing positive integers are [1,5,6,8,9,10,12,13,...]. The 5th missing positive integer is 9.
// Example 2:
// Input: arr = [1,2,3,4], k = 2
// Output: 6
// Explanation: The missing positive integers are [5,6,7,...]. The 2nd missing positive integer is 6.
//
// Constraints:
// 1 <= arr.length <= 1000
// 1 <= arr[i] <= 1000
// 1 <= k <= 1000
// arr[i] < arr[j] for 1 <= i < j <= arr.length
// Follow up:
// Could you solve this problem in less than O(n) complexity?

class Solution
{

    /**
     * @param Integer[] $arr
     * @param Integer $k
     * @return Integer
     */
    function findKthPositive(array $arr, int $k): int
    {
        $leftIndex = 0;
        $rightIndex = count($arr) - 1;
        while ($leftIndex <= $rightIndex) {
            $middleIndex = $leftIndex + floor(($rightIndex - $leftIndex) / 2);
            if (($arr[$middleIndex] - $middleIndex - 1) < $k) {
                $leftIndex = $middleIndex + 1;
            } else {
                $rightIndex = $middleIndex - 1;
            }
        }
        return $k + $leftIndex;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['arr'] = [2, 3, 4, 7, 11];
$cases[0]['Input']['k'] = 5;
$cases[0]['expectedOutput'] = 9;
$cases[1]['Input']['arr'] = [1, 2, 3, 4];
$cases[1]['Input']['k'] = 2;
$cases[1]['expectedOutput'] = 6;
// $cases[2]['Input']['arr'] = '';
// $cases[2]['Input']['k'] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['arr'] = '';
// $cases[3]['Input']['k'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['arr'] = '';
// $cases[4]['Input']['k'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->findKthPositive($case['Input']['arr'], $case['Input']['k']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void
{
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}