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

var runningSum___ = function (nums) {
    let runningTotal = 0;
    return nums.map((num) => {
        runningTotal += num;
        return runningTotal;
    });
};

var runningSum = function (nums) {
    nums.reduce((accumulator, currentValue, currentIndex, array) => array[currentIndex] += accumulator)
    return nums
};

// TEST CASES
console.log(runningSum([3, 1, 2, 10, 1]));