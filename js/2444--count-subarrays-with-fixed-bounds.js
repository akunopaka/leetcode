// 2444. Count Subarrays With Fixed Bounds
// https://leetcode.com/problems/count-subarrays-with-fixed-bounds/
// Hard
//You are given an integer array nums and two integers minK and maxK.
//A fixed-bound subarray of nums is a subarray that satisfies the following conditions:
//The minimum value in the subarray is equal to minK.
//The maximum value in the subarray is equal to maxK.
//Return the number of fixed-bound subarrays.
//A subarray is a contiguous part of an array.
//
//Example 1:
//Input: nums = [1,3,5,2,7,5], minK = 1, maxK = 5
//Output: 2
//Explanation: The fixed-bound subarrays are [1,3,5] and [1,3,5,2].
//Example 2:
//Input: nums = [1,1,1,1], minK = 1, maxK = 1
//Output: 10
//Explanation: Every subarray of nums is a fixed-bound subarray. There are 10 possible subarrays.
//
//Constraints:
//2 <= nums.length <= 105
//1 <= nums[i], minK, maxK <= 106


/**
 * @param {number[]} nums
 * @param {number} minK
 * @param {number} maxK
 * @return {number}
 */
var countSubarrays = function (nums, minK, maxK) {
    const countNum = nums.length;
    let boundPoint = -1;
    let minPoint = -1;
    let maxPoint = -1;
    // let nums = [1, 3, 5, 2,  7, 5], minK = 1, maxK = 5;
    //  minPoint - ^     ^-maxP ^
    //                   ^

    let totalSubArr = 0;
    for (let i = 0; i < countNum; i++) {
        if (nums[i] < minK || nums[i] > maxK) boundPoint = i;
        if (nums[i] == minK) minPoint = i;
        if (nums[i] == maxK) maxPoint = i;

        let countPossibleSubArr = Math.min(minPoint, maxPoint) - boundPoint;  //

        if (countPossibleSubArr > 0) totalSubArr += countPossibleSubArr;
    }
    return totalSubArr;
};

let nums = [1, 3, 5, 2, 7, 2, 5, 1, 5, 1], minK = 1, maxK = 5;
let res = countSubarrays(nums, minK, maxK);
console.log(res);
