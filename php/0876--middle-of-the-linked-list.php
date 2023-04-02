<?php
// 876. Middle of the Linked List
// https://leetcode.com/problems/middle-of-the-linked-list/
// Easy
//    Given the head of a singly linked list, return the middle node of the linked list.
//    If there are two middle nodes, return the second middle node.
//
//    Example 1:
//    Input: head = [1,2,3,4,5]
//    Output: [3,4,5]
//    Explanation: The middle node of the list is node 3.
//    Example 2:
//    Input: head = [1,2,3,4,5,6]
//    Output: [4,5,6]
//    Explanation: Since the list has two middle nodes with values 3 and 4, we return the second one.
//
//    Constraints:
//    The number of nodes in the list is in the range [1, 100].
//    1 <= Node.val <= 100

class Solution
{
    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head) {
        $c = $head;
        $f = $head;
        while ($f && $f->next) {
            $c = $c->next;
            $f = ($f->next)->next;
        }
        return $c;
    }

    function middleNode___2($head) {
        $temp = $head;
        $count = 0;
        while ($head) {
            $count++;
            $head = $head->next;
        }
        $halfID = floor($count / 2);
        while ($halfID != 0) {
            $halfID--;
            $temp = $temp->next;
        }
        return $temp;
    }
}


$list1 = new LinkedList();
$list1->arrayToLinkedList([3, 2, 0, -4, 7]);
//$list1->printList();

$list2 = new LinkedList();
$list2->arrayToLinkedList([7, 4, 3, 2, 0, -4]);
//$list2->printList();


echo '<pre>';
$run = new Solution();
$res = $run->middleNode($list2->head);
$list2->printList();
var_export($res);
echo PHP_EOL . '---------' . PHP_EOL . '</pre>';


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

/**
 * Definition for a singly-linked list.
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
//            $temp = new ListNode();
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
//// test the code
//$MyList = new LinkedList();
////Add three elements at the start of the list.
//$MyList->pushFront(10);
//$MyList->pushFront(20);
//$MyList->pushBack(50);
//$MyList->pushBack(60);
//$MyList->pushFront(30);
//$MyList->printList();
