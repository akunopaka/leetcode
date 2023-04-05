<?php
// 746. Min Cost Climbing Stairs
// https://leetcode.com/problems/min-cost-climbing-stairs/
// Easy
//    You are given an integer array cost where cost[i] is the cost of ith step on a staircase. Once you pay the cost, you can either climb one or two steps.
//    You can either start from the step with index 0, or the step with index 1.
//    Return the minimum cost to reach the top of the floor.
//
//    Example 1:
//    Input: cost = [10,15,20]
//    Output: 15
//    Explanation: You will start at index 1.
//    - Pay 15 and climb two steps to reach the top.
//    The total cost is 15.
//    Example 2:
//    Input: cost = [1,100,1,1,1,100,1,1,100,1]
//    Output: 6
//    Explanation: You will start at index 0.
//    - Pay 1 and climb two steps to reach index 2.
//    - Pay 1 and climb two steps to reach index 4.
//    - Pay 1 and climb two steps to reach index 6.
//    - Pay 1 and climb one step to reach index 7.
//    - Pay 1 and climb two steps to reach index 9.
//    - Pay 1 and climb one step to reach the top.
//    The total cost is 6.
//    Constraints:
//    2 <= cost.length <= 1000
//    0 <= cost[i] <= 999

class Solution
{
    /**
     * @param Integer[] $cost
     * @return Integer
     */
    function minCostClimbingStairs($cost) {
        $length = count($cost);
        for ($i = 2; $i < $length; $i++) {
            $cost[$i] += min($cost[$i - 1], $cost[$i - 2]);
        }
        return min($cost[$length - 1], $cost[$length - 2]);
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['data'] = [10, 15, 20];
$cases[0]['expectedOutput'] = 15;
$cases[1]['Input']['data'] = [1, 100, 1, 1, 1, 100, 1, 1, 100, 1];
$cases[1]['expectedOutput'] = 6;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->minCostClimbingStairs($case['Input']['data']);
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
