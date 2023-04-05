<?php
// 1046. Last Stone Weight
// https://leetcode.com/problems/last-stone-weight/
// Easy
//     You are given an array of integers stones where stones[i] is the weight of the ith stone.
//     We are playing a game with the stones. On each turn, we choose the heaviest two stones and smash them together. Suppose the heaviest two stones have weights x and y with x <= y. The result of this smash is:
//     If x == y, both stones are destroyed, and
//     If x != y, the stone of weight x is destroyed, and the stone of weight y has new weight y - x.
//     At the end of the game, there is at most one stone left.
//     Return the weight of the last remaining stone. If there are no stones left, return 0.
//
//     Example 1:
//     Input: stones = [2,7,4,1,8,1]
//     Output: 1
//     Explanation:
//     We combine 7 and 8 to get 1 so the array converts to [2,4,1,1,1] then,
//     we combine 2 and 4 to get 2 so the array converts to [2,1,1,1] then,
//     we combine 2 and 1 to get 1 so the array converts to [1,1,1] then,
//     we combine 1 and 1 to get 0 so the array converts to [1] then that's the value of the last stone.
//     Example 2:
//     Input: stones = [1]
//     Output: 1
//
//     Constraints:
//     1 <= stones.length <= 30
//     1 <= stones[i] <= 1000

class Solution
{
    /**
     * @param Integer[] $stones
     * @return Integer
     */
    function lastStoneWeight(array $stones): int {
        $heap = new SplMaxHeap();
        foreach ($stones as $stone) {
            $heap->insert($stone);
        }
        while (!$heap->isEmpty()) {
            // get two stones
            $stone1 = $heap->extract();
            if ($heap->isEmpty()) {
                // no remain stones
                return $stone1;
            }
            $stone2 = $heap->extract();
//            echo PHP_EOL . 'S1: ' . $stone1 . ' S2: ' . $stone2 . ' Remain: ' . ($stone1 - $stone2);
            if ($stone1 != $stone2) {
                $heap->insert($stone1 - $stone2);
            }
        }
        return 0;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['stones'] = [2, 7, 4, 1, 8, 1, 25];
$cases[0]['expectedOutput'] = 2;
$cases[1]['Input']['stones'] = [1];
$cases[1]['expectedOutput'] = 1;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->lastStoneWeight($case['Input']['stones']);
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
    if ($result != $expectedOutput) {
        echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL;
        var_export($expectedOutput);
    } else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}