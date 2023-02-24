<?php
//98. Validate Binary Search Tree
//https://leetcode.com/problems/validate-binary-search-tree/
//Medium
//Given the root of a binary tree, determine if it is a valid binary search tree (BST).
//A valid BST is defined as follows:
//The left
//subtree
// of a node contains only nodes with keys less than the node's key.
//The right subtree of a node contains only nodes with keys greater than the node's key.
//Both the left and right subtrees must also be binary search trees.
//
//Example 1:
//Input: root = [2,1,3]
//Output: true
//Example 2:
//Input: root = [5,1,4,null,null,3,6]
//Output: false
//Explanation: The root node's value is 5 but its right child's value is 4.
//Constraints:
//The number of nodes in the tree is in the range [1, 104].
//-231 <= Node.val <= 231 - 1

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
class TreeNode
{
    public $val = null;
    public $left = null;

    function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}


class Solution
{

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST($root, $minLimit = null, $maxLimit = null)
    {
        if ($root === null) return true;
        if (($minLimit !== null && $root->val <= $minLimit) ||
            ($maxLimit !== null && $root->val >= $maxLimit)) {
            return false;
        }
        return $this->isValidBST($root->left, $minLimit, $root->val) &&
            $this->isValidBST($root->right, $root->val, $maxLimit);
    }
}


// class with sample methods treeNodes
class Solution_______2
{

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST($root)
    {
        return $this->isNodeValid($root, null, null);
    }

    function isNodeValid($root, $minLimit, $maxLimit)
    {
        if ($root === null) {
            return true;
        }
        if (($minLimit !== null && $root->val <= $minLimit) || ($maxLimit !== null && $root->val >= $maxLimit)) {
            return false;
        }
        return $this->isNodeValid($root->left, $minLimit, $root->val) && $this->isNodeValid($root->right, $root->val, $maxLimit);
    }
}

class Solution_akuno_trash
{

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST(TreeNode $root)
    {
        return $this->isNodeValid($root);
    }

    function isNodeValid(TreeNode $root, $lower = null, $greater = null)
    {
//        echo '<pre>';
//        echo 'R: ' . $root->val . PHP_EOL;
//        echo 'L: ' . $lower . PHP_EOL;
//        echo 'G: ' . $greater . PHP_EOL;
//        echo PHP_EOL;

        if ($root->left &&
            ($root->left->val >= $root->val ||
                ($greater !== null && $root->left->val <= $greater) ||
                ($lower !== null && $root->left->val >= $lower)
            )
        ) {
            return false;
        }
        if ($root->right &&
            ($root->right->val <= $root->val ||
                ($greater !== null && $root->right->val <= $greater) ||
                ($lower !== null && $root->right->val >= $lower)
            )
        ) return false;

        if ($root->left && !$this->isNodeValid($root->left, ($lower == null || $lower > $root->val) ? $root->val : $lower, $greater)) return false;
        if ($root->right && !$this->isNodeValid($root->right, $lower, ($greater == null || $greater > $root->val) ? $root->val : $greater)) return false;
        return true;
    }
}


$root = new TreeNode(2, new TreeNode(1), new TreeNode(3));
$root1 = new TreeNode(5, new TreeNode(1), new TreeNode(4, new TreeNode(3), new TreeNode(6)));
$root2 = new TreeNode(5, new TreeNode(4), new TreeNode(6, new TreeNode(3), new TreeNode(7)));
$solution = new Solution();

echo '<pre>';
echo 'Expect: true, Result: ';
var_dump($solution->isValidBST($root)) . PHP_EOL;
echo 'Expect: false, Result: ';
var_dump($solution->isValidBST($root1)) . PHP_EOL;
echo 'Expect: false, Result: ';
var_dump($solution->isValidBST($root2)) . PHP_EOL;
echo '</pre>';

//Output:
//
//1
//0

//I hope you find it helpful .
//
//Cheers
//
//PHP Code: // class with sample methods treeNodes class Solution { /** * @param TreeNode $root * @return Boolean */ function isValidBST ( $root ) { return $this -> validate ( $root , null , null ) ; } function validate ( $root , $min , $max ) { if ( $root === null ) { return true ; } if ( $min !== null && $root -> val <= $min ) { return false ; } if ( $max !== null && $root -> val >= $max ) { return false ; } return $this -> validate ( $root -> left , $min , $root -> val ) && $this -> validate ( $root -> right , $root -> val , $max ) ; } }
//
//PHP Code:
//$root = new TreeNode (2, new TreeNode (1), new TreeNode (3));
//$root1 = new TreeNode (5, new TreeNode (1), new TreeNode (4, new TreeNode (3), new TreeNode (6)));
//$solution = new Solution ();
//echo $solution->isValidBST($root) . PHP_EOL;
//echo $solution->isValidBST($root1) . PHP_EOL;