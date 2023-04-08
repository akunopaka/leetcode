//    64. Minimum Path Sum
//    https://leetcode.com/problems/minimum-path-sum/
//    Medium
//
//    Given a m x n grid filled with non-negative numbers, find a path from top left to bottom right, which minimizes the sum of all numbers along its path.
//    Note: You can only move either down or right at any point in time.
//
//    Example 1:
//    Input: grid = [[1,3,1],[1,5,1],[4,2,1]]
//    Output: 7
//    Explanation: Because the path 1 → 3 → 1 → 1 → 1 minimizes the sum.
//    Example 2:
//    Input: grid = [[1,2,3],[4,5,6]]
//    Output: 12
//    Constraints:
//    m == grid.length
//    n == grid[i].length
//    1 <= m, n <= 200
//    0 <= grid[i][j] <= 100

/**
 * @param {number[][]} grid
 * @return {number}
 */
var minPathSum = function (grid) {
    const m = grid.length;
    const n = grid[0].length;
    const table = Array.from({length: m}, () => new Array(n));

    table[0][0] = grid[0][0];
    for (let i = 1; i < m; i++) {
        table[i][0] = table[i - 1][0] + grid[i][0];
    }
    for (let j = 1; j < n; j++) {
        table[0][j] = table[0][j - 1] + grid[0][j];
    }

    // Fill in the rest of the table
    for (let i = 1; i < m; i++) {
        for (let j = 1; j < n; j++) {
            table[i][j] = Math.min(table[i - 1][j], table[i][j - 1]) + grid[i][j];
        }
    }

    return table[m - 1][n - 1];
}