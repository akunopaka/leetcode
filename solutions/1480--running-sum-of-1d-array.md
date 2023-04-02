### 1480. Running Sum of 1d Array

Easy\
https://leetcode.com/problems/running-sum-of-1d-array/
<p>Given an array <code>nums</code>. We define a running sum of an array as&nbsp;<code>runningSum[i] = sum(nums[0]…nums[i])</code>.</p>
<p>Return the running sum of <code>nums</code>.</p>

<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> nums = [1,2,3,4]
<strong>Output:</strong> [1,3,6,10]
<strong>Explanation:</strong> Running sum is obtained as follows: [1, 1+2, 1+2+3, 1+2+3+4].</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> nums = [1,1,1,1,1]
<strong>Output:</strong> [1,2,3,4,5]
<strong>Explanation:</strong> Running sum is obtained as follows: [1, 1+1, 1+1+1, 1+1+1+1, 1+1+1+1+1].</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> nums = [3,1,2,10,1]
<strong>Output:</strong> [3,4,6,16,17]
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= nums.length &lt;= 1000</code></li>
	<li><code>-10^6&nbsp;&lt;= nums[i] &lt;=&nbsp;10^6</code></li>
</ul>
<p>&nbsp;</p>

```javascript
var runningSum = function (nums) {
    let runningTotal = 0;
    return nums.map((num) => {
        runningTotal += num;
        return runningTotal;
    });
};
// -- OR --
var runningSum = function (nums) {
    nums.reduce((accumulator, currentValue, currentIndex, array) => array[currentIndex] += accumulator)
    return nums
};
```

```php
class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function runningSum___($nums): array {
        if (!($nums) || is_null($nums[0])) return [];
        $newArr[0] = $nums[0];
        $length = count($nums);
        
        for ($i = 1; $i < $length; $i++) {
            $newArr[$i] = $newArr[$i - 1] + $nums[$i];
        }
        return $newArr;
    }
    // 2nd approach - don't use extra space for new array
    function runningSum($nums): array {
        $length = count($nums);
        for ($i = 1; $i < $length; $i++) {
            $nums[$i] += $nums[$i - 1];
        }
        return $nums;
    }
}
```