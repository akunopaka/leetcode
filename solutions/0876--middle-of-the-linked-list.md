### 876. Middle of the Linked List

Easy

https://leetcode.com/problems/middle-of-the-linked-list/

<p>Given the <code>head</code> of a singly linked list, return <em>the middle node of the linked list</em>.</p>
<p>If there are two middle nodes, return <strong>the second middle</strong> node.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/07/23/lc-midlist1.jpg" style="width: 544px; height: 65px;">
<pre><strong>Input:</strong> head = [1,2,3,4,5]
<strong>Output:</strong> [3,4,5]
<strong>Explanation:</strong> The middle node of the list is node 3.
</pre>
<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/07/23/lc-midlist2.jpg" style="width: 664px; height: 65px;">
<pre><strong>Input:</strong> head = [1,2,3,4,5,6]
<strong>Output:</strong> [4,5,6]
<strong>Explanation:</strong> Since the list has two middle nodes with values 3 and 4, we return the second one.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the list is in the range <code>[1, 100]</code>.</li>
	<li><code>1 &lt;= Node.val &lt;= 100</code></li>
</ul>

### My Solution

##### JavaScript

```js
/**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 * @return {ListNode}
 */
var middleNode = function (head) {
    let center = head, fast = head;
    while (fast && fast.next) {
        center = center.next;
        fast = fast.next.next;
    }
    return center;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head)
    {
        $c = $head;
        $f = $head;
        while ($f && $f->next) {
            $c = $c->next;
            $f = ($f->next)->next;
        }
        return $c;
    }
    
      -- OR --

    function middleNode($head)
    {
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
```

