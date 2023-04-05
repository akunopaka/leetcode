### 235. Lowest Common Ancestor of a Binary Search Tree

Difficulty: `Medium`

https://leetcode.com/problems/lowest-common-ancestor-of-a-binary-search-tree/

My Solution on
LeetCode: https://leetcode.com/problems/lowest-common-ancestor-of-a-binary-search-tree/solutions/3384014/javascript-php-recursive-iterative-approaches/

<p>Given a binary search tree (BST), find the lowest common ancestor (LCA) node of two given nodes in the BST.</p>

<p>According to the <a href="https://en.wikipedia.org/wiki/Lowest_common_ancestor" target="_blank">definition of LCA on Wikipedia</a>: “The lowest common ancestor is defined between two nodes <code>p</code> and <code>q</code> as the lowest node in <code>T</code> that has both <code>p</code> and <code>q</code> as descendants (where we allow <strong>a node to be a descendant of itself</strong>).”</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2018/12/14/binarysearchtree_improved.png" style="width: 200px; height: 190px;">
<pre><strong>Input:</strong> root = [6,2,8,0,4,7,9,null,null,3,5], p = 2, q = 8
<strong>Output:</strong> 6
<strong>Explanation:</strong> The LCA of nodes 2 and 8 is 6.
</pre>

<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2018/12/14/binarysearchtree_improved.png" style="width: 200px; height: 190px;">
<pre><strong>Input:</strong> root = [6,2,8,0,4,7,9,null,null,3,5], p = 2, q = 4
<strong>Output:</strong> 2
<strong>Explanation:</strong> The LCA of nodes 2 and 4 is 2, since a node can be a descendant of itself according to the LCA definition.
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> root = [2,1], p = 2, q = 1
<strong>Output:</strong> 2
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the tree is in the range <code>[2, 10<sup>5</sup>]</code>.</li>
	<li><code>-10<sup>9</sup> &lt;= Node.val &lt;= 10<sup>9</sup></code></li>
	<li>All <code>Node.val</code> are <strong>unique</strong>.</li>
	<li><code>p != q</code></li>
	<li><code>p</code> and <code>q</code> will exist in the BST.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
// recursive approach
var lowestCommonAncestor = function (root, p, q) {
    // both p and q are in the left subtree
    if (root.val > p.val && root.val > q.val) {
        return lowestCommonAncestor(root.left, p, q);
    }
    // both p and q are in the right subtree
    if (root.val < p.val && root.val < q.val) {
        return lowestCommonAncestor(root.right, p, q);
    }

    return root;
};

// -- OR --
// iterative approach
var lowestCommonAncestor = function (root, p, q) {
    while (root !== null) {
        if (root.val > p.val && root.val > q.val) {
            root = root.left
        } else if (root.val < p.val && root.val < q.val) {
            root = root.right
        } else {
            return root;
        }
    }
    return null
};
```

##### PHP

```php
// iterative approach
class Solution
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q): ?TreeNode {
        while ($root) {
            if ($root->val > $p->val && $root->val > $q->val) {
                $root = $root->left;
            } elseif ($root->val < $p->val && $root->val < $q->val) {
                $root = $root->right;
            } else {
                return $root;
            }
        }
        return null;
    }
}

// recursive approach
class Solution {
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q): ?TreeNode {
        if ($root->val > $p->val && $root->val > $q->val) {
            return $this->lowestCommonAncestor($root->left, $p, $q);
        }
        if ($root->val < $p->val && $root->val < $q->val) {
            return $this->lowestCommonAncestor($root->right, $p, $q);
        }
        return $root;
    }
}
//-- OR --
class Solution
{
    function lowestCommonAncestor($root, $p, $q) {
        if ($root == null || $root->val == $p->val || $root->val == $q->val) {
            return $root;
        }
        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        $right = $this->lowestCommonAncestor($root->right, $p, $q);
        if ($left && $right) {
            return $root;
        }
        return $left ? $left : $right;
    }
}
```
