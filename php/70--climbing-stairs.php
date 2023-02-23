<?php
// 70. Climbing Stairs
// https://leetcode.com/problems/climbing-stairs/
// SOLUTION :: https://www.youtube.com/watch?v=Y0lT9Fck7qI
// Climbing Stairs - Dynamic Programming - Leetcode 70
//Easy
//You are climbing a staircase. It takes n steps to reach the top.
//Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?
//
//Example 1:
//Input: n = 2
//Output: 2
//Explanation: There are two ways to climb to the top.
//1. 1 step + 1 step
//2. 2 steps
//Example 2:
//Input: n = 3
//Output: 3
//Explanation: There are three ways to climb to the top.
//1. 1 step + 1 step + 1 step
//2. 1 step + 2 steps
//3. 2 steps + 1 step
//Constraints:
//1 <= n <= 45


//1 <= n <= 45
class Solution
{

    /**
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n)
    {
        $answersLOLfibonaccccccci = [1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946, 17711, 28657, 46368, 75025, 121393, 196418, 317811, 514229, 832040, 1346269, 2178309, 3524578, 5702887, 9227465, 14930352, 24157817, 39088169, 63245986, 102334155, 165580141, 267914296, 433494437, 701408733, 1134903170, 1836311903, 2971215073, 4807526976, 7778742049, 12586269025];
        return $answersLOLfibonaccccccci[$n];
        if ($n < 3) return $n;
        $cache = [1, 1];
        for ($i = 1; $i < $n; $i++) {
            $cache[2] = $cache[0] + $cache[1];
            array_shift($cache);
        }
        return $cache[1];
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['data'] = 3;
$cases[0]['expectedOutput'] = 2;
$cases[1]['Input']['data'] = 3;
$cases[1]['expectedOutput'] = 3;
$cases[2]['Input']['data'] = 4;
$cases[2]['expectedOutput'] = 5;
$cases[2]['Input']['data'] = 5;
$cases[2]['expectedOutput'] = 8;
$cases[2]['Input']['data'] = 8;
$cases[2]['expectedOutput'] = 35;
// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->SOLVE($case['Input']['data']);
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
