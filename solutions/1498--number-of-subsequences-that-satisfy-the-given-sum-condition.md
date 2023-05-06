### 1498. Number of Subsequences That Satisfy the Given Sum Condition

Difficulty: `Medium`

https://leetcode.com/problems/number-of-subsequences-that-satisfy-the-given-sum-condition/



<p>You are given an array of integers <code>nums</code> and an integer <code>target</code>.</p>
<p>Return <em>the number of <strong>non-empty</strong> subsequences of </em><code>nums</code><em> such that the sum of the minimum and maximum element on it is less or equal to </em><code>target</code>. Since the answer may be too large, return it <strong>modulo</strong> <code>10<sup>9</sup> + 7</code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> nums = [3,5,6,7], target = 9
<strong>Output:</strong> 4
<strong>Explanation:</strong> There are 4 subsequences that satisfy the condition.
[3] -&gt; Min value + max value &lt;= target (3 + 3 &lt;= 9)
[3,5] -&gt; (3 + 5 &lt;= 9)
[3,5,6] -&gt; (3 + 6 &lt;= 9)
[3,6] -&gt; (3 + 6 &lt;= 9)
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> nums = [3,3,6,8], target = 10
<strong>Output:</strong> 6
<strong>Explanation:</strong> There are 6 subsequences that satisfy the condition. (nums can have repeated numbers).
[3] , [3] , [3,3], [3,6] , [3,6] , [3,3,6]
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> nums = [2,3,3,4,6,7], target = 12
<strong>Output:</strong> 61
<strong>Explanation:</strong> There are 63 non-empty subsequences, two of them do not satisfy the condition ([6,7], [7]).
Number of valid subsequences (63 - 2 = 61).
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= nums.length &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= nums[i] &lt;= 10<sup>6</sup></code></li>
	<li><code>1 &lt;= target &lt;= 10<sup>6</sup></code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var numSubseq = function (nums, target) {
    nums.sort((a, b) => a - b);

    const mod = 1e9 + 7;
    let pow = [];
    pow.push(1);
    for (let i = 1; i < nums.length; i++) {
        pow.push((pow[pow.length - 1] * 2) % mod);
    }

    let leftIndex = 0;
    let rightIndex = nums.length - 1;
    let answer = 0;
    while (leftIndex <= rightIndex && nums[leftIndex] * 2 <= target) {
        if (nums[leftIndex] + nums[rightIndex] > target) {
            rightIndex--;
        } else {
            answer = (answer + pow[rightIndex - leftIndex++]) % mod;
        }
    }

    return answer;
};


// -- OR --
/**
 * @param {number[]} nums
 * @param {number} target
 * @return {number}
 */
const findRight = (nums, target) => {
    let left = 0;
    let right = nums.length;
    while (left < right) {
        let mid = (left + right) >> 1;
        if (nums[mid] <= target) {
            left = mid + 1;
        } else {
            right = mid;
        }
    }
    return left;
};

/**
 * @param {number[]} nums
 * @param {number} target
 * @return {number}
 */
const numSubseq = (nums, target) => {
    let numsCount = nums.length;
    let mod = Math.pow(10, 9) + 7;
    nums.sort((a, b) => a - b);

    let pow = [];
    pow.push(1);
    for (let i = 1; i < numsCount; i++) {
        pow.push((pow[i - 1] << 1) % mod);
    }

    let answer = 0;

    for (let left = 0; left < numsCount; left++) {
        let right = findRight(nums, target - nums[left]) - 1;
        if (right >= left) {
            answer += pow[right - left];
        } else {
            break;
        }
    }
    return answer % mod;
};

```

##### PHP

```php
class Solution
{
    /**
     * @param array $nums
     * @param int $target
     * @return int
     */
    function findRight(array $nums, int $target): int {
        $left = 0;
        $right = count($nums);
        while ($left < $right) {
            $mid = ($left + $right) >> 1;
            if ($nums[$mid] <= $target) {
                $left = $mid + 1;
            } else {
                $right = $mid;
            }
        }
        return $left;
    }

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function numSubseq(array $nums, int $target): int {
        $numsCount = count($nums);
        $mod = pow(10, 9) + 7;
        sort($nums);

        $answer = 0;

        for ($left = 0; $left < $numsCount; $left++) {
            $right = self::findRight($nums, $target - $nums[$left]) - 1;
            if ($right >= $left) {
                $answer += bcpowmod(2, $right - $left, $mod);
                $answer = $answer % $mod;
            } else {
                break;
            }
        }
        return $answer % $mod;
    }
}
```

