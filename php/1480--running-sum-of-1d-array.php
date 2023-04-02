<?php
// 1480. Running Sum of 1d Array
// https://leetcode.com/problems/running-sum-of-1d-array/
// Easy
// Given an array nums. We define a running sum of an array as runningSum[i] = sum(nums[0]…nums[i]).
// Return the running sum of nums.
//
// Example 1:
// Input: nums = [1,2,3,4]
// Output: [1,3,6,10]
// Explanation: Running sum is obtained as follows: [1, 1+2, 1+2+3, 1+2+3+4].
// Example 2:
// Input: nums = [1,1,1,1,1]
// Output: [1,2,3,4,5]
// Explanation: Running sum is obtained as follows: [1, 1+1, 1+1+1, 1+1+1+1, 1+1+1+1+1].
// Example 3:
// Input: nums = [3,1,2,10,1]
// Output: [3,4,6,16,17]
//
// Constraints:
// 1 <= nums.length <= 1000
// -10^6 <= nums[i] <= 10^6


class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function runningSum___($nums): array {
        if (!($nums) || is_null($nums[0])) return [];
        $newArr[0] = $nums[0];

        for ($i = 1; $i < (count($nums)); $i++) {
            $newArr[$i] = $newArr[$i - 1] + $nums[$i];
        }
        return $newArr;
    }

    function runningSum($nums): array {
        $length = count($nums);
        for ($i = 1; $i < $length; $i++) {
            $nums[$i] += $nums[$i - 1];
        }
        return $nums;
    }
}


// TEST CASES
$cases = [];
$cases[1]['Input'] = [0];
$cases[1]['Output'] = [1, 3, 6, 10];

$cases[2]['Input'] = [1, 1, 1, 1, 1];
$cases[2]['Output'] = [1, 2, 3, 4, 5];

$cases[3]['Input'] = [3, 1, 2, 10, 1];
$cases[3]['Output'] = [3, 4, 6, 16, 17];

$cases[4]['Input'] = [0, 63, -23, 60, -27, -73, -53, -5, 63, 68, -85, -82, -1, -11, 96, 19, 33, -72, -93, -44, -65, -60, 17, 95, -98, -43, -67];
$cases[4]['Output'] = [0, 63, 40, 100, 73, 0, -53, -58, 5, 73, -12, -94, -95, -106, -10, 9, 42, -30, -123, -167, -232, -292, -275, -180, -278, -321, -388];

$cases[5]['Input'] = [1, 2, 3, 4];
$cases[5]['Output'] = [1, 3, 6, 10];
// Test Cases

// Check Solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->runningSum($case['Input']);
    echoResult($result, $case['Output']);
}

/**
 * Function to print Result
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