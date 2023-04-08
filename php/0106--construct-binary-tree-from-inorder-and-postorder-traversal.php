<?php
// 106. Construct Binary Tree from Inorder and Postorder Traversal
// https://leetcode.com/problems/construct-binary-tree-from-inorder-and-postorder-traversal/
// Medium
//
// Given two integer arrays inorder and postorder where inorder is the inorder traversal of a binary tree and postorder is the postorder traversal of the same tree, construct and return the binary tree.
//
// Example 1:
// Input: inorder = [9,3,15,20,7], postorder = [9,15,7,20,3]
// Output: [3,9,20,null,null,15,7]
// Example 2:
// Input: inorder = [-1], postorder = [-1]
// Output: [-1]
//
// Constraints:
// 1 <= inorder.length <= 3000
// postorder.length == inorder.length
// -3000 <= inorder[i], postorder[i] <= 3000
// inorder and postorder consist of unique values.
// Each value of postorder also appears in inorder.
// inorder is guaranteed to be the inorder traversal of the tree.
// postorder is guaranteed to be the postorder traversal of the tree.

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
class Solution____2
{
    /**
     * @param Integer[] $inorder
     * @param Integer[] $postorder
     * @return TreeNode
     */
    function buildTree(array $inorder, array $postorder): ?TreeNode {
        $build = function (int $inStart, int $inEnd, int $postStart, int $postEnd) use (&$build, $inorder, $postorder) {
            if ($inStart > $inEnd) {
                return null;
            }
            $rootVal = $postorder[$postEnd];
            $rootIndex = array_search($rootVal, $inorder);
            $leftSize = $rootIndex - $inStart;
            $left = $build($inStart, $rootIndex - 1, $postStart, $postStart + $leftSize - 1);
            $right = $build($rootIndex + 1, $inEnd, $postStart + $leftSize, $postEnd - 1);
            return new TreeNode($rootVal, $left, $right);
        };
        return $build(0, count($inorder) - 1, 0, count($postorder) - 1);
    }
}


class Solution
{

    /**
     * @param Integer[] $inorder
     * @param Integer[] $postorder
     * @return TreeNode
     */
    function buildTree(array $inorder, array $postorder): ?TreeNode {
        if (empty($inorder) || empty($postorder)) {
            return null;
        }
        $root = new TreeNode($postorder[count($postorder) - 1]);
        $rootIndex = array_search($root->val, $inorder);
        $root->left = $this->buildTree(array_slice($inorder, 0, $rootIndex), array_slice($postorder, 0, $rootIndex));
        $root->right = $this->buildTree(array_slice($inorder, $rootIndex + 1), array_slice($postorder, $rootIndex, count($postorder) - $rootIndex - 1));
        return $root;
    }
}