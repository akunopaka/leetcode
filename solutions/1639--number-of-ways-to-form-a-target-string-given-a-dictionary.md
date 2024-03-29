### 1639. Number of Ways to Form a Target String Given a Dictionary

Difficulty: `Hard`

https://leetcode.com/problems/number-of-ways-to-form-a-target-string-given-a-dictionary/



<p>You are given a list of strings of the <strong>same length</strong> <code>words</code> and a string <code>target</code>.</p>
<p>Your task is to form <code>target</code> using the given <code>words</code> under the following rules:</p>
<ul>
	<li><code>target</code> should be formed from left to right.</li>
	<li>To form the <code>i<sup>th</sup></code> character (<strong>0-indexed</strong>) of <code>target</code>, you can choose the <code>k<sup>th</sup></code> character of the <code>j<sup>th</sup></code> string in <code>words</code> if <code>target[i] = words[j][k]</code>.</li>
	<li>Once you use the <code>k<sup>th</sup></code> character of the <code>j<sup>th</sup></code> string of <code>words</code>, you <strong>can no longer</strong> use the <code>x<sup>th</sup></code> character of any string in <code>words</code> where <code>x &lt;= k</code>. In other words, all characters to the left of or at index <code>k</code> become unusuable for every string.</li>
	<li>Repeat the process until you form the string <code>target</code>.</li>
</ul>
<p><strong>Notice</strong> that you can use <strong>multiple characters</strong> from the <strong>same string</strong> in <code>words</code> provided the conditions above are met.</p>
<p>Return <em>the number of ways to form <code>target</code> from <code>words</code></em>. Since the answer may be too large, return it <strong>modulo</strong> <code>10<sup>9</sup> + 7</code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> words = ["acca","bbbb","caca"], target = "aba"
<strong>Output:</strong> 6
<strong>Explanation:</strong> There are 6 ways to form target.
"aba" -&gt; index 0 ("<u>a</u>cca"), index 1 ("b<u>b</u>bb"), index 3 ("cac<u>a</u>")
"aba" -&gt; index 0 ("<u>a</u>cca"), index 2 ("bb<u>b</u>b"), index 3 ("cac<u>a</u>")
"aba" -&gt; index 0 ("<u>a</u>cca"), index 1 ("b<u>b</u>bb"), index 3 ("acc<u>a</u>")
"aba" -&gt; index 0 ("<u>a</u>cca"), index 2 ("bb<u>b</u>b"), index 3 ("acc<u>a</u>")
"aba" -&gt; index 1 ("c<u>a</u>ca"), index 2 ("bb<u>b</u>b"), index 3 ("acc<u>a</u>")
"aba" -&gt; index 1 ("c<u>a</u>ca"), index 2 ("bb<u>b</u>b"), index 3 ("cac<u>a</u>")
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> words = ["abba","baab"], target = "bab"
<strong>Output:</strong> 4
<strong>Explanation:</strong> There are 4 ways to form target.
"bab" -&gt; index 0 ("<u>b</u>aab"), index 1 ("b<u>a</u>ab"), index 2 ("ab<u>b</u>a")
"bab" -&gt; index 0 ("<u>b</u>aab"), index 1 ("b<u>a</u>ab"), index 3 ("baa<u>b</u>")
"bab" -&gt; index 0 ("<u>b</u>aab"), index 2 ("ba<u>a</u>b"), index 3 ("baa<u>b</u>")
"bab" -&gt; index 1 ("a<u>b</u>ba"), index 2 ("ba<u>a</u>b"), index 3 ("baa<u>b</u>")
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= words.length &lt;= 1000</code></li>
	<li><code>1 &lt;= words[i].length &lt;= 1000</code></li>
	<li>All strings in <code>words</code> have the same length.</li>
	<li><code>1 &lt;= target.length &lt;= 1000</code></li>
	<li><code>words[i]</code> and <code>target</code> contain only lowercase English letters.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
var numWays = function (words, target) {
    const mod = 1e9 + 7;
    const result = new Array(target.length + 1).fill(0);
    result[0] = 1;

    for (let i = 0; i < words[0].length; i++) {
        let count = new Array(26).fill(0);
        for (let word of words) {
            count[word.charCodeAt(i) - 97]++;
        }
        for (let j = target.length - 1; j >= 0; --j) {
            result[j + 1] += result[j] * count[target.charCodeAt(j) - 97] % mod;
        }
    }
    return result[target.length] % mod;
};
```

##### PHP

```php
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
}

```

