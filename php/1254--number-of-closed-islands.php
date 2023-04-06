<?php
// 1254. Number of Closed Islands
// https://leetcode.com/problems/number-of-closed-islands/
// Medium
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


// Runtime 28ms Beats 100%
class Solution
{
    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function closedIsland(array $grid): int {
        $islandsCount = 0;
        $m = count($grid);     // y
        $n = count($grid[0]);  // x

        if ($m < 3 || $n < 3) return 0;

        for ($i = 1; $i < $m - 1; $i++) {
            for ($j = 1; $j < $n - 1; $j++) {
                if ($grid[$i][$j] === 0) {
                    if ($this->checkNeighbours($grid, $i, $j)) {
                        $islandsCount++;
                    }
                }
            }
        }
        return $islandsCount;
    }

    function checkNeighbours(array &$grid, int $i, int $j): bool {
        if (!isset($grid[$i][$j])) return false;
        if ($grid[$i][$j] === 1) return true;

        $grid[$i][$j] = 1;

        $left = $this->checkNeighbours($grid, $i, $j - 1);
        $right = $this->checkNeighbours($grid, $i, $j + 1);
        $top = $this->checkNeighbours($grid, $i - 1, $j);
        $bottom = $this->checkNeighbours($grid, $i + 1, $j);

        return $left && $right && $top && $bottom;
    }
}


class Solution2
{
    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function closedIsland($grid): int {
        $islandsCount = 0;
        $m = count($grid);     // y
        $n = count($grid[0]);  // x

        if ($m < 3 || $n < 3) return 0;

        for ($i = 1; $i < $m - 1; $i++) {
            for ($j = 1; $j < $n - 1; $j++) {
                if ($grid[$i][$j] === 0) {
                    if ($this->checkNeighbours($grid, $i, $j, $m, $n)) {
                        $islandsCount++;
                    }
                }
            }
        }
        return $islandsCount;
    }

    function checkNeighbours(&$grid, $i, $j, $m, $n): bool {
        if ($i < 0 || $i >= $m || $j < 0 || $j >= $n) return false;
        if ($grid[$i][$j] === 1) return true;

        $grid[$i][$j] = 1;

        $left = $this->checkNeighbours($grid, $i, $j - 1, $m, $n);
        $right = $this->checkNeighbours($grid, $i, $j + 1, $m, $n);
        $top = $this->checkNeighbours($grid, $i - 1, $j, $m, $n);
        $bottom = $this->checkNeighbours($grid, $i + 1, $j, $m, $n);

        return $left && $right && $top && $bottom;
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['grid'] = [
    [1, 1, 1, 1, 1, 1, 1, 0],
    [1, 0, 0, 0, 0, 1, 1, 0],
    [1, 0, 1, 0, 1, 1, 1, 0],
    [1, 0, 0, 0, 0, 1, 0, 1],
    [1, 1, 1, 1, 1, 1, 1, 0]
];
$cases[0]['expectedOutput'] = 2;
$cases[1]['Input']['grid'] = [[0, 0, 1, 0, 0], [0, 1, 0, 1, 0], [0, 1, 1, 1, 0]];
$cases[1]['expectedOutput'] = 1;
$cases[2]['Input']['grid'] = [
    [1, 1, 1, 1, 1, 1, 1],
    [1, 0, 0, 0, 0, 0, 1],
    [1, 0, 1, 1, 1, 0, 1],
    [1, 0, 1, 0, 1, 0, 1],
    [1, 0, 1, 1, 1, 0, 1],
    [1, 0, 0, 0, 0, 0, 1],
    [1, 1, 1, 1, 1, 1, 1]];
$cases[2]['expectedOutput'] = 2;
$cases[3]['Input']['grid'] = [
    [0, 0, 1, 1, 0, 1, 0, 0, 1, 0],
    [1, 1, 0, 1, 1, 0, 1, 1, 1, 0],
    [1, 0, 1, 1, 1, 0, 0, 1, 1, 0],
    [0, 1, 1, 0, 0, 0, 0, 1, 0, 1],
    [0, 0, 0, 0, 0, 0, 1, 1, 1, 0],
    [0, 1, 0, 1, 0, 1, 0, 1, 1, 1],
    [1, 0, 1, 0, 1, 1, 0, 0, 0, 1],
    [1, 1, 1, 1, 1, 1, 0, 0, 0, 0],
    [1, 1, 1, 0, 0, 1, 0, 1, 0, 1],
    [1, 1, 1, 0, 1, 1, 0, 1, 1, 0]
];
$cases[3]['expectedOutput'] = 5;
// $cases[4]['Input']['grid'] = '';
// $cases[4]['expectedOutput'] = '';


function printMatrix($matrix) {
//        echo '<pre>';
//        $this->printMatrix($grid);
    $m = count($matrix);
    $n = count($matrix[0]);
    for ($i = 0; $i < $m; $i++) {
        for ($j = 0; $j < $n; $j++) {
            echo $matrix[$i][$j] . ' ';
        }
        echo PHP_EOL;
    }
}


// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->closedIsland($case['Input']['grid']);
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