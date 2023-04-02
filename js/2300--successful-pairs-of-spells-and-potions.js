// 2300. Successful Pairs of Spells and Potions
// Medium
// https://leetcode.com/problems/successful-pairs-of-spells-and-potions/
//
// You are given two positive integer arrays spells and potions, of length n and m respectively, where spells[i] represents the strength of the ith spell and potions[j] represents the strength of the jth potion.
// You are also given an integer success. A spell and potion pair is considered successful if the product of their strengths is at least success.
// Return an integer array pairs of length n where pairs[i] is the number of potions that will form a successful pair with the ith spell.
// Example 1:
// Input: spells = [5,1,3], potions = [1,2,3,4,5], success = 7
// Output: [4,0,3]
// Explanation:
// - 0th spell: 5 * [1,2,3,4,5] = [5,10,15,20,25]. 4 pairs are successful.
// - 1st spell: 1 * [1,2,3,4,5] = [1,2,3,4,5]. 0 pairs are successful.
// - 2nd spell: 3 * [1,2,3,4,5] = [3,6,9,12,15]. 3 pairs are successful.
// Thus, [4,0,3] is returned.

// Example 2:
// Input: spells = [3,1,2], potions = [8,5,8], success = 16
// Output: [2,0,2]
// Explanation:
// - 0th spell: 3 * [8,5,8] = [24,15,24]. 2 pairs are successful.
// - 1st spell: 1 * [8,5,8] = [8,5,8]. 0 pairs are successful.
// - 2nd spell: 2 * [8,5,8] = [16,10,16]. 2 pairs are successful.
// Thus, [2,0,2] is returned.

// Constraints:
// n == spells.length
// m == potions.length
// 1 <= n, m <= 105
// 1 <= spells[i], potions[i] <= 105
// 1 <= success <= 1010A

/**
 * Binary search approach O((n+m)*log(n))
 * @param {number[]} spells
 * @param {number[]} potions
 * @param {number} success
 * @return {number[]}
 */
var successfulPairs = function (spells, potions, success) {
    const pairs = [];
    potions.sort((a, b) => a - b);
    const spellsLength = spells.length;
    const potionsLength = potions.length;

    console.log(potions);

    let maxSpellValueWithZeroSuccess = 0; // Optimize 1 -  max value of a spell that will never be successful

    for (let i = 0; i < spellsLength; i++) {
        let count = 0;
        // // Optimize 2 - save and reuse success result with the same spell value
        // // search spells[i] spell value in the previous spells
        // let cacheResultIndex = spells.indexOf(spells[i]);
        // if (cacheResultIndex !== -1 && cacheResultIndex < i) {
        //     count = pairs[cacheResultIndex];
        //
        // } else {
        //     cacheResultIndex = -1;
        // }

        // Optimize 1 - skip if the spell value is less than the max value of a spell that will never be successful
        // if (cacheResultIndex === -1 && spells[i] > maxSpellValueWithZeroSuccess) {
        if (spells[i] > maxSpellValueWithZeroSuccess) {
            // binary search
            let left = 0;
            let right = potionsLength - 1;
            while (left <= right) {
                // const mid = Math.floor((left + right) / 2);
                const mid = (left + right) >> 1;
                if (spells[i] * potions[mid] >= success) {
                    right = mid - 1;
                } else {
                    left = mid + 1;
                }
            }
            count = potionsLength - left;
            if (count == 0) maxSpellValueWithZeroSuccess = spells[i];
        }
        pairs.push(count);
    }
    return pairs;
};


var successfulPairs__ = function (spells, potions, success) {
    const pairs = [];
    potions.sort((a, b) => a - b);
    const spellsLength = spells.length;
    const potionsLength = potions.length;

    for (let i = 0; i < spellsLength; i++) {
        let count = 0;
        // binary search
        let left = 0;
        let right = potionsLength - 1;
        while (left <= right) {
            // const mid = Math.floor((left + right) / 2);
            const mid = (left + right) >> 1;
            if (spells[i] * potions[mid] >= success) {
                right = mid - 1;
            } else {
                left = mid + 1;
            }
        }
        count = potionsLength - left;
        pairs.push(count);
    }
    return pairs;
};

// TEST
let spells = [5, 1, 3], potions = [12, 2, 3, 4, 5], success = 7;
let res = successfulPairs(spells, potions, success);
console.log(res);

// let left = 10;
// let right = 15;
// const mid = (left + right) >>> 1;
// console.log(mid);