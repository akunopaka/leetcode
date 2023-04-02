<?php
// 206. Reverse Linked List
// https://leetcode.com/problems/reverse-linked-list/
// Easy
// Given the head of a singly linked list, reverse the list, and return the reversed list.
//
// Example 1:
// Input: head = [1,2,3,4,5]
// Output: [5,4,3,2,1]
// Example 2:
// Input: head = [1,2]
// Output: [2,1]
// Example 3:
// Input: head = []
// Output: []
//
// Constraints:
// The number of nodes in the list is the range [0, 5000].
// -5000 <= Node.val <= 5000
// Follow up: A linked list can be reversed either iteratively or recursively. Could you implement both?

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

class Solution
{
    /**
     * @param ListNode $head
     * @return ListNode
     */

    function reverseList($head) {
        $resList = new ListNode($head->val, null);
        while ($head = $head->next) {
            $resList = new ListNode($head->val, $resList);
        }
        return $resList;
    }

    function reverseList___approach_2($head) {
        $resList = null;
        while ($head) {
            $newNode = new ListNode();
            $newNode->val = $head->val;
            $newNode->next = $resList;
            $resList = $newNode;
            $head = $head->next;
        }
        return $resList;
    }
}


echo '<pre>';

$list1 = new LinkedList();
$list1->arrayToLinkedList([1, 2, 2, 6, 8]);
$list2 = new LinkedList();
$list2->arrayToLinkedList([1, 3, 4]);
$list1->printList();
//$list2->printList();
$run = new Solution();
$res = $run->reverseList($list1->head);
printList($res);
print_r(PHP_EOL . '---------' . PHP_EOL);
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
    public function arrayToLinkedList($array) {
        $this->head = null;
        foreach ($array as $value) {
            $this->pushBack($value);
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

//// test the code
// test the code
$MyList = new LinkedList();

//Add three elements at the start of the list.
$MyList->pushFront(10);
$MyList->pushFront(20);
$MyList->pushBack(50);
$MyList->pushBack(60);
$MyList->pushFront(30);
$MyList->printList();
