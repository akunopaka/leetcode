### 2218. Maximum Value of K Coins From Piles

Difficulty: `Hard`

https://leetcode.com/problems/maximum-value-of-k-coins-from-piles/



<p>There are <code>n</code> <strong>piles</strong> of coins on a table. Each pile consists of a <strong>positive number</strong> of coins of assorted denominations.</p>
<p>In one move, you can choose any coin on <strong>top</strong> of any pile, remove it, and add it to your wallet.</p>
<p>Given a list <code>piles</code>, where <code>piles[i]</code> is a list of integers denoting the composition of the <code>i<sup>th</sup></code> pile from <strong>top to bottom</strong>, and a positive integer <code>k</code>, return <em>the <strong>maximum total value</strong> of coins you can have in your wallet if you choose <strong>exactly</strong></em> <code>k</code> <em>coins optimally</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2019/11/09/e1.png" style="width: 600px; height: 243px;">
<pre><strong>Input:</strong> piles = [[1,100,3],[7,8,9]], k = 2
<strong>Output:</strong> 101
<strong>Explanation:</strong>
The above diagram shows the different ways we can choose k coins.
The maximum total we can obtain is 101.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> piles = [[100],[100],[100],[100],[100],[100],[1,1,1,1,1,1,700]], k = 7
<strong>Output:</strong> 706
<strong>Explanation:
</strong>The maximum total can be obtained if we choose all coins from the last pile.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>n == piles.length</code></li>
	<li><code>1 &lt;= n &lt;= 1000</code></li>
	<li><code>1 &lt;= piles[i][j] &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= k &lt;= sum(piles[i].length) &lt;= 2000</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var maxValueOfCoins = function (piles, k) {
    let n = piles.length;
    let dp = Array.from(Array(n + 1), () => Array(k + 1).fill(0));
    for (let i = 1; i <= n; i++) {
        for (let coins = 0; coins <= k; coins++) {
            let currentSum = 0;
            for (let currentCoins = 0; currentCoins <= Math.min(piles[i - 1].length, coins); currentCoins++) {
                if (currentCoins > 0) {
                    currentSum += piles[i - 1][currentCoins - 1];
                }
                dp[i][coins] = Math.max(dp[i][coins], dp[i - 1][coins - currentCoins] + currentSum);
            }
        }
    }
    return dp[n][k];
};
```

##### PHP

```php
class Solution
{

    /**
     * @param Integer[][] $piles
     * @param Integer $k
     * @return Integer
     */
    function maxValueOfCoins($piles, $k) {
         $n = count($piles);
        $dp = array_fill(0, $n + 1, array_fill(0, $k + 1, 0));

        for ($i = 1; $i <= $n; $i++) {
            for ($coins = 0; $coins <= $k; $coins++) {
                $currentSum = 0;
                for ($currentCoins = 0; $currentCoins <= min(count($piles[$i - 1]), $coins); $currentCoins++) {
                    if ($currentCoins > 0) {
                        $currentSum += $piles[$i - 1][$currentCoins - 1];
                    }
                    $dp[$i][$coins] = max($dp[$i][$coins], $dp[$i - 1][$coins - $currentCoins] + $currentSum);
                }
            }
        }

        return $dp[$n][$k];
    }
}
```

