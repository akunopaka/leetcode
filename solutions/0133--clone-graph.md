### 133. Clone Graph

Difficulty: `Medium`

https://leetcode.com/problems/clone-graph/

My Solution on LeetCode:
https://leetcode.com/discuss/topic/3392084/javascriptphp-bfs-dfs-approaches/


<p>Given a reference of a node in a <strong><a href="https://en.wikipedia.org/wiki/Connectivity_(graph_theory)#Connected_graph" target="_blank">connected</a></strong> undirected graph.</p>

<p>Return a <a href="https://en.wikipedia.org/wiki/Object_copying#Deep_copy" target="_blank"><strong>deep copy</strong></a> (clone) of the graph.</p>

<p>Each node in the graph contains a value (<code>int</code>) and a list (<code>List[Node]</code>) of its neighbors.</p>

<pre>class Node {
    public int val;
    public List&lt;Node&gt; neighbors;
}
</pre>


<p><strong>Test case format:</strong></p>

<p>For simplicity, each node's value is the same as the node's index (1-indexed). For example, the first node with <code>val == 1</code>, the second node with <code>val == 2</code>, and so on. The graph is represented in the test case using an adjacency list.</p>

<p><b>An adjacency list</b> is a collection of unordered <b>lists</b> used to represent a finite graph. Each list describes the set of neighbors of a node in the graph.</p>

<p>The given node will always be the first node with <code>val = 1</code>. You must return the <strong>copy of the given node</strong> as a reference to the cloned graph.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2019/11/04/133_clone_graph_question.png" style="width: 454px; height: 500px;">
<pre><strong>Input:</strong> adjList = [[2,4],[1,3],[2,4],[1,3]]
<strong>Output:</strong> [[2,4],[1,3],[2,4],[1,3]]
<strong>Explanation:</strong> There are 4 nodes in the graph.
1st node (val = 1)'s neighbors are 2nd node (val = 2) and 4th node (val = 4).
2nd node (val = 2)'s neighbors are 1st node (val = 1) and 3rd node (val = 3).
3rd node (val = 3)'s neighbors are 2nd node (val = 2) and 4th node (val = 4).
4th node (val = 4)'s neighbors are 1st node (val = 1) and 3rd node (val = 3).
</pre>

<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/01/07/graph.png" style="width: 163px; height: 148px;">
<pre><strong>Input:</strong> adjList = [[]]
<strong>Output:</strong> [[]]
<strong>Explanation:</strong> Note that the input contains one empty list. The graph consists of only one node with val = 1 and it does not have any neighbors.
</pre>
<p><strong class="example">Example 3:</strong></p>

<pre><strong>Input:</strong> adjList = []
<strong>Output:</strong> []
<strong>Explanation:</strong> This an empty graph, it does not have any nodes.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li>The number of nodes in the graph is in the range <code>[0, 100]</code>.</li>
	<li><code>1 &lt;= Node.val &lt;= 100</code></li>
	<li><code>Node.val</code> is unique for each node.</li>
	<li>There are no repeated edges and no self-loops in the graph.</li>
	<li>The Graph is connected and all nodes can be visited starting from the given node.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
// DFS approach
var cloneGraph_____DFS = function (node) {
    // DFS approach
    // 1. create a new node
    // 2. add the new node to the visited map
    // 3. for each neighbor of the node
    // 4.    if the neighbor is not in the visited map
    // 5.        create a new node
    // 6.        add the new node to the visited map
    // 7.    add the new node to the neighbors of the new node
    if (!node) return null;

    let dfs = (node, visited) => {
        if (visited.has(node)) return visited.get(node);
        let newNode = new Node(node.val);
        visited.set(node, newNode);
        for (let neighbor of node.neighbors) {
            newNode.neighbors.push(dfs(neighbor, visited));
        }
        return newNode;
    }
    return dfs(node, new Map());
}

// BFS approach
var cloneGraph_________BFS = function (node) {
    // BFS approach
    // 1. create a new node
    // 2. add the new node to the queue
    // 3. add the new node to the visited map
    // 4. while the queue is not empty
    // 5.    get the first node from the queue
    // 6.    for each neighbor of the node
    // 7.        if the neighbor is not in the visited map
    // 8.            create a new node
    // 9.            add the new node to the queue
    // 10.           add the new node to the visited map
    // 11.       add the new node to the neighbors of the new node
    if (!node) return null;

    let newNode = new Node(node.val);
    let queue = [node];
    let visited = new Map();
    visited.set(node, newNode);

    while (queue.length > 0) {
        let currentNode = queue.shift();
        for (let neighbor of currentNode.neighbors) {
            if (!visited.has(neighbor)) {
                let newNeighbor = new Node(neighbor.val);
                queue.push(neighbor);
                visited.set(neighbor, newNeighbor);
            }
            visited.get(currentNode).neighbors.push(visited.get(neighbor));
        }
    }
    return newNode;
};
```

##### PHP

```php
// BFS Approach
class Solution________BFS
{
    /**
     * @param Node $node
     * @return Node
     */
    function cloneGraph($node) {
        if ($node === null) return null;
        $visited = [];
        $queue = new SplQueue();
        $queue->enqueue($node);
        $visited[$node->val] = new Node($node->val);
        while (!$queue->isEmpty()) {
            $current = $queue->dequeue();
            foreach ($current->neighbors as $neighbor) {
                if (!isset($visited[$neighbor->val])) {
                    $visited[$neighbor->val] = new Node($neighbor->val);
                    $queue->enqueue($neighbor);
                }
                $visited[$current->val]->neighbors[] = $visited[$neighbor->val];
            }
        }
        return $visited[$node->val];
    }
}

// DFS Approach
class Solution________DFS
{
    /**
     * @param Node $node
     * @return Node
     */
    function cloneGraph(?Node $node): ?Node {
        if ($node === null) return null;
        $visited = [];
        return $this->cloneGraphDFSHelper($node, $visited);
    }

    function cloneGraphDFSHelper(?Node $node, array &$visited): ?Node {
        if (isset($visited[$node->val])) {
            return $visited[$node->val];
        }
        $newNode = new Node($node->val);
        $visited[$node->val] = $newNode;
        foreach ($node->neighbors as $neighbor) {
            $newNode->neighbors[] = $this->cloneGraphDFSHelper($neighbor, $visited);
        }
        return $newNode;
    }
}
```

