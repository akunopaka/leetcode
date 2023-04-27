<?php
//  319. Bulb Switcher
//  https://leetcode.com/problems/bulb-switcher/
//  Medium
//  
//    There are n bulbs that are initially off. You first turn on all the bulbs, then&nbsp;you turn off every second bulb.
//    On the third round, you toggle every third bulb (turning on if it's off or turning off if it's on). For the ith round, you toggle every i bulb. For the nth round, you only toggle the last bulb.
//    Return the number of bulbs that are on after n rounds.
//    Example 1:
//    Input: n = 3
//    Output: 1
//    Explanation: At first, the three bulbs are [off, off, off].
//    After the first round, the three bulbs are [on, on, on].
//    After the second round, the three bulbs are [on, off, on].
//    After the third round, the three bulbs are [on, off, off]. 
//    So you should return 1 because there is only one bulb is on.
//    Example 2:
//    Input: n = 0
//    Output: 0
//    Example 3:
//    Input: n = 1
//    Output: 1
//    Constraints:
//    0 &lt;= n &lt;= 109

class Solution
{

    /**
     * @param Integer $n
     * @return Integer
     */
    function bulbSwitch(int $n): int {
        return floor(sqrt($n));
    }

//    function bulbSwitch(int $n): int {
//        if ($n == 0) return 0;
//        if ($n == 1) return 1;
//        $bulbs = array_fill(0, $n, 0);
//        for ($i = 1; $i <= $n; $i++) {
//            for ($j = $i - 1; $j < $n; $j += $i) {
//                $bulbs[$j] = $bulbs[$j] == 0 ? 1 : 0;
//            }
//        }
//        return array_sum($bulbs);
//    }
}


