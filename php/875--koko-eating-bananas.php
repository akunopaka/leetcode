<?php
// 875. Koko Eating Bananas
// https://leetcode.com/problems/koko-eating-bananas/
// Medium
//Koko loves to eat bananas. There are n piles of bananas, the ith pile has piles[i] bananas. The guards have gone and will come back in h hours.
//Koko can decide her bananas-per-hour eating speed of k. Each hour, she chooses some pile of bananas and eats k bananas from that pile. If the pile has less than k bananas, she eats all of them instead and will not eat any more bananas during this hour.
//Koko likes to eat slowly but still wants to finish eating all the bananas before the guards return.
//Return the minimum integer k such that she can eat all the bananas within h hours.
//
//Example 1:
//Input: piles = [3,6,7,11], h = 8
//Output: 4
//Example 2:
//Input: piles = [30,11,23,4,20], h = 5
//Output: 30
//Example 3:
//Input: piles = [30,11,23,4,20], h = 6
//Output: 23
//
//Constraints:
//1 <= piles.length <= 104
//piles.length <= h <= 109
//1 <= piles[i] <= 109

class Solution
{
    /**
     * @param Integer[] $piles
     * @param Integer $h
     * @return Integer
     */
    function minEatingSpeed(array $piles, int $h): int
    {
        $minK = 1;
        $maxK = max($piles);
//      $maxK = PHP_INT_MAX;
        while ($minK <= $maxK) {
            $midK = floor($minK + ($maxK - $minK) / 2);
            // count K hours to eat all
            $k = 0;
            foreach ($piles as $bananas) {
                $k += ceil($bananas / $midK);
                if ($k > $h) break;
            }

            if ($k <= $h) {
                $maxK = $midK - 1;
            } else {
                $minK = $midK + 1;
            }
        }
        return $minK;
    }
}

//echo '<pre>' . PHP_EOL . '$h:' . $h . PHP_EOL . 'Result:' . PHP_EOL . var_export($piles, true) . PHP_EOL;
//
//echo '<pre> $k ' . $k . ' $midK ' . $midK . ' $minK ' . $minK . ' $maxK ' . $maxK . ' $K: ' . var_export($k, true) . PHP_EOL;
//
// Test Cases
$cases = [];
//$cases[0]['Input']['piles'] = [3, 6, 7, 11];
//$cases[0]['Input']['h'] = 8;
//$cases[0]['expectedOutput'] = 4;
//$cases[1]['Input']['piles'] = [30, 11, 23, 4, 20];
//$cases[1]['Input']['h'] = 5;
//$cases[1]['expectedOutput'] = 30;
//$cases[2]['Input']['piles'] = [30, 11, 23, 4, 20];
//$cases[2]['Input']['h'] = 6;
//$cases[2]['expectedOutput'] = 23;
//$cases[3]['Input']['piles'] = [312884470];
//$cases[3]['Input']['h'] = 312884469;
//$cases[3]['expectedOutput'] = 2;
$cases[4]['Input']['piles'] = [1, 1, 1, 999999999];
$cases[4]['Input']['h'] = 10;
$cases[4]['expectedOutput'] = 142857143;

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->minEatingSpeed($case['Input']['piles'], $case['Input']['h']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void
{
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}