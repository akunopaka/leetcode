// 509. Fibonacci Number
// https://leetcode.com/problems/fibonacci-number/description/
// Easy
//     The Fibonacci numbers, commonly denoted F(n) form a sequence, called the Fibonacci sequence, such that each number is the sum of the two preceding ones, starting from 0 and 1. That is,
//     F(0) = 0, F(1) = 1
//     F(n) = F(n - 1) + F(n - 2), for n > 1.
//     Given n, calculate F(n).
//
//     Example 1:
//     Input: n = 2
//     Output: 1
//     Explanation: F(2) = F(1) + F(0) = 1 + 0 = 1.
//     Example 2:
//     Input: n = 3
//     Output: 2
//     Explanation: F(3) = F(2) + F(1) = 1 + 1 = 2.
//     Example 3:
//     Input: n = 4
//     Output: 3
//     Explanation: F(4) = F(3) + F(2) = 2 + 1 = 3.
//
//
//     Constraints:
//     0 <= n <= 30

/**
 * @param {number} n
 * @return {number}
 */
var fib = function (n) {
    // const LOL = [0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946, 17711, 28657, 46368, 75025, 121393, 196418, 317811, 514229, 832040];
    // return LOL[n];

    if (n == 0 || n == 1) return n;
    const cache = [0, 1];
    for (let i = 2; i <= n; i++) {
        cache[2] = cache[1] + cache[0];
        cache.shift();
    }
    return cache[1];
};