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


/**
 * @param {number[]} arr
 * @param {number} k
 * @return {number}
 */
/**
 * @param {number[]} arr
 * @param {number} k
 * @return {number}
 */
var findKthPositive = function (arr, k) {
    let leftIndex = 0, rightIndex = arr.length;
    while (leftIndex <= rightIndex) {
        let midIndex = leftIndex + Math.floor((rightIndex - leftIndex) / 2);
        if (arr[midIndex] - midIndex - 1 < k) {
            leftIndex = midIndex + 1;
        } else {
            rightIndex = midIndex - 1;
        }
    }
    return leftIndex + k;
};


// OR
var findKthPositive = function (arr, k) {
    let arrLength = arr.length;
    let leftIndex = 0;
    let rightIndex = arr.length - 1;
    // if K out of arr
    // get value of last element
    let arrLastValue = arr.at(-1);
    // count of missing positive integers
    let missedInteger = arrLastValue - arrLength;
    if (k > missedInteger) {
        return arrLastValue + k - missedInteger;
    }

    // if k in array
    // find center
    let midIndex;
    while (leftIndex <= rightIndex) {
        midIndex = leftIndex + Math.floor((rightIndex - leftIndex) / 2);
        if ((arr[midIndex] - midIndex - 1) < k) {
            leftIndex = midIndex + 1;
        } else {
            rightIndex = midIndex - 1;
        }
    }
    return k + leftIndex;
};

let arr = [2, 3, 4, 7, 11];
let k = 5;

let res = findKthPositive(arr, k);
console.log(res);


// OR
var findKthPositive__solutio_1 = function (arr, k) {
    let j = 0;
    let t = 0;
    let i;
    for (i = 1; i < arr.at(-1); i++) {
        if (arr[j] == i) {
            j++;
        } else {
            t++;
        }
        if (t == k) return i;

    }
    return k - t + i;
};