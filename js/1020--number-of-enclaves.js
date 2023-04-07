// 1020. Number of Enclaves
// https://leetcode.com/problems/number-of-enclaves/
// Medium
//
// My Solution on LeetCode:
// https://leetcode.com/discuss/topic/3388246/php-207-ms-beats-100phpjavascript-73-ms-beats-9841-depth-first-search-approach/
//
// You are given an m x n binary matrix grid, where 0 represents a sea cell and 1 represents a land cell.
// A move consists of walking from one land cell to another adjacent (4-directionally) land cell or walking off the boundary of the grid.
// Return the number of land cells in grid for which we cannot walk off the boundary of the grid in any number of moves.
//
// Example 1:
// Input: grid = [[0,0,0,0],[1,0,1,0],[0,1,1,0],[0,0,0,0]]
// Output: 3
// Explanation: There are three 1s that are enclosed by 0s, and one 1 that is not enclosed because its on the boundary.
// Example 2:
// Input: grid = [[0,1,1,0],[0,0,1,0],[0,0,1,0],[0,0,0,0]]
// Output: 0
// Explanation: All 1s are either on the boundary or can reach the boundary.
//
// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 500
// grid[i][j] is either 0 or 1.

/**
 * @param {number[][]} grid
 * @return {number}
 */
var numEnclaves = function (grid) {
    const col = grid.length;
    const row = grid[0].length;

    // 1. find all the 1s on the boundary
    // 2. find all the 1s connected to the boundary and set them to 0
    // 3. count the rest 1s
    // 4. return the count

    let checkNeighboursDFS = (i, j) => {
        if (i < 0 || i >= col || j < 0 || j >= row || grid[i][j] === 0) {
            return;
        }
        grid[i][j] = 0;
        checkNeighboursDFS(i - 1, j);
        checkNeighboursDFS(i + 1, j);
        checkNeighboursDFS(i, j - 1);
        checkNeighboursDFS(i, j + 1);
    };

    // 1. find all the 1s on the boundary
    for (let i = 0; i < col; i++) {
        checkNeighboursDFS(i, 0);
        checkNeighboursDFS(i, row - 1);
    }
    for (let i = 0; i < row; i++) {
        checkNeighboursDFS(0, i);
        checkNeighboursDFS(col - 1, i);
    }

    // 3. count the rest 1s
    let isolatedIslandCount = 0;
    // isolatedIslandCount = grid.flat().reduce((a, b) => a + b);
    for (let i = 1; i < col - 1; i++) {
        for (let j = 1; j < row - 1; j++) {
            if (grid[i][j] === 1) {
                isolatedIslandCount++;
            }
        }
    }

    return isolatedIslandCount;
};