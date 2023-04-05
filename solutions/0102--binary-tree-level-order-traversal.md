### 102. Binary Tree Level Order Traversal

Difficulty: `Medium`

https://leetcode.com/problems/binary-tree-level-order-traversal/


<p>Given the <code>root</code> of a binary tree, return <em>the level order traversal of its nodes' values</em>. (i.e., from left to right, level by level).</p>

<p><strong class="example">Example 1:</strong></p>
<img src="https://assets.leetcode.com/uploads/2021/02/19/tree1.jpg" alt="" style="width: 277px; height: 302px;">
<pre><strong>Input:</strong> root = [3,9,20,null,null,15,7]
<strong>Output:</strong> [[3],[9,20],[15,7]]
</pre>

<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> root = [1]
<strong>Output:</strong> [[1]]
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> root = []
<strong>Output:</strong> []
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the tree is in the range <code>[0, 2000]</code>.</li>
	<li><code>-1000 &lt;= Node.val &lt;= 1000</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
/**
 * Definition for a binary tree node.
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {TreeNode} root
 * @return {number[][]}
 */

var levelOrder = function (root) {
    if (!root) return [];
    const res = [];
    const queue = [root];
    while (queue.length) {
        const levelSize = queue.length;
        const level = [];
        for (let i = 0; i < levelSize; i++) {
            const currentNode = queue.shift();
            level.push(currentNode.val);
            if (currentNode.left) queue.push(currentNode.left);
            if (currentNode.right) queue.push(currentNode.right);
        }
        res.push(level);
    }
    return res;
};

// -- OR --
var levelOrder = function (root) {
    let res = [];
    let level = 0;
    let stack = [root];
    if (root === null) return res;
    res = getOrders(root, level);
    return res;
};

var getOrders = function (node, level) {
    return node.val;
}
```

##### PHP

```php
class Solution
{
    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder(TreeNode $root): array {
        if (!$root) return [];
        $result = [];
        $queue = [$root];
        while ($queue) {
            $levelSize = count($queue);
            $level = [];
            for ($i = 0; $i < $levelSize; $i++) {
                $currentNode = array_shift($queue);
                $level[] = $currentNode->val;
                if ($currentNode->left) $queue[] = $currentNode->left;
                if ($currentNode->right) $queue[] = $currentNode->right;
            }
            $result[] = $level;
        }
        return $result;
    }
}
```

