### 844. Backspace String Compare

Difficulty: `Easy`

https://leetcode.com/problems/backspace-string-compare/


<p>Given two strings <code>s</code> and <code>t</code>, return <code>true</code> <em>if they are equal when both are typed into empty text editors</em>. <code>'#'</code> means a backspace character.</p>

<p>Note that after backspacing an empty text, the text will continue empty.</p>

<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> s = "ab#c", t = "ad#c"
<strong>Output:</strong> true
<strong>Explanation:</strong> Both s and t become "ac".
</pre>

<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> s = "ab##", t = "c#d#"
<strong>Output:</strong> true
<strong>Explanation:</strong> Both s and t become "".
</pre>
<p><strong class="example">Example 3:</strong></p>

<pre><strong>Input:</strong> s = "a#c", t = "b"
<strong>Output:</strong> false
<strong>Explanation:</strong> s becomes "c" while t becomes "b".
</pre>
<p><strong>Constraints:</strong></p>

<ul>
	<li><code><span>1 &lt;= s.length, t.length &lt;= 200</span></code></li>
	<li><span><code>s</code> and <code>t</code> only contain lowercase letters and <code>'#'</code> characters.</span></li>
</ul>
<p>&nbsp;</p>
<p><strong>Follow up:</strong> Can you solve it in <code>O(n)</code> time and <code>O(1)</code> space?</p>

<p>&nbsp;</p>

### My Solution(s):

##### PHP

```php
class Solution
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function backspaceCompare(string $s, string $t): bool {
        return $this->backspacing($s) == $this->backspacing($t);
    }
    function backspacing(string $s): string {
        $strLength = strlen($s);
        $result = '';
        $backspaceCount = 0;
        for ($i = $strLength - 1; $i >= 0; $i--) {
            if ($s[$i] == '#') {
                $backspaceCount++;
                continue;
            }
            if ($backspaceCount > 0) {
                $backspaceCount--;
                continue;
            }
            $result = $s[$i] . $result;
        }
        return $result;
    }
}

class Solution_2
{
    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function backspaceCompare($s, $t)
    {
        $count = 1;
        while ($count > 0) {
            $s = preg_replace('/[^#]{1}#/', '', $s, -1, $count);
        }
        $count = 1;
        while ($count > 0) {
            $t = preg_replace('/[^#]{1}#/', '', $t, -1, $count);
        }
        if (ltrim($s, '#') == ltrim($t, '#')) return true;
        return false;
    }
}
```

##### JavaScript

```js
var backspaceCompare = function (s, t) {
    // Create a function that takes a string and returns a new string with backspaces removed
    function backspacing(str) {
        let result = '';
        let backspaces = 0;

        for (let i = str.length - 1; i >= 0; i -= 1) {
            if (str[i] === '#') {
                backspaces += 1;
            } else if (backspaces > 0) {
                backspaces -= 1;
            } else {
                result = str[i] + result;
            }
        }
        return result;
    }

    return backspacing(s) === backspacing(t);
};
```
