<?php
// 844. Backspace String Compare
// https://leetcode.com/problems/backspace-string-compare/
// Easy
//    Given two strings s and t, return true if they are equal when both are typed into empty text editors. '#' means a backspace character.
//    Note that after backspacing an empty text, the text will continue empty.
//
//    Example 1:
//    Input: s = "ab#c", t = "ad#c"
//    Output: true
//    Explanation: Both s and t become "ac".
//    Example 2:
//    Input: s = "ab##", t = "c#d#"
//    Output: true
//    Explanation: Both s and t become "".
//    Example 3:
//    Input: s = "a#c", t = "b"
//    Output: false
//    Explanation: s becomes "c" while t becomes "b".
//
//    Constraints:
//    1 <= s.length, t.length <= 200
//    s and t only contain lowercase letters and '#' characters.
//    Follow up: Can you solve it in O(n) time and O(1) space?


class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function backspaceCompare(string $s, string $t): bool {
        return $this->backspacing($s) == $this->backspacing($t);
    }

    function backspacing(string $s): string {
        $strLength = strlen($s);
        $result = '';
        $backspaceCount = 0;
        for ($i = $strLength - 1; $i >= 0; $i--) {
            if ($s[$i] == '#') {
                $backspaceCount++;
                continue;
            }
            if ($backspaceCount > 0) {
                $backspaceCount--;
                continue;
            }
            $result = $s[$i] . $result;
        }
        return $result;
    }

    // -- OR --
    function backspaceCompare__replace(string $s, string $t): bool {
        $count = 1;
        while ($count > 0) {
            $s = preg_replace('/[^#]{1}#/', '', $s, -1, $count);
        }
        $count = 1;
        while ($count > 0) {
            $t = preg_replace('/[^#]{1}#/', '', $t, -1, $count);
        }
        if (ltrim($s, '#') == ltrim($t, '#')) return true;
        return false;
    }
}


// Test Cases
$cases = [];
//$cases[0]['Input']['s'] = 'DC###';
//$cases[0]['Input']['t'] = 'c#d#';
//$cases[0]['expectedOutput'] = true;
//$cases[1]['Input']['s'] = 'a#c';
//$cases[1]['Input']['t'] = 'b';
//$cases[1]['expectedOutput'] = false;
$cases[2]['Input']['s'] = '###a#c#zx#aa#';
$cases[2]['Input']['t'] = 'b#cc###za';
$cases[2]['expectedOutput'] = true;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->backspaceCompare($case['Input']['s'], $case['Input']['t']);
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