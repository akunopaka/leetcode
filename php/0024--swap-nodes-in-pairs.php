<?php
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
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution
{
    /**
     * @param ListNode $head
     * @return ListNode
     */
    function swapPairs(?ListNode $head): ?ListNode {
        $list = new ListNode();
        $list->next = $head;
        $current = $list;
        while ($current->next != null && $current->next->next != null) {
            $first = $current->next;
            $second = $current->next->next;
            $first->next = $second->next;
            $current->next = $second;
            $current->next->next = $first;
            $current = $current->next->next;
        }
        return $list->next;
    }
}