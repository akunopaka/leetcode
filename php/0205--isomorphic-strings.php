<?php
//205. Isomorphic Strings
//https://leetcode.com/problems/isomorphic-strings
//Easy
//Given two strings s and t, determine if they are isomorphic.
//Two strings s and t are isomorphic if the characters in s can be replaced to get t.
//All occurrences of a character must be replaced with another character while preserving the order of characters.
// No two characters may map to the same character, but a character may map to itself.
//
//Example 1:
//Input: s = "egg", t = "add"
//Output: true
//Example 2:
//Input: s = "foo", t = "bar"
//Output: false
//Example 3:
//Input: s = "paper", t = "title"
//Output: true
//
//Constraints:
//1 <= s.length <= 5 * 104
//t.length == s.length
//s and t consist of any valid ascii character.


class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isIsomorphic(string $s, string $t): bool
    {
        if (strlen($s) !== strlen($t)) return false;
        $map = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if (!array_key_exists($s[$i], $map) && !in_array($t[$i], $map)) {
                $map[$s[$i]] = $t[$i];
            } else if ($map[$s[$i]] !== $t[$i]) {
                return false;
            }
        }
        return true;
    }

    function isIsomorphic_2(string $s, string $t): bool
    {
        $map = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if (!array_key_exists($s[$i], $map)) {
                // Check if the character in string t is already mapped
                if (in_array($t[$i], $map)) {
                    return false;
                }
                // Map characters
                $map[$s[$i]] = $t[$i];
            } else if ($map[$s[$i]] != $t[$i]) {
                return false;
            }
        }
        return true;
    }


    function isIsomorphic_3(string $s, string $t): bool
    {
        $res = false;
        $map = [];
        $map2 = [];
        $sLen = strlen($s);
        for ($i = 0; $i < $sLen; $i++) {
            $sChar = $s[$i];
            $tChar = $t[$i];
            if (!isset($map[$sChar]) && !isset($map2[$tChar])) {
                $map[$sChar] = $tChar;
                $map2[$tChar] = $sChar;
                $s = substr_replace($s, $tChar, $i, 1);
            } else {
                if (!isset($map[$sChar]) && isset($map2[$tChar])) {
                    return false;
                }
                $s = substr_replace($s, $map[$sChar], $i, 1);
            }
        }
        if ($s == $t) {
            $res = true;
        }
        return $res;
    }
}

$cases = [];
$cases[0]['Input']['str1'] = 'paper';
$cases[0]['Input']['str2'] = 'title';
$cases[0]['Output'] = true;

$cases[1]['Input']['str1'] = 'badc';
$cases[1]['Input']['str2'] = 'baba';
$cases[1]['Output'] = false;


$run = new Solution();
foreach ($cases as $case) {
    $result = $run->isIsomorphic($case['Input']['str1'], $case['Input']['str2']);
    printResult($result, $case);
}

function printResult($result, $case)
{
    echo '<pre>' . '--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    print_r($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    print_r($case['Output']);
    echo '</pre>--------' . PHP_EOL;
}