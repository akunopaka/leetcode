<?php
// 62. Unique Paths
// https://leetcode.com/problems/unique-paths/
// Medium
// There is a robot on an m x n grid. The robot is initially located at the top-left corner (i.e., grid[0][0]). The robot tries to move to the bottom-right corner (i.e., grid[m - 1][n - 1]). The robot can only move either down or right at any point in time.
// Given the two integers m and n, return the number of possible unique paths that the robot can take to reach the bottom-right corner.
// The test cases are generated so that the answer will be less than or equal to 2 * 109.
//
// Example 1:
// Input: m = 3, n = 7
// Output: 28
// Example 2:
// Input: m = 3, n = 2
// Output: 3
// Explanation: From the top-left corner, there are a total of 3 ways to reach the bottom-right corner:
// 1. Right -> Down -> Down
// 2. Down -> Down -> Right
// 3. Down -> Right -> Down
// Constraints:
// 1 <= m, n <= 100


class Solution
{
    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n): int {
        if ($m == 1 || $n == 1) return 1;
        if (isset($this->map[$n][$m])) return $this->map[$n][$m];
        return $this->map[$n][$m] = $this->map[$m][$n] = $this->uniquePaths($m - 1, $n) + $this->uniquePaths($m, $n - 1);
    }
}


class Solution___2
{
    public array $map;

    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n): int {
        $res = 0;
        if ($m == 1 || $n == 1) return 1;
        if (isset($this->map[$n][$m])) {
            return $this->map[$n][$m];
        }
        $res += $this->uniquePaths($m - 1, $n);
        $res += $this->uniquePaths($m, $n - 1);

        $this->map[$n][$m] = $this->map[$m][$n] = $res;

        return $res;
    }
}


class Solution___fromInet
{

    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n) {
        $down = $m - 1;
        $right = $n - 1;
        $amount = array_fill(0, $right + 1, array_fill(0, $down + 1, 1));

        for ($r = 1; $r <= $right; $r++) {
            for ($d = 1; $d <= $down; $d++) {
                $amount[$r][$d] = $amount[$r - 1][$d] + $amount[$r][$d - 1];
            }
        }

        return $amount[$right][$down];


        // 1 ********************************
        return $this->factorial($down + $right) / ($this->factorial($down) * $this->factorial($right));

        // 2 ********************************
        $result = 0;
        $this->backtrack($down, $right, $result);
        return $result;


        // 3 ********************************
        $amount = 0;
        $this->getAmountPaths($m, $n, 0, 0, $amount);
        return $amount;

        // 4 ********************************
        $queue = new SplQueue();
        $queue->push([0, 0]);
        $result = 0;

        while (!$queue->isEmpty()) {

            [$top, $right] = $queue->pop();

            if ($top === $m - 1 && $right === $n - 1) {
                $result++;
            }

            if ($n > $right) {
                $queue->push([$top, $right + 1]);
            }

            if ($m > $top) {
                $queue->push([$top + 1, $right]);
            }
        }

        return $result;
    }

    private function factorial($n): float {
        $result = 1;
        for ($i = 1; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }

    private function backtrack($down, $right, &$result): void {
        if ($down + $right === 0) {
            $result++;
        }

        if ($down > 0) {
            $this->backtrack($down - 1, $right, $result);
        }

        if ($right > 0) {
            $this->backtrack($down, $right - 1, $result);
        }

    }

    private function getAmountPaths($m, $n, $top, $right, &$amount): void {
        if ($top === $m - 1 && $right === $n - 1) {
            $amount++;
            return;
        }

        if ($n > $right) {
            $this->getAmountPaths($m, $n, $top, $right + 1, $amount);
        }

        if ($m > $top) {
            $this->getAmountPaths($m, $n, $top + 1, $right, $amount);
        }
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['m'] = 3;
$cases[0]['Input']['n'] = 7;
$cases[0]['expectedOutput'] = 28;
$cases[1]['Input']['m'] = 3;
$cases[1]['Input']['n'] = 2;
$cases[1]['expectedOutput'] = 3;
$cases[2]['Input']['m'] = 3;
$cases[2]['Input']['n'] = 3;
$cases[2]['expectedOutput'] = 6;
$cases[3]['Input']['m'] = 4;
$cases[3]['Input']['n'] = 3;
$cases[3]['expectedOutput'] = 10;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->uniquePaths($case['Input']['m'], $case['Input']['n']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo '<pre>' . '--------' . PHP_EOL . 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid/Expected Output is:' . PHP_EOL;
    var_export($expectedOutput);
    echo '</pre>' . PHP_EOL;
}