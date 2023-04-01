#### 704. Binary Search

https://leetcode.com/problems/binary-search/

Easy

Given an array of integers <code>nums</code> which is sorted in ascending order, and an integer <code>target</code>,
write a function to search <code>target</code> in <code>nums</code>. If <code>target</code> exists, then return its
index. Otherwise, return <code>-1</code>.

<p>You must write an algorithm with <code>O(log n)</code> runtime complexity.</p>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> nums = [-1,0,3,5,9,12], target = 9
<strong>Output:</strong> 4
<strong>Explanation:</strong> 9 exists in nums and its index is 4
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> nums = [-1,0,3,5,9,12], target = 2
<strong>Output:</strong> -1
<strong>Explanation:</strong> 2 does not exist in nums so return -1
</pre>

<strong>Constraints:</strong>
<ul>
	<li><code>1 &lt;= nums.length &lt;= 10<sup>4</sup></code></li>
	<li><code>-10<sup>4</sup> &lt; nums[i], target &lt; 10<sup>4</sup></code></li>
	<li>All the integers in <code>nums</code> are <strong>unique</strong>.</li>
	<li><code>nums</code> is sorted in ascending order.</li>
</ul>

#### .JS

```js
var search = function (nums, target) {
    let left = 0;
    let right = nums.length - 1;
    while (left <= right) {
        const mid = Math.floor((left + right) / 2);
        const value = nums[mid];

        if (value === target) {
            return mid;
        }

        if (value < target) {
            left = mid + 1;
        } else {
            right = mid - 1;
        }
    }
    return -1;
};
```

#### PHP

```php
class Solution
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target): int
    {
        if (!in_array($target, $nums)) return -1;
        $left = 0;
        $right = count($nums) - 1;
        while ($left <= $right) {
            $mid = round(($left + $right) / 2);
            if ($nums[$mid] > $target) {
                $right = $mid - 1;
            } elseif ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else {
                return $mid;
            }
        }
        return -1;
    }
}
```

-- OR --

```php
class Solution
{
    function search(array $nums, int $target): int
    {
        if ($nums == null) return (int)-1;
        $res = $this->getIndex($nums, $target, 0);
        return (int)$res;
    }

    function getIndex(array $nums, int $target, int $offset = 0): int
    {
        if (!in_array($target, $nums)) return -1;
        $index = -1;
        $length = count($nums);
        if ($length == 1 && $nums[0] != $target) {
            return (int)-1;
        } elseif ($length == 1 && $nums[0] == $target) {
            return $offset;
        }
        $mid = floor($length / 2);
        if ($nums[$mid] == $target) {
            return $mid + $offset;
        } else if ($nums[$mid] > $target) {
            $index = $this->getIndex(array_slice($nums, 0, $mid), $target, $offset);
        } else {
            $index = $this->getIndex(array_slice($nums, $mid), $target, $mid + $offset);
        }
        return $index;
    }
}
```