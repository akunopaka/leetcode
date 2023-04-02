<?php
// 724. Find Pivot Index
// https://leetcode.com/problems/find-pivot-index/
// Easy
// Given an array of integers nums, calculate the pivot index of this array.
// The pivot index is the index where the sum of all the numbers strictly to the left of the index is equal to the sum of all the numbers strictly to the index's right.
// If the index is on the left edge of the array, then the left sum is 0 because there are no elements to the left. This also applies to the right edge of the array.
// Return the leftmost pivot index. If no such index exists, return -1.
//
// Example 1:
// Input: nums = [1,7,3,6,5,6]
// Output: 3
// Explanation:
// The pivot index is 3.
// Left sum = nums[0] + nums[1] + nums[2] = 1 + 7 + 3 = 11
// Right sum = nums[4] + nums[5] = 5 + 6 = 11
// Example 2:
// Input: nums = [1,2,3]
// Output: -1
// Explanation:
// There is no index that satisfies the conditions in the problem statement.
// Example 3:
// Input: nums = [2,1,-1]
// Output: 0
// Explanation:
// The pivot index is 0.
// Left sum = 0 (no elements to the left of index 0)
// Right sum = nums[1] + nums[2] = 1 + -1 = 0
//
//Note: This question is the same as 1991: https://leetcode.com/problems/find-the-middle-index-in-array/


class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function pivotIndex(array $nums): int {
        $rightSum = array_sum($nums);
        $leftSum = 0;
        for ($i = 0; $i < count($nums); $i++) {
            $rightSum -= $nums[$i];
            if ($leftSum === $rightSum) {
                return $i;
            }
            $leftSum += $nums[$i];
        }
        return -1;
    }
}


$cases = [];
$cases[0]['Input'] = [1, 7, 3, 6, 5, 6];
$cases[0]['Output'] = 3;

$cases[1]['Input'] = [1, 2, 3];
$cases[1]['Output'] = -1;

$cases[2]['Input'] = [2, 1, -1];
$cases[2]['Output'] = 0;


$run = new Solution();
foreach ($cases as $case) {
    $result = $run->pivotIndex($case['Input']);

    echo '<pre>--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    print_r($result);
    echo 'Valid is:' . PHP_EOL;
    print_r($case['Output']);
    echo '</pre>--------' . PHP_EOL;

}