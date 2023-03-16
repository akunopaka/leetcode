<?php
// 958. Check Completeness of a Binary Tree
// https://leetcode.com/problems/check-completeness-of-a-binary-tree/
// Medium
// Given the root of a binary tree, determine if it is a complete binary tree.
// In a complete binary tree, every level, except possibly the last, is completely filled, and all nodes in the last level are as far left as possible. It can have between 1 and 2h nodes inclusive at the last level h.
//
// Example 1:
// Input: root = [1,2,3,4,5,6]
// Output: true
// Explanation: Every level before the last is full (ie. levels with node-values {1} and {2, 3}), and all nodes in the last level ({4, 5, 6}) are as far left as possible.
// Example 2:
// Input: root = [1,2,3,4,5,null,7]
// Output: false
// Explanation: The node with value 7 isn't as far left as possible.
// Constraints:
// The number of nodes in the tree is in the range [1, 100].
// 1 <= Node.val <= 1000

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
     * @return Boolean
     */
    function isCompleteTree(?TreeNode $root): bool
    {
        $nullNodeFound = false;
        $queue = [$root];
        while (count($queue) > 0) {
            $node = array_shift($queue);
            if (!$node) {
                $nullNodeFound = true;
            } else {
                if ($nullNodeFound) return false;
                $queue[] = $node->left;
                $queue[] = $node->right;
            }
        }
        return true;
    }
}