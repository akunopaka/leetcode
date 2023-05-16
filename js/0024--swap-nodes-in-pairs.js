//  24. Swap Nodes in Pairs
//  https://leetcode.com/problems/swap-nodes-in-pairs/
//  Medium
//  
//    Example 1:
//    Input: head = [1,2,3,4]
//    Output: [2,1,4,3]
//    Example 2:
//    Input: head = []
//    Output: []
//    Example 3:
//    Input: head = [1]
//    Output: [1]
//    Constraints:
//    The number of nodes in the&nbsp;list&nbsp;is in the range [0, 100].
//    0 &lt;= Node.val &lt;= 100

/**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 * @return {ListNode}
 */
var swapPairs = function (head) {
    let list = new ListNode(0);
    list.next = head;
    let current = list;
    while (current.next != null && current.next.next != null) {
        let first = current.next;
        let second = current.next.next;
        first.next = second.next;
        current.next = second;
        current.next.next = first;
        current = current.next.next;
    }
    return list.next;
};