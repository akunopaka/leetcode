### 703. Kth Largest Element in a Stream

Difficulty: `Easy`

https://leetcode.com/problems/kth-largest-element-in-a-stream/


<p>Implement <code>KthLargest</code> class:</p>
<ul>
	<li><code>KthLargest(int k, int[] nums)</code> Initializes the object with the integer <code>k</code> and the stream of integers <code>nums</code>.</li>
	<li><code>int add(int val)</code> Appends the integer <code>val</code> to the stream and returns the element representing the <code>k<sup>th</sup></code> largest element in the stream.</li>
</ul>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input</strong>
["KthLargest", "add", "add", "add", "add", "add"]
[[3, [4, 5, 8, 2]], [3], [5], [10], [9], [4]]
<strong>Output</strong>
[null, 4, 5, 5, 8, 8]
<strong>Explanation</strong>
KthLargest kthLargest = new KthLargest(3, [4, 5, 8, 2]);
kthLargest.add(3);   // return 4
kthLargest.add(5);   // return 5
kthLargest.add(10);  // return 5
kthLargest.add(9);   // return 8
kthLargest.add(4);   // return 8
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= k &lt;= 10<sup>4</sup></code></li>
	<li><code>0 &lt;= nums.length &lt;= 10<sup>4</sup></code></li>
	<li><code>-10<sup>4</sup> &lt;= nums[i] &lt;= 10<sup>4</sup></code></li>
	<li><code>-10<sup>4</sup> &lt;= val &lt;= 10<sup>4</sup></code></li>
	<li>At most <code>10<sup>4</sup></code> calls will be made to <code>add</code>.</li>
	<li>It is guaranteed that there will be at least <code>k</code> elements in the array when you search for the <code>k<sup>th</sup></code> element.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
/**
 * @param {number} k
 * @param {number[]} nums
 */
var KthLargest = function (k, nums) {
        this.main = new MinPriorityQueue();
        this.size = k;
        for (let num of nums) {
            this.add(num);
        }
    };

/**
 * @param {number} val
 * @return {number}
 */
KthLargest.prototype.add = function (val) {
    this.main.enqueue(val);
    if (this.main.size() > this.size) {
        this.main.dequeue();
    }
    return this.main.front().element;
};

/**
 * Your KthLargest object will be instantiated and called as such:
 * var obj = new KthLargest(k, nums)
 * var param_1 = obj.add(val)
 */
```

##### PHP

```php
class KthLargest
{
    private $k;
    private $heap;

    /**
     * @param Integer $k
     * @param Integer[] $nums
     */
    function __construct(int $k, array $nums) {
        $this->k = $k;

        sort($nums);
        $nums = array_slice($nums, -1 * $k);

        $this->heap = new SplMinHeap();

        foreach ($nums as $val) {
            $this->heap->insert($val);
            if ($this->heap->count() > $k) {
                $this->heap->extract();
            }
        }
    }

    /**
     * @param Integer $val
     * @return Integer
     */
    function add(int $val): int {
        $this->heap->insert($val);
        if ($this->heap->count() > $this->k) {
            $this->heap->extract();
        }
        return $this->heap->top();
    }
}
```

