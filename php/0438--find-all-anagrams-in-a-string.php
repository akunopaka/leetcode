<?php
//  438. Find All Anagrams in a String
//  https://leetcode.com/problems/find-all-anagrams-in-a-string/
//  Medium
//    Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.
//    An Anagram is a word or phrase formed by rearranging the letters of a different word or phrase, typically using all the original letters exactly once.
//
//    Example 1:
//    Input: s = "cbaebabacd", p = "abc"
//    Output: [0,6]
//    Explanation:
//    The substring with start index = 0 is "cba", which is an anagram of "abc".
//    The substring with start index = 6 is "bac", which is an anagram of "abc".
//    Example 2:
//    Input: s = "abab", p = "ab"
//    Output: [0,1,2]
//    Explanation:
//    The substring with start index = 0 is "ab", which is an anagram of "ab".
//    The substring with start index = 1 is "ba", which is an anagram of "ab".
//    The substring with start index = 2 is "ab", which is an anagram of "ab".
//    Constraints:
//    1 <= s.length, p.length <= 3 * 104
//    s and p consist of lowercase English letters.

class Solution
{
    /**
     * @param String $s
     * @param String $p
     * @return Integer[]
     */
    function findAnagrams(string $s, string $p): array {
        $sLen = strlen($s);
        $pLen = strlen($p);
        $result = [];
        if ($sLen < $pLen) return $result;

        $sCount = $pCount = array_fill(0, 26, 0);

        for ($i = 0; $i < $pLen; $i++) {
            $pCount[ord($p[$i]) - ord('a')]++;
            $sCount[ord($s[$i]) - ord('a')]++;
        }

        if ($pCount == $sCount) $result[] = 0;

        for ($i = $pLen; $i < $sLen; $i++) {
            $sCount[ord($s[$i]) - ord('a')]++;
            $sCount[ord($s[$i - $pLen]) - ord('a')]--;
            if ($pCount == $sCount) {
                $result[] = $i - $pLen + 1;
            }
        }
        return $result;
    }

//    // my 1st solution - slow
//    function findAnagrams(string $s, string $p): array {
//        $res = [];
//        $pArr = str_split($p);
//        sort($pArr);
//        for ($i = 0; $i < strlen($s); $i++) {
//            $tempArr = str_split(substr($s, $i, strlen($p)));
//            sort($tempArr);
//            if ($tempArr == $pArr) {
//                $res[] = $i;
//            }
//        }
//        return $res;
//    }
}

$cases = [];
$cases[0]['Input']['s'] = 'cbaebabacd';
$cases[0]['Input']['p'] = 'abc';
$cases[0]['Output'] = [0, 6];

$run = new Solution();
foreach ($cases as $case) {
    $result = $run->findAnagrams($case['Input']['s'], $case['Input']['p']);
    echo '<pre>--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    print_r($result);
    echo 'Valid is:' . PHP_EOL;
    print_r($case['Output']);
    echo '</pre>--------' . PHP_EOL;
}