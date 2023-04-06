// 1254. Number of Closed Islands
// https://leetcode.com/problems/number-of-closed-islands/
// Medium
//
// My Solution on LeetCode: https://leetcode.com/discuss/topic/3384964/php-27ms-beats-100phpjavascript-9655-depth-first-search-approach/
//
// Given a 2D grid consists of 0s (land) and 1s (water).  An island is a maximal 4-directionally connected group of 0s and a closed island is an island totally (all left, top, right, bottom) surrounded by 1s.
// Return the number of closed islands.
//
// Example 1:
// Input: grid = [[1,1,1,1,1,1,1,0],[1,0,0,0,0,1,1,0],[1,0,1,0,1,1,1,0],[1,0,0,0,0,1,0,1],[1,1,1,1,1,1,1,0]]
// Output: 2
// Explanation:
// Islands in gray are closed because they are completely surrounded by water (group of 1s).
// Example 2:
// Input: grid = [[0,0,1,0,0],[0,1,0,1,0],[0,1,1,1,0]]
// Output: 1
// Example 3:
// Input: grid = [[1,1,1,1,1,1,1],
//                [1,0,0,0,0,0,1],
//                [1,0,1,1,1,0,1],
//                [1,0,1,0,1,0,1],
//                [1,0,1,1,1,0,1],
//                [1,0,0,0,0,0,1],
//                [1,1,1,1,1,1,1]]
// Output: 2
//
// Constraints:
// 1 <= grid.length, grid[0].length <= 100
// 0 <= grid[i][j] <=1

/**
 * @param {number[][]} grid
 * @return {number}
 */
var closedIsland = function (grid) {
    let result = 0;
    let rows = grid.length;
    let cols = grid[0].length;
    if (cols < 3 || rows < 3) return 0;
    let checkNeighbours = (i, j) => {
        if (i < 0 || i >= rows || j < 0 || j >= cols) {
            return false;
        }
        if (grid[i][j] === 1) {
            return true;
        }
        grid[i][j] = 1;
        let left = checkNeighbours(i, j - 1);
        let right = checkNeighbours(i, j + 1);
        let top = checkNeighbours(i - 1, j);
        let bottom = checkNeighbours(i + 1, j);
        return left && right && top && bottom;
    }

    for (let i = 1; i < rows - 1; i++) {
        for (let j = 1; j < cols - 1; j++) {
            if (grid[i][j] === 0) {
                result += checkNeighbours(i, j);
            }
        }
    }
    return result;
};
