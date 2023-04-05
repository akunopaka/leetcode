### 62. Unique Paths

Difficulty: `Medium`

https://leetcode.com/problems/unique-paths/

<p>There is a robot on an <code>m x n</code> grid. The robot is initially located at the <strong>top-left corner</strong> (i.e., <code>grid[0][0]</code>). The robot tries to move to the <strong>bottom-right corner</strong> (i.e., <code>grid[m - 1][n - 1]</code>). The robot can only move either down or right at any point in time.</p>

<p>Given the two integers <code>m</code> and <code>n</code>, return <em>the number of possible unique paths that the robot can take to reach the bottom-right corner</em>.</p>

<p>The test cases are generated so that the answer will be less than or equal to <code>2 * 10<sup>9</sup></code>.</p>

<p><strong class="example">Example 1:</strong></p>
<img src="https://assets.leetcode.com/uploads/2018/10/22/robot_maze.png" style="width: 400px; height: 183px;">
<pre><strong>Input:</strong> m = 3, n = 7
<strong>Output:</strong> 28
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> m = 3, n = 2
<strong>Output:</strong> 3
<strong>Explanation:</strong> From the top-left corner, there are a total of 3 ways to reach the bottom-right corner:
1. Right -&gt; Down -&gt; Down
2. Down -&gt; Down -&gt; Right
3. Down -&gt; Right -&gt; Down
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= m, n &lt;= 100</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var uniquePaths = function (m, n) {
    let memo = Array(m).fill(Array(n).fill(1));
    for (let i = 1; i < m; i++) {
        for (let j = 1; j < n; j++) {
            memo[i][j] = memo[i - 1][j] + memo[i][j - 1];
        }
    }
    return memo[m - 1][n - 1];
};

//-- OR --
var uniquePaths = function (m, n) {
    let paths = new Array(n).fill(1);

    for (let i = 1; i < m; i++) {
        for (let j = 1; j < n; j++) {
            paths[j] = paths[j] + paths[j - 1];
        }
    }

    return paths[n - 1];
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n): int
    {
        if ($m == 1 || $n == 1) return 1;
        if (isset($this->map[$n][$m])) return $this->map[$n][$m];
        return $this->map[$n][$m] = $this->map[$m][$n] = $this->uniquePaths($m - 1, $n) + $this->uniquePaths($m, $n - 1);
    }
}

//-- OR --
class Solution
{
    public array $map;
    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n): int
    {
        $res = 0;
        if ($m == 1 || $n == 1) return 1;
        if (isset($this->map[$n][$m])) {
            return $this->map[$n][$m];
        }
        $res += $this->uniquePaths($m - 1, $n);
        $res += $this->uniquePaths($m, $n - 1);

        $this->map[$n][$m] = $this->map[$m][$n] = $res;

        return $res;
    }
}


// -- OR +4 solutions from Internet --
class Solution___fromInet {
    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n) {
        $down = $m - 1;
        $right = $n - 1;
        $amount = array_fill(0, $right + 1, array_fill(0, $down + 1, 1));

        for ($r = 1; $r <= $right; $r++) {
            for ($d = 1; $d <= $down; $d++) {
                $amount[$r][$d] = $amount[$r - 1][$d] + $amount[$r][$d - 1];
            }
        }

        return $amount[$right][$down];


        // 1 ********************************
        return $this->factorial($down + $right) / ($this->factorial($down) * $this->factorial($right));

        // 2 ********************************
        $result = 0;
        $this->backtrack($down, $right, $result);
        return $result;


        // 3 ********************************
        $amount = 0;
        $this->getAmountPaths($m, $n, 0, 0, $amount);
        return $amount;

        // 4 ********************************
        $queue = new SplQueue();
        $queue->push([0, 0]);
        $result = 0;

        while (! $queue->isEmpty()) {

            [$top, $right] = $queue->pop();

            if ($top === $m - 1 && $right === $n - 1) {
                $result++;
            }

            if ($n > $right) {
                $queue->push([$top, $right + 1]);
            }

            if ($m > $top) {
                $queue->push([$top + 1, $right]);
            }
        }

        return $result;
    }

    private function factorial($n): float
    {
        $result = 1;
        for ($i = 1; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }

    private function backtrack($down, $right, &$result): void
    {
        if ($down + $right === 0) {
            $result++;
        }

        if ($down > 0) {
            $this->backtrack($down - 1, $right, $result);
        }

        if ($right > 0) {
            $this->backtrack($down, $right - 1, $result);
        }

    }

    private function getAmountPaths($m, $n, $top, $right, &$amount): void
    {
        if ($top === $m - 1 && $right === $n - 1) {
            $amount++;
            return;
        }

        if ($n > $right) {
            $this->getAmountPaths($m, $n, $top, $right + 1, $amount);
        }

        if ($m > $top) {
            $this->getAmountPaths($m, $n, $top + 1, $right, $amount);
        }
    }
}
```
