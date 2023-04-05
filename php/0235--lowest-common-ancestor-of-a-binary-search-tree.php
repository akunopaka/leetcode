<?php
// 235. Lowest Common Ancestor of a Binary Search Tree
// https://leetcode.com/problems/lowest-common-ancestor-of-a-binary-search-tree/
// Medium
// Given a binary search tree (BST), find the lowest common ancestor (LCA) node of two given nodes in the BST.
// According to the definition of LCA on Wikipedia: “The lowest common ancestor is defined between two nodes p and q as the lowest node in T that has both p and q as descendants (where we allow a node to be a descendant of itself).”
//
// Example 1:
// Input: root = [6,2,8,0,4,7,9,null,null,3,5], p = 2, q = 8
// Output: 6
// Explanation: The LCA of nodes 2 and 8 is 6.
// Example 2:
// Input: root = [6,2,8,0,4,7,9,null,null,3,5], p = 2, q = 4
// Output: 2
// Explanation: The LCA of nodes 2 and 4 is 2, since a node can be a descendant of itself according to the LCA definition.
// Example 3:
// Input: root = [2,1], p = 2, q = 1
// Output: 2
//
// Constraints:
// The number of nodes in the tree is in the range [2, 105].
// -109 <= Node.val <= 109
// All Node.val are unique.
// p != q
// p and q will exist in the BST.

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
// iterative approach
class Solution
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q): ?TreeNode {
        while ($root) {
            if ($root->val > $p->val && $root->val > $q->val) {
                $root = $root->left;
            } elseif ($root->val < $p->val && $root->val < $q->val) {
                $root = $root->right;
            } else {
                return $root;
            }
        }
        return null;
    }
}


class Solution____1
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        if ($root->val > $p->val && $root->val > $q->val) return $this->lowestCommonAncestor($root->left, $p, $q);
        if ($root->val < $p->val && $root->val < $q->val) return $this->lowestCommonAncestor($root->right, $p, $q);
        return $root;
    }
}

class Solution___OK
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        if ($root == null || $root->val == $p->val || $root->val == $q->val) {
            return $root;
        }
        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        $right = $this->lowestCommonAncestor($root->right, $p, $q);
        if ($left && $right) {
            return $root;
        }
        return $left ?: $right;
    }
}

class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($val = 0, $left = null, $right = null) {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class TreeNodeExtend extends TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;
    public $parentNode = null;
    public $level = null;

    function __construct($val = 0, $left = null, $right = null, $parentNode = null, $level = 0) {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
        $this->parentNode = $parentNode;
        $this->level = $level;
    }
}

class Solution___2
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        $resP = $this->findDepth(new TreeNodeExtend($root->val, $root->left, $root->right, null, 0), $p);
        $resQ = $this->findDepth(new TreeNodeExtend($root->val, $root->left, $root->right, null, 0), $q);
        if ($resP->level > $resQ->level) {
            while ($resP->level != $resQ->level) {
                $resP = $resP->parentNode;
            }
        }
        if ($resP->level < $resQ->level) {
            while ($resP->level != $resQ->level) {
                $resQ = $resQ->parentNode;
            }
        }
        while ($resP != $resQ) {
            $resP = $resP->parentNode;
            $resQ = $resQ->parentNode;
        }
        return new TreeNode($resP->val, $resP->left, $resP->right);
    }

    function findDepth($root, $searchNode) {
        if ($root === null) return null;
        if ($root->val == $searchNode) return $root;
        foreach ([$root->left, $root->right] as $node) {
            if ($node && $res = $this->findDepth(new TreeNodeExtend($node->val, $node->left, $node->right, $root, ($root->level + 1)), $searchNode)) {
                return $res;
            }
        }
        return null;
    }
}

echo '<pre>';
$solution = new Solution();

$root = new TreeNode(6,
    new TreeNode(2, new TreeNode(0),
        new TreeNode(4, new TreeNode(3),
            new TreeNode(5))),
    new TreeNode(8, new TreeNode(7),
        new TreeNode(9)));
echo 'Expect: 6, Solution Result: ';
var_dump($solution->lowestCommonAncestor($root, 2, 8)) . PHP_EOL;
echo 'Expect: 2, Solution Result: ';
var_dump($solution->lowestCommonAncestor($root, 2, 5)) . PHP_EOL;

$root1 = new TreeNode(2, new TreeNode(1));
echo 'Expect: 2, Solution Result: ';
var_dump($solution->lowestCommonAncestor($root1, 2, 1)) . PHP_EOL;
//$root2 = new TreeNode(5, new TreeNode(4), new TreeNode(6, new TreeNode(3), new TreeNode(7)));


echo '</pre>';
