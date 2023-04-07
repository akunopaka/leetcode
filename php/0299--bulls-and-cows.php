<?php
// 299. Bulls and Cows
// https://leetcode.com/problems/bulls-and-cows/
// Medium
//
//  My Solution on LeetCode:
//  https://leetcode.com/discuss/topic/3388273/javascriptphp-fast-simple-counting-with-hashmap/
//
//     You are playing the Bulls and Cows game with your friend.
//     You write down a secret number and ask your friend to guess what the number is. When your friend makes a guess, you provide a hint with the following info:
//     The number of "bulls", which are digits in the guess that are in the correct position.
//     The number of "cows", which are digits in the guess that are in your secret number but are located in the wrong position. Specifically, the non-bull digits in the guess that could be rearranged such that they become bulls.
//     Given the secret number secret and your friend's guess guess, return the hint for your friend's guess.
//     The hint should be formatted as "xAyB", where x is the number of bulls and y is the number of cows. Note that both secret and guess may contain duplicate digits.
//
//     Example 1:
//     Input: secret = "1807", guess = "7810"
//     Output: "1A3B"
//     Explanation: Bulls are connected with a '|' and cows are underlined:
//     "1807"
//      |
//     "7810"
//     Example 2:
//     Input: secret = "1123", guess = "0111"
//     Output: "1A1B"
//     Explanation: Bulls are connected with a '|' and cows are underlined:
//     "1123"        "1123"
//      |      or     |
//     "0111"        "0111"
//     Note that only one of the two unmatched 1s is counted as a cow since the non-bull digits can only be rearranged to allow one 1 to be a bull.
//     Constraints:
//     1 <= secret.length, guess.length <= 1000
//     secret.length == guess.length
//     secret and guess consist of digits only.

class Solution
{
    function getHint($secret, $guess) {
        $bulls = 0;
        $cows = 0;
        $counts = array_fill(0, 10, 0);
        for ($i = 0; $i < strlen($secret); $i++) {
            if ($secret[$i] == $guess[$i]) {
                $bulls++;
            } else {
                if ($counts[$secret[$i]]++ < 0)
                    $cows++;
                if ($counts[$guess[$i]]-- > 0)
                    $cows++;
            }
        }
        return "{$bulls}A{$cows}B";
    }
}


class Solution_____A
{
    /**
     * @param String $secret
     * @param String $guess
     * @return String
     */
    function getHint($secret, $guess) {
        $bulls = 0; // correct position
        $cows = 0;  // located in the wrong position
        $length = strlen($secret);
        for ($i = 0; $i < $length; $i++) {
            if ($secret[$i] == $guess[$i]) $bulls++;
        }
        $s = count_chars($secret, 1);
        $g = count_chars($guess, 1);
        foreach (array_intersect_key($s, $g) as $charN => $freq) {
            $cows += min($s[$charN], $g[$charN]);
        }
        $cows -= $bulls;
//        return $bulls . 'A' . $cows . 'B';
        return "{$bulls}A{$cows}B";
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['secret'] = "1807";
$cases[0]['Input']['guess'] = "7810";
$cases[0]['expectedOutput'] = "1A3B";
$cases[1]['Input']['secret'] = "1123";
$cases[1]['Input']['guess'] = "0111";
$cases[1]['expectedOutput'] = "1A1B";

// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->getHint($case['Input']['secret'], $case['Input']['guess']);
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