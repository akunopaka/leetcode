<?php
// 692. Top K Frequent Words
// https://leetcode.com/problems/top-k-frequent-words/
// Medium
//     Given an array of strings words and an integer k, return the k most frequent strings.
//     Return the answer sorted by the frequency from highest to lowest. Sort the words with the same frequency by their lexicographical order.
//
//
//
//     Example 1:
//     Input: words = ["i","love","leetcode","i","love","coding"], k = 2
//     Output: ["i","love"]
//     Explanation: "i" and "love" are the two most frequent words.
//     Note that "i" comes before "love" due to a lower alphabetical order.
//     Example 2:
//     Input: words = ["the","day","is","sunny","the","the","the","sunny","is","is"], k = 4
//     Output: ["the","is","sunny","day"]
//     Explanation: "the", "is", "sunny" and "day" are the four most frequent words, with the number of occurrence being 4, 3, 2 and 1 respectively.
//
//
//     Constraints:
//     1 <= words.length <= 500
//     1 <= words[i].length <= 10
//     words[i] consists of lowercase English letters.
//     k is in the range [1, The number of unique words[i]]
//
//     Follow-up: Could you solve it in O(n log(k)) time and O(n) extra space?

// sorting array SOlUTION
class Solution____array_sorting
{
    function topKFrequent($words, $k) {
        sort($words);
        $words = array_count_values($words);
        arsort($words);
        return array_keys(array_slice($words, 0, $k, true));
    }
}

// HEAP SOlUTION
class Solution
{
    function topKFrequent($words, $k) {
        sort($words);
        $words = array_count_values($words);
        $queue = new SplPriorityQueue();
        $i = 0;
        foreach ($words as $word => $wordCount) {
            $queue->insert($word, $wordCount * 1000 - $i++);
        }
        $res = [];
        for ($i = 0; $i < $k; $i++) {
            $res[] = $queue->extract();
        }
        return $res;
    }
}


class Solution___2
{
    /**
     * @param String[] $words
     * @param Integer $k
     * @return String[]
     */
    function topKFrequent($words, $k) {
        $words = array_count_values($words);
        $wordsHeap = new maxHeapFromArray();
        foreach ($words as $word => $wordCount) {
            $wordsHeap->insert(array($word => $wordCount));
        }
        $res = [];
        for ($i = 0; $i < $k; $i++) {
            $res[] = array_keys($wordsHeap->extract())[0];
        }
        return $res;
    }
}

class maxHeapFromArray extends SplHeap
{
    /**
     * @param mixed $array1
     * @param mixed $array2
     * @return int
     */
    public function compare(mixed $array1, mixed $array2): int {
        if (array_values($array1)[0] === array_values($array2)[0]) {
            if (array_keys($array1)[0] === array_keys($array2)[0]) {
                return 0;
            } else {
                return array_keys($array1)[0] < array_keys($array2)[0] ? 1 : -1;
            }
        }
        return array_values($array1)[0] < array_values($array2)[0] ? -1 : 1;
    }
}

// Test Cases
$cases = [];
$cases[2]['Input']['words'] = ["i", "love", "leetcode", "i", "love", "coding"];
$cases[2]['Input']['k'] = 3;
$cases[2]['expectedOutput'] = ["i", "love", "coding"];

$cases[0]['Input']['words'] = ["xx", "i", "love", "xxx", "leetcode", "i", "love", "xx", "aaa", "coding"];
$cases[0]['Input']['k'] = 2;
$cases[0]['expectedOutput'] = ['i', "love"];
$cases[1]['Input']['words'] = ["the", "day", "is", "sunny", "the", "the", "the", "sunny", "is", "is"];
$cases[1]['Input']['k'] = 4;
$cases[1]['expectedOutput'] = ["the", "is", "sunny", "day"];
$cases[5]['Input']['words'] = ["i", "love", "leetcode", "i", "love", "coding"];
$cases[5]['Input']['k'] = 2;
$cases[5]['expectedOutput'] = ["i", "love"];
// $cases[2]['Input']['words'] = '';
// $cases[2]['Input']['k'] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['words'] = '';
// $cases[3]['Input']['k'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['words'] = '';
// $cases[4]['Input']['k'] = '';
// $cases[4]['expectedOutput'] = '';
// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->topKFrequent($case['Input']['words'], $case['Input']['k']);
    echoResult($result, $case['expectedOutput']);
}
/**
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo PHP_EOL . '<pre>' . '--------' . PHP_EOL . 'Result:' . PHP_EOL;
    var_export($result);
    if ($result != $expectedOutput) {
        echo PHP_EOL . '!!! >>FAIL<< !!!';
        echo PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL;
        var_export($expectedOutput);
    } else echo ' << OK!' . PHP_EOL;
    echo '</pre>';
}