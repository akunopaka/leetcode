### 509. Fibonacci Number

Difficulty: `Easy`

https://leetcode.com/problems/fibonacci-number/description/



<p>The <b>Fibonacci numbers</b>, commonly denoted <code>F(n)</code> form a sequence, called the <b>Fibonacci sequence</b>, such that each number is the sum of the two preceding ones, starting from <code>0</code> and <code>1</code>. That is,</p>
<pre>F(0) = 0, F(1) = 1
F(n) = F(n - 1) + F(n - 2), for n &gt; 1.
</pre>
<p>Given <code>n</code>, calculate <code>F(n)</code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> n = 2
<strong>Output:</strong> 1
<strong>Explanation:</strong> F(2) = F(1) + F(0) = 1 + 0 = 1.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> n = 3
<strong>Output:</strong> 2
<strong>Explanation:</strong> F(3) = F(2) + F(1) = 1 + 1 = 2.
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> n = 4
<strong>Output:</strong> 3
<strong>Explanation:</strong> F(4) = F(3) + F(2) = 2 + 1 = 3.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>0 &lt;= n &lt;= 30</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var fib = function (n) {
//    const answersLOL = [0,1,1,2,3,5,8,13,21,34,55,89,144,233,377,610,987,1597,2584,4181,6765,10946,17711,28657,46368,75025,121393,196418,317811,514229,832040];
//    return answersLOL[n];

    if (n == 0 || n == 1) return n;
    const cache = [0, 1];
    for (let i = 2; i <= n; i++) {
        cache[2] = cache[1] + cache[0];
        cache.shift();
    }
    return cache[1];
};

```

##### PHP

```php
class Solution
{
    /**
     * @param Integer $n
     * @return Integer
     */
    function fib(int $n): int
    {
        if ($n == 0 || $n == 1) return $n;
        $cache = [0, 1];
        for ($i = 2; $i <= $n; $i++) {
            $cache[2] = $cache[0] + $cache[1];
            array_shift($cache);
        }
        return $cache[1];
    }
}
//-- OR --
class Solution
{
    /**
     * @param Integer $n
     * @return Integer
     */
    function fib(int $n): int
    {
        // Constraints: 0 <= n <= 30
        // $answersLOL = [0,1,1,2,3,5,8,13,21,34,55,89,144,233,377,610,987,1597,2584,4181,6765,10946,17711,28657,46368,75025,121393,196418,317811,514229,832040];
        // return $answersLOL[$n];

        if ($n == 0 || $n == 1) return $n;
         $fPrev1 = 0;
         $fPrev2 = 1;
         for($i=2; $i<=$n; $i++){
            $fibonacci = $fPrev1 + $fPrev2;
            $fPrev1 = $fPrev2;
            $fPrev2 = $fibonacci;
         }
         return $fibonacci;
    }
}
```
