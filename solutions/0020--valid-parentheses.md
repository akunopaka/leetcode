### 20. Valid Parentheses

Difficulty: `Easy`

https://leetcode.com/problems/valid-parentheses/description/

My Solution on LeetCode:
https://leetcode.com/discuss/topic/3401175/php-beats-100javascript-bracket-validation-with-a-stack/


<p>Given a string <code>s</code> containing just the characters <code>'('</code>, <code>')'</code>, <code>'{'</code>, <code>'}'</code>, <code>'['</code> and <code>']'</code>, determine if the input string is valid.</p>

<p>An input string is valid if:</p>
<ol>
	<li>Open brackets must be closed by the same type of brackets.</li>
	<li>Open brackets must be closed in the correct order.</li>
	<li>Every close bracket has a corresponding open bracket of the same type.</li>
</ol>
<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> s = "()"
<strong>Output:</strong> true
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "()[]{}"
<strong>Output:</strong> true
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> s = "(]"
<strong>Output:</strong> false
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= s.length &lt;= 10<sup>4</sup></code></li>
	<li><code>s</code> consists of parentheses only <code>'()[]{}'</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var isValid = function (s) {
    const sLength = s.length;

    if (sLength % 2 !== 0) {
        return false;
    }

    const brackets = {'(': ')', '{': '}', '[': ']'};
    const stack = [];

    for (let i = 0; i < sLength; i += 1) {
        if (brackets[s[i]]) {
            stack.push(s[i]);
        } else if (s[i] !== brackets[stack.pop()]) {
            return false;
        }
    }

    return stack.length === 0;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param String $s
     * @return Boolean
     */
    function isValid(string $s): bool {
        $sLength = strlen($s);
        if ($sLength % 2 !== 0) return false;
        $bracketSet = ['(' => ')', '[' => ']', '{' => '}'];

        $bracketStack = [];

        for ($i = 0; $i < $sLength; $i++) {
            if (array_key_exists($s[$i], $bracketSet)) {
                $bracketStack[] = $bracketSet[$s[$i]];
            } elseif (array_pop($bracketStack) !== $s[$i]) {
                return false;
            }
        }
        if (count($bracketStack) !== 0) return false;
        return true;
    }
}
```

