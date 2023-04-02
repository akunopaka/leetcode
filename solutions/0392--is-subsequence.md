#### 392. Is Subsequence

https://leetcode.com/problems/is-subsequence/

Easy

<p>Given two strings <code>s</code> and <code>t</code>, return <code>true</code><em> if </em><code>s</code><em> is a <strong>subsequence</strong> of </em><code>t</code><em>, or </em><code>false</code><em> otherwise</em>.</p>

<p>A <strong>subsequence</strong> of a string is a new string that is formed from the original string by deleting some (can be none) of the characters without disturbing the relative positions of the remaining characters. (i.e., <code>"ace"</code> is a subsequence of <code>"<u>a</u>b<u>c</u>d<u>e</u>"</code> while <code>"aec"</code> is not).</p>

<p>&nbsp;</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "abc", t = "ahbgdc"
<strong>Output:</strong> true
</pre><p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "axc", t = "ahbgdc"
<strong>Output:</strong> false
</pre>
<p>&nbsp;</p>
<p><strong>Constraints:</strong></p>

<ul>
	<li><code>0 &lt;= s.length &lt;= 100</code></li>
	<li><code>0 &lt;= t.length &lt;= 10<sup>4</sup></code></li>
	<li><code>s</code> and <code>t</code> consist only of lowercase English letters.</li>
</ul>

<strong>Follow up:</strong> Suppose there are lots of incoming <code>s</code>, say <code>s<sub>1</sub>, s<sub>
2</sub>, ..., s<sub>k</sub></code> where <code>k &gt;= 10<sup>9</sup></code>, and you want to check one by one to see
if <code>t</code> has its subsequence. In this scenario, how would you change your code?

<p>&nbsp;</p>

##### JS

```javascript
var isSubsequence = function (s, t) {
    if (!s) return true;
    if (s === t) return true;
    let sIndex = 0;
    let tIndex = 0;
    while (tIndex < t.length) {
        if (s[sIndex] === t[tIndex]) {
            sIndex++;
        }
        if (sIndex === s.length) {
            return true;
        }
        tIndex++;
    }
    return false;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isSubsequence(string $s, string $t): bool
    {
        if ($s == $t) {
            return true;
        }
        $lengthS = strlen($s);
        $lengthT = strlen($t);
        if ($lengthS > $lengthT) {
            return false;
        }
        $j = 0;
        for ($i = 0; $i < $lengthT; $i++) {
            if ($s[$j] == $t[$i]) {
                $j++;
            }
            if ($j == $lengthS) {
                return true;
            }
        }
        return false;
    }
}
```

-- OR --

```php
class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    // 3ms
    function isSubsequence(string $s, string $t): bool
        if($s == $t) {
            return true;
        }
        $length = strlen($t);
        for($i = 0; $i < $length; $i++){
            if($s[0] == $t[$i]){
                $s = substr($s, 1);
            }
            if($s == ''){
                return true;
            }
        }
        return false;
    }
}
```