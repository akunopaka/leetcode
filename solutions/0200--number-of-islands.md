### 200. Number of Islands

Difficulty: `Medium`

https://leetcode.com/problems/number-of-islands/


<p>Given an <code>m x n</code> 2D binary grid <code>grid</code> which represents a map of <code>'1'</code>s (land) and <code>'0'</code>s (water), return <em>the number of islands</em>.</p>

<p>An <strong>island</strong> is surrounded by water and is formed by connecting adjacent lands horizontally or vertically. You may assume all four edges of the grid are all surrounded by water.</p>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> grid = [
  ["1","1","1","1","0"],
  ["1","1","0","1","0"],
  ["1","1","0","0","0"],
  ["0","0","0","0","0"]
]
<strong>Output:</strong> 1
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> grid = [
  ["1","1","0","0","0"],
  ["1","1","0","0","0"],
  ["0","0","1","0","0"],
  ["0","0","0","1","1"]
]
<strong>Output:</strong> 3
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li><code>m == grid.length</code></li>
	<li><code>n == grid[i].length</code></li>
	<li><code>1 &lt;= m, n &lt;= 300</code></li>
	<li><code>grid[i][j]</code> is <code>'0'</code> or <code>'1'</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
/**
 * @param {character[][]} grid
 * @return {number}
 */
var numIslands = function (grid) {
        let islandsCount = 0;
        const [m, n] = [grid.length, grid[0].length];
        const checkNeighbours = function (rowIndex, columnIndex) {
            if (grid[rowIndex] == undefined ||
                grid[rowIndex][columnIndex] === undefined ||
                grid[rowIndex][columnIndex] != '1')
                return;
            grid[rowIndex][columnIndex] = '2';
            checkNeighbours(rowIndex - 1, columnIndex);
            checkNeighbours(rowIndex + 1, columnIndex);
            checkNeighbours(rowIndex, columnIndex - 1);
            checkNeighbours(rowIndex, columnIndex + 1);
        }
        for (let i = 0; i < m; i++) {
            for (let j = 0; j < n; j++) {
                if (grid[i][j] === '1') {
                    checkNeighbours(i, j);
                    islandsCount++;
                }
            }
        }
        return islandsCount;
    };
//-- OR --
var numIslands = function (grid) {
    if (grid.length === 0) return 0;
    const [m, n] = [grid.length, grid[0].length];

    let count = 0;
    let queue = [];
    const direction = [[-1, 0], [0, 1], [1, 0], [0, -1]];

    for (let row = 0; row < m; row++) {
        for (let col = 0; col < n; col++) {
            if (grid[row][col] === "1") {
                count++;
                queue.push([row, col]);
                grid[row][col] = "0";

                while (queue.length) {
                    let current = queue.shift();
                    const curRow = current[0];
                    const curCol = current[1];
                    // checkNeighbours
                    // direction.forEach(function (currentDir) {
                    //     const nextRow = curRow + currentDir[0];
                    //     const nextCol = curCol + currentDir[1];
                    //      if (nextRow < 0 || nextCol < 0 ||
                    //          nextRow > grid.length - 1 ||
                    //          nextCol > grid[0].length - 1 ||
                    //          grid[nextRow][nextCol] !== "1") {
                    //         return;
                    //     }
                    //     queue.push([nextRow, nextCol]);
                    //     grid[nextRow][nextCol] = "0"
                    // })
                    for (let i = 0; i < direction.length; i++) {
                        const currentDir = direction[i];
                        const nextRow = curRow + currentDir[0];
                        const nextCol = curCol + currentDir[1];

                        if (nextRow < 0 || nextCol < 0 ||
                            nextRow > grid.length - 1 ||
                            nextCol > grid[0].length - 1 ||
                            grid[nextRow][nextCol] !== "1") continue;

                        queue.push([nextRow, nextCol]);
                        grid[nextRow][nextCol] = "0"
                    }
                }
            }
        }
    }
    return count;
};
```

##### PHP

```php
class Solution {
    /**
     * @param String[][] $grid
     * @return Integer
     */
   function numIslands($grid): int {
        $islandsCount = 0;
        $m = count($grid);     // y
        $n = count($grid[0]);  // x
        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $zone = $grid[$i][$j];
                if ($zone === '1') {
                    $islandsCount++;
                    $this->checkNeighbours($grid, $i, $j);
                }
            }
        }
        return $islandsCount;
    }

    function checkNeighbours(&$grid, $i, $j): void {
        if (!isset($grid[$i][$j]) || $grid[$i][$j] != 1) return;
        $grid[$i][$j] = '2'; // 0
        $this->checkNeighbours($grid, $i-1, $j);
        $this->checkNeighbours($grid, $i+1, $j);
        $this->checkNeighbours($grid, $i, $j-1);
        $this->checkNeighbours($grid, $i, $j+1);
        // $neighbours = [
        //     [$i - 1, $j], // top
        //     [$i + 1, $j], // bottom
        //     [$i, $j - 1], // left
        //     [$i, $j + 1]  // right
        // ];
        // foreach ($neighbours as $neighbour) {
        //     $this->checkNeighbours($grid, $neighbour[0], $neighbour[1]);
        // }
        return;
    }
}
```







