<?php
//  703. Kth Largest Element in a Stream
//  https://leetcode.com/problems/kth-largest-element-in-a-stream/
//  Easy
//  
//    Implement KthLargest class:
//    KthLargest(int k, int[] nums) Initializes the object with the integer k and the stream of integers nums.
//    int add(int val) Appends the integer val to the stream and returns the element representing the kth largest element in the stream.
//    Example 1:
//    Input
//    ["KthLargest", "add", "add", "add", "add", "add"]
//    [[3, [4, 5, 8, 2]], [3], [5], [10], [9], [4]]
//    Output
//    [null, 4, 5, 5, 8, 8]
//    Explanation
//    KthLargest kthLargest = new KthLargest(3, [4, 5, 8, 2]);
//    kthLargest.add(3);   // return 4
//    kthLargest.add(5);   // return 5
//    kthLargest.add(10);  // return 5
//    kthLargest.add(9);   // return 8
//    kthLargest.add(4);   // return 8
//    Constraints:
//    1 &lt;= k &lt;= 104
//    0 &lt;= nums.length &lt;= 104
//    -104 &lt;= nums[i] &lt;= 104
//    -104 &lt;= val &lt;= 104
//    At most 104 calls will be made to add.
//    It is guaranteed that there will be at least k elements in the array when you search for the kth element.


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

/**
 * Your KthLargest object will be instantiated and called as such:
 * $obj = KthLargest($k, $nums);
 * $ret_1 = $obj->add($val);
 */

// test
$nums = [4, 5, 8, 2];
$kthLargest = new KthLargest(3, $nums);
echo $kthLargest->add(3) . PHP_EOL;   // return 4
echo $kthLargest->add(5) . PHP_EOL;   // return 5
