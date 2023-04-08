### 106. Construct Binary Tree from Inorder and Postorder Traversal

Difficulty: `Medium`

https://leetcode.com/problems/construct-binary-tree-from-inorder-and-postorder-traversal/

<p>Given two integer arrays <code>inorder</code> and <code>postorder</code> where <code>inorder</code> is the inorder traversal of a binary tree and <code>postorder</code> is the postorder traversal of the same tree, construct and return <em>the binary tree</em>.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/tree.jpg" style="width: 277px; height: 302px;">
<pre><strong>Input:</strong> inorder = [9,3,15,20,7], postorder = [9,15,7,20,3]
<strong>Output:</strong> [3,9,20,null,null,15,7]
</pre>
<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> inorder = [-1], postorder = [-1]
<strong>Output:</strong> [-1]
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= inorder.length &lt;= 3000</code></li>
	<li><code>postorder.length == inorder.length</code></li>
	<li><code>-3000 &lt;= inorder[i], postorder[i] &lt;= 3000</code></li>
	<li><code>inorder</code> and <code>postorder</code> consist of <strong>unique</strong> values.</li>
	<li>Each value of <code>postorder</code> also appears in <code>inorder</code>.</li>
	<li><code>inorder</code> is <strong>guaranteed</strong> to be the inorder traversal of the tree.</li>
	<li><code>postorder</code> is <strong>guaranteed</strong> to be the postorder traversal of the tree.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var buildTree = function (inorder, postorder) {
    if (!inorder.length || !postorder.length) return null;
    let root = new TreeNode(postorder.pop());
    let rootIndex = inorder.indexOf(root.val);
    root.right = buildTree(inorder.slice(rootIndex + 1), postorder);
    root.left = buildTree(inorder.slice(0, rootIndex), postorder);
    return root;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[] $inorder
     * @param Integer[] $postorder
     * @return TreeNode
     */
    function buildTree(array $inorder,array $postorder): ?TreeNode
    {
        if (empty($inorder) || empty($postorder)) {
            return null;
        }
        $root = new TreeNode($postorder[count($postorder) - 1]);
        $rootIndex = array_search($root->val, $inorder);
        $root->left = $this->buildTree(array_slice($inorder, 0, $rootIndex), array_slice($postorder, 0, $rootIndex));
        $root->right = $this->buildTree(array_slice($inorder, $rootIndex + 1), array_slice($postorder, $rootIndex, count($postorder) - $rootIndex - 1));
        return $root;
    }
}
```




