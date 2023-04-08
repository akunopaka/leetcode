### 129. Sum Root to Leaf Numbers

Difficulty: `Medium`

https://leetcode.com/problems/sum-root-to-leaf-numbers/

My SOLUTION on LeetCode:

https://leetcode.com/problems/sum-root-to-leaf-numbers/solutions/3297822/php-beats-100-javascript-93-2-different-approaches/


<p>You are given the <code>root</code> of a binary tree containing digits from <code>0</code> to <code>9</code> only.</p>

<p>Each root-to-leaf path in the tree represents a number.</p>

<ul>
	<li>For example, the root-to-leaf path <code>1 -&gt; 2 -&gt; 3</code> represents the number <code>123</code>.</li>
</ul>

<p>Return <em>the total sum of all root-to-leaf numbers</em>. Test cases are generated so that the answer will fit in a <strong>32-bit</strong> integer.</p>

<p>A <strong>leaf</strong> node is a node with no children.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/num1tree.jpg" style="width: 212px; height: 182px;">
<pre><strong>Input:</strong> root = [1,2,3]
<strong>Output:</strong> 25
<strong>Explanation:</strong>
The root-to-leaf path <code>1-&gt;2</code> represents the number <code>12</code>.
The root-to-leaf path <code>1-&gt;3</code> represents the number <code>13</code>.
Therefore, sum = 12 + 13 = <code>25</code>.
</pre>

<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/02/19/num2tree.jpg" style="width: 292px; height: 302px;">
<pre><strong>Input:</strong> root = [4,9,0,5,1]
<strong>Output:</strong> 1026
<strong>Explanation:</strong>
The root-to-leaf path <code>4-&gt;9-&gt;5</code> represents the number 495.
The root-to-leaf path <code>4-&gt;9-&gt;1</code> represents the number 491.
The root-to-leaf path <code>4-&gt;0</code> represents the number 40.
Therefore, sum = 495 + 491 + 40 = <code>1026</code>.
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li>The number of nodes in the tree is in the range <code>[1, 1000]</code>.</li>
	<li><code>0 &lt;= Node.val &lt;= 9</code></li>
	<li>The depth of the tree will not exceed <code>10</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
// This solution uses a Depth-First Search (DFS) approach to traverse the binary tree and calculate the sum of all root-to-leaf path numbers. The DFS function takes in a node and the sum of the existing path up to the node. If the node is null, then it returns 0. If the node is a leaf node, it returns the total sum of the path from the root to the leaf node. If the node has children, then it calls the same DFS function on both of the children, passing in the sum of the existing path up to that node. The sum of all the DFS calls is then returned.
// Time Complexity: O(n) as we have to traverse each node in the binary tree once.
// Space Complexity: O(n) as the maximum depth of the recursive stack can be n for a binary tree with n nodes.
/**
 * @param {TreeNode} root
 * @return {number}
 */
var sumNumbers = function (root) {
    const dfs = function (node, sum) {
        if (node == null) {
            return 0;
        }
        if (node.left === null && node.right == null) {
            return sum * 10 + node.val;
        }
        return dfs(node.left, sum * 10 + node.val) +
            dfs(node.right, sum * 10 + node.val)
    }
    return dfs(root, 0);
}

//-- OR --

// The approach used in this solution is to traverse the tree using a breadth-first search, and for each node add the values of its children to the sum of its own value. We also use a queue to keep track of the nodes that need to be visited. We start with the root node, and for each node check if it is a leaf node (if it has no children). If it is, add the value of the node to the total sum. If it is not a leaf node, add its children to the queue, and add the node value to the children's values. When the queue is empty, all the nodes have been visited and the sum is returned.
// Time complexity: O(n), as we visit every node in the tree once.
// Space complexity: O(n), as we use a queue to store up to n nodes at any given time.
var sumNumbers = function (root) {
    let totalSum = 0;
    if (root === null || root.val === undefined) return 0;
    if (root.left === undefined && root.right === undefined) return 0;
    let queue = [root];

    while (queue.length > 0) {
        node = queue.shift();
        if (node.left === null && node.right == null) {
            totalSum += parseInt(node.val);
        }
        if (node.left && node.left.val !== undefined) {
            node.left.val = node.val + "" + node.left.val;
            queue.push(node.left);
        }
        if (node.right && node.right.val !== undefined) {
            node.right.val = node.val + "" + node.right.val;
            queue.push(node.right);
        }
    }
    return totalSum;
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
    function sumNumbers(TreeNode $root): int
    {
        return $this->dfs($root, 0);
    }

    private function dfs(?TreeNode $node, int $sum): int
    {
        if ($node === null) {
            return 0;
        }
        if ($node->left === null && $node->right == null) {
            return $sum * 10 + $node->val;
        }
        return $this->dfs($node->left, $sum * 10 + $node->val) +
            $this->dfs($node->right, $sum * 10 + $node->val);
    }
}

//-- OR --

class Solution___2
{
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function sumNumbers(TreeNode $root): int
    {
        if ($root === null || $root->val === null) return 0;
        $totalSum = 0;
        $queue = [$root];
        while (count($queue) > 0) {
            $node = array_shift($queue);
            if ($node->left === null && $node->right === null) {
                $totalSum += $node->val;
            }

            if ($node->left) {
                $node->left->val = $node->val * 10 + $node->left->val;
                $queue[] = $node->left;
            }
            if ($node->right) {
                $node->right->val = $node->val * 10 + $node->right->val;
                $queue[] = $node->right;
            }
        }
        return $totalSum;
    }
}
```

//
POST https://leetcode.com/problems/sum-root-to-leaf-numbers/solutions/3297822/php-beats-100-javascript-93-2-different-approaches/

##### Here you can get acquainted with **2 different solutions**. Solutions implemented in **PHP** and **JavaScript**

### SOLUTION #1

The approach used in this solution is to traverse the tree using a breadth-first search, and for each node add the
values of its children to the sum of its own value. We also use a queue to keep track of the nodes that need to be
visited. We start with the root node, and for each node check if it is a leaf node (if it has no children). If it is,
add the value of the node to the total sum. If it is not a leaf node, add its children to the queue, and add the node
value to the children's values. When the queue is empty, all the nodes have been visited and the sum is returned.
*Time complexity*: O(n), as we visit every node in the tree once.
*Space complexity*: O(n), as we use a queue to store up to n nodes at any given time.

```PHP []
class Solution
{
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function sumNumbers(TreeNode $root): int {
        if ($root === null || $root->val === null) return 0;
        $totalSum = 0;
        $queue = [$root];
        while (count($queue) > 0) {
            $node = array_shift($queue);
            if ($node->left === null && $node->right === null) {
                $totalSum += $node->val;
            }

            if ($node->left) {
                $node->left->val = $node->val * 10 + $node->left->val;
                $queue[] = $node->left;
            }
            if ($node->right) {
                $node->right->val = $node->val * 10 + $node->right->val;
                $queue[] = $node->right;
            }
        }
        return $totalSum;
    }
}
```

```javascript []
var sumNumbers = function (root) {
    let totalSum = 0;
    if (root === null || root.val === undefined) return 0;
    if (root.left === undefined && root.right === undefined) return root.val;
    let queue = [root];

    while (queue.length > 0) {
        node = queue.shift();
        if (node.left === null && node.right == null) {
            totalSum += node.val;
        }
        if (node.left && node.left.val !== undefined) {
            node.left.val = node.val * 10 + node.left.val;
            queue.push(node.left);
        }
        if (node.right && node.right.val !== undefined) {
            node.right.val = node.val * 10 + node.right.val;
            queue.push(node.right);
        }
    }
    return totalSum;
};
```

### SOLUTION #2

This solution uses a Depth-First Search (DFS) approach to traverse the binary tree and calculate the sum of all
root-to-leaf path numbers. The DFS function takes in a node and the sum of the existing path up to the node. If the node
is null, then it returns 0. If the node is a leaf node, it returns the total sum of the path from the root to the leaf
node. If the node has children, then it calls the same DFS function on both of the children, passing in the sum of the
existing path up to that node. The sum of all the DFS calls is then returned.
*Time Complexity*: O(n) as we have to traverse each node in the binary tree once.
*Space Complexity*: O(n) as the maximum depth of the recursive stack can be n for a binary tree with n nodes.

```PHP []
class Solution
{
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function sumNumbers(TreeNode $root): int
    {
        return $this->dfs($root, 0);
    }

    private function dfs(?TreeNode $node, int $sum): int
    {
        if ($node === null) {
            return 0;
        }
        if ($node->left === null && $node->right == null) {
            return $sum * 10 + $node->val;
        }
        return $this->dfs($node->left, $sum * 10 + $node->val) +
            $this->dfs($node->right, $sum * 10 + $node->val);
    }
}
```

```javascript []
var sumNumbers = function (root) {
    const dfs = function (node, sum) {
        if (node == null) {
            return 0;
        }
        if (node.left === null && node.right == null) {
            return sum * 10 + node.val;
        }
        return dfs(node.left, sum * 10 + node.val) +
            dfs(node.right, sum * 10 + node.val)
    }
    return dfs(root, 0);
}
```
