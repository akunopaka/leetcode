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
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */

// This solution uses a Depth-First Search (DFS) approach to traverse the binary tree and calculate the sum of all root-to-leaf path numbers. The DFS function takes in a node and the sum of the existing path up to the node. If the node is null, then it returns 0. If the node is a leaf node, it returns the total sum of the path from the root to the leaf node. If the node has children, then it calls the same DFS function on both of the children, passing in the sum of the existing path up to that node. The sum of all the DFS calls is then returned.
// Time Complexity: O(n) as we have to traverse each node in the binary tree once.
// Space Complexity: O(n) as the maximum depth of the recursive stack can be n for a binary tree with n nodes.
/**
 * @param {TreeNode} root
 * @return {number}
 */
var sumNumbers = function (root) {
    const dfs = function (node, sum) {
        if (node == null) {
            return 0;
        }
        if (node.left === null && node.right == null) {
            return sum * 10 + node.val;
        }
        return dfs(node.left, sum * 10 + node.val) +
            dfs(node.right, sum * 10 + node.val)
    }
    return dfs(root, 0);
}


// The approach used in this solution is to traverse the tree using a breadth-first search, and for each node add the values of its children to the sum of its own value. We also use a queue to keep track of the nodes that need to be visited. We start with the root node, and for each node check if it is a leaf node (if it has no children). If it is, add the value of the node to the total sum. If it is not a leaf node, add its children to the queue, and add the node value to the children's values. When the queue is empty, all the nodes have been visited and the sum is returned.
// Time complexity: O(n), as we visit every node in the tree once.
// Space complexity: O(n), as we use a queue to store up to n nodes at any given time.
var sumNumbers = function (root) {
    let totalSum = 0;
    if (root === null || root.val === undefined) return 0;
    if (root.left === undefined && root.right === undefined) return root.val;
    let queue = [root];

    while (queue.length > 0) {
        node = queue.shift();
        if (node.left === null && node.right == null) {
            totalSum += parseInt(node.val);
        }
        if (node.left && node.left.val !== undefined) {
            node.left.val = node.val + "" + node.left.val;
            queue.push(node.left);
        }
        if (node.right && node.right.val !== undefined) {
            node.right.val = node.val + "" + node.right.val;
            queue.push(node.right);
        }
    }
    return totalSum;
};