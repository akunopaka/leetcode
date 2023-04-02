### 409. Longest Palindrome

Easy

https://leetcode.com/problems/longest-palindrome/description/

<p>Given a string <code>s</code> which consists of lowercase or uppercase letters, return <em>the length of the <strong>longest palindrome</strong></em>&nbsp;that can be built with those letters.</p>

<p>Letters are <strong>case sensitive</strong>, for example,&nbsp;<code>"Aa"</code> is not considered a palindrome here.</p>

<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "abccccdd"
<strong>Output:</strong> 7
<strong>Explanation:</strong> One longest palindrome that can be built is "dccaccd", whose length is 7.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "a"
<strong>Output:</strong> 1
<strong>Explanation:</strong> The longest palindrome that can be built is "a", whose length is 1.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length &lt;= 2000</code></li>
	<li><code>s</code> consists of lowercase <strong>and/or</strong> uppercase English&nbsp;letters only.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
var longestPalindrome = function (s) {
    let t = 0;
    let chars = {};
    for (let i = 0; i < s.length; i++) {
        if (chars[s[i]]) {
            chars[s[i]]++;
        } else {
            chars[s[i]] = 1;
        }
    }
    for (let val in chars) {
        t += Math.floor(chars[val] / 2) * 2;
        if (t % 2 == 0 && chars[val] % 2 == 1) {
            t++;
        }
    }
    return parseInt(t);
};
```

##### PHP

```php
class Solution
{
    /**
     * @param String $s
     * @return Integer
     */
    function longestPalindrome(string $string): int {
        $longestPalindrome = 0;
        foreach (count_chars($string) as $val) {
            $longestPalindrome += floor($val / 2) * 2;
            if ($longestPalindrome % 2 == 0 && $val % 2 == 1) {
                $longestPalindrome++;
            }
        }
        return (int)$longestPalindrome;
    }

    function longestPalindrome___2(string $s): int {
        $length = strlen($s);
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[$s[$i]]++;
        }
        $result = 0;
        $hasOdd = false;
        foreach ($arr as $key => $value) {
            if ($value % 2 == 0) {
                $result += $value;
            } else {
                $hasOdd = true;
                $result += $value - 1;
            }
        }
        if ($hasOdd) {
            $result++;
        }
        return $result;
    }
}

```

