//7. Reverse Integer
//Medium
//Given a signed 32-bit integer x, return x with its digits reversed. If reversing x causes the value to go outside the signed 32-bit integer range [-231, 231 - 1], then return 0.
//Assume the environment does not allow you to store 64-bit integers (signed or unsigned).
//
//Example 1:
//Input: x = 123
//Output: 321
//Example 2:
//Input: x = -123
//Output: -321
//Example 3:
//Input: x = 120
//Output: 21
//
//Constraints:
//-231 <= x <= 231 - 1

// let reversed = parseInt(x.toString().split('').reverse().join(''));
// if (reversed > Math.pow(2, 31) - 1 || reversed < -Math.pow(2, 31)) {
//     return 0;
// }
// return reversed * Math.sign(x);

/**
 * @param {number} x
 * @return {number}
 */
var reverse = function (x) {
    x = x.toString();
    let isNegative = false;

    if (x[0] == '-') {
        isNegative = true;
        x = x.substr(1, x.length - 1);
    }

    x = parseInt(x.split('').reverse().join(''));
    if (isNegative) {
        x = -x;
    }

    if (x > Math.pow(2, 31) - 1 || x < -Math.pow(2, 31)) {
        return 0;
    }
    return x;
};