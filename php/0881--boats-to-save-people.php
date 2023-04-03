<?php
// 881. Boats to Save People
// https://leetcode.com/problems/boats-to-save-people/
// Difficulty: Medium
// You are given an array people where people[i] is the weight of the ith person, and an infinite number of boats where each boat can carry a maximum weight of limit. Each boat carries at most two people at the same time, provided the sum of the weight of those people is at most limit.
// Return the minimum number of boats to carry every given person.
//
// Example 1:
// Input: people = [1,2], limit = 3
// Output: 1
// Explanation: 1 boat (1, 2)
// Example 2:
// Input: people = [3,2,2,1], limit = 3
// Output: 3
// Explanation: 3 boats (1, 2), (2) and (3)
// Example 3:
// Input: people = [3,5,3,4], limit = 5
// Output: 4
// Explanation: 4 boats (3), (3), (4), (5)
//
// Constraints:
// 1 <= people.length <= 5 * 104
// 1 <= people[i] <= limit <= 3 * 104

class Solution
{
    /**
     * @param Integer[] $people
     * @param Integer $limit
     * @return Integer
     */
    function numRescueBoats($people, $limit) {
        // the idea is to collect the maximum sum to limit for each boat
        // two poiners approach
        // sort the array
        sort($people);
        // set the pointers
        $leftPointer = 0;
        $rightPointer = count($people) - 1;
        // set the counter
        $boatsCounter = 0;
        // loop until the pointers meet
        while ($leftPointer <= $rightPointer) {
            // we can always put the heaviest person in a boat
            // also we can put up to two people in a boat
            // So, if the sum of the two people is less than the limit
            if ($people[$leftPointer] + $people[$rightPointer] <= $limit) {
                // increment the left pointer
                $leftPointer++;
            }
            // decrement the right pointer
            $rightPointer--;
            // increment the boats counter
            $boatsCounter++;
        }
        // return the boats counter
        return $boatsCounter;
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['people'] = [1, 2];
$cases[0]['Input']['limit'] = 3;
$cases[0]['expectedOutput'] = 1;
$cases[1]['Input']['people'] = [3, 2, 2, 1];
$cases[1]['Input']['limit'] = 3;
$cases[1]['expectedOutput'] = 3;
$cases[2]['Input']['people'] = [3, 5, 3, 4];
$cases[2]['Input']['limit'] = 5;
$cases[2]['expectedOutput'] = 4;

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->numRescueBoats($case['Input']['people'], $case['Input']['limit']);
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