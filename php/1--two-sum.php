<?php
//  1. Two Sum
// Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target.
// You may assume that each input would have exactly one solution, and you may not use the same element twice.
// You can return the answer in any order.
//
//Example 1:
//Input: nums = [2,7,11,15], target = 9
//Output: [0,1]
//Explanation: Because nums[0] + nums[1] == 9, we return [0, 1].
//Example 2:
//Input: nums = [3,2,4], target = 6
//Output: [1,2]
//Example 3:
//Input: nums = [3,3], target = 6
//Output: [0,1]
//
//Constraints:
//2 <= nums.length <= 104
//-109 <= nums[i] <= 109
//-109 <= target <= 109
//Only one valid answer exists.

// ---------------------
//# Intuition
//<!-- Describe your first thoughts on how to solve this problem. -->
//My first thought would be to loop through the array and store each number in a map with its index as the value. Then I would check if the map contains the target minus the current number, and if it does, I would return the indices of the two numbers that make up the target.
//
//# Approach
//My approach to solving this problem is to use a hash map to store the numbers and their indices in the array. Then we loop through the array and check if there is an element that is equal to the target minus the current element. If there is, we return the indices of the two elements.
//
//# Complexity
//- Time complexity:
//O(n)
//
//- Space complexity:
//O(n)
//
//# Code
class Solution
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target): array
    {
        $map = [];
        foreach ($nums as $i => $num) {
            if (isset($map[$target - $num])) {
                return [$map[$target - $num], $i];
            }
            $map[$num] = $i;
        }
        return [];
    }
}