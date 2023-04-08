### 64. Minimum Path Sum

Difficulty: `Medium`

https://leetcode.com/problems/minimum-path-sum/

<p>Given a <code>m x n</code> <code>grid</code> filled with non-negative numbers, find a path from top left to bottom right, which minimizes the sum of all numbers along its path.</p>

<p><strong>Note:</strong> You can only move either down or right at any point in time.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/11/05/minpath.jpg" style="width: 242px; height: 242px;">
<pre><strong>Input:</strong> grid = [[1,3,1],[1,5,1],[4,2,1]]
<strong>Output:</strong> 7
<strong>Explanation:</strong> Because the path 1 → 3 → 1 → 1 → 1 minimizes the sum.
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> grid = [[1,2,3],[4,5,6]]
<strong>Output:</strong> 12
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>m == grid.length</code></li>
	<li><code>n == grid[i].length</code></li>
	<li><code>1 &lt;= m, n &lt;= 200</code></li>
	<li><code>0 &lt;= grid[i][j] &lt;= 100</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var minPathSum = function (grid) {
    const m = grid.length;
    const n = grid[0].length;
    const table = Array.from({length: m}, () => new Array(n));

    table[0][0] = grid[0][0];
    for (let i = 1; i < m; i++) {
        table[i][0] = table[i - 1][0] + grid[i][0];
    }
    for (let j = 1; j < n; j++) {
        table[0][j] = table[0][j - 1] + grid[0][j];
    }

    // Fill in the rest of the table
    for (let i = 1; i < m; i++) {
        for (let j = 1; j < n; j++) {
            table[i][j] = Math.min(table[i - 1][j], table[i][j - 1]) + grid[i][j];
        }
    }

    return table[m - 1][n - 1];
}
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function minPathSum(array $grid): int {
        if ($grid == [[]]) return 0;
        if (count($grid) == 1) return array_sum($grid[0]);
        if (count($grid[0]) == 1) return array_sum(array_column($grid, 0));

        $m = count($grid); // rows => y
        $n = count($grid[0]); // columns => x

        for ($y = 0; $y < $m; $y++) {
            for ($x = 0; $x < $n; $x++) {
                if ($x == 0 && $y == 0) continue;
                if ($x == 0) $grid[$y][$x] += $grid[$y - 1][$x];
                elseif ($y == 0) $grid[$y][$x] += $grid[$y][$x - 1];
                else $grid[$y][$x] += min($grid[$y - 1][$x], $grid[$y][$x - 1]);
            }
        }
        return $grid[$m - 1][$n - 1];
    }
}
```

