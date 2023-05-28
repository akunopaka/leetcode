### 1547. Minimum Cost to Cut a Stick

Difficulty: `Hard`

https://leetcode.com/problems/minimum-cost-to-cut-a-stick/


<img alt="" src="https://assets.leetcode.com/uploads/2020/07/21/statement.jpg" style="width: 521px; height: 111px;">
<p>Given an integer array <code>cuts</code> where <code>cuts[i]</code> denotes a position you should perform a cut at.</p>
<p>You should perform the cuts in order, you can change the order of the cuts as you wish.</p>
<p>The cost of one cut is the length of the stick to be cut, the total cost is the sum of costs of all cuts. When you cut a stick, it will be split into two smaller sticks (i.e. the sum of their lengths is the length of the stick before the cut). Please refer to the first example for a better explanation.</p>
<p>Return <em>the minimum total cost</em> of the cuts.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/07/23/e1.jpg" style="width: 350px; height: 284px;">
<pre><strong>Input:</strong> n = 7, cuts = [1,3,4,5]
<strong>Output:</strong> 16
<strong>Explanation:</strong> Using cuts order = [1, 3, 4, 5] as in the input leads to the following scenario:
<img alt="" src="https://assets.leetcode.com/uploads/2020/07/21/e11.jpg" style="width: 350px; height: 284px;">
The first cut is done to a rod of length 7 so the cost is 7. The second cut is done to a rod of length 6 (i.e. the second part of the first cut), the third is done to a rod of length 4 and the last cut is to a rod of length 3. The total cost is 7 + 6 + 4 + 3 = 20.
Rearranging the cuts to be [3, 5, 1, 4] for example will lead to a scenario with total cost = 16 (as shown in the example photo 7 + 4 + 3 + 2 = 16).</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> n = 9, cuts = [5,6,1,4,2]
<strong>Output:</strong> 22
<strong>Explanation:</strong> If you try the given cuts ordering the cost will be 25.
There are much ordering with total cost &lt;= 25, for example, the order [4, 6, 5, 2, 1] has total cost = 22 which is the minimum possible.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>2 &lt;= n &lt;= 10<sup>6</sup></code></li>
	<li><code>1 &lt;= cuts.length &lt;= min(n - 1, 100)</code></li>
	<li><code>1 &lt;= cuts[i] &lt;= n - 1</code></li>
	<li>All the integers in <code>cuts</code> array are <strong>distinct</strong>.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
var minCost = function (n, cuts) {
    let memo = {};
    return dfs(0, n);

    function dfs(left, right) {
        if (right - left <= 1) return 0;

        if (memo[left] && memo[left][right]) return memo[left][right];

        let res = Infinity;
        for (let cut of cuts) {
            if (cut > left && cut < right) {
                res = Math.min(res, right - left + dfs(left, cut) + dfs(cut, right));
            }
        }

        if (res == Infinity) res = 0;

        if (!memo[left]) memo[left] = {};
        memo[left][right] = res;

        return res;
    }
};
```

##### PHP

```php

class Solution
{
    private $memo = [];

    /**
     * @param Integer $n
     * @param Integer[] $cuts
     * @return Integer
     */
    function minCost($n, $cuts, $left = null, $right = null) {
        if ($left === null) $left = 0;
        if ($right === null) $right = $n;
        if ($right - $left == 1) return 0;

        if (isset($this->memo[$left][$right])) return $this->memo[$left][$right];

        $res = PHP_INT_MAX;
        foreach ($cuts as $cut) {
            if ($cut > $left && $cut < $right) {
                $res = min($res, $right - $left + $this->minCost($n, $cuts, $left, $cut) + $this->minCost($n, $cuts, $cut, $right));
            }
        }
        if ($res == PHP_INT_MAX) $res = 0;

        $this->memo[$left][$right] = $res;

        return $res;
    }
}
```

