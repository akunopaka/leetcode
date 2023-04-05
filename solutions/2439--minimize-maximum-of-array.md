### 2439. Minimize Maximum of Array

Difficulty: `Medium`

https://leetcode.com/problems/minimize-maximum-of-array/

My Solution on LeetCode:
https://leetcode.com/problems/minimize-maximum-of-array/solutions/3383460/javascript-php-minimize-maximum-of-array-by-calculating-sum-and-finding-max-of-sum-i-1/

<p>You are given a <strong>0-indexed</strong> array <code>nums</code> comprising of <code>n</code> non-negative integers.</p>
<p>In one operation, you must:</p>
<ul>
	<li>Choose an integer <code>i</code> such that <code>1 &lt;= i &lt; n</code> and <code>nums[i] &gt; 0</code>.</li>
	<li>Decrease <code>nums[i]</code> by 1.</li>
	<li>Increase <code>nums[i - 1]</code> by 1.</li>
</ul>
<p>Return<em> the <strong>minimum</strong> possible value of the <strong>maximum</strong> integer of </em><code>nums</code><em> after performing <strong>any</strong> number of operations</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> nums = [3,7,1,6]
<strong>Output:</strong> 5
<strong>Explanation:</strong>
One set of optimal operations is as follows:
1. Choose i = 1, and nums becomes [4,6,1,6].
2. Choose i = 3, and nums becomes [4,6,2,5].
3. Choose i = 1, and nums becomes [5,5,2,5].
The maximum integer of nums is 5. It can be shown that the maximum number cannot be less than 5.
Therefore, we return 5.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> nums = [10,1]
<strong>Output:</strong> 10
<strong>Explanation:</strong>
It is optimal to leave nums as is, and since 10 is the maximum value, we return 10.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>n == nums.length</code></li>
	<li><code>2 &lt;= n &lt;= 10<sup>5</sup></code></li>
	<li><code>0 &lt;= nums[i] &lt;= 10<sup>9</sup></code></li>
</ul>

### My Solution(s):

// https://leetcode.com/problems/minimize-maximum-of-array/editorial/

##### JavaScript

```js
var minimizeArrayValue = function (nums) {
    let sum = 0;
    let res = 0;
    const numsLength = nums.length;
    for (let i = 0; i < numsLength; i++) {
        sum += nums[i];
        res = Math.max(res, Math.ceil(sum / (i + 1)));
    }
    return res;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function minimizeArrayValue(array $nums): int {
        $numLength = count($nums);
        $sum = 0;
        $mixMaxResult = 0;
        for ($i = 0; $i < $numLength; $i++) {
            $sum += $nums[$i];
            $mixMaxResult = max($mixMaxResult, ceil($sum / ($i + 1)));
        }
        return $mixMaxResult;
    }
}
```

