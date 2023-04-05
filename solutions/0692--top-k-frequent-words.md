### 692. Top K Frequent Words

Difficulty: `Medium`

https://leetcode.com/problems/top-k-frequent-words/

<p>Given an array of strings <code>words</code> and an integer <code>k</code>, return <em>the </em><code>k</code><em> most frequent strings</em>.</p>

<p>Return the answer <strong>sorted</strong> by <strong>the frequency</strong> from highest to lowest. Sort the words with the same frequency by their <strong>lexicographical order</strong>.</p>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> words = ["i","love","leetcode","i","love","coding"], k = 2
<strong>Output:</strong> ["i","love"]
<strong>Explanation:</strong> "i" and "love" are the two most frequent words.
Note that "i" comes before "love" due to a lower alphabetical order.
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> words = ["the","day","is","sunny","the","the","the","sunny","is","is"], k = 4
<strong>Output:</strong> ["the","is","sunny","day"]
<strong>Explanation:</strong> "the", "is", "sunny" and "day" are the four most frequent words, with the number of occurrence being 4, 3, 2 and 1 respectively.
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= words.length &lt;= 500</code></li>
	<li><code>1 &lt;= words[i].length &lt;= 10</code></li>
	<li><code>words[i]</code> consists of lowercase English letters.</li>
	<li><code>k</code> is in the range <code>[1, The number of <strong>unique</strong> words[i]]</code></li>
</ul>

<p><strong>Follow-up:</strong> Could you solve it in <code>O(n log(k))</code> time and <code>O(n)</code> extra space?</p>
<p>&nbsp;</p>

### My Solution(s):

##### PHP

```php
// sorting array SOlUTION
class Solution____array_sorting
{
    function topKFrequent($words, $k)
    {
        sort($words);
        $words = array_count_values($words);
        arsort($words);
        return array_keys(array_slice($words, 0, $k, true));
    }
}
// -- OR --

class Solution____akunopaka_HEAP
{
    /**
     * @param String[] $words
     * @param Integer $k
     * @return String[]
     */
    function topKFrequent($words, $k)
    {
        $words = array_count_values($words);
        $wordsHeap = new topHeap();
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

class topHeap extends SplHeap
{
    public function compare($array1, $array2): int
    {
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
```

##### JavaScript

```js
var topKFrequent = function (words, k) {
    // Create a hash table to store the frequency of each word
    let hash = {};
    for (let i = 0; i < words.length; i += 1) {
        if (hash[words[i]]) {
            hash[words[i]] += 1;
        } else {
            hash[words[i]] = 1;
        }
    }
    // Create an array of the words in the hash table
    let arr = Object.keys(hash);
    // Sort the array by frequency and lexicographical order
    arr.sort((a, b) => {
        if (hash[a] === hash[b]) {
            return a.localeCompare(b);
        } else {
            return hash[b] - hash[a];
        }
    });
    // Return the first k elements of the array
    return arr.slice(0, k);
};
```
