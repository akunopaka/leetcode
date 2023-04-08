<?php
// 101. Symmetric Tree
// https://leetcode.com/problems/symmetric-tree/
// Easy
//
//Given the root of a binary tree, check whether it is a mirror of itself (i.e., symmetric around its center).
//Example 1:
//Input: root = [1,2,2,3,4,4,3]
//Output: true
//Example 2:
//Input: root = [1,2,2,null,3,null,3]
//Output: false
//Constraints:
//The number of nodes in the tree is in the range [1, 1000].
//-100 <= Node.val <= 100
//Follow up: Could you solve it both recursively and iteratively?


/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $leftNode = null;
 *     public $rightNode = null;
 *     function __construct($val = 0, $leftNode = null, $rightNode = null) {
 *         $this->val = $val;
 *         $this->left = $leftNode;
 *         $this->right = $rightNode;
 *     }
 * }
 */
// Iterative Solution
class Solution
{
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetric(?TreeNode $root): bool {
        if ($root === null) {
            return true;
        }
        $queue = [[$root->left, $root->right]];

        while ($queue) {
            $newQueue = [];
            foreach ($queue as [$leftNode, $rightNode]) {
                if ($leftNode === null && $rightNode === null) {
                    continue;
                }
                if ($leftNode->val !== $rightNode->val ||
                    $leftNode === null ||
                    $rightNode === null) {
                    return false;
                }
                $newQueue[] = [$leftNode->left, $rightNode->right];
                $newQueue[] = [$leftNode->right, $rightNode->left];
            }
            $queue = $newQueue;
        }
        return true;
    }
}


// recursive solution
class Solution_recursive
{
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetric(?TreeNode $root): bool {
        if ($root === null) {
            return true;
        }
        return $this->isNodesMirror($root->left, $root->right);
    }

    function isNodesMirror(?TreeNode $leftNode, ?TreeNode $rightNode): bool {
        if ($leftNode === null && $rightNode === null) {
            return true;
        }
        if ($leftNode === null || $rightNode === null) {
            return false;
        }
        return $leftNode->val === $rightNode->val &&
            $this->isNodesMirror($leftNode->left, $rightNode->right) &&
            $this->isNodesMirror($leftNode->right, $rightNode->left);
    }
}