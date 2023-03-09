<?php
// 142. Linked List Cycle II
// https://leetcode.com/problems/linked-list-cycle-ii/
// Medium
// Given the head of a linked list, return the node where the cycle begins. If there is no cycle, return null.
// There is a cycle in a linked list if there is some node in the list that can be reached again by continuously following the next pointer. Internally, pos is used to denote the index of the node that tail's next pointer is connected to (0-indexed). It is -1 if there is no cycle. Note that pos is not passed as a parameter.
// Do not modify the linked list.
//
//Example 1:
//Input: head = [3,2,0,-4], pos = 1
//Output: tail connects to node index 1
//Explanation: There is a cycle in the linked list, where tail connects to the second node.
//Example 2:
//Input: head = [1,2], pos = 0
//Output: tail connects to node index 0
//Explanation: There is a cycle in the linked list, where tail connects to the first node.
//Example 3:
//Input: head = [1], pos = -1
//Output: no cycle
//Explanation: There is no cycle in the linked list.
//
//Constraints:
//The number of the nodes in the list is in the range [0, 104].
//-105 <= Node.val <= 105
//pos is -1 or a valid index in the linked-list.
//Follow up: Can you solve it using O(1) (i.e. constant) memory?


/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution
{
    /**
     * @param ListNode $head
     * @return ListNode
     */
    function detectCycle($head)
    {
        $s = $head;
        $f = $head;
        while ($f != null && $f->next != null) {
            $s = $s->next;
            $f = $f->next->next;
            if ($s == $f) {
                $s = $head;
                while ($s != $f) {
                    $s = $s->next;
                    $f = $f->next;
                }
                return $s;
            }
        }
        return null;
    }

    function detectCycle1($head)
    {
        $fast = $head;
        $slow = $head;
        while ($fast && $fast->next) {
            $slow = $slow->next;
            $fast = $fast->next->next;
            if ($fast === $slow) {
                while ($head !== $slow) {
                    $head = $head->next;
                    $slow = $slow->next;
                }
                return $slow;
            }
        }
        return null;
    }
}


echo '<pre>';

$list1 = new LinkedList();
$list1->arrayToLinkedList([3, 2, 0, -4, 2]);
$list1->printList();

$run = new Solution();
$res = $run->detectCycle($list1->head);
var_export($res);

echo PHP_EOL . '---------' . PHP_EOL . '</pre>';


class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

class LinkedList
{
    public $head;

    public function __construct()
    {
        $this->head = null;
    }

    //Add element at the start of the list
    public function pushFront($newElement)
    {
        //1. allocate a new node
        $newNode = new ListNode();
        //2. assign data element
        $newNode->val = $newElement;
        //3. make next node of new node as head
        $newNode->next = $this->head;
        //4. make new node as head
        $this->head = $newNode;
    }

    public function pushBack($newElement)
    {
        //1. allocate node
        $newNode = new ListNode();
        //2. assign data element
        $newNode->val = $newElement;
        //3. assign null to the next of new node
        $newNode->next = null;
        //4. Check the Linked List is empty or not,
        //   if empty make the new node as head
        if ($this->head == null) {
            $this->head = $newNode;
        } else {
            //5. Else, traverse to the last node
//            $temp = new ListNode();
            $temp = $this->head;
            while ($temp->next != null) {
                $temp = $temp->next;
            }
            //6. Change the next of last node to new node
            $temp->next = $newNode;
        }
    }

    // array to linked list
    public function arrayToLinkedList($array)
    {
        $this->head = null;
        foreach ($array as $value) {
            $this->pushBack($value);
        }
    }

    //display the content of the list
    public function printList()
    {
        $temp = new ListNode();
        $temp = $this->head;
        if ($temp != null) {
            echo "The list contains: ";
            while ($temp != null) {
                echo $temp->val . " ";
                $temp = $temp->next;
            }
            echo "\n";
        } else {
            echo "The list is empty.\n";
        }
    }
}