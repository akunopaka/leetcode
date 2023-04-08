// 109. Convert Sorted List to Binary Search Tree
// https://leetcode.com/problems/convert-sorted-list-to-binary-search-tree/
// Medium
//
// Given the head of a singly linked list where elements are sorted in ascending order, convert it to a
// height-balanced binary search tree.
//
// Example 1:
// Input: head = [-10,-3,0,5,9]
// Output: [0,-3,9,-10,null,5]
// Explanation: One possible answer is [0,-3,9,-10,null,5], which represents the shown height balanced BST.
// Example 2:
// Input: head = []
// Output: []
//
//
// Constraints:
// The number of nodes in head is in the range [0, 2 * 104].
// -105 <= Node.val <= 105

var sortedListToBST = function (head) {
    if (head == null) return null;
    if (head.next == null) return new TreeNode(head.val);
    let slowPointer = head, fastPointer = head;
    let splitPointer = null;
    while (fastPointer !== null && fastPointer.next !== null) {
        splitPointer = slowPointer;
        slowPointer = slowPointer.next;
        fastPointer = fastPointer.next.next
    }

    splitPointer.next = null;

    return new TreeNode(slowPointer.val, sortedListToBST(head), sortedListToBST(slowPointer.next));
    ;
};