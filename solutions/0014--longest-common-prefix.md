### 14. Longest Common Prefix

Difficulty: `Easy`

https://leetcode.com/problems/longest-common-prefix/`



<p>Write a function to find the longest common prefix string amongst an array of strings.</p>
<p>If there is no common prefix, return an empty string <code>""</code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> strs = ["flower","flow","flight"]
<strong>Output:</strong> "fl"
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> strs = ["dog","racecar","car"]
<strong>Output:</strong> ""
<strong>Explanation:</strong> There is no common prefix among the input strings.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= strs.length &lt;= 200</code></li>
	<li><code>0 &lt;= strs[i].length &lt;= 200</code></li>
	<li><code>strs[i]</code> consists of only lowercase English letters.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
var longestCommonPrefix1 = function (strs) {
    let res = '';
    if (strs.length === 0) return "";
    if (strs.length === 1) return strs[0];
    for (let i = 0; i < strs[0].length; i++) {
        for (let j = 1; j < strs.length; j++) {
            if (strs[j][i] !== strs[0][i]) {
                return res;
            }
        }
        res += strs[0][i];
    }
    return res;
};
var longestCommonPrefix = function (strs) {
    strs.sort();
    let res = '';
    if (strs.length === 0) return "";
    if (strs.length === 1) return strs[0];
    for (let i = 0; i < strs[0].length; i++) {
        if (strs[strs.length - 1][i] !== strs[0][i]) {
            return res;
        }
        res += strs[0][i];
    }
    return res;
}

var longestCommonPrefix______3 = function (strs) {
    let prefix = strs[0];
    let i = 1;
    while (i < strs.length) {
        if (!strs[i].startsWith(prefix)) {
            prefix = prefix.slice(0, -1);
        } else {
            i++;
        }
    }
    return prefix;
};

```

##### PHP

```php
class Solution
{

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix____2($strs) {
        $prefix = '';
        $strsCount = count($strs);
        if ($strsCount == 0) return $prefix;
        $strsLength = strlen($strs[0]);
        for ($i = 0; $i < $strsLength; $i++) {
            $char = $strs[0][$i];
            for ($j = 1; $j < $strsCount; $j++) {
                if ($strs[$j][$i] != $char) {
                    return $prefix;
                }
            }
            $prefix .= $char;
        }
        return $prefix;
    }

    function longestCommonPrefix($strs) {
        $strsCount = count($strs);
        if ($strsCount == 0) return '';

        $prefix = $strs[0];
        for ($i = 1; $i < $strsCount; $i++) {
            while (!str_starts_with($strs[$i], $prefix)) {
                $prefix = substr($prefix, 0, -1);
                if ($prefix == '') return '';
            }
        }
        return $prefix;
    }

}
```

