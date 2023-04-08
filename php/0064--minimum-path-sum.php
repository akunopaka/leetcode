<?php
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

class Solution
{
    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function minPathSum(array $grid): int {
        if ($grid == [[]]) return 0;
        if (count($grid) == 1) return array_sum($grid[0]);
        if (count($grid[0]) == 1) return array_sum(array_column($grid, 0));

        $m = count($grid); // rows => y
        $n = count($grid[0]); // columns => x

        for ($y = 0; $y < $m; $y++) {
            for ($x = 0; $x < $n; $x++) {
                if ($x == 0 && $y == 0) continue;
                if ($x == 0) $grid[$y][$x] += $grid[$y - 1][$x];
                elseif ($y == 0) $grid[$y][$x] += $grid[$y][$x - 1];
                else $grid[$y][$x] += min($grid[$y - 1][$x], $grid[$y][$x - 1]);
            }
        }
        return $grid[$m - 1][$n - 1];
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['grid'] = [[1, 3, 1], [1, 5, 1], [4, 2, 1]];
$cases[0]['expectedOutput'] = 7;
$cases[1]['Input']['grid'] = [[1, 2, 3], [4, 5, 6]];
$cases[1]['expectedOutput'] = 12;

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->minPathSum($case['Input']['grid']);
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