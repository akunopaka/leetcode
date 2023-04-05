<?php
// 424. Longest Repeating Character Replacement
// https://leetcode.com/problems/longest-repeating-character-replacement/
// Medium
//     You are given a string s and an integer k. You can choose any character of the string and change it to any other uppercase English character. You can perform this operation at most k times.
//     Return the length of the longest substring containing the same letter you can get after performing the above operations.
//
//     Example 1:
//     Input: s = "ABAB", k = 2
//     Output: 4
//     Explanation: Replace the two 'A's with two 'B's or vice versa.
//     Example 2:
//     Input: s = "AABABBA", k = 1
//     Output: 4
//     Explanation: Replace the one 'A' in the middle with 'B' and form "AABBBBA".
//     The substring "BBBB" has the longest repeating letters, which is 4.
//     Constraints:
//     1 <= s.length <= 105
//     s consists of only uppercase English letters.
//     0 <= k <= s.length

class Solution
{
    function characterReplacement___2(string $s, int $k): int {
        $left = 0;
        $res = 0;
        $max = 0;
        $letters = [];

        for ($rightIndex = 0; $rightIndex < strlen($s); $rightIndex++) {
            $letters[$s[$rightIndex]] = 1 + ($letters[$s[$rightIndex]] ?? 0);
            if ($letters[$s[$rightIndex]] > $max) {
                $max = $letters[$s[$rightIndex]];
            }
            while (($rightIndex - $left + 1) - $max > $k) {
                $letters[$s[$left]]--;
                $left++;
            }
            $res = max($res, $rightIndex - $left + 1);
        }
        return $res;
    }

    /**
     * @param String $s
     * @param Integer $k
     * @return Integer
     */
    function characterReplacement(string $s, int $k): int {
        $longestSubstring = 0;
        $leftIndex = 0;
        $max = 0;
        $map = [];
        $sLength = strlen($s);
        for ($rightIndex = 0; $rightIndex < $sLength; $rightIndex++) {
            isset($map[$s[$rightIndex]]) ? $map[$s[$rightIndex]]++ : $map[$s[$rightIndex]] = 1;
            if ($map[$s[$rightIndex]] > $max) {
                $max = $map[$s[$rightIndex]];
            }
            while (($rightIndex - $leftIndex + 1) - $max > ($k)) {
                $map[$s[$leftIndex]]--;
                $leftIndex++;
            }
            $longestSubstring = max($longestSubstring, $rightIndex - $leftIndex + 1);
        }
        return $longestSubstring;
    }


    function characterReplacement___runtime_error(string $s, int $k): int {
        echo '<pre>' . '--------' . PHP_EOL . 'test:' . PHP_EOL;
        $longestSubstring = 0;
        $hash = [];
        for ($i = 0; $i < strlen($s); $i++) {
            $char = $s[$i];
            foreach ($hash as $key => $val) {
                if ($char == $val['char']) {
                    $hash[$key]['count']++;
                } else {
                    if ($val['k'] > 0) {
                        $hash[$key]['count']++;
                        $hash[$key]['k']--;
                    } else {
                        $longestSubstring = max($longestSubstring, $val['count']);
                        unset($hash[$key]);
                    }
                }
            }
            if (isset($s[$i - 1]) && ($s[$i - 1] != $char)) {
                $hash[] = ['char' => $char, 'count' => 1, 'k' => $k];
            }
        }
        foreach ($hash as $val) {
            $longestSubstring = max($longestSubstring, ($val['count'] + $val['k']));
        }
        return ($longestSubstring < strlen($s)) ? $longestSubstring : strlen($s);
    }
}

// Test Cases
$cases = [];


$cases[0]['Input']['s'] = "ABBB";
$cases[0]['Input']['k'] = 2;
$cases[0]['expectedOutput'] = 4;
$cases[1]['Input']['s'] = "ABAB";
$cases[1]['Input']['k'] = 2;
$cases[1]['expectedOutput'] = 4;
$cases[2]['Input']['s'] = "AABABBA";
$cases[2]['Input']['k'] = 1;
$cases[2]['expectedOutput'] = 4;
//
$cases[3]['Input']['s'] = "IMNJJTRMJEGMSOLSCCQICIHLQIOGBJAEHQOCRAJQMBIBATGLJDTBNCPIFRDLRIJHRABBJGQAOLIKRLHDRIGERENNMJSDSSMESSTR";
$cases[3]['Input']['k'] = 2;
$cases[3]['expectedOutput'] = 6;
//
$cases[4]['Input']['s'] = "JSDSSMESS";
$cases[4]['Input']['k'] = 2;
$cases[4]['expectedOutput'] = 6;

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->characterReplacement($case['Input']['s'], $case['Input']['k']);
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