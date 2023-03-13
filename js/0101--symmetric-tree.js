// 101. Symmetric Tree
// https://leetcode.com/problems/symmetric-tree/
// Easy
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

// 1. Recursive Solution
var isSymmetric = function (root) {
    if (root == null) return true;
    return isMirror(root.left, root.right);

    function isMirror(leftNode, rightNode) {
        if (leftNode == null && rightNode == null) return true;
        if (leftNode == null || rightNode == null) return false;
        return leftNode.val === rightNode.val &&
            isMirror(leftNode.left, rightNode.right) &&
            isMirror(leftNode.right, rightNode.left);
    }

};

// 2. Iterative Solution
var isSymmetric = function (root) {
    if (root == null) return true;
    let queue = [root.left, root.right];
    while (queue.length > 0) {
        let leftNode = queue.shift();
        let rightNode = queue.shift();
        if (leftNode == null && rightNode == null) continue;
        if (leftNode == null ||
            rightNode == null ||
            leftNode.val !== rightNode.val) {
            return false;
        }
        queue.push(leftNode.left, rightNode.right);
        queue.push(leftNode.right, rightNode.left);
    }
    return true;
}