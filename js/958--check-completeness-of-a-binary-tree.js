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
var isCompleteTree = function (root) {
    // Breadth-first search (BFS) - from left to right - if there is any nodes aftrer null -> means not  a complete binary tree == false
    let nullNodeFound = false;
    let queue = [root];
    while (queue.length > 0) {
        let node = queue.shift();
        if (node === null) {
            nullNodeFound = true;
            continue;
        }
        if (node.val && nullNodeFound === true) return false;
        queue.push(node.left);
        queue.push(node.right);
    }
    return true;
};