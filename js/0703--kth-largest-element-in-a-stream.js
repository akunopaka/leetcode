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