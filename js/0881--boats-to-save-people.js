// 881. Boats to Save People
// https://leetcode.com/problems/boats-to-save-people/
// Difficulty: Medium
// You are given an array people where people[i] is the weight of the ith person, and an infinite number of boats where each boat can carry a maximum weight of limit. Each boat carries at most two people at the same time, provided the sum of the weight of those people is at most limit.
// Return the minimum number of boats to carry every given person.
//
// Example 1:
// Input: people = [1,2], limit = 3
// Output: 1
// Explanation: 1 boat (1, 2)
// Example 2:
// Input: people = [3,2,2,1], limit = 3
// Output: 3
// Explanation: 3 boats (1, 2), (2) and (3)
// Example 3:
// Input: people = [3,5,3,4], limit = 5
// Output: 4
// Explanation: 4 boats (3), (3), (4), (5)
//
// Constraints:
// 1 <= people.length <= 5 * 10^4
// 1 <= people[i] <= limit <= 3 * 10^4

// the idea is to collect the maximum sum to limit for each boat


/**
 * Two pointer approach - move left and right pointers
 * @param {number[]} people
 * @param {number} limit
 * @return {number}
 */
var numRescueBoats = function (people, limit) {
    people.sort((a, b) => a - b);
    let leftPointer = 0;
    let rightPointer = people.length - 1;
    let boatsCount = 0;

    while (leftPointer <= rightPointer) {
        if (people[rightPointer] !== limit && (people[rightPointer] + people[leftPointer]) <= limit) {
            leftPointer++;
        }
        rightPointer--;
        boatsCount++;
    }

    return boatsCount;
};


/**
 * Slow approach - shift and pop people array
 * @param {number[]} people
 * @param {number} limit
 * @return {number}
 */
var numRescueBoats__slow = function (people, limit) {
    people.sort((a, b) => a - b);
    let boatsCount = 0;

    while (people.length > 0) {
        let personOne = people.pop();
        if (personOne !== limit && (personOne + people[0]) <= limit) {
            people.shift();
        }
        boatsCount++;
    }

    return boatsCount;
};


// TEST CASES
let people = [1, 2], limit = 3;
let result = numRescueBoats(people, limit);
console.log(result);
