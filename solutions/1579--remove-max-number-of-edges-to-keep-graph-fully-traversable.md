### 1579. Remove Max Number of Edges to Keep Graph Fully Traversable

Difficulty: `Hard`

https://leetcode.com/problems/remove-max-number-of-edges-to-keep-graph-fully-traversable/

MY SOLUTION ON LEETCODE:
https://leetcode.com/discuss/topic/3470626/phpjavascript-beats-100-using-union-find-or-disjoint-set-data-structure/


<p>Alice and Bob have an undirected graph of <code>n</code> nodes and three types of edges:</p>
<ul>
	<li>Type 1: Can be traversed by Alice only.</li>
	<li>Type 2: Can be traversed by Bob only.</li>
	<li>Type 3: Can be traversed by both Alice and Bob.</li>
</ul>
<p>Given an array <code>edges</code> where <code>edges[i] = [type<sub>i</sub>, u<sub>i</sub>, v<sub>i</sub>]</code> represents a bidirectional edge of type <code>type<sub>i</sub></code> between nodes <code>u<sub>i</sub></code> and <code>v<sub>i</sub></code>, find the maximum number of edges you can remove so that after removing the edges, the graph can still be fully traversed by both Alice and Bob. The graph is fully traversed by Alice and Bob if starting from any node, they can reach all other nodes.</p>
<p>Return <em>the maximum number of edges you can remove, or return</em> <code>-1</code> <em>if Alice and Bob cannot fully traverse the graph.</em></p>
<p><strong class="example">Example 1:</strong></p>
<p><strong><img alt="" src="https://assets.leetcode.com/uploads/2020/08/19/ex1.png" style="width: 179px; height: 191px;"></strong></p>
<pre><strong>Input:</strong> n = 4, edges = [[3,1,2],[3,2,3],[1,1,3],[1,2,4],[1,1,2],[2,3,4]]
<strong>Output:</strong> 2
<strong>Explanation: </strong>If we remove the 2 edges [1,1,2] and [1,1,3]. The graph will still be fully traversable by Alice and Bob. Removing any additional edge will not make it so. So the maximum number of edges we can remove is 2.
</pre>
<p><strong class="example">Example 2:</strong></p>
<p><strong><img alt="" src="https://assets.leetcode.com/uploads/2020/08/19/ex2.png" style="width: 178px; height: 190px;"></strong></p>
<pre><strong>Input:</strong> n = 4, edges = [[3,1,2],[3,2,3],[1,1,4],[2,1,4]]
<strong>Output:</strong> 0
<strong>Explanation: </strong>Notice that removing any edge will not make the graph fully traversable by Alice and Bob.
</pre>
<p><strong class="example">Example 3:</strong></p>
<p><strong><img alt="" src="https://assets.leetcode.com/uploads/2020/08/19/ex3.png" style="width: 178px; height: 190px;"></strong></p>
<pre><strong>Input:</strong> n = 4, edges = [[3,2,3],[1,1,2],[2,3,4]]
<strong>Output:</strong> -1
<b>Explanation: </b>In the current graph, Alice cannot reach node 4 from the other nodes. Likewise, Bob cannot reach 1. Therefore it's impossible to make the graph fully traversable.</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= n &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= edges.length &lt;= min(10<sup>5</sup>, 3 * n * (n - 1) / 2)</code></li>
	<li><code>edges[i].length == 3</code></li>
	<li><code>1 &lt;= type<sub>i</sub> &lt;= 3</code></li>
	<li><code>1 &lt;= u<sub>i</sub> &lt; v<sub>i</sub> &lt;= n</code></li>
	<li>All tuples <code>(type<sub>i</sub>, u<sub>i</sub>, v<sub>i</sub>)</code> are distinct.</li>
</ul>

### My Solution(s):

##### JavaScript

```js

/**
 * @param {number} n
 * @param {number[][]} edges
 * @return {number}
 */
var maxNumEdgesToRemove = function (n, edges) {
    let ufA = new UnionFind(n);
    let ufB = new UnionFind(n);
    let resNumberOfEdgesToKeep = 0;
    // Type 3
    for (let edge of edges) {
        if (edge[0] === 3) {
            resNumberOfEdgesToKeep += ufA.union(edge[1], edge[2]);
            ufB.union(edge[1], edge[2]);
        }
    }
    // Type 1 and 2
    for (let edge of edges) {
        if (edge[0] === 1) {
            resNumberOfEdgesToKeep += ufA.union(edge[1], edge[2]);
        } else if (edge[0] === 2) {
            resNumberOfEdgesToKeep += ufB.union(edge[1], edge[2]);
        }
    }
    return ufA.isConnected() && ufB.isConnected() ? edges.length - resNumberOfEdgesToKeep : -1;
};

class UnionFind {
    constructor(n) {
        this.parent = {};
        this.rank = {};
        this.count = n;
        for (let i = 0; i <= n; i++) {
            this.parent[i] = i;
            this.rank[i] = 1;
        }
    }

    find(node) {
        while (node !== this.parent[node]) {
            this.parent[node] = this.parent[this.parent[node]];
            node = this.parent[node];
        }
        return node;
    }

    union(u, v) {
        let rootU = this.find(u);
        let rootV = this.find(v);
        if (rootU === rootV) return 0;
        if (this.rank[rootU] > this.rank[rootV]) {
            this.parent[rootV] = rootU;
            this.rank[rootU] += this.rank[rootV];
        } else {
            this.parent[rootU] = rootV;
            this.rank[rootV] += this.rank[rootU];
        }
        this.count--;
        return 1;
    }

    isConnected() {
        return this.count === 1;
    }
}
```

##### PHP

```php

class Solution
{
    /**
     * @param Integer $n
     * @param Integer[][] $edges
     * @return Integer
     */
    function maxNumEdgesToRemove(int $n, array $edges): int {
        $ufA = new UnionFind($n);
        $ufB = new UnionFind($n);
        $resNumberOfEdgesToKeep = 0;
        // Type 3
        foreach ($edges as $edge) {
            if ($edge[0] == 3) {
                $resNumberOfEdgesToKeep += $ufA->union($edge[1], $edge[2]);
                $ufB->union($edge[1], $edge[2]);
            }
        }
        // Type 1 and 2
        foreach ($edges as $edge) {
            if ($edge[0] == 1) {
                $resNumberOfEdgesToKeep += $ufA->union($edge[1], $edge[2]);
            } else if ($edge[0] == 2) {
                $resNumberOfEdgesToKeep += $ufB->union($edge[1], $edge[2]);
            }
        }
        return $ufA->isConnected() && $ufB->isConnected() ? count($edges) - $resNumberOfEdgesToKeep : -1;

    }
}

class UnionFind
{
    private $parent = [];
    private $rank = [];
    private $count = 0;

    function __construct(int $n) {
        $this->count = $n;
        for ($i = 0; $i <= $n; $i++) {
            $this->parent[$i] = $i;
            $this->rank[$i] = 1;
        }
    }

    function find(int $node): int {
        while ($node != $this->parent[$node]) {
            $this->parent[$node] = $this->parent[$this->parent[$node]];
            $node = $this->parent[$node];
        }
        return $node;
    }

    function union(int $u, int $v): int {
        $rootU = $this->find($u);
        $rootV = $this->find($v);
        if ($rootU == $rootV) return 0;
        if ($this->rank[$rootU] > $this->rank[$rootV]) {
            $this->parent[$rootV] = $rootU;
        } else {
            $this->parent[$rootU] = $rootV;
            if ($this->rank[$rootU] == $this->rank[$rootV]) {
                $this->rank[$rootV]++;
            }
        }
        $this->count--;
        return 1;
    }

    function isConnected(): bool {
        return $this->count == 1;
    }
}

```

