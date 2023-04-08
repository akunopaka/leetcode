### 101. Symmetric Tree

Difficulty: `Easy`

https://leetcode.com/problems/symmetric-tree/

<p>Given the <code>root</code> of a binary tree, <em>check whether it is a mirror of itself</em> (i.e., symmetric around its center).</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/symtree1.jpg" style="width: 354px; height: 291px;">
<pre><strong>Input:</strong> root = [1,2,2,3,4,4,3]
<strong>Output:</strong> true
</pre>

<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/symtree2.jpg" style="width: 308px; height: 258px;">
<pre><strong>Input:</strong> root = [1,2,2,null,3,null,3]
<strong>Output:</strong> false
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li>The number of nodes in the tree is in the range <code>[1, 1000]</code>.</li>
	<li><code>-100 &lt;= Node.val &lt;= 100</code></li>
</ul>

<strong>Follow up:</strong> Could you solve it both recursively and iteratively?</div>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
// 1. Recursive Solution
var isSymmetric = function (root) {
    if (root == null) return true;
    return isMirror(root.left, root.right);

    function isMirror(leftNode, rightNode) {
        if (leftNode == null && rightNode == null) return true;
        if (leftNode == null || rightNode == null) return false;
        return leftNode.val === rightNode.val &&
            isMirror(leftNode.left, rightNode.right) &&
            isMirror(leftNode.right, rightNode.left);
    }

};

// -- OR --
// 2. Iterative Solution
var isSymmetric = function (root) {
    if (root == null) return true;
    let queue = [root.left, root.right];
    while (queue.length > 0) {
        let leftNode = queue.shift();
        let rightNode = queue.shift();
        if (leftNode == null && rightNode == null) continue;
        if (leftNode.val !== rightNode.val ||
            leftNode == null ||
            rightNode == null) {
            return false;
        }
        queue.push(leftNode.left, rightNode.right);
        queue.push(leftNode.right, rightNode.left);
    }
    return true;
}
```

##### PHP

```php
// Iterative Solution
class Solution
{
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetric(TreeNode $root): bool
    {
        if ($root === null) {
            return true;
        }
        $queue = [[$root->left, $root->right]];

        while ($queue) {
            $newQueue = [];
            foreach ($queue as [$leftNode, $rightNode]) {
                if ($leftNode === null && $rightNode === null) {
                    continue;
                }
                if ($leftNode->val !== $rightNode->val ||
                    $leftNode === null ||
                    $rightNode === null) {
                    return false;
                }
                $newQueue[] = [$leftNode->left, $rightNode->right];
                $newQueue[] = [$leftNode->right, $rightNode->left];
            }
            $queue = $newQueue;
        }

        return true;
    }
}

//-- OR --

// Recursive Solution
class Solution
{
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetric($root)
    {
        if ($root === null) {
            return true;
        }
        return $this->isNodesMirror($root->left, $root->right);
    }

    function isNodesMirror($leftNode, $rightNode)
    {
        if ($leftNode === null && $rightNode === null) {
            return true;
        }
        if ($leftNode === null || $rightNode === null) {
            return false;
        }
        return $leftNode->val === $rightNode->val &&
            $this->isNodesMirror($leftNode->left, $rightNode->right) &&
            $this->isNodesMirror($leftNode->right, $rightNode->left);
    }
}
```
