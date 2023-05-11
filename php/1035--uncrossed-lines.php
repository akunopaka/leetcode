<?php
//  1035. Uncrossed Lines
//  https://leetcode.com/problems/uncrossed-lines/
//  Medium
//  
//    We may draw connecting lines: a straight line connecting two numbers nums1[i] and nums2[j] such that:
//    nums1[i] == nums2[j], and
//    the line we draw does not intersect any other connecting (non-horizontal) line.
//    Note that a connecting line cannot intersect even at the endpoints (i.e., each number can only belong to one connecting line).
//    Return the maximum number of connecting lines we can draw in this way.
//    Example 1:
//    Input: nums1 = [1,4,2], nums2 = [1,2,4]
//    Output: 2
//    Explanation: We can draw 2 uncrossed lines as in the diagram.
//    We cannot draw 3 uncrossed lines, because the line from nums1[1] = 4 to nums2[2] = 4 will intersect the line from nums1[2]=2 to nums2[1]=2.
//    Example 2:
//    Input: nums1 = [2,5,1,2,5], nums2 = [10,5,2,1,5,2]
//    Output: 3
//    Example 3:
//    Input: nums1 = [1,3,7,1,7,5], nums2 = [1,9,2,5,1]
//    Output: 2
//    Constraints:
//    1 &lt;= nums1.length, nums2.length &lt;= 500
//    1 &lt;= nums1[i], nums2[j] &lt;= 2000

class Solution
{
    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer
     */
    function maxUncrossedLines(array $nums1, array $nums2): int {
        $lengthNum1 = count($nums1);
        $lengthNum2 = count($nums2);
        $dp = array_fill(0, $lengthNum1 + 1, array_fill(0, $lengthNum2 + 1, 0));
        for ($i = 1; $i <= $lengthNum1; $i++) {
            for ($j = 1; $j <= $lengthNum2; $j++) {
                $dp[$i][$j] = $nums1[$i - 1] == $nums2[$j - 1] ? $dp[$i - 1][$j - 1] + 1 : max($dp[$i - 1][$j], $dp[$i][$j - 1]);
            }
        }
        return $dp[$lengthNum1][$lengthNum2];
    }
}