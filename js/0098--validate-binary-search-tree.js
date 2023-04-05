// 98. Validate Binary Search Tree
// https://leetcode.com/problems/validate-binary-search-tree/
// Medium
// Given the root of a binary tree, determine if it is a valid binary search tree (BST).
// A valid BST is defined as follows:
// The left
// subtree
// of a node contains only nodes with keys less than the node's key.
// The right subtree of a node contains only nodes with keys greater than the node's key.
// Both the left and right subtrees must also be binary search trees.
//
// Example 1:
// Input: root = [2,1,3]
// Output: true
// Example 2:
// Input: root = [5,1,4,null,null,3,6]
// Output: false
// Explanation: The root node's value is 5 but its right child's value is 4.
// Constraints:
// The number of nodes in the tree is in the range [1, 104].
// -231 <= Node.val <= 231 - 1

/**
 * Definition for a binary tree node.
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {TreeNode} root
 * @return {boolean}
 */
var isValidBST = function (root, minLimit = -Infinity, maxLimit = Infinity) {
    if (root === null) return true;
    if ((root.val <= minLimit) || root.val >= maxLimit) return false;
    return isValidBST(root.left, minLimit, root.val) && isValidBST(root.right, root.val, maxLimit);
};

// OR
// OR
// OR
/**
 * Definition for a binary tree node.
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {TreeNode} root
 * @return {boolean}
 */
var isValidBST____2 = function (root) {
    const isNodeValidBST = function (root, minLimit = -Infinity, maxLimit = Infinity) {
        if (root === null) return true;
        if ((root.val <= minLimit) || (root.val >= maxLimit)) return false;
        return isNodeValidBST(root.left, minLimit, root.val) && isNodeValidBST(root.right, root.val, maxLimit);
    }
    return isNodeValidBST(root);
};


// OR
// OR
// OR
/**
 * Definition for a binary tree node.
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {TreeNode} root
 * @return {boolean}
 */
var isValidBST = function (root) {
    return isNodeValidBST(root, null, null);
};

var isNodeValidBST = function (root, minLimit = null, maxLimit = null) {
    if (root === null) return true;
    if ((minLimit !== null && root.val <= minLimit) ||
        (maxLimit !== null && root.val >= maxLimit)
    ) return false;
    return isNodeValidBST(root.left, minLimit, root.val) && isNodeValidBST(root.right, root.val, maxLimit);
}