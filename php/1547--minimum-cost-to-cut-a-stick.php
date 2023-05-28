<?php
//  1547. Minimum Cost to Cut a Stick
//  https://leetcode.com/problems/minimum-cost-to-cut-a-stick/
//  Hard
//  
//    Given an integer array cuts where cuts[i] denotes a position you should perform a cut at.
//    You should perform the cuts in order, you can change the order of the cuts as you wish.
//    The cost of one cut is the length of the stick to be cut, the total cost is the sum of costs of all cuts. When you cut a stick, it will be split into two smaller sticks (i.e. the sum of their lengths is the length of the stick before the cut). Please refer to the first example for a better explanation.
//    Return the minimum total cost of the cuts.
//    Example 1:
//    Input: n = 7, cuts = [1,3,4,5]
//    Output: 16
//    Explanation: Using cuts order = [1, 3, 4, 5] as in the input leads to the following scenario:
//    The first cut is done to a rod of length 7 so the cost is 7. The second cut is done to a rod of length 6 (i.e. the second part of the first cut), the third is done to a rod of length 4 and the last cut is to a rod of length 3. The total cost is 7 + 6 + 4 + 3 = 20.
//    Rearranging the cuts to be [3, 5, 1, 4] for example will lead to a scenario with total cost = 16 (as shown in the example photo 7 + 4 + 3 + 2 = 16).
//    Example 2:
//    Input: n = 9, cuts = [5,6,1,4,2]
//    Output: 22
//    Explanation: If you try the given cuts ordering the cost will be 25.
//    There are much ordering with total cost &lt;= 25, for example, the order [4, 6, 5, 2, 1] has total cost = 22 which is the minimum possible.
//    Constraints:
//    2 &lt;= n &lt;= 106
//    1 &lt;= cuts.length &lt;= min(n - 1, 100)
//    1 &lt;= cuts[i] &lt;= n - 1
//    All the integers in cuts array are distinct.


class Solution
{
    private $cache = [];


    /**
     * @param Integer $n
     * @param Integer[] $cuts
     * @param int|null $left
     * @param int|null $right
     * @return int
     */
    function minCost(int $n, array $cuts, int $left = null, int $right = null): int {
        if ($left === null) $left = 0;
        if ($right === null) $right = $n;
        if ($right - $left == 1) return 0;

        if (isset($this->cache[$left][$right])) return $this->cache[$left][$right];

        $res = PHP_INT_MAX;
        foreach ($cuts as $cut) {
            if ($cut > $left && $cut < $right) {
                $res = min($res, $right - $left + $this->minCost($n, $cuts, $left, $cut) + $this->minCost($n, $cuts, $cut, $right));
            }
        }
        if ($res == PHP_INT_MAX) $res = 0;

        $this->cache[$left][$right] = $res;

        return $res;
    }
}