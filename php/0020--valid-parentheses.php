<?php
// 20. Valid Parentheses
// https://leetcode.com/problems/valid-parentheses/description/
// Easy
//
//    My Solution on LeetCode:
//    https://leetcode.com/discuss/topic/3401175/php-beats-100javascript-bracket-validation-with-a-stack/
//
//         Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.
//         An input string is valid if:
//         Open brackets must be closed by the same type of brackets.
//         Open brackets must be closed in the correct order.
//         Every close bracket has a corresponding open bracket of the same type.
//
//         Example 1:
//         Input: s = "()"
//         Output: true
//         Example 2:
//         Input: s = "()[]{}"
//         Output: true
//         Example 3:
//         Input: s = "(]"
//         Output: false
//
//         Constraints:
//         1 <= s.length <= 104
//         s consists of parentheses only '()[]{}'.


class Solution
{
    /**
     * @param String $s
     * @return Boolean
     */
    function isValid(string $s): bool {
        $sLength = strlen($s);
        if ($sLength % 2 !== 0) return false;
        $bracketSet = ['(' => ')', '[' => ']', '{' => '}'];

        $bracketStack = [];

        for ($i = 0; $i < $sLength; $i++) {
            if (array_key_exists($s[$i], $bracketSet)) {
                $bracketStack[] = $bracketSet[$s[$i]];
            } elseif (array_pop($bracketStack) !== $s[$i]) {
                return false;
            }
        }
        return count($bracketStack) === 0;
    }
}