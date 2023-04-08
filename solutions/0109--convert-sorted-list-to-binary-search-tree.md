### 109. Convert Sorted List to Binary Search Tree

Difficulty: `Medium`

https://leetcode.com/problems/convert-sorted-list-to-binary-search-tree/

<p>Given the <code>head</code> of a singly linked list where elements are sorted in <strong>ascending order</strong>, convert <em>it to a </em><span data-keyword="height-balanced" class=" cursor-pointer relative text-dark-blue-s text-sm"><div class="popover-wrapper inline-block" data-headlessui-state=""><div><div id="headlessui-popover-button-:rm:" aria-expanded="false" data-headlessui-state=""><strong><em>height-balanced</em></strong></div></div></div></span> <em>binary search tree</em>.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/08/17/linked.jpg" style="width: 500px; height: 388px;">
<pre><strong>Input:</strong> head = [-10,-3,0,5,9]
<strong>Output:</strong> [0,-3,9,-10,null,5]
<strong>Explanation:</strong> One possible answer is [0,-3,9,-10,null,5], which represents the shown height balanced BST.
</pre>
<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> head = []
<strong>Output:</strong> []
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in <code>head</code> is in the range <code>[0, 2 * 10<sup>4</sup>]</code>.</li>
	<li><code>-10<sup>5</sup> &lt;= Node.val &lt;= 10<sup>5</sup></code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var sortedListToBST = function (head) {
    if (head == null) return null;
    if (head.next == null) return new TreeNode(head.val);
    let slowPointer = head, fastPointer = head;
    let splitPointer = null;
    while (fastPointer !== null && fastPointer.next !== null) {
        splitPointer = slowPointer;
        slowPointer = slowPointer.next;
        fastPointer = fastPointer.next.next
    }

    splitPointer.next = null;

    return new TreeNode(slowPointer.val, sortedListToBST(head), sortedListToBST(slowPointer.next));
    ;
};

--OR--

var sortedListToBST = function (head) {
    // Define a recursive function that constructs the binary search tree.
    const constructBST = (start, end) => {
        if (start > end) {
            return null;
        }
        const mid = Math.floor((start + end) / 2);
        const left = constructBST(start, mid - 1);
        const node = new TreeNode(head.val);
        node.left = left;
        head = head.next;
        node.right = constructBST(mid + 1, end);
        return node;
    };

    // Get the length of the linked list.
    let len = 0;
    let curr = head;
    while (curr !== null) {
        len++;
        curr = curr.next;
    }

    // Call the recursive function to construct the binary search tree.
    return constructBST(0, len - 1);
};
```

##### PHP

```php
class Solution
{
    /**
     * @param ListNode $head
     * @return TreeNode
     */
    function sortedListToBST($head)
    {
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
```
