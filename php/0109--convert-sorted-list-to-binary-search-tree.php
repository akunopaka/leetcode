<?php
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


class Solution
{
    /**
     * @param ListNode $head
     * @return TreeNode
     */
    function sortedListToBST($head) {
        if ($head == null) {
            return null;
        }
        if ($head->next === null) {
            return new TreeNode($head->val);
        }

        $slowPointer = $head;
        $fastPointer = $head;
        $splitPointer = null;

        while ($fastPointer != null && $fastPointer->next != null) {
            $splitPointer = $slowPointer;
            $slowPointer = $slowPointer->next;
            $fastPointer = $fastPointer->next->next;
        }

        // split the list
        $splitPointer->next = null;

        $left = $this->sortedListToBST($head);
        $right = $this->sortedListToBST($slowPointer->next);

        return new TreeNode($slowPointer->val, $left, $right);
    }
}

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($val = 0, $left = null, $right = null) {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}


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


class LinkedList
{
    public $head;

    public function __construct($head = null) {
        $this->head = $head;
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


echo '<pre>';
$list1 = new LinkedList();
$list1->arrayToLinkedList([-25, -19, -9, -4, 1, 4, 9, 12, 13, 14, 19]);
$list1->printList();


// Test Cases
$cases = [];
$cases[0]['Input']['list'] = $list1->head;
$cases[0]['expectedOutput'] = '';
$cases[1]['Input']['list'] = '';
$cases[1]['expectedOutput'] = '';
// $cases[2]['Input']['list'] = '';
// $cases[2]['Input']['ok'] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['list'] = '';
// $cases[3]['Input']['ok'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['list'] = '';
// $cases[4]['Input']['ok'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->sortedListToBST($case['Input']['list']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}

//// test the code
//$myLinkdedList = new LinkedList();
//
////Add three elements at the start of the list.
//$myLinkdedList->pushFront(10);
//$myLinkdedList->pushFront(20);
//$myLinkdedList->pushBack(50);
//$myLinkdedList->pushBack(60);
//$myLinkdedList->pushFront(30);
//$myLinkdedList->printList();