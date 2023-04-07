<?php
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


class Solution
{
    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function numEnclaves(array $grid): int {
        $col = count($grid); // y
        $row = count($grid[0]); // x

        // check boundary
        // top and bottom
        for ($i = 0; $i < $col; $i++) {
            $this->checkIsland($grid, $i, 0);
            $this->checkIsland($grid, $i, $row - 1);
        }
        // left and right
        for ($i = 0; $i < $row; $i++) {
            $this->checkIsland($grid, 0, $i);
            $this->checkIsland($grid, $col - 1, $i);
        }

        $isolatedIslandCount = 0;
        for ($i = 1; $i < $col - 1; $i++) {
            $isolatedIslandCount += array_sum($grid[$i]);
        }

        return $isolatedIslandCount;
    }


    function checkIsland(array &$grid, int $y, int $x): void {
        if (!isset($grid[$y][$x]) || $grid[$y][$x] === 0) return;

        $grid[$y][$x] = 0;

        $this->checkIsland($grid, $y - 1, $x);
        $this->checkIsland($grid, $y + 1, $x);
        $this->checkIsland($grid, $y, $x - 1);
        $this->checkIsland($grid, $y, $x + 1);
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['grid'] = [[0, 0, 0, 0], [1, 0, 1, 0], [0, 1, 1, 0], [0, 0, 0, 0]];
$cases[0]['expectedOutput'] = 3;
$cases[1]['Input']['grid'] = [[0, 1, 1, 0], [0, 0, 1, 0], [0, 0, 1, 0], [0, 0, 0, 0]];
$cases[1]['expectedOutput'] = 0;
// $cases[2]['Input']['grid'] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['grid'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['grid'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->numEnclaves($case['Input']['grid']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}