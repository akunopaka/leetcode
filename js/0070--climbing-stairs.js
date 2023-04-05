// 70. Climbing Stairs
// https://leetcode.com/problems/climbing-stairs/
// Easy
//     You are climbing a staircase. It takes n steps to reach the top.
//     Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?
//
//     Example 1:
//     Input: n = 2
//     Output: 2
//     Explanation: There are two ways to climb to the top.
//     1. 1 step + 1 step
//     2. 2 steps
//     Example 2:
//     Input: n = 3
//     Output: 3
//     Explanation: There are three ways to climb to the top.
//     1. 1 step + 1 step + 1 step
//     2. 1 step + 2 steps
//     3. 2 steps + 1 step
//     Constraints:
//     1 <= n <= 45
/**
 * @param {number} n
 * @return {number}
 */
var climbStairs = function (n) {
    const LOL = [1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946, 17711, 28657, 46368, 75025, 121393, 196418, 317811, 514229, 832040, 1346269, 2178309, 3524578, 5702887, 9227465, 14930352, 24157817, 39088169, 63245986, 102334155, 165580141, 267914296, 433494437, 701408733, 1134903170, 1836311903, 2971215073, 4807526976, 7778742049, 12586269025];
    return LOL[n];

    let one = 1, two = 1, tmp = 0;
    if (n == 1) return 1;
    for (let i = 1; i < n; i++) {
        tmp = one;
        one = one + two;
        two = tmp;
    }
    return one;
};