<?php
// 23. Merge k Sorted Lists
// https://leetcode.com/problems/merge-k-sorted-lists/
// Hard
// You are given an array of k linked-lists lists, each linked-list is sorted in ascending order.
// Merge all the linked-lists into one sorted linked-list and return it.
//
// Example 1:
// Input: lists = [[1,4,5],[1,3,4],[2,6]]
// Output: [1,1,2,3,4,4,5,6]
// Explanation: The linked-lists are:
//[ 1->4->5,
//  1->3->4,
//  2->6
//]
//merging them into one sorted list:
//1->1->2->3->4->4->5->6
//Example 2:
//Input: lists = []
//Output: []
//Example 3:
//Input: lists = [[]]
//Output: []
//Constraints:
//k == lists.length
//0 <= k <= 104
//0 <= lists[i].length <= 500
//-104 <= lists[i][j] <= 104
//lists[i] is sorted in ascending order.
//The sum of lists[i].length will not exceed 104.

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


// SOLITION 1
// Get all values from all lists to one array
// Sort array
// Create new list from sorted array :)
class Solution__ArraySolution
{
    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    function mergeKLists($lists)
    {
        $result = [];
        foreach ($lists as $list) {
            $cur = $list;
            while ($cur !== null) {
                $result[] = $cur->val;
                $cur = $cur->next;
            }
        }
        rsort($result);
        $res = null;
        foreach ($result as $v) {
            $res = new ListNode($v, $res);
        }
        return $res;
    }
}


// SOLUTION 2
// HEAP SOLUTION
class Solution___HEAPSolution
{
    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    function mergeKLists(ListNode $lists): ?ListNode
    {
        // check if lists is empty
        if (count($lists) == 0) {
            return null;
        }
        // check if lists has only one element
        if (count($lists) == 1) {
            return $lists[0];
        }

        $heap = new SplMinHeap();
        foreach ($lists as $list) {
            if ($list) {
                $heap->insert([$list->val, $list]);
            }
        }

        $headResultList = new ListNode();
        $resultList = $headResultList;
        while (!$heap->isEmpty()) {
            $minElementFromHeap = $heap->extract();
            $resultList->next = new ListNode($minElementFromHeap[0]);
            $resultList = $resultList->next;
            $minElementFromHeap[1] = $minElementFromHeap[1]->next;
            if ($minElementFromHeap[1]) {
                $heap->insert([$minElementFromHeap[1]->val, $minElementFromHeap[1]]);
            }
        }
        return $headResultList->next;
    }
}


// SOLUTION 3
// Loop through all lists, compare value of each list, get the smallest value add to new list
class Solution___LinkedListSolution
{
    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    function mergeKLists($lists)
    {
        // check if lists is empty
        if (count($lists) == 0) {
            return null;
        }
        // check if lists has only one element
        if (count($lists) == 1) {
            return $lists[0];
        }
        // foreach list in lists, compare value of list, get the smallest value add to new list
        while (count($lists) > 0) {
            $minValue = PHP_INT_MAX;
            $tmpList = null;
            $tmpKey = null;
            foreach ($lists as $keyList => $list) {
                if ($list == null || !isset($list->val)) {
                    unset($lists[$keyList]);
                    continue;
                }
                if ($list->val < $minValue) {
                    $minValue = $list->val;
                    $tmpList = $list;
                    $tmpKey = $keyList;
                }
            }

            if ($tmpList != null) {
                if (!isset($resultList)) {
                    $resultList = new ListNode();
                    $headResultList = $resultList;
                }
                $resultList->val = $minValue;
                $resultList->next = null;
                if ($tmpList->next == null) {
                    unset($lists[$tmpKey]);
                } else {
                    $lists[$tmpKey] = $tmpList->next;
                }
            }
            if (count($lists) > 0) {
                $resultList->next = new ListNode();
                $resultList = $resultList->next;
            }
        }
        return $headResultList ?? [];
    }
}


//class Solution {
//
//    function mergeTwoLists($list1, $list2) {
//        $result = null;
//        $merged = null;
//        while ($list1 !== null || $list2 !== null) {
//            if ($list2 === null || ($list1 !== null && $list1->val < $list2->val)) {
//                if (null !== $merged) $merged->next = $list1;
//                else $result = $list1;
//                $merged = $list1;
//                $list1 = $list1->next;
//            } else {
//                if (null !== $merged) $merged->next = $list2;
//                else $result = $list2;
//                $merged = $list2;
//                $list2 = $list2->next;
//            }
//        }
//        return $result;
//    }
//
//
//    /**
//     * @param ListNode[] $lists
//     * @return ListNode
//     */
//    function mergeKLists($lists) {
//        if (count($lists) == 1) return $lists[0];
//        while (count($lists)>1) {
//            $results = [];
//            for ($i=0; $i<count($lists)-1; $i+=2) {
//                //echo "merging $i and ".($i+1)."\n";
//                $results[] = $this->mergeTwoLists($lists[$i], $lists[$i+1]);
//            }
//            echo "i = $i, count lists = ".count($lists)."\n";
//            if ($i < count($lists)) {
//                //echo "adding odd ".$i."\n";
//                $results[] = $lists[$i];
//            }
//            $lists = $results;
//        }
//        return $results[0];
//    }
//}

$list1 = new LinkedList();
$list1->arrayToLinkedList([1, 4, 5]);
$list2 = new LinkedList();
$list2->arrayToLinkedList([1, 3, 4]);
$list3 = new LinkedList();
$list3->arrayToLinkedList([2, 6]);

$list4 = new LinkedList();
$list4->arrayToLinkedList([0]);
$list5 = new LinkedList();
$list5->arrayToLinkedList([1]);
// Test Cases
$cases = [];
//$cases[0]['Input']['lists'] = [$list1->head, $list2->head, $list3->head];
//$cases[0]['expectedOutput'] = '';
//$cases[1]['Input']['lists'] = [[], []];
//$cases[1]['expectedOutput'] = [];
$cases[2]['Input']['lists'] = [$list4->head, $list5->head];
$cases[2]['expectedOutput'] = '2';
// $cases[3]['Input']['lists'] = '';
// $cases[3]['Input'][''] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['lists'] = '';
// $cases[4]['Input'][''] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->mergeKLists($case['Input']['lists']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void
{
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}

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

