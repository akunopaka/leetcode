<?php
//  347. Top K Frequent Elements
//  https://leetcode.com/problems/top-k-frequent-elements/
//  Medium
//  
//    Example 1:
//    Input: nums = [1,1,1,2,2,3], k = 2
//    Output: [1,2]
//    Example 2:
//    Input: nums = [1], k = 1
//    Output: [1]
//    Constraints:
//    1 &lt;= nums.length &lt;= 105
//    -104 &lt;= nums[i] &lt;= 104
//    k is in the range [1, the number of unique elements in the array].
//    It is guaranteed that the answer is unique.
//    Follow up: Your algorithm's time complexity must be better than O(n log n), where n is the array's size.

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