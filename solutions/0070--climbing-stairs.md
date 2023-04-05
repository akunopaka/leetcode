### 70. Climbing Stairs

Difficulty: `Easy`

https://leetcode.com/problems/climbing-stairs/

SOLUTION :: https://www.youtube.com/watch?v=Y0lT9Fck7qI

Climbing Stairs - Dynamic Programming - Leetcode 70



<p>You are climbing a staircase. It takes <code>n</code> steps to reach the top.</p>

<p>Each time you can either climb <code>1</code> or <code>2</code> steps. In how many distinct ways can you climb to the top?</p>

<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> n = 2
<strong>Output:</strong> 2
<strong>Explanation:</strong> There are two ways to climb to the top.
1. 1 step + 1 step
2. 2 steps
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> n = 3
<strong>Output:</strong> 3
<strong>Explanation:</strong> There are three ways to climb to the top.
1. 1 step + 1 step + 1 step
2. 1 step + 2 steps
3. 2 steps + 1 step
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= n &lt;= 45</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var climbStairs = function (n) {
    // const LOL = [1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946, 17711, 28657, 46368, 75025, 121393, 196418, 317811, 514229, 832040, 1346269, 2178309, 3524578, 5702887, 9227465, 14930352, 24157817, 39088169, 63245986, 102334155, 165580141, 267914296, 433494437, 701408733, 1134903170, 1836311903, 2971215073, 4807526976, 7778742049, 12586269025];
    // return LOL[n];

    let one = 1, two = 1, tmp = 0;
    if (n == 1) return 1;
    for (let i = 1; i < n; i++) {
        tmp = one;
        one = one + two;
        two = tmp;
    }
    return one;
};

```

##### PHP

```php
class Solution {
    /**
     * @param Integer $n
     * @return Integer
     */
    function climbStairs(int $n): int {
        // $lol = [0, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946, 17711, 28657, 46368, 75025, 121393, 196418, 317811, 514229, 832040, 1346269, 2178309, 3524578, 5702887, 9227465, 14930352, 24157817, 39088169, 63245986, 102334155, 165580141, 267914296, 433494437, 701408733, 1134903170, 1836311903, 2971215073, 4807526976, 7778742049, 12586269025];
        // return $lol[$n];

        if ($n < 3) return $n;
        $cache = [1, 1];
        for ($i = 1; $i < $n; $i++) {
            $cache[2] = $cache[0] + $cache[1];
            array_shift($cache);
        }
        return $cache[1];
    }
}

```

##### Python3

```python
class Solution:
    def climbStairs(self, n: int) -> int:
        one, two = 1, 1
        for i in range(n-1):
            temp = one
            one = one+two
            two = temp
        return one


//-- OR --
class Solution:
    def climbStairs(self, n: int) -> int:
        if n <3: return n
        one = 2
        two = 3
        for i in range(n-3):
            two, one = two+one, two
        return two
```