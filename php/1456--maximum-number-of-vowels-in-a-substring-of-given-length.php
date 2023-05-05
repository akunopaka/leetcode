<?php
//  1456. Maximum Number of Vowels in a Substring of Given Length
//  https://leetcode.com/problems/maximum-number-of-vowels-in-a-substring-of-given-length/
//  Medium
//  
//    Given a string s and an integer k, return the maximum number of vowel letters in any substring of s with length k.
//    Vowel letters in English are 'a', 'e', 'i', 'o', and 'u'.
//    Example 1:
//    Input: s = "abciiidef", k = 3
//    Output: 3
//    Explanation: The substring "iii" contains 3 vowel letters.
//    Example 2:
//    Input: s = "aeiou", k = 2
//    Output: 2
//    Explanation: Any substring of length 2 contains 2 vowels.
//    Example 3:
//    Input: s = "leetcode", k = 3
//    Output: 2
//    Explanation: "lee", "eet" and "ode" contain 2 vowels.
//    Constraints:
//    1 &lt;= s.length &lt;= 105
//    s consists of lowercase English letters.
//    1 &lt;= k &lt;= s.length


class Solution
{
    /**
     * @param String $s
     * @param Integer $k
     * @return Integer
     */
    function maxVowels(string $s, int $k): int {
        $maxVowelsResult = 0;
        $vowels = ['a', 'e', 'i', 'o', 'u'];
        $vowelsCountCurrent = 0;
        $leftIndex = 0;
        $rightIndex = 0;
        $sLength = strlen($s);
        while ($rightIndex < $sLength) {
            if (in_array($s[$rightIndex], $vowels)) {
                $vowelsCountCurrent++;
            }
            if ($rightIndex - $leftIndex + 1 == $k) {
                $maxVowelsResult = max($maxVowelsResult, $vowelsCountCurrent);
                if (in_array($s[$leftIndex], $vowels)) {
                    $vowelsCountCurrent--;
                }
                $leftIndex++;
            }
            $rightIndex++;
        }
        return $maxVowelsResult;
    }
}