### 206. Reverse Linked List

Easy

https://leetcode.com/problems/reverse-linked-list/

<p>Given the <code>head</code> of a singly linked list, reverse the list, and return <em>the reversed list</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/rev1ex1.jpg" style="width: 542px; height: 222px;">
<pre><strong>Input:</strong> head = [1,2,3,4,5]
<strong>Output:</strong> [5,4,3,2,1]
</pre>
<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/rev1ex2.jpg" style="width: 182px; height: 222px;">
<pre><strong>Input:</strong> head = [1,2]
<strong>Output:</strong> [2,1]
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> head = []
<strong>Output:</strong> []
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the list is the range <code>[0, 5000]</code>.</li>
	<li><code>-5000 &lt;= Node.val &lt;= 5000</code></li>
</ul>
<p><strong>Follow up:</strong> A linked list can be reversed either iteratively or recursively. Could you implement both?</p>

### My Solution

##### JavaScript

```js
var reverseList = function (head) {
    if (!head) return null;
    let revList = null;
    do {
        revList = new ListNode(head.val, revList);
    }
    while (head = head.next)
    return revList;
};
```

##### PHP

```php
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
```

