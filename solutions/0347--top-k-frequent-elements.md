### 347. Top K Frequent Elements

Difficulty: `Medium`

https://leetcode.com/problems/top-k-frequent-elements/


<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> nums = [1,1,1,2,2,3], k = 2
<strong>Output:</strong> [1,2]
</pre><p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> nums = [1], k = 1
<strong>Output:</strong> [1]
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= nums.length &lt;= 10<sup>5</sup></code></li>
	<li><code>-10<sup>4</sup> &lt;= nums[i] &lt;= 10<sup>4</sup></code></li>
	<li><code>k</code> is in the range <code>[1, the number of unique elements in the array]</code>.</li>
	<li>It is <strong>guaranteed</strong> that the answer is <strong>unique</strong>.</li>
</ul>
<p><strong>Follow up:</strong> Your algorithm's time complexity must be better than <code>O(n log n)</code>, where n is the array's size.</p>

### My Solution(s):

##### JavaScript

```js
var topKFrequent = function (nums, k) {
    const map = {};
    const result = [];
    for (let i = 0; i < nums.length; i++) {
        const num = nums[i];
        if (!map[num]) map[num] = 0;
        map[num]++;
    }
    const sorted = Object.keys(map).sort((a, b) => map[b] - map[a]);
    for (let i = 0; i < k; i++) {
        result.push(sorted[i]);
    }
    return result;
};
```

##### PHP

```php
class Solution
{
    function topKFrequent(array $nums, int $k): array {
        $map = [];
        foreach ($nums as $num) {
            if (isset($map[$num])) {
                $map[$num]++;
            } else {
                $map[$num] = 1;
            }
        }
        arsort($map);
        return array_slice(array_keys($map), 0, $k);
    }
}
```

