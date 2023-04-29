### 1697. Checking Existence of Edge Length Limited Paths

Difficulty: `Hard`

https://leetcode.com/problems/checking-existence-of-edge-length-limited-paths/



<p>An undirected graph of <code>n</code> nodes is defined by <code>edgeList</code>, where <code>edgeList[i] = [u<sub>i</sub>, v<sub>i</sub>, dis<sub>i</sub>]</code> denotes an edge between nodes <code>u<sub>i</sub></code> and <code>v<sub>i</sub></code> with distance <code>dis<sub>i</sub></code>. Note that there may be <strong>multiple</strong> edges between two nodes.</p>
<p>Given an array <code>queries</code>, where <code>queries[j] = [p<sub>j</sub>, q<sub>j</sub>, limit<sub>j</sub>]</code>, your task is to determine for each <code>queries[j]</code> whether there is a path between <code>p<sub>j</sub></code> and <code>q<sub>j</sub></code><sub> </sub>such that each edge on the path has a distance <strong>strictly less than</strong> <code>limit<sub>j</sub></code> .</p>
<p>Return <em>a <strong>boolean array</strong> </em><code>answer</code><em>, where </em><code>answer.length == queries.length</code> <em>and the </em><code>j<sup>th</sup></code> <em>value of </em><code>answer</code> <em>is </em><code>true</code><em> if there is a path for </em><code>queries[j]</code><em> is </em><code>true</code><em>, and </em><code>false</code><em> otherwise</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/12/08/h.png" style="width: 267px; height: 262px;">
<pre><strong>Input:</strong> n = 3, edgeList = [[0,1,2],[1,2,4],[2,0,8],[1,0,16]], queries = [[0,1,2],[0,2,5]]
<strong>Output:</strong> [false,true]
<strong>Explanation:</strong> The above figure shows the given graph. Note that there are two overlapping edges between 0 and 1 with distances 2 and 16.
For the first query, between 0 and 1 there is no path where each distance is less than 2, thus we return false for this query.
For the second query, there is a path (0 -&gt; 1 -&gt; 2) of two edges with distances less than 5, thus we return true for this query.
</pre>
<p><strong class="example">Example 2:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2020/12/08/q.png" style="width: 390px; height: 358px;">
<pre><strong>Input:</strong> n = 5, edgeList = [[0,1,10],[1,2,5],[2,3,9],[3,4,13]], queries = [[0,4,14],[1,4,13]]
<strong>Output:</strong> [true,false]
<strong>Exaplanation:</strong> The above figure shows the given graph.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>2 &lt;= n &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= edgeList.length, queries.length &lt;= 10<sup>5</sup></code></li>
	<li><code>edgeList[i].length == 3</code></li>
	<li><code>queries[j].length == 3</code></li>
	<li><code>0 &lt;= u<sub>i</sub>, v<sub>i</sub>, p<sub>j</sub>, q<sub>j</sub> &lt;= n - 1</code></li>
	<li><code>u<sub>i</sub> != v<sub>i</sub></code></li>
	<li><code>p<sub>j</sub> != q<sub>j</sub></code></li>
	<li><code>1 &lt;= dis<sub>i</sub>, limit<sub>j</sub> &lt;= 10<sup>9</sup></code></li>
	<li>There may be <strong>multiple</strong> edges between two nodes.</li>
</ul>

### Solution(s):

##### JavaScript

```js
function distanceLimitedPathsExist(n, edgeList, queries) {
    let unionFind = new UnionFind(n);
    let queriesCount = queries.length;
    let answer = Array(queriesCount);

    // Store original indices with all queries.
    let queriesWithIndex = [];
    for (let i = 0; i < queriesCount; ++i) {
        queriesWithIndex[i] = queries[i];
        queriesWithIndex[i].push(i);
    }

    // Sort all edges in increasing order of their edge weights.
    edgeList.sort((a, b) => a[2] - b[2]);
    // Sort all queries in increasing order of the limit of edge allowed.
    queriesWithIndex.sort((a, b) => a[2] - b[2]);

    let edgesIndex = 0;

    // Iterate on each query one by one.
    queriesWithIndex.forEach(([p, q, limit, queryOriginalIndex]) => {
        // We can attach all edges which satisfy the limit given by the query.
        while (edgesIndex < edgeList.length && edgeList[edgesIndex][2] < limit) {
            let node1 = edgeList[edgesIndex][0];
            let node2 = edgeList[edgesIndex][1];
            unionFind.join(node1, node2);
            edgesIndex += 1;
        }

        // If both nodes belong to the same component, it means we can reach them. 
        answer[queryOriginalIndex] = unionFind.areConnected(p, q);
    });

    return answer;
};

class UnionFind {
    constructor(size) {
        this.group = [];
        this.rank = [];
        for (let i = 0; i < size; ++i) {
            this.group[i] = i;
        }
    }

    find(node) {
        if (this.group[node] !== node) {
            this.group[node] = this.find(this.group[node]);
        }
        return this.group[node];
    }

    join(node1, node2) {
        let group1 = this.find(node1);
        let group2 = this.find(node2);

        // node1 and node2 already belong to same group.
        if (group1 === group2) {
            return;
        }

        if (this.rank[group1] > this.rank[group2]) {
            this.group[group2] = group1;
        } else if (this.rank[group1] < this.rank[group2]) {
            this.group[group1] = group2;
        } else {
            this.group[group1] = group2;
            this.rank[group2] += 1;
        }
    }

    areConnected(node1, node2) {
        let group1 = this.find(node1);
        let group2 = this.find(node2);
        return group1 === group2;
    }
}
```

##### PHP

```php

//
//class Solution
//{
//    /**
//     * @param Integer $n
//     * @param Integer[][] $edgeList
//     * @param Integer[][] $queries
//     * @return Boolean[]
//     */
//    function distanceLimitedPathsExist(int $n, array $edgeList, array $queries): array {
//        $result = [];
//
//        // sort and remove edges with distance >= limit
//        usort($edgeList, function ($a, $b) {
//            return $a[2] <=> $b[2];
//        });
//
//
//        foreach ($queries as $query) {
//            $result[] = $this->checkPath($query, $edgeList);
//        }
//        return $result;
//    }
//
//    function checkPath(array $query, array $edgeList): bool {
//        $startPathNode = $query[0];
//        $finishPathNode = $query[1];
//        $limit = $query[2];
//        $visited = [];
//        $queue = [$startPathNode];
//        while (!empty($queue)) {
//            $currentNode = array_shift($queue);
//            if ($currentNode == $finishPathNode) return true;
//            $visited[] = $currentNode;
//            foreach ($edgeList as $edge) {
//                if ($edge[2] >= $limit) break;
//                if ($edge[0] == $currentNode && !in_array($edge[1], $visited)) {
//                    $queue[] = $edge[1];
//                }
//                if ($edge[1] == $currentNode && !in_array($edge[0], $visited)) {
//                    $queue[] = $edge[0];
//                }
//            }
//        }
//        return false;
//    }
//}


class Solution
{
    /**
     * @param Integer $n
     * @param Integer[][] $edges
     * @param Integer[][] $queries
     * @return Boolean[]
     */
    public static function distanceLimitedPathsExist($n, $edges, $queries) {
        $unionFind = new UnionFind($n);
        $queriesCount = count($queries);
        $answer = array_fill(0, $queriesCount, False);
        $queriesWithIndex = [];
        foreach ($queries as $i => $q) {
            $queriesWithIndex[] = [$q[0], $q[1], $q[2], $i];
        }
        usort($edges, function ($e1, $e2) {
            return $e1[2] - $e2[2];
        });
        usort($queriesWithIndex, function ($q1, $q2) {
            return $q1[2] - $q2[2];
        });
        $edgesIndex = 0;
        foreach ($queriesWithIndex as $q) {
            list($p, $q, $limit, $queryOriginalIndex) = $q;
            while ($edgesIndex < count($edges) && $edges[$edgesIndex][2] < $limit) {
                $node1 = $edges[$edgesIndex][0];
                $node2 = $edges[$edgesIndex][1];
                $unionFind->join($node1, $node2);
                $edgesIndex++;
            }
            $answer[$queryOriginalIndex] = $unionFind->areConnected($p, $q);
        }
        return $answer;
    }
}

class UnionFind
{
    private $group;
    private $rank;

    public function __construct($size) {
        $this->group = array_fill(0, $size, 0);
        $this->rank = array_fill(0, $size, 0);
        for ($i = 0; $i < $size; $i++) {
            $this->group[$i] = $i;
        }
    }

    public function find($node) {
        if ($this->group[$node] !== $node) {
            $this->group[$node] = $this->find($this->group[$node]);
        }
        return $this->group[$node];
    }

    public function join($node1, $node2) {
        $group1 = $this->find($node1);
        $group2 = $this->find($node2);
        if ($group1 === $group2) {
            return;
        }
        if ($this->rank[$group1] > $this->rank[$group2]) {
            $this->group[$group2] = $group1;
        } elseif ($this->rank[$group1] < $this->rank[$group2]) {
            $this->group[$group1] = $group2;
        } else {
            $this->group[$group1] = $group2;
            $this->rank[$group2]++;
        }
    }

    public function areConnected($node1, $node2) {
        $group1 = $this->find($node1);
        $group2 = $this->find($node2);
        return $group1 === $group2;
    }
}
```

