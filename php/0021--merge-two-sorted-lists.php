<?php
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
class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null) {
        $this->val = $val;
        $this->next = $next;
    }
}

// 9ms
class Solution1
{
    /**
     * @param ListNode $list1
     * @param ListNode $list2
     * @return ListNode
     */
    function mergeTwoLists($list1, $list2) {
        $current = $head = new ListNode();
        while ($list1 != null && $list2 != null) {
            if ($list1->val < $list2->val) {
                $current->next = $list1;
                $list1 = $list1->next;
            } else {
                $current->next = $list2;
                $list2 = $list2->next;
            }
            $current = $current->next;
        }
        if ($list1 != null) {
            $current->next = $list1;
        }
        if ($list2 != null) {
            $current->next = $list2;
        }
        return $head->next;
    }
}

class Solution
{
    /**
     * @param ListNode $list1
     * @param ListNode $list2
     * @return ListNode
     */
    function mergeTwoLists($list1, $list2) {
        $head = new ListNode();
        return $head->next = $this->getNextNode($list1, $list2);
    }

    function getNextNode($list1, $list2) {
        if ($list1 == null) {
            return $list2;
        }
        if ($list2 == null) {
            return $list1;
        }
        if ($list1->val < $list2->val) {
            $list1->next = $this->getNextNode($list1->next, $list2);
            return $list1;
        } else {
            $list2->next = $this->getNextNode($list1, $list2->next);
            return $list2;
        }
    }
}


echo '<pre>';
$list1 = new LinkedList();
$list1->arrayToLinkedList([1, 2, 4]);
$list2 = new LinkedList();
$list2->arrayToLinkedList([1, 3, 4]);
$list1->printList();
$list2->printList();

$run = new Solution();
$res = $run->mergeTwoLists($list1->head, $list2->head);
printList($res);

print_r(PHP_EOL . '---------' . PHP_EOL);

$list1 = new LinkedList();
$list1->arrayToLinkedList([1, 2, 4]);
$list2 = new LinkedList();
$list2->arrayToLinkedList([1, 3, 4]);
$list1->printList();
$list2->printList();
$run = new Solution1();
$res1 = $run->mergeTwoLists($list1->head, $list2->head);

printList($res1);
$values = [];

echo '</pre>';
function printList($res) {
    $temp = $res;
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

class LinkedList
{
    public $head;

    public function __construct() {
        $this->head = null;
    }

    //Add element at the start of the list
    public function pushFront($newElement) {
        //1. allocate a new node
        $newNode = new ListNode();
        //2. assign data element
        $newNode->val = $newElement;
        //3. make next node of new node as head
        $newNode->next = $this->head;
        //4. make new node as head
        $this->head = $newNode;
    }

    public function arrayToLinkedList($array) {
        $this->head = null;
        foreach ($array as $value) {
            $this->pushBack($value);
        }
    }


    // array to linked list
    public function pushBack($newElement) {
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
//          $temp = new ListNode();
            $temp = $this->head;
            while ($temp->next != null) {
                $temp = $temp->next;
            }
            //6. Change the next of last node to new node
            $temp->next = $newNode;
        }
    }

    //display the content of the list
    public function printList() {
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

// test the code
$MyList = new LinkedList();
//Add three elements at the start of the list.
$MyList->pushFront(10);
$MyList->pushFront(20);
$MyList->pushBack(50);
$MyList->pushBack(60);
$MyList->pushFront(30);
$MyList->printList();
