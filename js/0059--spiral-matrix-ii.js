//  59. Spiral Matrix II
//  https://leetcode.com/problems/spiral-matrix-ii/
//  Medium
//  
//    Example 1:
//    Input: n = 3
//    Output: [[1,2,3],[8,9,4],[7,6,5]]
//    Example 2:
//    Input: n = 1
//    Output: [[1]]
//    Constraints:
//    1 &lt;= n &lt;= 20

var generateMatrix = function (n) {
    // direction: 0 - right, 1 - down, 2 - left, 3 - up
    let direction = 0;
    let top = 0, bottom = n - 1, left = 0, right = n - 1;
    let count = 1;
    let matrix = new Array(n).fill(0).map(() => new Array(n).fill(0));

    while (top <= bottom && left <= right) {
        if (direction === 0) {
            for (let i = left; i <= right; i++) {
                matrix[top][i] = count++;
            }
            top++;
        } else if (direction === 1) {
            for (let i = top; i <= bottom; i++) {
                matrix[i][right] = count++;
            }
            right--;
        } else if (direction === 2) {
            for (let i = right; i >= left; i--) {
                matrix[bottom][i] = count++;
            }
            bottom--;
        } else if (direction === 3) {
            for (let i = bottom; i >= top; i--) {
                matrix[i][left] = count++;
            }
            left++;
        }
        direction = (direction + 1) % 4;
    }

    return matrix;
};