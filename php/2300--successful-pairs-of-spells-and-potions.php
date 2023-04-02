<?php
// 2300. Successful Pairs of Spells and Potions
// Medium
// https://leetcode.com/problems/successful-pairs-of-spells-and-potions/
//
// You are given two positive integer arrays spells and potions, of length n and m respectively, where spells[i] represents the strength of the ith spell and potions[j] represents the strength of the jth potion.
// You are also given an integer success. A spell and potion pair is considered successful if the product of their strengths is at least success.
// Return an integer array pairs of length n where pairs[i] is the number of potions that will form a successful pair with the ith spell.
// Example 1:
// Input: spells = [5,1,3], potions = [1,2,3,4,5], success = 7
// Output: [4,0,3]
// Explanation:
// - 0th spell: 5 * [1,2,3,4,5] = [5,10,15,20,25]. 4 pairs are successful.
// - 1st spell: 1 * [1,2,3,4,5] = [1,2,3,4,5]. 0 pairs are successful.
// - 2nd spell: 3 * [1,2,3,4,5] = [3,6,9,12,15]. 3 pairs are successful.
// Thus, [4,0,3] is returned.

// Example 2:
// Input: spells = [3,1,2], potions = [8,5,8], success = 16
// Output: [2,0,2]
// Explanation:
// - 0th spell: 3 * [8,5,8] = [24,15,24]. 2 pairs are successful.
// - 1st spell: 1 * [8,5,8] = [8,5,8]. 0 pairs are successful.
// - 2nd spell: 2 * [8,5,8] = [16,10,16]. 2 pairs are successful.
// Thus, [2,0,2] is returned.

// Constraints:
// n == spells.length
// m == potions.length
// 1 <= n, m <= 105
// 1 <= spells[i], potions[i] <= 105
// 1 <= success <= 1010A

class Solution
{
    /**
     * @param Integer[] $spells
     * @param Integer[] $potions
     * @param Integer $success
     * @return Integer[]
     */
    function successfulPairs(array $spells, array $potions, int $success): array {
        $pairsResult = [];
        $potionsCount = count($potions);
        $spellsCount = count($spells);
        $maxSpellValueWithZeroSuccess = 0;
        sort($potions);
        // binary search
        for ($i = 0; $i < $spellsCount; $i++) {
            if ($spells[$i] > $maxSpellValueWithZeroSuccess) {
                $left = 0;
                $right = $potionsCount - 1;
                while ($left <= $right) {
                    $mid = ($left + $right) >> 1;
                    if ($spells[$i] * $potions[$mid] >= $success) {
                        $right = $mid - 1;
                    } else {
                        $left = $mid + 1;
                    }
                }
                $pairsResult[$i] = $potionsCount - $left;
                if ($pairsResult[$i] == 0) $maxSpellValueWithZeroSuccess = $spells[$i];
            } else {
                $pairsResult[$i] = 0;
            }
        }
        return $pairsResult;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['spells'] = [5, 1, 3];
$cases[0]['Input']['potions'] = [1, 2, 3, 4, 5];
$cases[0]['Input']['success'] = 7;
$cases[0]['expectedOutput'] = [4, 0, 3];
$cases[1]['Input']['spells'] = [3, 1, 2];
$cases[1]['Input']['potions'] = [8, 5, 8];
$cases[1]['Input']['success'] = 16;
$cases[1]['expectedOutput'] = [2, 0, 2];
// $cases[2]['Input']['spells'] = '';
// $cases[2]['Input'][''] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['spells'] = '';
// $cases[3]['Input'][''] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['spells'] = '';
// $cases[4]['Input'][''] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->successfulPairs($case['Input']['spells'], $case['Input']['potions'], $case['Input']['success']);
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