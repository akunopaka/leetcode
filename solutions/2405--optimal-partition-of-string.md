### 2405. Optimal Partition of String

Difficulty: `Medium`

https://leetcode.com/problems/optimal-partition-of-string/

<p>Given a string <code>s</code>, partition the string into one or more <strong>substrings</strong> such that the characters in each substring are <strong>unique</strong>. That is, no letter appears in a single substring more than <strong>once</strong>.</p>
<p>Return <em>the <strong>minimum</strong> number of substrings in such a partition.</em></p>
<p>Note that each character should belong to exactly one substring in a partition.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "abacaba"
<strong>Output:</strong> 4
<strong>Explanation:</strong>
Two possible partitions are ("a","ba","cab","a") and ("ab","a","ca","ba").
It can be shown that 4 is the minimum number of substrings needed.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "ssssss"
<strong>Output:</strong> 6
<strong>Explanation:
</strong>The only valid partition is ("s","s","s","s","s","s").
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length &lt;= 10<sup>5</sup></code></li>
	<li><code>s</code> consists of only English lowercase letters.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
// charCodeAt
var partitionString = function (s) {
    let substringsCount = 1;
    const sLength = s.length;
    let map = [];
    for (var i = 0; i < sLength; i++) {
        charCode = s.charCodeAt(i);
        if (map[charCode] != undefined) {
            substringsCount++;
            map = [];
        }
        map[charCode] = true;
    }
    return substringsCount;
};

// SET()
var partitionString____set = function (s) {
    let substringsCount = 1;
    const map = new Set();
    for (const char of s) {
        if (map.has(char)) {
            map.clear();
            substringsCount++;
        }
        map.add(char);
    }
    return substringsCount;
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
    function partitionString(string $s): int {
        $substringsCountResult = 1;
        $stringLength = strlen($s);
        $map = [];
        for ($i = 0; $i < $stringLength; $i++) {
            if(isset($map[$s[$i]])){
                $map = [];
                $substringsCountResult++;
            }
            $map[$s[$i]] = true;
        }
        return $substringsCountResult;
    }
}
```

