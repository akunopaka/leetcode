### 24. Swap Nodes in Pairs

Difficulty: `Medium`

https://leetcode.com/problems/swap-nodes-in-pairs/


<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/10/03/swap_ex1.jpg" style="width: 422px; height: 222px;">
<pre><strong>Input:</strong> head = [1,2,3,4]
    <strong>Output:</strong> [2,1,4,3]
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> head = []
    <strong>Output:</strong> []
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> head = [1]
    <strong>Output:</strong> [1]
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the&nbsp;list&nbsp;is in the range <code>[0, 100]</code>.</li>
	<li><code>0 &lt;= Node.val &lt;= 100</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var swapPairs = function (head) {
    let list = new ListNode(0);
    list.next = head;
    let current = list;
    while (current.next != null && current.next.next != null) {
        let first = current.next;
        let second = current.next.next;
        first.next = second.next;
        current.next = second;
        current.next.next = first;
        current = current.next.next;
    }
    return list.next;
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
    function swapPairs(?ListNode $head): ?ListNode {
        $list = new ListNode();
        $list->next = $head;
        $current = $list;
        while ($current->next != null && $current->next->next != null) {
            $first = $current->next;
            $second = $current->next->next;
            $first->next = $second->next;
            $current->next = $second;
            $current->next->next = $first;
            $current = $current->next->next;
        }
        return $list->next;
    }
}
```

