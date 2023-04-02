// 21. Merge Two Sorted Lists
// https://leetcode.com/problems/merge-two-sorted-lists/
// Easy
// You are given the heads of two sorted linked lists list1 and list2.
// Merge the two lists in a one sorted list. The list should be made by splicing together the nodes of the first two lists.
// Return the head of the merged linked list.
//
// Example 1:
// Input: list1 = [1,2,4], list2 = [1,3,4]
// Output: [1,1,2,3,4,4]
// Example 2:
// Input: list1 = [], list2 = []
// Output: []
// Example 3:
// Input: list1 = [], list2 = [0]
// Output: [0]
//
// Constraints:
// The number of nodes in both lists is in the range [0, 50].
// -100 <= Node.val <= 100
// Both list1 and list2 are sorted in non-decreasing order.

/**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} list1
 * @param {ListNode} list2
 * @return {ListNode}
 */
var mergeTwoLists = function (list1, list2) {
    if (list1 === null && list2 === null) return null;
    if (list1 === null) return list2;
    if (list2 === null) return list1;
    if (list1.val < list2.val) {
        return new ListNode(list1.val, mergeTwoLists(list1.next, list2))
    } else {
        return new ListNode(list2.val, mergeTwoLists(list1, list2.next))
    }
};

var mergeTwoLists = function (l1, l2) {
    if (!l1) return l2;
    if (!l2) return l1;
    if (l1.val <= l2.val) {
        l1.next = mergeTwoLists(l1.next, l2);
        return l1;
    } else {
        l2.next = mergeTwoLists(l1, l2.next);
        return l2
    }
};
