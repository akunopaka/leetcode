### 1372. Longest ZigZag Path in a Binary Tree

Difficulty: `Medium`

https://leetcode.com/problems/longest-zigzag-path-in-a-binary-tree/



<p>You are given the <code>root</code> of a binary tree.</p>
<p>A ZigZag path for a binary tree is defined as follow:</p>
<ul>
	<li>Choose <strong>any </strong>node in the binary tree and a direction (right or left).</li>
	<li>If the current direction is right, move to the right child of the current node; otherwise, move to the left child.</li>
	<li>Change the direction from right to left or from left to right.</li>
	<li>Repeat the second and third steps until you can't move in the tree.</li>
</ul>
<p>Zigzag length is defined as the number of nodes visited - 1. (A single node has a length of 0).</p>
<p>Return <em>the longest <strong>ZigZag</strong> path contained in that tree</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/01/22/sample_1_1702.png" style="width: 221px; height: 383px;">
<pre><strong>Input:</strong> root = [1,null,1,1,1,null,null,1,1,null,1,null,null,null,1,null,1]
    <strong>Output:</strong> 3
<strong>Explanation:</strong> Longest ZigZag path in blue nodes (right -&gt; left -&gt; right).
</pre>
<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/01/22/sample_2_1702.png" style="width: 157px; height: 329px;">
<pre><strong>Input:</strong> root = [1,1,1,null,1,null,null,1,1,null,1]
    <strong>Output:</strong> 4
<strong>Explanation:</strong> Longest ZigZag path in blue nodes (left -&gt; right -&gt; left -&gt; right).
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> root = [1]
    <strong>Output:</strong> 0
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the tree is in the range <code>[1, 5 * 10<sup>4</sup>]</code>.</li>
	<li><code>1 &lt;= Node.val &lt;= 100</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var longestZigZag = function (root) {
    let max = 0;
    const dfs = (node, dir, count) => {
        if (!node) {
            max = Math.max(max, count - 1);
            return;
        }
        if (dir === 'left') {
            dfs(node.left, 'left', 1);
            dfs(node.right, 'right', count + 1);
        } else {
            dfs(node.left, 'left', count + 1);
            dfs(node.right, 'right', 1);
        }
    }
    dfs(root.left, 'left', 1);
    dfs(root.right, 'right', 1);
    return max;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function longestZigZag($root) {
        $left = $this->dfs($root->left, 'left', 0);
        $right = $this->dfs($root->right, 'right', 0);
        return max($left, $right);
    }

    function dfs($node, $direction, $length) {
        if ($node == null) return $length;
        $length++;
        if ($direction == 'left') {
            $left = $this->dfs($node->left, 'left', 0);
            $right = $this->dfs($node->right, 'right', $length);
            return max($left, $right);
        } else {
            $left = $this->dfs($node->left, 'left', $length);
            $right = $this->dfs($node->right, 'right', 0);
            return max($left, $right);
        }
    }
}
```
