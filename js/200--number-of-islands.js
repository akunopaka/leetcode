// https://leetcode.com/problems/number-of-islands/
// 200. Number of Islands
//   Medium
//   Given an m x n 2D binary grid grid which represents a map of '1's (land) and '0's (water), return the number of islands.
//   An island is surrounded by water and is formed by connecting adjacent lands horizontally or vertically. You may assume all four edges of the grid are all surrounded by water.
//   Example 1:
//   Input: grid = [
//     ["1","1","1","1","0"],
//     ["1","1","0","1","0"],
//     ["1","1","0","0","0"],
//     ["0","0","0","0","0"]
//   ]
//   Output: 1
//   Example 2:
//   Input: grid = [
//     ["1","1","0","0","0"],
//     ["1","1","0","0","0"],
//     ["0","0","1","0","0"],
//     ["0","0","0","1","1"]
//   ]
//   Output: 3
//   Constraints:
//   m == grid.length
//   n == grid[i].length
//   1 <= m, n <= 300
//   grid[i][j] is '0' or '1'.

/**
 * @param {character[][]} grid
 * @return {number}
 */
var numIslands = function (grid) {
    let islandsCount = 0;
    const [m, n] = [grid.length, grid[0].length];
    const checkNeighbours = function (rowIndex, columnIndex) {
        if (grid[rowIndex] == undefined ||
            grid[rowIndex][columnIndex] === undefined ||
            grid[rowIndex][columnIndex] != '1')
            return;
        grid[rowIndex][columnIndex] = '2';
        checkNeighbours(rowIndex - 1, columnIndex);
        checkNeighbours(rowIndex + 1, columnIndex);
        checkNeighbours(rowIndex, columnIndex - 1);
        checkNeighbours(rowIndex, columnIndex + 1);

    }
    for (let i = 0; i < m; i++) {
        for (let j = 0; j < n; j++) {
            if (grid[i][j] === '1') {
                checkNeighbours(i, j);
                islandsCount++;
            }
        }
    }
    return islandsCount;
};

// OR
var numIslands = function (grid) {
    if (grid.length === 0) return 0;
    const [m, n] = [grid.length, grid[0].length];

    let count = 0;
    let queue = [];
    const direction = [[-1, 0], [0, 1], [1, 0], [0, -1]];

    for (let row = 0; row < m; row++) {
        for (let col = 0; col < n; col++) {
            if (grid[row][col] === "1") {
                count++;
                queue.push([row, col]);
                grid[row][col] = "0";

                while (queue.length) {
                    let current = queue.shift();
                    const curRow = current[0];
                    const curCol = current[1];
                    // checkNeighbours
                    // direction.forEach(function (currentDir) {
                    //     const nextRow = curRow + currentDir[0];
                    //     const nextCol = curCol + currentDir[1];
                    //      if (nextRow < 0 || nextCol < 0 ||
                    //          nextRow > grid.length - 1 ||
                    //          nextCol > grid[0].length - 1 ||
                    //          grid[nextRow][nextCol] !== "1") {
                    //         return;
                    //     }
                    //     queue.push([nextRow, nextCol]);
                    //     grid[nextRow][nextCol] = "0"
                    // })
                    for (let i = 0; i < direction.length; i++) {
                        const currentDir = direction[i];
                        const nextRow = curRow + currentDir[0];
                        const nextCol = curCol + currentDir[1];

                        if (nextRow < 0 || nextCol < 0 ||
                            nextRow > grid.length - 1 ||
                            nextCol > grid[0].length - 1 ||
                            grid[nextRow][nextCol] !== "1") continue;

                        queue.push([nextRow, nextCol]);
                        grid[nextRow][nextCol] = "0"
                    }
                }
            }
        }
    }
    return count;
};