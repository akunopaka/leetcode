### 438. Find All Anagrams in a String

Difficulty: `Medium`

https://leetcode.com/problems/find-all-anagrams-in-a-string/

<p>Given two strings <code>s</code> and <code>p</code>, return <em>an array of all the start indices of </em><code>p</code><em>'s anagrams in </em><code>s</code>. You may return the answer in <strong>any order</strong>.</p>

<p>An <strong>Anagram</strong> is a word or phrase formed by rearranging the letters of a different word or phrase, typically using all the original letters exactly once.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "cbaebabacd", p = "abc"
<strong>Output:</strong> [0,6]
<strong>Explanation:</strong>
The substring with start index = 0 is "cba", which is an anagram of "abc".
The substring with start index = 6 is "bac", which is an anagram of "abc".
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "abab", p = "ab"
<strong>Output:</strong> [0,1,2]
<strong>Explanation:</strong>
The substring with start index = 0 is "ab", which is an anagram of "ab".
The substring with start index = 1 is "ba", which is an anagram of "ab".
The substring with start index = 2 is "ab", which is an anagram of "ab".
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length, p.length &lt;= 3 * 10<sup>4</sup></code></li>
	<li><code>s</code> and <code>p</code> consist of lowercase English letters.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
/**
 * @param {string} s
 * @param {string} p
 * @return {number[]}
 */
var findAnagrams = function (s, p) {
        let sLen = s.length;
        let pLen = p.length;
        let result = [];
        if (sLen < pLen) {
            return result;
        }

        let pCount = Array(26).fill(0);
        let sCount = [...pCount];
        for (let i = 0; i < pLen; i++) {
            pCount[p.charCodeAt(i) - 97]++;
            sCount[s.charCodeAt(i) - 97]++;
        }

        if (pCount.toString() === sCount.toString()) {
            result.push(0);
        }

        for (let i = pLen; i < sLen; i++) {
            sCount[s.charCodeAt(i) - 97]++;
            sCount[s.charCodeAt(i - pLen) - 97]--;
            if (pCount.toString() === sCount.toString()) {
                result.push(i - pLen + 1);
            }
        }

        return result;
    };
```

##### PHP

```php
    function findAnagrams($s, $p)
    {
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
```

