### 54. Spiral Matrix

Difficulty: `Medium`

https://leetcode.com/problems/spiral-matrix/`

<p>Given the <code>root</code> of a binary tree, return <em>the level order traversal of its nodes' values</em>. (i.e., from left to right, level by level).</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/tree1.jpg" style="width: 277px; height: 302px;">
<pre><strong>Input:</strong> root = [3,9,20,null,null,15,7]
    <strong>Output:</strong> [[3],[9,20],[15,7]]
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> root = [1]
    <strong>Output:</strong> [[1]]
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> root = []
    <strong>Output:</strong> []
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the tree is in the range <code>[0, 2000]</code>.</li>
	<li><code>-1000 &lt;= Node.val &lt;= 1000</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var spiralOrder = function (matrix) {
    // direction: 0 - right, 1 - down, 2 - left, 3 - up
    const result = [];
    let direction = 0;
    let rowStart = 0;
    let rowEnd = matrix.length - 1;
    let colStart = 0;
    let colEnd = matrix[0].length - 1;
    while (rowStart <= rowEnd && colStart <= colEnd) {
        if (direction === 0) {
            for (let i = colStart; i <= colEnd; i++) {
                result.push(matrix[rowStart][i]);
            }
            rowStart++;
        } else if (direction === 1) {
            for (let i = rowStart; i <= rowEnd; i++) {
                result.push(matrix[i][colEnd]);
            }
            colEnd--;
        } else if (direction === 2) {
            for (let i = colEnd; i >= colStart; i--) {
                result.push(matrix[rowEnd][i]);
            }
            rowEnd--;
        } else if (direction === 3) {
            for (let i = rowEnd; i >= rowStart; i--) {
                result.push(matrix[i][colStart]);
            }
            colStart++;
        }
        direction = (direction + 1) % 4;
    }
    return result;
};


// OR

var spiralOrder___2 = function (matrix) {
    const res = []
    while (matrix.length) {
        const first = matrix.shift()
        res.push(...first)
        for (const m of matrix) {
            let val = m.pop()
            if (val)
                res.push(val)
            m.reverse()
        }
        matrix.reverse()
    }
    return res
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[][] $matrix
     * @return Integer[]
     */
    function spiralOrder(array $matrix): array {
        $res = [];
        while ($matrix) {
            $first = array_shift($matrix);
            array_push($res, ...$first);
            foreach ($matrix as &$m) {
                $val = array_pop($m);
                if ($val) $res[] = $val;
                $m = array_reverse($m);
            }
            $matrix = array_reverse($matrix);
        }
        return $res;
    }

    function spiralOrder___2(array $matrix): array {
        // direction: 0 - right, 1 - down, 2 - left, 3 - up
        $direction = 0;
        $row = 0;
        $col = 0;
        $rowMax = count($matrix) - 1;
        $colMax = count($matrix[0]) - 1;
        $result = [];
        while ($row <= $rowMax && $col <= $colMax) {
            switch ($direction) {
                case 0:
                    for ($i = $col; $i <= $colMax; $i++) $result[] = $matrix[$row][$i];
                    $row++;
                    break;
                case 1:
                    for ($i = $row; $i <= $rowMax; $i++) $result[] = $matrix[$i][$colMax];
                    $colMax--;
                    break;
                case 2:
                    for ($i = $colMax; $i >= $col; $i--) $result[] = $matrix[$rowMax][$i];
                    $rowMax--;
                    break;
                case 3:
                    for ($i = $rowMax; $i >= $row; $i--) $result[] = $matrix[$i][$col];
                    $col++;
                    break;
            }
            $direction = ($direction + 1) % 4;
        }
        return $result;
    }
}
```

