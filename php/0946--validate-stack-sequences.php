<?php
//  946. Validate Stack Sequences
//  https://leetcode.com/problems/validate-stack-sequences/
//  Medium
//  
//    Given two integer arrays pushed and popped each with distinct values, return true if this could have been the result of a sequence of push and pop operations on an initially empty stack, or false otherwise.
//    Example 1:
//    Input: pushed = [1,2,3,4,5], popped = [4,5,3,2,1]
//    Output: true
//    Explanation: We might do the following sequence:
//    push(1), push(2), push(3), push(4),
//    pop() -&gt; 4,
//    push(5),
//    pop() -&gt; 5, pop() -&gt; 3, pop() -&gt; 2, pop() -&gt; 1
//    Example 2:
//    Input: pushed = [1,2,3,4,5], popped = [4,3,5,1,2]
//    Output: false
//    Explanation: 1 cannot be popped before 2.
//    Constraints:
//    1 &lt;= pushed.length &lt;= 1000
//    0 &lt;= pushed[i] &lt;= 1000
//    All the elements of pushed are unique.
//    popped.length == pushed.length
//    popped is a permutation of pushed.

class Solution
{
    /**
     * @param Integer[] $pushed
     * @param Integer[] $popped
     * @return Boolean
     */
    function validateStackSequences(array $pushed, array $popped): bool {
        $stack = [];
        $i = 0;
        foreach ($pushed as $value) {
            $stack[] = $value;
            while (!empty($stack) && $stack[count($stack) - 1] == $popped[$i]) {
                array_pop($stack);
                $i++;
            }
        }
        return empty($stack);
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['pushed'] = [1, 2, 3, 4, 5];
$cases[0]['Input']['popped'] = [4, 5, 3, 2, 1];
$cases[0]['expectedOutput'] = true;
//$cases[1]['Input']['pushed'] = '';
//$cases[1]['Input']['popped'] = '';
//$cases[1]['expectedOutput'] = '';
// $cases[2]['Input']['pushed'] = '';
// $cases[2]['Input']['popped'] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['pushed'] = '';
// $cases[3]['Input']['popped'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['pushed'] = '';
// $cases[4]['Input']['popped'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->validateStackSequences($case['Input']['pushed'], $case['Input']['popped']);
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