### 394. Decode String

Difficulty: `Medium`

https://leetcode.com/problems/decode-string/

<p>Given an encoded string, return its decoded string.</p>
<p>The encoding rule is: <code>k[encoded_string]</code>, where the <code>encoded_string</code> inside the square brackets is being repeated exactly <code>k</code> times. Note that <code>k</code> is guaranteed to be a positive integer.</p>

<p>You may assume that the input string is always valid; there are no extra white spaces, square brackets are well-formed, etc. Furthermore, you may assume that the original data does not contain any digits and that digits are only for those repeat numbers, <code>k</code>. For example, there will not be input like <code>3a</code> or <code>2[4]</code>.</p>

<p>The test cases are generated so that the length of the output will never exceed <code>10<sup>5</sup></code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "3[a]2[bc]"
<strong>Output:</strong> "aaabcbc"
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "3[a2[c]]"
<strong>Output:</strong> "accaccacc"
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> s = "2[abc]3[cd]ef"
<strong>Output:</strong> "abcabccdcdcdef"
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length &lt;= 30</code></li>
	<li><code>s</code> consists of lowercase English letters, digits, and square brackets <code>'[]'</code>.</li>
	<li><code>s</code> is guaranteed to be <strong>a valid</strong> input.</li>
	<li>All the integers in <code>s</code> are in the range <code>[1, 300]</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var decodeString = function (s) {
    let stack = [];
    let num = 0;
    let str = '';
    for (let i = 0; i < s.length; i++) {
        let c = s[i];
        if (c === '[') {
            stack.push(str);
            stack.push(num);
            num = 0;
            str = '';
        } else if (c === ']') {
            let n = stack.pop();
            let prevStr = stack.pop();
            str = prevStr + str.repeat(n);
        } else if (c >= '0' && c <= '9') {
            num = num * 10 + Number(c);
        } else {
            str += c;
        }
    }
    return str;
};
```

##### PHP

```php
class Solution___akunopaka_regular-expression-replacements
{
    /**
     * @param String $s
     * @return String
     */
    function decodeString($s)
    {
        do $s = preg_replace_callback('/(\d+)\[([a-z]+)\]/', fn($match) => str_repeat($match[2], $match[1]), $s, -1, $count);
        while ($count > 0);
        return preg_replace('/(\d+)/', '', $s);
    }
}
//-- OR --
class Solution {
    function decodeString($s) {
        $count = 1;
        while ($count > 0) {
            $s = preg_replace_callback('/(\d+)\[([a-z]+)\]/',
                function ($match) {
                    $text = '';
                    for ($i = 0; $i < $match[1]; $i++) {
                        $text .= $match[2];
                    }
                    return $text;
                }, $s, -1, $count);
        }
        return preg_replace('/(\d+)/', '', $s);
    }
}
```
