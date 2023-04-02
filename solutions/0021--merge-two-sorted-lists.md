### 21. Merge Two Sorted Lists

Easy\
https://leetcode.com/problems/merge-two-sorted-lists/
<p>You are given the heads of two sorted linked lists <code>list1</code> and <code>list2</code>.</p>
<p>Merge the two lists in a one <strong>sorted</strong> list. The list should be made by splicing together the nodes of the first two lists.</p>
<p>Return <em>the head of the merged linked list</em>.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/10/03/merge_ex1.jpg" style="width: 662px; height: 302px;">
<pre><strong>Input:</strong> list1 = [1,2,4], list2 = [1,3,4]
<strong>Output:</strong> [1,1,2,3,4,4]
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> list1 = [], list2 = []
<strong>Output:</strong> []
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> list1 = [], list2 = [0]
<strong>Output:</strong> [0]
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in both lists is in the range <code>[0, 50]</code>.</li>
	<li><code>-100 &lt;= Node.val &lt;= 100</code></li>
	<li>Both <code>list1</code> and <code>list2</code> are sorted in <strong>non-decreasing</strong> order.</li>
</ul>

##### JavaScript

```js
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

```

##### PHP

```php
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
```
