### 684. Redundant Connection

Difficulty: `Medium`

https://leetcode.com/problems/redundant-connection/

MY SOLUTION ON LEETCODE:
https://leetcode.com/discuss/topic/3470672/phpjavascript-beats-100-disjoint-set-union-union-find/


<p>In this problem, a tree is an <strong>undirected graph</strong> that is connected and has no cycles.</p>
<p>You are given a graph that started as a tree with <code>n</code> nodes labeled from <code>1</code> to <code>n</code>, with one additional edge added. The added edge has two <strong>different</strong> vertices chosen from <code>1</code> to <code>n</code>, and was not an edge that already existed. The graph is represented as an array <code>edges</code> of length <code>n</code> where <code>edges[i] = [a<sub>i</sub>, b<sub>i</sub>]</code> indicates that there is an edge between nodes <code>a<sub>i</sub></code> and <code>b<sub>i</sub></code> in the graph.</p>
<p>Return <em>an edge that can be removed so that the resulting graph is a tree of </em><code>n</code><em> nodes</em>. If there are multiple answers, return the answer that occurs last in the input.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/05/02/reduntant1-1-graph.jpg" style="width: 222px; height: 222px;">
<pre><strong>Input:</strong> edges = [[1,2],[1,3],[2,3]]
<strong>Output:</strong> [2,3]
</pre>
<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/05/02/reduntant1-2-graph.jpg" style="width: 382px; height: 222px;">
<pre><strong>Input:</strong> edges = [[1,2],[2,3],[3,4],[1,4],[1,5]]
<strong>Output:</strong> [1,4]
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>n == edges.length</code></li>
	<li><code>3 &lt;= n &lt;= 1000</code></li>
	<li><code>edges[i].length == 2</code></li>
	<li><code>1 &lt;= a<sub>i</sub> &lt; b<sub>i</sub> &lt;= edges.length</code></li>
	<li><code>a<sub>i</sub> != b<sub>i</sub></code></li>
	<li>There are no repeated edges.</li>
	<li>The given graph is connected.</li>
</ul>

### My Solution(s):

##### JavaScript

```js

// Disjoint Set Union -- Union Find
class DSU {
    constructor(n) {
        this.parent = Array(n).fill(0);
        this.rank = Array(n).fill(0);
        for (let i = 0; i < n; i++) {
            this.parent[i] = i;
            this.rank[i] = 1;
        }
    }

    find(x) {
        if (x == this.parent[x])
            return x;
        else
            return this.parent[x] = this.find(this.parent[x]);
    }

    union(x, y) {
        let xParent = this.find(x);
        let yParent = this.find(y);
        if (xParent == yParent) {
            return false;
        }
        if (this.rank[xParent] > this.rank[yParent]) {
            this.parent[yParent] = xParent;
            this.rank[xParent] += this.rank[yParent];
        } else {
            this.parent[xParent] = yParent;
            this.rank[yParent] += this.rank[xParent];
        }
        return true;
    }
}

/**
 * @param {number[][]} edges
 * @return {number[]}
 */
var findRedundantConnection = function (edges) {
    let dsu = new DSU(edges.length + 1);
    for (let edge of edges)
        if (!dsu.union(edge[0], edge[1]))
            return edge;
    return [];
};
```

##### PHP

```php

//
//class Solution
//{
//    /**
//     * @param Integer[][] $edges
//     * @return Integer[]
//     */
//    function findRedundantConnection(array $edges): array {
//        $uf = new UnionFind(count($edges) + 1);
//        foreach ($edges as $edge) {
//            if ($uf->find($edge[0]) == $uf->find($edge[1])) {
//                return $edge;
//            }
//            $uf->union($edge[0], $edge[1]);
//        }
//        return [];
//    }
//
//}
//
//class UnionFind
//{
//    private array $parent;
//
//    function __construct($n) {
//        $this->parent = range(0, $n);
//    }
//
//    function find($x) {
//        if ($this->parent[$x] != $x) {
//            $this->parent[$x] = $this->find($this->parent[$x]);
//        }
//        return $this->parent[$x];
//    }
//
//    function union($x, $y) {
//        $this->parent[$this->find($x)] = $this->find($y);
//    }
//}

// -- OR --  with rank

// Disjoint Set Union -- Union Find
class DSU
{
    private array $parent;
    private array $rank;

    public function __construct(int $n) {
        $this->parent = array_fill(0, $n, 0);
        $this->rank = array_fill(0, $n, 0);
        for ($i = 0; $i < $n; $i++) {
            $this->parent[$i] = $i;
        }
    }

    public function find(int $x) {
        if ($x == $this->parent[$x])
            return $x;
        else
            return $this->parent[$x] = $this->find($this->parent[$x]);
    }

    public function union(int $x,int $y): bool {
        $xParent = $this->find($x);
        $yParent = $this->find($y);
        if ($xParent == $yParent) {
            return false;
        }
        if ($this->rank[$xParent] > $this->rank[$yParent]) {
            $this->parent[$yParent] = $xParent;
            $this->rank[$xParent] += $this->rank[$yParent];
        } else {
            $this->parent[$xParent] = $yParent;
            $this->rank[$yParent] += $this->rank[$xParent];
        }
        return true;
    }
}

class Solution
{
    /**
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function findRedundantConnection(array $edges): array {
        $dsu = new DSU(sizeof($edges) + 1);
        foreach ($edges as $edge)
            if (!$dsu->union($edge[0], $edge[1]))
                return $edge;
        return [];
    }
}


```

