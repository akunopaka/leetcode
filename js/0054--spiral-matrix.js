//  54. Spiral Matrix
//  https://leetcode.com/problems/spiral-matrix/
//  Medium
//  
//    Given the root of a binary tree, return the level order traversal of its nodes' values. (i.e., from left to right, level by level).
//    Example 1:
//    Input: root = [3,9,20,null,null,15,7]
//    Output: [[3],[9,20],[15,7]]
//    Example 2:
//    Input: root = [1]
//    Output: [[1]]
//    Example 3:
//    Input: root = []
//    Output: []
//    Constraints:
//    The number of nodes in the tree is in the range [0, 2000].
//    -1000 &lt;= Node.val &lt;= 1000
/**
 * @param {number[][]} matrix
 * @return {number[]}
 */
var spiralOrder = function (matrix) {
    // direction: 0 - right, 1 - down, 2 - left, 3 - up
    const result = [];
    let direction = 0;
    let rowStart = 0;
    let rowEnd = matrix.length - 1;
    let colStart = 0;
    let colEnd = matrix[0].length - 1;
    while (rowStart <= rowEnd && colStart <= colEnd) {
        if (direction === 0) {
            for (let i = colStart; i <= colEnd; i++) {
                result.push(matrix[rowStart][i]);
            }
            rowStart++;
        } else if (direction === 1) {
            for (let i = rowStart; i <= rowEnd; i++) {
                result.push(matrix[i][colEnd]);
            }
            colEnd--;
        } else if (direction === 2) {
            for (let i = colEnd; i >= colStart; i--) {
                result.push(matrix[rowEnd][i]);
            }
            rowEnd--;
        } else if (direction === 3) {
            for (let i = rowEnd; i >= rowStart; i--) {
                result.push(matrix[i][colStart]);
            }
            colStart++;
        }
        direction = (direction + 1) % 4;
    }
    return result;
};


// OR

var spiralOrder___2 = function (matrix) {
    const res = []
    while (matrix.length) {
        const first = matrix.shift()
        res.push(...first)
        for (const m of matrix) {
            let val = m.pop()
            if (val)
                res.push(val)
            m.reverse()
        }
        matrix.reverse()
    }
    return res
};


let matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
let matrix2 = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12]];

let result = spiralOrder(matrix);
console.log(result);
let result2 = spiralOrder(matrix2);
console.log(result2);
