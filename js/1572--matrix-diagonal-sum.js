//  1572. Matrix Diagonal Sum
//  https://leetcode.com/problems/matrix-diagonal-sum/
//  Easy
//  
//    Only include the sum of all the elements on the primary diagonal and all the elements on the secondary diagonal that are not part of the primary diagonal.
//    Example 1:
//    Input: mat = [[1,2,3],
//    &nbsp; [4,5,6],
//    &nbsp; [7,8,9]]
//    Output: 25
//    Explanation: Diagonals sum: 1 + 5 + 9 + 3 + 7 = 25
//    Notice that element mat[1][1] = 5 is counted only once.
//    Example 2:
//    Input: mat = [[1,1,1,1],
//    &nbsp; [1,1,1,1],
//    &nbsp; [1,1,1,1],
//    &nbsp; [1,1,1,1]]
//    Output: 8
//    Example 3:
//    Input: mat = [[5]]
//    Output: 5
//    Constraints:
//    n == mat.length == mat[i].length
//    1 &lt;= n &lt;= 100
//    1 &lt;= mat[i][j] &lt;= 100

/**
 * @param {number[][]} mat
 * @return {number}
 */
var diagonalSum = function (mat) {
    let sum = 0;
    const matLength = mat.length;
    for (let i = matLength; i--;) {
        sum += mat[i][i];
        if (i !== matLength - i - 1) sum += mat[i][matLength - i - 1];
    }
    return sum;
};