<?php
//  1639. Number of Ways to Form a Target String Given a Dictionary
//  https://leetcode.com/problems/number-of-ways-to-form-a-target-string-given-a-dictionary/
//  Hard
//  
//    You are given a list of strings of the same length words and a string target.
//    Your task is to form target using the given words under the following rules:
//    target should be formed from left to right.
//    To form the ith character (0-indexed) of target, you can choose the kth character of the jth string in words if target[i] = words[j][k].
//    Once you use the kth character of the jth string of words, you can no longer use the xth character of any string in words where x &lt;= k. In other words, all characters to the left of or at index k become unusuable for every string.
//    Repeat the process until you form the string target.
//    Notice that you can use multiple characters from the same string in words provided the conditions above are met.
//    Return the number of ways to form target from words. Since the answer may be too large, return it modulo 109 + 7.
//    Example 1:
//    Input: words = ["acca","bbbb","caca"], target = "aba"
//    Output: 6
//    Explanation: There are 6 ways to form target.
//    "aba" -&gt; index 0 ("acca"), index 1 ("bbbb"), index 3 ("caca")
//    "aba" -&gt; index 0 ("acca"), index 2 ("bbbb"), index 3 ("caca")
//    "aba" -&gt; index 0 ("acca"), index 1 ("bbbb"), index 3 ("acca")
//    "aba" -&gt; index 0 ("acca"), index 2 ("bbbb"), index 3 ("acca")
//    "aba" -&gt; index 1 ("caca"), index 2 ("bbbb"), index 3 ("acca")
//    "aba" -&gt; index 1 ("caca"), index 2 ("bbbb"), index 3 ("caca")
//    Example 2:
//    Input: words = ["abba","baab"], target = "bab"
//    Output: 4
//    Explanation: There are 4 ways to form target.
//    "bab" -&gt; index 0 ("baab"), index 1 ("baab"), index 2 ("abba")
//    "bab" -&gt; index 0 ("baab"), index 1 ("baab"), index 3 ("baab")
//    "bab" -&gt; index 0 ("baab"), index 2 ("baab"), index 3 ("baab")
//    "bab" -&gt; index 1 ("abba"), index 2 ("baab"), index 3 ("baab")
//    Constraints:
//    1 &lt;= words.length &lt;= 1000
//    1 &lt;= words[i].length &lt;= 1000
//    All strings in words have the same length.
//    1 &lt;= target.length &lt;= 1000
//    words[i] and target contain only lowercase English letters.

class Solution
{
    function numWays(array $words, string $target): int {
        $wordsLength = strlen($words[0]);
        $targetLength = strlen($target);
        $lettersCount = array_fill(0, $wordsLength, array_fill_keys(range('a', 'z'), 0));

        foreach ($words as $word) {
            for ($i = 0; $i < $wordsLength; $i++) {
                $lettersCount[$i][$word[$i]]++;
            }
        }
        $a = [];
        $a[1] = array_fill(-1, $wordsLength + 1, 1);
        $a[0] = array_fill(-1, $wordsLength + 1, 0);
        for ($indexTarget = 0; $indexTarget < $targetLength; $indexTarget++) {
            $s = 0;
            $c = $indexTarget % 2;
            for ($j = $indexTarget; $j < $wordsLength; $j++) {
                $s += $a[1 - $c][$j - 1] * $lettersCount[$j][$target[$indexTarget]];
                $a[$c][$j] = $s % (10 ** 9 + 7);
            }
        }
        return end($a[$c]) % (10 ** 9 + 7);
    }


//    function numWays(array $words, string $target): int {
//        // get 2d array of letters positions and count in words
//        $lettersCount = [];
//        $wordsLength = strlen($words[0]);
//        foreach ($words as $word) for ($i = 0; $i < $wordsLength; $i++) {
//            $letter = $word[$i];
//            isset($lettersCount[$i][$letter]) ? $lettersCount[$i][$letter]++ : $lettersCount[$i][$letter] = 1;
//        }
//        return $this->getWays(0, 0, $lettersCount, $target, strlen($target), $wordsLength);
//    }
//
//    // indexTarget - index of target letter
//    // indexWord - index of word letter words[$j][$indexWord]
//    function getWays($indexTarget, $indexWord, $lettersCount, &$target, $targetLength, $wordsLength): int {
//        if ($indexTarget == $targetLength) return 1;
//        if ($indexWord == $wordsLength) return 0;
//        if (isset($cache[$indexTarget][$indexWord])) {
//            echo "cache hit: $indexTarget $indexWord; ";
//            return $cache[$indexTarget][$indexWord];
//        }
//
//        // cache indexTarget indexWord => waysNumber
//            $lettersCount[$indexWord][$target[$indexTarget]] ?? $lettersCount[$indexWord][$target[$indexTarget]] = 0;
//        $cache[$indexTarget][$indexWord] = $this->getWays($indexTarget, $indexWord + 1, $lettersCount, $target, $targetLength, $wordsLength);
//        $cache[$indexTarget][$indexWord] += $lettersCount[$indexWord][$target[$indexTarget]] * $this->getWays($indexTarget + 1, $indexWord + 1, $lettersCount, $target, $targetLength, $wordsLength);
//        return $cache[$indexTarget][$indexWord] % 1000000007;
//    }

}


// Test Cases
$cases = [];
//$cases[0]['Input']['words'] = ["acca", "bbbb", "caca"];
//$cases[0]['Input']['target'] = "aba";
//$cases[0]['expectedOutput'] = 6;
//$cases[1]['Input']['words'] = ["abba", "baab"];
//$cases[1]['Input']['target'] = "bab";
//$cases[1]['expectedOutput'] = 4;
$cases[2]['Input']['words'] = ["cabbaacaaaccaabbbbaccacbabbbcb", "bbcabcbcccbcacbbbaacacaaabbbac", "cbabcaacbcaaabbcbaabaababbacbc", "aacabbbcaaccaabbaccacabccaacca", "bbabbaabcaabccbbabccaaccbabcab", "bcaccbbaaccaabcbabbacaccbbcbbb", "bcbbaabbbccababacacacacacababa"];
$cases[2]['Input']['target'] = "acbaccacbbaaabbbabac";
$cases[2]['expectedOutput'] = 1111;
// $cases[3]['Input']['words'] = '';
// $cases[3]['Input']['target'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['words'] = '';
// $cases[4]['Input']['target'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->numWays($case['Input']['words'], $case['Input']['target']);
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