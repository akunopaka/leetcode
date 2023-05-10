### 59. Spiral Matrix II

Difficulty: `Medium`

https://leetcode.com/problems/spiral-matrix-ii/


<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/11/13/spiraln.jpg" style="width: 242px; height: 242px;">
<pre><strong>Input:</strong> n = 3
<strong>Output:</strong> [[1,2,3],[8,9,4],[7,6,5]]
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> n = 1
<strong>Output:</strong> [[1]]
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= n &lt;= 20</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var generateMatrix = function (n) {
    // direction: 0 - right, 1 - down, 2 - left, 3 - up
    let direction = 0;
    let top = 0, bottom = n - 1, left = 0, right = n - 1;
    let count = 1;
    let matrix = new Array(n).fill(0).map(() => new Array(n).fill(0));

    while (top <= bottom && left <= right) {
        if (direction === 0) {
            for (let i = left; i <= right; i++) {
                matrix[top][i] = count++;
            }
            top++;
        } else if (direction === 1) {
            for (let i = top; i <= bottom; i++) {
                matrix[i][right] = count++;
            }
            right--;
        } else if (direction === 2) {
            for (let i = right; i >= left; i--) {
                matrix[bottom][i] = count++;
            }
            bottom--;
        } else if (direction === 3) {
            for (let i = bottom; i >= top; i--) {
                matrix[i][left] = count++;
            }
            left++;
        }
        direction = (direction + 1) % 4;
    }

    return matrix;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer $n
     * @return Integer[][]
     */
    function generateMatrix(int $n): array {
        // direction: 0 - right, 1 - down, 2 - left, 3 - up
        $direction = 0;
        $row = $col = 0;
        $rowMax = $colMax = $n - 1;

        $matrix = [];
        for ($i = 0; $i < $n; $i++) {
            $matrix[$i] = array_fill(0, $n, null);
        }

        $count = 1;
        while ($row <= $rowMax && $col <= $colMax) {
            switch ($direction) {
                case 0:
                    for ($i = $col; $i <= $colMax; $i++) $matrix[$row][$i] = $count++;
                    $row++;
                    break;
                case 1:
                    for ($i = $row; $i <= $rowMax; $i++) $matrix[$i][$colMax] = $count++;
                    $colMax--;
                    break;
                case 2:
                    for ($i = $colMax; $i >= $col; $i--) $matrix[$rowMax][$i] = $count++;
                    $rowMax--;
                    break;
                case 3:
                    for ($i = $rowMax; $i >= $row; $i--) $matrix[$i][$col] = $count++;
                    $col++;
                    break;
            }
            $direction = ($direction + 1) % 4;
        }
        foreach ($matrix as &$m) ksort($m);

        return $matrix;
    }
}
```

