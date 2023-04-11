### 202. Happy Number

Difficulty: `Easy`

https://leetcode.com/problems/happy-number/

<p>&nbsp;</p>
<p>Write an algorithm to determine if a number <code>n</code> is happy.</p>

<p>A <strong>happy number</strong> is a number defined by the following process:</p>
<ul>
	<li>Starting with any positive integer, replace the number by the sum of the squares of its digits.</li>
	<li>Repeat the process until the number equals 1 (where it will stay), or it <strong>loops endlessly in a cycle</strong> which does not include 1.</li>
	<li>Those numbers for which this process <strong>ends in 1</strong> are happy.</li>
</ul>

<p>Return <code>true</code> <em>if</em> <code>n</code> <em>is a happy number, and</em> <code>false</code> <em>if not</em>.</p>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> n = 19
<strong>Output:</strong> true
<strong>Explanation:</strong>
1<sup>2</sup> + 9<sup>2</sup> = 82
8<sup>2</sup> + 2<sup>2</sup> = 68
6<sup>2</sup> + 8<sup>2</sup> = 100
1<sup>2</sup> + 0<sup>2</sup> + 0<sup>2</sup> = 1
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> n = 2
<strong>Output:</strong> false
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= n &lt;= 2<sup>31</sup> - 1</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
// HashMap Approach
var isHappy = function (n) {
    let set = new Set();
    while (n != 1 && !set.has(n)) {
        let sum = 0;
        for (const digit of n.toString().split("")) {
            sum += digit ** 2;
        }
        set.add(n);
        n = sum;
    }
    return n == 1;
};

// "Math Approach"
var isHappy__math = function (n) {
    while (n != 1 && n != 4) {
        let sum = 0;
        for (const digit of n.toString().split("")) {
            sum += digit ** 2;
        }
        n = sum;
    }
    return n == 1;
};


```

##### PHP

```php
class Solution
{
    /**
     * @param Integer $n
     * @return Boolean
     */
    function isHappy____math($n) {
        // Math solution
        while ($n != 1 && $n !== 4) {
            $n = array_sum(
                array_map(
                    function ($x) {
                        return $x * $x;
                    }
                    , str_split($n))
            );
        }
        return $n == 1;
    }

    // -- OR --
    function isHappy____hash($n) {
        // Hash solution
        $hash = [];
        while ($n != 1 && !isset($hash[$n])) {
            $hash[$n] = true;
            $sum = 0;
            while ($n > 0) {
                $sum += ($n % 10) ** 2;
                $n = (int)($n / 10);
            }
            $n = $sum;
//          $n = array_sum(array_map(function ($x) {return $x * $x;}, str_split($n)));
        }
        return $n == 1;
    }
}
```

