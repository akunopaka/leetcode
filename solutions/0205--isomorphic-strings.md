### 205. Isomorphic Strings

https://leetcode.com/problems/isomorphic-strings

<p>Given two strings <code>s</code> and <code>t</code>, <em>determine if they are isomorphic</em>.</p>

<p>Two strings <code>s</code> and <code>t</code> are isomorphic if the characters in <code>s</code> can be replaced to get <code>t</code>.</p>

<p>All occurrences of a character must be replaced with another character while preserving the order of characters. No two characters may map to the same character, but a character may map to itself.</p>

<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "egg", t = "add"
<strong>Output:</strong> true
</pre><p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "foo", t = "bar"
<strong>Output:</strong> false
</pre><p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> s = "paper", t = "title"
<strong>Output:</strong> true
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length &lt;= 5 * 10<sup>4</sup></code></li>
	<li><code>t.length == s.length</code></li>
	<li><code>s</code> and <code>t</code> consist of any valid ascii character.</li>
</ul>


<p>&nbsp;</p>

#### .JS

```js
var isIsomorphic = function (s, t) {
    for (var i = 0; i < s.length; i++) {
        if (s.indexOf(s[i]) !== t.indexOf(t[i])) return false;
    }
    return true;
};
```

-- OR --

```js
var isIsomorphic = function (s, t) {
    if (s.length !== t.length) return false;
    let mapS = {};
    let mapT = {};
    for (let i = 0; i < s.length; i++) {
        if (mapS[s[i]] === undefined) {
            mapS[s[i]] = t[i];
        } else {
            if (mapS[s[i]] !== t[i]) return false;
        }
        if (mapT[t[i]] === undefined) {
            mapT[t[i]] = s[i];
        } else {
            if (mapT[t[i]] !== s[i]) return false;
        }
    }
    return true;
};
```

#### PHP

```php
class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isIsomorphic(string $s, string $t): bool
    {
        if (strlen($s) !== strlen($t)) return false;
        $map = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if (!array_key_exists($s[$i], $map) && !in_array($t[$i], $map)) {
                $map[$s[$i]] = $t[$i];
            } else if ($map[$s[$i]] !== $t[$i]) {
                return false;
            }
        }
        return true;
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
     function isIsomorphic(string $s, string $t): bool
    {
        $map = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if (!array_key_exists($s[$i], $map)) {
                // Check if the character in string t is already mapped
                if (in_array($t[$i], $map)) {
                    return false;
                }
                // Map characters
                $map[$s[$i]] = $t[$i];
            } else if ($map[$s[$i]] != $t[$i]) {
                return false;
            }
        }
        return true;
    }
}
```