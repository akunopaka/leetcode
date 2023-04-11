<?php
//  54. Spiral Matrix
//  https://leetcode.com/problems/spiral-matrix/
//  Medium
//  
//    Given the root of a binary tree, return the level order traversal of its nodes' values. (i.e., from left to right, level by level).
//    Example 1:
//    Input: root = [3,9,20,null,null,15,7]
//    Output: [[3],[9,20],[15,7]]
//    Example 2:
//    Input: root = [1]
//    Output: [[1]]
//    Example 3:
//    Input: root = []
//    Output: []
//    Constraints:
//    The number of nodes in the tree is in the range [0, 2000].
//    -1000 &lt;= Node.val &lt;= 1000
class Solution
{
    /**
     * @param Integer[][] $matrix
     * @return Integer[]
     */
    function spiralOrder(array $matrix): array {
        $res = [];
        while ($matrix) {
            $first = array_shift($matrix);
            array_push($res, ...$first);
            foreach ($matrix as &$m) {
                $val = array_pop($m);
                if ($val) $res[] = $val;
                $m = array_reverse($m);
            }
            $matrix = array_reverse($matrix);
        }
        return $res;
    }

    function spiralOrder___2(array $matrix): array {
        // direction: 0 - right, 1 - down, 2 - left, 3 - up
        $direction = 0;
        $row = 0;
        $col = 0;
        $rowMax = count($matrix) - 1;
        $colMax = count($matrix[0]) - 1;
        $result = [];
        while ($row <= $rowMax && $col <= $colMax) {
            switch ($direction) {
                case 0:
                    for ($i = $col; $i <= $colMax; $i++) $result[] = $matrix[$row][$i];
                    $row++;
                    break;
                case 1:
                    for ($i = $row; $i <= $rowMax; $i++) $result[] = $matrix[$i][$colMax];
                    $colMax--;
                    break;
                case 2:
                    for ($i = $colMax; $i >= $col; $i--) $result[] = $matrix[$rowMax][$i];
                    $rowMax--;
                    break;
                case 3:
                    for ($i = $rowMax; $i >= $row; $i--) $result[] = $matrix[$i][$col];
                    $col++;
                    break;
            }
            $direction = ($direction + 1) % 4;
        }
        return $result;
    }
}