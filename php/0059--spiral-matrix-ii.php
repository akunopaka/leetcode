<?php
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


class Solution
{
    /**
     * @param Integer $n
     * @return Integer[][]
     */
    function generateMatrix(int $n): array {
        // direction: 0 - right, 1 - down, 2 - left, 3 - up
        $direction = 0;
        $row = $col = 0;
        $rowMax = $colMax = $n - 1;

        $matrix = [];
        for ($i = 0; $i < $n; $i++) {
            $matrix[$i] = array_fill(0, $n, null);
        }

        $count = 1;
        while ($row <= $rowMax && $col <= $colMax) {
            switch ($direction) {
                case 0:
                    for ($i = $col; $i <= $colMax; $i++) $matrix[$row][$i] = $count++;
                    $row++;
                    break;
                case 1:
                    for ($i = $row; $i <= $rowMax; $i++) $matrix[$i][$colMax] = $count++;
                    $colMax--;
                    break;
                case 2:
                    for ($i = $colMax; $i >= $col; $i--) $matrix[$rowMax][$i] = $count++;
                    $rowMax--;
                    break;
                case 3:
                    for ($i = $rowMax; $i >= $row; $i--) $matrix[$i][$col] = $count++;
                    $col++;
                    break;
            }
            $direction = ($direction + 1) % 4;
        }
        foreach ($matrix as &$m) ksort($m);

        return $matrix;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['n'] = 3;
$cases[0]['expectedOutput'] = [[1, 2, 3], [8, 9, 4], [7, 6, 5]];
//$cases[1]['Input']['n'] = 1;
//$cases[1]['expectedOutput'] = [[1]];
// $cases[2]['Input']['n'] = '';
// $cases[2]['Input'][''] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['n'] = '';
// $cases[3]['Input'][''] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['n'] = '';
// $cases[4]['Input'][''] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->generateMatrix($case['Input']['n']);
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