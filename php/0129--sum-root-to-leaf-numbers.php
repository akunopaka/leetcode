<?php
// 129. Sum Root to Leaf Numbers
// https://leetcode.com/problems/sum-root-to-leaf-numbers/
// Medium
//You are given the root of a binary tree containing digits from 0 to 9 only.
//Each root-to-leaf path in the tree represents a number.
//For example, the root-to-leaf path 1 -> 2 -> 3 represents the number 123.
//Return the total sum of all root-to-leaf numbers. Test cases are generated so that the answer will fit in a 32-bit integer.
//A leaf node is a node with no children.
//
//Example 1:
//Input: root = [1,2,3]
//Output: 25
//Explanation:
//The root-to-leaf path 1->2 represents the number 12.
//The root-to-leaf path 1->3 represents the number 13.
//Therefore, sum = 12 + 13 = 25.
//Example 2:
//Input: root = [4,9,0,5,1]
//Output: 1026
//Explanation:
//The root-to-leaf path 4->9->5 represents the number 495.
//The root-to-leaf path 4->9->1 represents the number 491.
//The root-to-leaf path 4->0 represents the number 40.
//Therefore, sum = 495 + 491 + 40 = 1026.
//Constraints:
//The number of nodes in the tree is in the range [1, 1000].
//0 <= Node.val <= 9
//The depth of the tree will not exceed 10.

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution
{
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function sumNumbers(TreeNode $root): int
    {
        return $this->dfs($root, 0);
    }

    private function dfs(?TreeNode $node, int $sum): int
    {
        if ($node === null) {
            return 0;
        }
        if ($node->left === null && $node->right == null) {
            return $sum * 10 + $node->val;
        }
        return $this->dfs($node->left, $sum * 10 + $node->val) +
            $this->dfs($node->right, $sum * 10 + $node->val);
    }
}


class Solution___2
{
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function sumNumbers(TreeNode $root): int
    {
        if ($root === null || $root->val === null) return 0;
        $totalSum = 0;
        $queue = [$root];
        while (count($queue) > 0) {
            $node = array_shift($queue);
            if ($node->left === null && $node->right === null) {
                $totalSum += $node->val;
            }

            if ($node->left) {
                $node->left->val = $node->val * 10 + $node->left->val;
                $queue[] = $node->left;
            }
            if ($node->right) {
                $node->right->val = $node->val * 10 + $node->right->val;
                $queue[] = $node->right;
            }
        }
        return $totalSum;
    }
}
