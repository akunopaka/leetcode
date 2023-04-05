### 98. Validate Binary Search Tree

Difficulty: `Medium`

https://leetcode.com/problems/validate-binary-search-tree/

<p>Given the <code>root</code> of a binary tree, <em>determine if it is a valid binary search tree (BST)</em>.</p>
<p>A <strong>valid BST</strong> is defined as follows:</p>
<ul>
	<li>The left <span data-keyword="subtree" class=" cursor-pointer relative text-dark-blue-s text-sm"><div class="popover-wrapper inline-block" data-headlessui-state=""><div><div id="headlessui-popover-button-:r43:" aria-expanded="false" data-headlessui-state="">subtree</div></div></div></span> of a node contains only nodes with keys <strong>less than</strong> the node's key.</li>
	<li>The right subtree of a node contains only nodes with keys <strong>greater than</strong> the node's key.</li>
	<li>Both the left and right subtrees must also be binary search trees.</li>
</ul>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/12/01/tree1.jpg" style="width: 302px; height: 182px;">
<pre><strong>Input:</strong> root = [2,1,3]
<strong>Output:</strong> true
</pre>
<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/12/01/tree2.jpg" style="width: 422px; height: 292px;">
<pre><strong>Input:</strong> root = [5,1,4,null,null,3,6]
<strong>Output:</strong> false
<strong>Explanation:</strong> The root node's value is 5 but its right child's value is 4.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the tree is in the range <code>[1, 10<sup>4</sup>]</code>.</li>
	<li><code>-2<sup>31</sup> &lt;= Node.val &lt;= 2<sup>31</sup> - 1</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var isValidBST = function (root, minLimit = -Infinity, maxLimit = Infinity) {
    if (root === null) return true;
    if ((root.val <= minLimit) || root.val >= maxLimit) return false;
    return isValidBST(root.left, minLimit, root.val) && isValidBST(root.right, root.val, maxLimit);
};

//-- OR --
var isValidBST = function (root) {
    const isNodeValidBST = function (root, minLimit = -Infinity, maxLimit = Infinity) {
        if (root === null) return true;
        if ((root.val <= minLimit) || (root.val >= maxLimit)) return false;
        return isNodeValidBST(root.left, minLimit, root.val) && isNodeValidBST(root.right, root.val, maxLimit);
    }
    return isNodeValidBST(root);
};
```

##### PHP

```php
class Solution {
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST($root)
    {
        return $this->isNodeValid($root, null, null);
    }

    function isNodeValid($root, $lower, $greater)
    {
        if ($root === null) {
            return true;
        }
        if ( ($lower !== null && $root->val <= $lower) || ($greater !== null && $root->val >= $greater) ) {
            return false;
        }
        return $this->isNodeValid($root->left, $lower, $root->val) && $this->isNodeValid($root->right, $root->val, $greater);
    }
}

//-- OR --
var isValidBST = function(root, minLimit = -Infinity, maxLimit = Infinity) {
    if( root === null ) return true;
    if( (root.val <= minLimit) || root.val >= maxLimit ) return false;
    return isValidBST(root.left, minLimit, root.val) && isValidBST(root.right, root.val, maxLimit);
};

//-- OR --
class Solution
{
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST(TreeNode $root)
    {
        return $this->isNodeValid($root);
    }

    function isNodeValid(TreeNode $root, $lower = null, $greater = null)
    {
        if ($root->left &&
            ($root->left->val >= $root->val ||
                ($greater !== null && $root->left->val <= $greater) ||
                ($lower !== null && $root->left->val >= $lower)
            )
        ) {
            return false;
        }
        if ($root->right &&
            ($root->right->val <= $root->val ||
                ($greater !== null && $root->right->val <= $greater) ||
                ($lower !== null && $root->right->val >= $lower)
            )
        ) return false;

        if ($root->left && !$this->isNodeValid($root->left, ($lower == null || $lower > $root->val) ? $root->val : $lower, $greater)) return false;
        if ($root->right && !$this->isNodeValid($root->right, $lower, ($greater == null || $greater > $root->val) ? $root->val : $greater)) return false;
        return true;
    }
}
```
