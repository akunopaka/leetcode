### 443. String Compression

Difficulty: `Medium`

https://leetcode.com/problems/string-compression/

<p>Given an array of characters <code>chars</code>, compress it using the following algorithm:</p>

<p>Begin with an empty string <code>s</code>. For each group of <strong>consecutive repeating characters</strong> in <code>chars</code>:</p>

<ul>
	<li>If the group's length is <code>1</code>, append the character to <code>s</code>.</li>
	<li>Otherwise, append the character followed by the group's length.</li>
</ul>

<p>The compressed string <code>s</code> <strong>should not be returned separately</strong>, but instead, be stored <strong>in the input character array <code>chars</code></strong>. Note that group lengths that are <code>10</code> or longer will be split into multiple characters in <code>chars</code>.</p>

<p>After you are done <strong>modifying the input array,</strong> return <em>the new length of the array</em>.</p>

<p>You must write an algorithm that uses only constant extra space.</p>

<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> chars = ["a","a","b","b","c","c","c"]
<strong>Output:</strong> Return 6, and the first 6 characters of the input array should be: ["a","2","b","2","c","3"]
<strong>Explanation:</strong> The groups are "aa", "bb", and "ccc". This compresses to "a2b2c3".
</pre>

<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> chars = ["a"]
<strong>Output:</strong> Return 1, and the first character of the input array should be: ["a"]
<strong>Explanation:</strong> The only group is "a", which remains uncompressed since it's a single character.
</pre>

<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> chars = ["a","b","b","b","b","b","b","b","b","b","b","b","b"]
<strong>Output:</strong> Return 4, and the first 4 characters of the input array should be: ["a","b","1","2"].
<strong>Explanation:</strong> The groups are "a" and "bbbbbbbbbbbb". This compresses to "ab12".</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= chars.length &lt;= 2000</code></li>
	<li><code>chars[i]</code> is a lowercase English letter, uppercase English letter, digit, or symbol.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var compress = function (chars) {
    for (let i = 0; i < chars.length; i++) {
        let currentChar = chars[i];
        let count = 1;
        let next = i + 1;
        while (currentChar !== undefined && next < chars.length && chars[next] === currentChar) {
            count++;
            next++;
        }
        if (count > 1) {
            chars.splice(i + 1, count - 1, ...count.toString().split(''));
            i += count.toString().length;
        }
    }
    return chars.length;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param String[] $chars
     * @return Integer
     */

    // My solution
    function compress1(array &$chars): int
    {
        if (count($chars) < 2) return count($chars);
        $countIndex = 0;
        $count = 0;
        foreach ($chars as $i => $char) {
            if ($i == 0) {
                $prev = $char;
                continue;
            }
            if ($char == $prev) {
                if ($countIndex == 0) {
                    $countIndex = $i;
                    $chars[$countIndex] = (string)'2';
                    $count = 2;
                } else {
                    if (count(str_split($count)) == count(str_split($count++))) {
                        unset($chars[$i]);
                    }
                    $j = 0;
                    foreach (str_split($count) as $digit) {
                        $chars[$countIndex + $j++] = (string)$digit;
                    }
                }
            } else {
                $countIndex = 0;
                $count = 0;
                $prev = $char;
            }
        }
        ksort($chars);
        return count($chars);
    }

    // #2 solution
    function compress(array &$chars): int
    {
        $s = '';
        $count = 1;
        $char = $chars[0];
        $len = count($chars);
        for ($i = 1; $i < $len; $i++) {
            if ($chars[$i] == $char) {
                $count++;
            } else {
                $s .= $char;
                if ($count > 1) $s .= $count;
                $char = $chars[$i];
                $count = 1;
            }
        }
        $s .= $char;
        if ($count > 1) $s .= $count;
        $chars = str_split($s);
        return count($chars);
    }
}
```

