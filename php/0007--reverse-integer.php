<?php
//  7. Reverse Integer
//  https://leetcode.com/problems/reverse-integer/
//  Medium
//
//  Given a signed 32-bit integer x, return x with its digits reversed. If reversing x causes the value to go outside the signed 32-bit integer range [-231, 231 - 1], then return 0.
//  Assume the environment does not allow you to store 64-bit integers (signed or unsigned).
//
//    Example 1:
//    Input: x = 123
//    Output: 321
//    Example 2:
//    Input: x = -123
//    Output: -321
//    Example 3:
//    Input: x = 120
//    Output: 21
//
//    Constraints:
//    -231 <= x <= 231 - 1

class Solution
{
    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse(int $x): int {
        $x = (string)$x;
        $isNegative = false;

        if ($x[0] == '-') {
            $isNegative = true;
            $x = substr($x, 1, strlen($x) - 1);
        }

        $x = (int)strrev($x);
        if ($isNegative) {
            $x = -$x;
        }

        if ($x > pow(2, 31) - 1 || $x < -pow(2, 31)) {
            return 0;
        }
        return $x;
    }

}

$cases[1]['Input']['str1'] = -123;
$cases[1]['Output'] = -321;

$run = new Solution();
foreach ($cases as $case) {
    $result = $run->reverse($case['Input']['str1']);
    echo '<pre>--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    print_r($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    print_r($case['Output']);
    echo '</pre>--------' . PHP_EOL;
}