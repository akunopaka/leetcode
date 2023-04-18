### 1768. Merge Strings Alternately

Difficulty: `Easy`

https://leetcode.com/problems/merge-strings-alternately/



<p>You are given two strings <code>word1</code> and <code>word2</code>. Merge the strings by adding letters in alternating order, starting with <code>word1</code>. If a string is longer than the other, append the additional letters onto the end of the merged string.</p>
<p>Return <em>the merged string.</em></p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> word1 = "abc", word2 = "pqr"
<strong>Output:</strong> "apbqcr"
<strong>Explanation:</strong>&nbsp;The merged string will be merged as so:
word1:  a   b   c
word2:    p   q   r
merged: a p b q c r
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> word1 = "ab", word2 = "pqrs"
<strong>Output:</strong> "apbqrs"
<strong>Explanation:</strong>&nbsp;Notice that as word2 is longer, "rs" is appended to the end.
word1:  a   b 
word2:    p   q   r   s
merged: a p b q   r   s
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> word1 = "abcd", word2 = "pq"
<strong>Output:</strong> "apbqcd"
<strong>Explanation:</strong>&nbsp;Notice that as word1 is longer, "cd" is appended to the end.
word1:  a   b   c   d
word2:    p   q 
merged: a p b q c   d
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= word1.length, word2.length &lt;= 100</code></li>
	<li><code>word1</code> and <code>word2</code> consist of lowercase English letters.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
var mergeAlternately = function (word1, word2) {
    const [lengthW1, lengthW2] = [word1.length, word2.length];
    const lengthMin = Math.min(lengthW1, lengthW2);
    let i, result = '';
    for (i = 0; i < lengthMin; i++) {
        result += word1[i] + word1[2];
    }
    return result + word1.slice(i) + word2.slice(i);
}
```

##### PHP

```php
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
```

