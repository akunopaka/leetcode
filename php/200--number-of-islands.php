<?php
// https://leetcode.com/problems/number-of-islands/
// 200. Number of Islands
//   Medium
//   Given an m x n 2D binary grid  which represents a map of '1's (land) and '0's (water), return the number of islands.
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

class Solution
{
    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid): int
    {
//        m == grid.length
//        n == grid[i].length
//        1 <= m, n <= 300
//        grid[i][j] is '0' or '1'.

        $islandsCount = 0;
        $m = count($grid);     // y
        $n = count($grid[0]);  // x

        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $zone = $grid[$i][$j];
                if ($zone == '1') {
                    $islandsCount++;
                    $this->checkNeighbours($grid, $i, $j);
                }
            }
        }
        return $islandsCount;
    }

    function checkNeighbours(&$grid, $i, $j): void
    {
        if (!isset($grid[$i][$j]) || $grid[$i][$j] != 1) return;
        $grid[$i][$j] = '2';
        $neighbours = [
            [$i - 1, $j], // top
            [$i + 1, $j], // bottom
            [$i, $j - 1], // left
            [$i, $j + 1]  // right
        ];
        foreach ($neighbours as $neighbour) {
            $this->checkNeighbours($grid, $neighbour[0], $neighbour[1]);
        }
        return;
    }
}

class Solution___2
{

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid): int
    {
//        m == grid.length
//        n == grid[i].length
//        1 <= m, n <= 300
//        grid[i][j] is '0' or '1'.

        $islandsCount = 0;
        $m = count($grid);     // y
        $n = count($grid[0]);  // x

        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $zone = $grid[$i][$j];
                if ($zone === '1') {
                    $islandsCount++;
                    $this->checkNeighbours($grid, $i, $j);
                }
            }
        }
        return $islandsCount;
    }

    function checkNeighbours(&$grid, $i, $j): void
    {
        if (!isset($grid[$i][$j]) || $grid[$i][$j] != 1) return;
        $grid[$i][$j] = '2'; // 0
        $this->checkNeighbours($grid, $i - 1, $j);
        $this->checkNeighbours($grid, $i + 1, $j);
        $this->checkNeighbours($grid, $i, $j - 1);
        $this->checkNeighbours($grid, $i, $j + 1);

        // $neighbours = [
        //     [$i - 1, $j], // top
        //     [$i + 1, $j], // bottom
        //     [$i, $j - 1], // left
        //     [$i, $j + 1]  // right
        // ];
        // foreach ($neighbours as $neighbour) {
        //     $this->checkNeighbours($grid, $neighbour[0], $neighbour[1]);
        // }
        return;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['grid'] = [
    ["1", "1", "1", "1", "0"],
    ["1", "1", "0", "1", "0"],
    ["1", "1", "0", "0", "0"],
    ["0", "0", "0", "0", "0"]
];
$cases[0]['expectedOutput'] = 1;
$cases[1]['Input']['grid'] = [
    ["1", "1", "0", "0", "0"],
    ["1", "1", "0", "0", "0"],
    ["0", "0", "1", "0", "0"],
    ["0", "0", "0", "1", "1"]
];
$cases[1]['expectedOutput'] = 3;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->numIslands($case['Input']['grid']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void
{
    echo '<pre>' . '--------' . PHP_EOL . 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid/Expected Output is:' . PHP_EOL;
    var_export($expectedOutput);
    echo '</pre>' . PHP_EOL;
}