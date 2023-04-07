### 1020. Number of Enclaves

Difficulty: `Medium`

https://leetcode.com/problems/number-of-enclaves/

My Solution on LeetCode:
https://leetcode.com/discuss/topic/3388246/php-207-ms-beats-100phpjavascript-73-ms-beats-9841-depth-first-search-approach/

<p>You are given an <code>m x n</code> binary matrix <code>grid</code>, where <code>0</code> represents a sea cell and <code>1</code> represents a land cell.</p>

<p>A <strong>move</strong> consists of walking from one land cell to another adjacent (<strong>4-directionally</strong>) land cell or walking off the boundary of the <code>grid</code>.</p>

<p>Return <em>the number of land cells in</em> <code>grid</code> <em>for which we cannot walk off the boundary of the grid in any number of <strong>moves</strong></em>.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/18/enclaves1.jpg" style="width: 333px; height: 333px;">
<pre><strong>Input:</strong> grid = [[0,0,0,0],[1,0,1,0],[0,1,1,0],[0,0,0,0]]
<strong>Output:</strong> 3
<strong>Explanation:</strong> There are three 1s that are enclosed by 0s, and one 1 that is not enclosed because its on the boundary.
</pre>

<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/18/enclaves2.jpg" style="width: 333px; height: 333px;">
<pre><strong>Input:</strong> grid = [[0,1,1,0],[0,0,1,0],[0,0,1,0],[0,0,0,0]]
<strong>Output:</strong> 0
<strong>Explanation:</strong> All 1s are either on the boundary or can reach the boundary.
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>m == grid.length</code></li>
	<li><code>n == grid[i].length</code></li>
	<li><code>1 &lt;= m, n &lt;= 500</code></li>
	<li><code>grid[i][j]</code> is either <code>0</code> or <code>1</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var numEnclaves = function (grid) {
    const col = grid.length;
    const row = grid[0].length;

    // 1. find all the 1s on the boundary
    // 2. find all the 1s connected to the boundary and set them to 0
    // 3. count the rest 1s
    // 4. return the count

    let checkNeighboursDFS = (i, j) => {
        if (i < 0 || i >= col || j < 0 || j >= row || grid[i][j] === 0) {
            return;
        }
        grid[i][j] = 0;
        checkNeighboursDFS(i - 1, j);
        checkNeighboursDFS(i + 1, j);
        checkNeighboursDFS(i, j - 1);
        checkNeighboursDFS(i, j + 1);
    };

    // 1. find all the 1s on the boundary
    for (let i = 0; i < col; i++) {
        checkNeighboursDFS(i, 0);
        checkNeighboursDFS(i, row - 1);
    }
    for (let i = 0; i < row; i++) {
        checkNeighboursDFS(0, i);
        checkNeighboursDFS(col - 1, i);
    }

    // 3. count the rest 1s
    let isolatedIslandCount = 0;
    // isolatedIslandCount = grid.flat().reduce((a, b) => a + b);
    for (let i = 1; i < col - 1; i++) {
        for (let j = 1; j < row - 1; j++) {
            if (grid[i][j] === 1) {
                isolatedIslandCount++;
            }
        }
    }

    return isolatedIslandCount;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function numEnclaves(array $grid): int {
        $col = count($grid); // y
        $row = count($grid[0]); // x

        // check boundary
        // top and bottom
        for ($i = 0; $i < $col; $i++) {
            $this->checkIsland($grid, $i, 0);
            $this->checkIsland($grid, $i, $row - 1);
        }
        // left and right
        for ($i = 0; $i < $row; $i++) {
            $this->checkIsland($grid, 0, $i);
            $this->checkIsland($grid, $col - 1, $i);
        }

        $isolatedIslandCount = 0;
        for ($i = 1; $i < $col - 1; $i++) {
            $isolatedIslandCount += array_sum($grid[$i]);
        }

        return $isolatedIslandCount;
    }


    function checkIsland(array &$grid, int $y, int $x): void {
        if (!isset($grid[$y][$x]) || $grid[$y][$x] === 0) return;

        $grid[$y][$x] = 0;

        $this->checkIsland($grid, $y - 1, $x);
        $this->checkIsland($grid, $y + 1, $x);
        $this->checkIsland($grid, $y, $x - 1);
        $this->checkIsland($grid, $y, $x + 1);
    }
}
```

