### 1456. Maximum Number of Vowels in a Substring of Given Length

Difficulty: `Medium`

https://leetcode.com/problems/maximum-number-of-vowels-in-a-substring-of-given-length/



<p>Given a string <code>s</code> and an integer <code>k</code>, return <em>the maximum number of vowel letters in any substring of </em><code>s</code><em> with length </em><code>k</code>.</p>
<p><strong>Vowel letters</strong> in English are <code>'a'</code>, <code>'e'</code>, <code>'i'</code>, <code>'o'</code>, and <code>'u'</code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "abciiidef", k = 3
<strong>Output:</strong> 3
<strong>Explanation:</strong> The substring "iii" contains 3 vowel letters.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "aeiou", k = 2
<strong>Output:</strong> 2
<strong>Explanation:</strong> Any substring of length 2 contains 2 vowels.
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> s = "leetcode", k = 3
<strong>Output:</strong> 2
<strong>Explanation:</strong> "lee", "eet" and "ode" contain 2 vowels.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length &lt;= 10<sup>5</sup></code></li>
	<li><code>s</code> consists of lowercase English letters.</li>
	<li><code>1 &lt;= k &lt;= s.length</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var maxVowels = function (s, k) {
    let maxVowelsResult = 0;
    const vowels = ['a', 'e', 'i', 'o', 'u'];
    const isVowel = s => s === 'a' || s === 'e' || s === 'i' || s === 'o' || s === 'u';

    // use sliding window
    let left = 0;
    let right = 0;
    let currentVowels = 0;

    while (right < s.length) {
        // if (vowels.includes(s[right])) {
        if (isVowel(s[right])) {
            currentVowels++;
        }
        if (right - left + 1 === k) {
            maxVowelsResult = Math.max(maxVowelsResult, currentVowels);
            // if (vowels.includes(s[left])) {
            if (isVowel(s[left])) {
                currentVowels--;
            }
            left++;
        }
        right++;
    }

    return maxVowelsResult;
};
```

##### PHP

```php
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
```

