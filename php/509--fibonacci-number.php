<?php
// 509. Fibonacci Number
// https://leetcode.com/problems/fibonacci-number/description/
//Easy
//The Fibonacci numbers, commonly denoted F(n) form a sequence, called the Fibonacci sequence, such that each number is the sum of the two preceding ones, starting from 0 and 1. That is,
//F(0) = 0, F(1) = 1
//F(n) = F(n - 1) + F(n - 2), for n > 1.
//Given n, calculate F(n).
//
//Example 1:
//Input: n = 2
//Output: 1
//Explanation: F(2) = F(1) + F(0) = 1 + 0 = 1.
//Example 2:
//Input: n = 3
//Output: 2
//Explanation: F(3) = F(2) + F(1) = 1 + 1 = 2.
//Example 3:
//Input: n = 4
//Output: 3
//Explanation: F(4) = F(3) + F(2) = 2 + 1 = 3.
//
//
//Constraints:
//0 <= n <= 30
class Solution
{
    /**
     * @param Integer $n
     * @return Integer
     */
    function fib(int $n): int
    {
        //Constraints:
        //0 <= n <= 30
        // $answersLOL = [0,1,1,2,3,5,8,13,21,34,55,89,144,233,377,610,987,1597,2584,4181,6765,10946,17711,28657,46368,75025,121393,196418,317811,514229,832040];
        // return $answersLOL[$n];

        if ($n == 0 || $n == 1) return $n;
        $cache = [0, 1];
        for ($i = 2; $i <= $n; $i++) {
            $cache[2] = $cache[0] + $cache[1];
            array_shift($cache);
        }
        return $cache[1];

        // $fPrev1 = 0;
        // $fPrev2 = 1;
        // for($i=2; $i<=$n; $i++){
        //    $fibonacci = $fPrev1 + $fPrev2;
        //    $fPrev1 = $fPrev2;
        //    $fPrev2 = $fibonacci;
        // }
        // return $fibonacci;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['n'] = 3;
$cases[0]['expectedOutput'] = 2;
$cases[1]['Input']['n'] = 4;
$cases[1]['expectedOutput'] = 3;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->fib($case['Input']['n']);
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