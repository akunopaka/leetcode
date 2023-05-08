### 1964. Find the Longest Valid Obstacle Course at Each Position

Difficulty: `Hard`

https://leetcode.com/problems/find-the-longest-valid-obstacle-course-at-each-position/


<p>For every index <code>i</code> between <code>0</code> and <code>n - 1</code> (<strong>inclusive</strong>), find the length of the <strong>longest obstacle course</strong> in <code>obstacles</code> such that:</p>
<ul>
	<li>You choose any number of obstacles between <code>0</code> and <code>i</code> <strong>inclusive</strong>.</li>
	<li>You must include the <code>i<sup>th</sup></code> obstacle in the course.</li>
	<li>You must put the chosen obstacles in the <strong>same order</strong> as they appear in <code>obstacles</code>.</li>
	<li>Every obstacle (except the first) is <strong>taller</strong> than or the <strong>same height</strong> as the obstacle immediately before it.</li>
</ul>
<p>Return <em>an array</em> <code>ans</code> <em>of length</em> <code>n</code>, <em>where</em> <code>ans[i]</code> <em>is the length of the <strong>longest obstacle course</strong> for index</em> <code>i</code><em> as described above</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> obstacles = [1,2,3,2]
<strong>Output:</strong> [1,2,3,3]
<strong>Explanation:</strong> The longest valid obstacle course at each position is:
- i = 0: [<u>1</u>], [1] has length 1.
- i = 1: [<u>1</u>,<u>2</u>], [1,2] has length 2.
- i = 2: [<u>1</u>,<u>2</u>,<u>3</u>], [1,2,3] has length 3.
- i = 3: [<u>1</u>,<u>2</u>,3,<u>2</u>], [1,2,2] has length 3.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> obstacles = [2,2,1]
<strong>Output:</strong> [1,2,1]
<strong>Explanation: </strong>The longest valid obstacle course at each position is:
- i = 0: [<u>2</u>], [2] has length 1.
- i = 1: [<u>2</u>,<u>2</u>], [2,2] has length 2.
- i = 2: [2,2,<u>1</u>], [1] has length 1.
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> obstacles = [3,1,5,6,4,2]
<strong>Output:</strong> [1,1,2,3,2,2]
<strong>Explanation:</strong> The longest valid obstacle course at each position is:
- i = 0: [<u>3</u>], [3] has length 1.
- i = 1: [3,<u>1</u>], [1] has length 1.
- i = 2: [<u>3</u>,1,<u>5</u>], [3,5] has length 2. [1,5] is also valid.
- i = 3: [<u>3</u>,1,<u>5</u>,<u>6</u>], [3,5,6] has length 3. [1,5,6] is also valid.
- i = 4: [<u>3</u>,1,5,6,<u>4</u>], [3,4] has length 2. [1,4] is also valid.
- i = 5: [3,<u>1</u>,5,6,4,<u>2</u>], [1,2] has length 2.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>n == obstacles.length</code></li>
	<li><code>1 &lt;= n &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= obstacles[i] &lt;= 10<sup>7</sup></code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
/**
 * @param {number[]} dp
 * @param {number} obstacle
 */
function binarySearch(dp, obstacle) {
    let left = 0;
    let right = dp.length - 1;
    while (left <= right) {
        const mid = (left + right) >>> 1;
        if (dp[mid] <= obstacle) {
            left = mid + 1;
        } else {
            right = mid - 1;
        }
    }
    return left;
}

/**
 * @param {number[]} obstacles
 * @return {number[]}
 */
var longestObstacleCourseAtEachPosition = function (obstacles) {
    const result = [];
    const dp = [];
    const obstaclesLength = obstacles.length;
    for (let i = 0; i < obstaclesLength; i++) {
        const obstacle = obstacles[i];
        let index = binarySearch(dp, obstacle);
        dp[index] = obstacle;
        result.push(index + 1);
    }
    return result;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[] $obstacles
     * @return Integer[]
     */
    function longestObstacleCourseAtEachPosition(array $obstacles): array {
        $dp = [];
        $res = [];
        foreach ($obstacles as $obstacle) {
            $index = $this->binarySearch($dp, $obstacle);
            $dp[$index] = $obstacle;
            $res[] = $index + 1;
        }
        return $res;
    }

    /**
     * @param array $arr
     * @param int $target
     * @return int
     */
    function binarySearch(array $arr, int $target): int {
        $left = 0;
        $right = count($arr) - 1;
        while ($left <= $right) {
            $mid = floor(($left + $right) / 2);
            if ($arr[$mid] <= $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }
        return $left;
    }
}
```

