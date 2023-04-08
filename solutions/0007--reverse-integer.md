### 7. Reverse Integer

Difficulty: `Medium`

https://leetcode.com/problems/reverse-integer/

<p>Given a signed 32-bit integer <code>x</code>, return <code>x</code><em> with its digits reversed</em>. If reversing <code>x</code> causes the value to go outside the signed 32-bit integer range <code>[-2<sup>31</sup>, 2<sup>31</sup> - 1]</code>, then return <code>0</code>.</p>

<p><strong>Assume the environment does not allow you to store 64-bit integers (signed or unsigned).</strong></p>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> x = 123
<strong>Output:</strong> 321
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> x = -123
<strong>Output:</strong> -321
</pre>

<p><strong class="example">Example 3:</strong></p>

<pre><strong>Input:</strong> x = 120
<strong>Output:</strong> 21
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li><code>-2<sup>31</sup> &lt;= x &lt;= 2<sup>31</sup> - 1</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var reverse = function (x) {
    x = x.toString();
    let isNegative = false;

    if (x[0] == '-') {
        isNegative = true;
        x = x.substr(1, x.length - 1);
    }

    x = parseInt(x.split('').reverse().join(''));
    if (isNegative) {
        x = -x;
    }

    if (x > Math.pow(2, 31) - 1 || x < -Math.pow(2, 31)) {
        return 0;
    }
    return x;
};
```

##### PHP

```php
class Solution
{
    function reverse($x) {
        $x = (string)$x;
        $isNegative = false;

        if ($x[0] == '-') {
            $isNegative = true;
            $x = substr($x, 1, strlen($x) - 1);
        }

        $x = (int)strrev($x);
        if ($isNegative) {
            $x = -$x;
        }

        if ($x > pow(2, 31) - 1 || $x < -pow(2, 31)) {
            return 0;
        }
        return $x;
    }
}
```

