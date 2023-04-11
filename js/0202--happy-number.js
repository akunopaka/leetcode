// 202. Happy Number
// https://leetcode.com/problems/happy-number/
// Easy
//
//     Write an algorithm to determine if a number n is happy.
//     A happy number is a number defined by the following process:
//     Starting with any positive integer, replace the number by the sum of the squares of its digits.
//     Repeat the process until the number equals 1 (where it will stay), or it loops endlessly in a cycle which does not include 1.
//     Those numbers for which this process ends in 1 are happy.
//     Return true if n is a happy number, and false if not.
//
//
//     Example 1:
//     Input: n = 19
//     Output: true
//     Explanation:
//     1^2 + 9^2 = 82
//     8^2 + 2^2 = 68
//     6^2 + 8^2 = 100
//     1^2 + 0^2 + 02 = 1
//     Example 2:
//     Input: n = 2
//     Output: false
//
//     Constraints:
//
//     1 <= n <= 231 - 1


/**
 * @param {number} n
 * @return {boolean}
 */



// HashMap Approach
var isHappy = function (n) {
    let set = new Set();
    while (n != 1 && !set.has(n)) {
        let sum = 0;
        for (const digit of n.toString().split("")) {
            sum += digit ** 2;
        }
        set.add(n);
        n = sum;
    }
    return n == 1;
};

// "Math Approach"
var isHappy__math = function (n) {
    while (n != 1 && n != 4) {
        let sum = 0;
        for (const digit of n.toString().split("")) {
            sum += digit ** 2;
        }
        n = sum;
    }
    return n == 1;
};


// console.log(sum);
let num = 13;
res = isHappy(num);
console.log(res);

// 1. Using the Math.floor and Math.pow functions:
//
// let num = 12345;
// let digits = [];
// while (num > 0) {
//     digits.push(Math.floor(num % 10));
//     num = Math.floor(num / 10);
// }
//
// 2. Using the for loop:
//
// let num = 12345;
// let digits = [];
//
// for (let i = 0; i < String(num).length; i++) {
//     digits.push(Number(String(num)[i]));
// }
//
// 3. Using the toString and split methods:
//
//     let num = 12345;
// let digits = num.toString().split("");
//
// 4. Using the parseInt and Math.pow functions:
//
//     let num = 12345;
// let digits = [];
//
// for (let i = 0; i < String(num).length; i++) {
//     digits.push(parseInt(num / Math.pow(10, i)) % 10);
// }