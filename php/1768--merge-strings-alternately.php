<?php
//  1768. Merge Strings Alternately
//  https://leetcode.com/problems/merge-strings-alternately/
//  Easy
//  
//    You are given two strings word1 and word2. Merge the strings by adding letters in alternating order, starting with word1. If a string is longer than the other, append the additional letters onto the end of the merged string.
//    Return the merged string.
//    Example 1:
//    Input: word1 = "abc", word2 = "pqr"
//    Output: "apbqcr"
//    Explanation:&nbsp;The merged string will be merged as so:
//    word1:  a   b   c
//    word2:p   q   r
//    merged: a p b q c r
//    Example 2:
//    Input: word1 = "ab", word2 = "pqrs"
//    Output: "apbqrs"
//    Explanation:&nbsp;Notice that as word2 is longer, "rs" is appended to the end.
//    word1:  a   b 
//    word2:p   q   r   s
//    merged: a p b q   r   s
//    Example 3:
//    Input: word1 = "abcd", word2 = "pq"
//    Output: "apbqcd"
//    Explanation:&nbsp;Notice that as word1 is longer, "cd" is appended to the end.
//    word1:  a   b   c   d
//    word2:p   q 
//    merged: a p b q c   d
//    Constraints:
//    1 &lt;= word1.length, word2.length &lt;= 100
//    word1 and word2 consist of lowercase English letters.

class Solution
{
    /**
     * @param String $word1
     * @param String $word2
     * @return String
     */
    function mergeAlternately(string $word1, string $word2): string {
        $lengthW1 = strlen($word1);
        $lengthW2 = strlen($word2);
        $lengthMin = min($lengthW1, $lengthW2);
        $result = '';
        for ($i = 0; $i < $lengthMin; $i++) {
            $result .= $word1[$i] . $word2[$i];
        }
        return $result . substr($word1, $lengthMin) . substr($word2, $lengthMin);
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['word1'] = "abc";
$cases[0]['Input']['word2'] = "pqr";
$cases[0]['expectedOutput'] = "apbqcr";


// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->mergeAlternately($case['Input']['word1'], $case['Input']['word2']);
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