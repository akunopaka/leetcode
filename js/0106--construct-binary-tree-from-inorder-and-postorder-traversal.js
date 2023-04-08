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
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {number[]} inorder
 * @param {number[]} postorder
 * @return {TreeNode}
 */
var buildTree = function (inorder, postorder) {
    if (!inorder.length || !postorder.length) return null;
    let root = new TreeNode(postorder.pop());
    let rootIndex = inorder.indexOf(root.val);
    root.right = buildTree(inorder.slice(rootIndex + 1), postorder);
    root.left = buildTree(inorder.slice(0, rootIndex), postorder);
    return root;
};


const buildTree = (inorder, postorder) => {
    const build = (inStart, inEnd, postStart, postEnd) => {
        if (inStart > inEnd) {
            return null;
        }
        const rootVal = postorder[postEnd];
        const rootIndex = inorder.indexOf(rootVal);
        const leftSize = rootIndex - inStart;
        const left = build(inStart, rootIndex - 1, postStart, postStart + leftSize - 1);
        const right = build(rootIndex + 1, inEnd, postStart + leftSize, postEnd - 1);
        return new TreeNode(rootVal, left, right);
    };

    return build(0, inorder.length - 1, 0, postorder.length - 1);
};