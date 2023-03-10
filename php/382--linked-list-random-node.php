<?php
// 382. Linked List Random Node
// https://leetcode.com/problems/linked-list-random-node/
// Medium
//Given a singly linked list, return a random node's value from the linked list. Each node must have the same probability of being chosen.
//Implement the Solution class:
//Solution(ListNode head) Initializes the object with the head of the singly-linked list head.
//int getRandom() Chooses a node randomly from the list and returns its value. All the nodes of the list should be equally likely to be chosen.
//
//Example 1:
//Input
//["Solution", "getRandom", "getRandom", "getRandom", "getRandom", "getRandom"]
//[[[1, 2, 3]], [], [], [], [], []]
//Output
//[null, 1, 3, 2, 2, 3]
//Explanation
//Solution solution = new Solution([1, 2, 3]);
//solution.getRandom(); // return 1
//solution.getRandom(); // return 3
//solution.getRandom(); // return 2
//solution.getRandom(); // return 2
//solution.getRandom(); // return 3
//// getRandom() should return either 1, 2, or 3 randomly. Each element should have equal probability of returning.
//
//Constraints:
//The number of nodes in the linked list will be in the range [1, 104].
//-104 <= Node.val <= 104
//At most 104 calls will be made to getRandom.
//Follow up:
//What if the linked list is extremely large and its length is unknown to you?
//Could you solve this efficiently without using extra space?


// SOLUTION #1/3 - reservoir sampling
// R Algorithm, O(n) time, O(1) space,
class Solution
{
    private $head;

    /**
     * @param ListNode $head
     */
    function __construct(ListNode $head)
    {
        $this->head = $head;
    }

    /**
     * @return Integer
     */
    function getRandom(): int
    {
        $i = $val = 0;
        $node = $this->head;
        while ($node) {
            // R Algorithm
            if (rand(1, ++$i) == $i) $val = $node->val;
            $node = $node->next;
        }
        return $val;
    }
}

/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($head);
 * $ret_1 = $obj->getRandom();
 */


// Solution #2/3 -- Count the nodes, get random number, traverse the list and return the node at random number position
// Solution #2/3
// Solution #2/3

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
class Solution___2
{
    /**
     * @param ListNode $head
     */
    function __construct(ListNode $head)
    {
        $this->head = $head;
    }

    /**
     * @return Integer
     */
    function getRandom(): int
    {
        $node = $this->head;

        // Get count of nodes
        $countNodes = 0;
        while ($node != null) {
            $countNodes++;
            $node = $node->next;
        }

        // Generate a random number between 0 and n-1
        $rand = rand(0, $countNodes - 1);

        // Traverse the linked list and return the node at random number position
        $node = $this->head;
        while ($rand > 0) {
            $node = $node->next;
            $rand--;
        }
        return $node->val;
    }
}

/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($head);
 * $ret_1 = $obj->getRandom();
 */


// Solution #3/3 -- make array from ListNode and get random element from there

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
class Solution__3
{
    private array $storage;

    /**
     * @param ListNode $head
     */
    function __construct(ListNode $head)
    {
        while ($head) {
            $this->storage[] = $head->val;
            $head = $head->next;
        }
    }

    /**
     * @return Integer
     */
    function getRandom(): int
    {
        return $this->storage[array_rand($this->storage)];
    }
}

/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($head);
 * $ret_1 = $obj->getRandom();
 */
