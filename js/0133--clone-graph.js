// 133. Clone Graph
// https://leetcode.com/problems/clone-graph/
// Medium
//
//    My Solution on LeetCode:
//    https://leetcode.com/discuss/topic/3392084/javascriptphp-bfs-dfs-approaches/
//
// Given a reference of a node in a connected undirected graph.
// Return a deep copy (clone) of the graph.
// Each node in the graph contains a value (int) and a list (List[Node]) of its neighbors.
//
// class Node {
//     public int val;
//     public List<Node> neighbors;
// }
//
// Test case format:
// For simplicity, each node's value is the same as the node's index (1-indexed). For example, the first node with val == 1, the second node with val == 2, and so on. The graph is represented in the test case using an adjacency list.
// An adjacency list is a collection of unordered lists used to represent a finite graph. Each list describes the set of neighbors of a node in the graph.
// The given node will always be the first node with val = 1. You must return the copy of the given node as a reference to the cloned graph.
//
// Example 1:
// Input: adjList = [[2,4],[1,3],[2,4],[1,3]]
// Output: [[2,4],[1,3],[2,4],[1,3]]
// Explanation: There are 4 nodes in the graph.
// 1st node (val = 1)'s neighbors are 2nd node (val = 2) and 4th node (val = 4).
// 2nd node (val = 2)'s neighbors are 1st node (val = 1) and 3rd node (val = 3).
// 3rd node (val = 3)'s neighbors are 2nd node (val = 2) and 4th node (val = 4).
// 4th node (val = 4)'s neighbors are 1st node (val = 1) and 3rd node (val = 3).
// Example 2:
// Input: adjList = [[]]
// Output: [[]]
// Explanation: Note that the input contains one empty list. The graph consists of only one node with val = 1 and it does not have any neighbors.
// Example 3:
// Input: adjList = []
// Output: []
// Explanation: This an empty graph, it does not have any nodes.
//
// Constraints:
// The number of nodes in the graph is in the range [0, 100].
// 1 <= Node.val <= 100
// Node.val is unique for each node.
// There are no repeated edges and no self-loops in the graph.
// The Graph is connected and all nodes can be visited starting from the given node.

/**
 * // Definition for a Node.
 * function Node(val, neighbors) {
 *    this.val = val === undefined ? 0 : val;
 *    this.neighbors = neighbors === undefined ? [] : neighbors;
 * };
 */

/**
 * @param {Node} node
 * @return {Node}
 */

// DFS approach
var cloneGraph_____DFS = function (node) {
    // DFS approach
    // 1. create a new node
    // 2. add the new node to the visited map
    // 3. for each neighbor of the node
    // 4.    if the neighbor is not in the visited map
    // 5.        create a new node
    // 6.        add the new node to the visited map
    // 7.    add the new node to the neighbors of the new node
    if (!node) return null;

    let dfs = (node, visited) => {
        if (visited.has(node)) return visited.get(node);
        let newNode = new Node(node.val);
        visited.set(node, newNode);
        for (let neighbor of node.neighbors) {
            newNode.neighbors.push(dfs(neighbor, visited));
        }
        return newNode;
    }
    return dfs(node, new Map());
}

// BFS approach
var cloneGraph_________BFS = function (node) {
    // BFS approach
    // 1. create a new node
    // 2. add the new node to the queue
    // 3. add the new node to the visited map
    // 4. while the queue is not empty
    // 5.    get the first node from the queue
    // 6.    for each neighbor of the node
    // 7.        if the neighbor is not in the visited map
    // 8.            create a new node
    // 9.            add the new node to the queue
    // 10.           add the new node to the visited map
    // 11.       add the new node to the neighbors of the new node
    if (!node) return null;

    let newNode = new Node(node.val);
    let queue = [node];
    let visited = new Map();
    visited.set(node, newNode);

    while (queue.length > 0) {
        let currentNode = queue.shift();
        for (let neighbor of currentNode.neighbors) {
            if (!visited.has(neighbor)) {
                let newNeighbor = new Node(neighbor.val);
                queue.push(neighbor);
                visited.set(neighbor, newNeighbor);
            }
            visited.get(currentNode).neighbors.push(visited.get(neighbor));
        }
    }
    return newNode;
};