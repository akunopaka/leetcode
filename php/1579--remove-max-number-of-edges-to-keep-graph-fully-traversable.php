<?php
//  1579. Remove Max Number of Edges to Keep Graph Fully Traversable
//  https://leetcode.com/problems/remove-max-number-of-edges-to-keep-graph-fully-traversable/
//  Hard
//
//   MY SOLUTION ON LEETCODE:
//   https://leetcode.com/discuss/topic/3470626/phpjavascript-beats-100-using-union-find-or-disjoint-set-data-structure/
//
//    Alice and Bob have an undirected graph of n nodes and three types of edges:
//    Type 1: Can be traversed by Alice only.
//    Type 2: Can be traversed by Bob only.
//    Type 3: Can be traversed by both Alice and Bob.
//    Given an array edges where edges[i] = [typei, ui, vi] represents a bidirectional edge of type typei between nodes ui and vi, find the maximum number of edges you can remove so that after removing the edges, the graph can still be fully traversed by both Alice and Bob. The graph is fully traversed by Alice and Bob if starting from any node, they can reach all other nodes.
//    Return the maximum number of edges you can remove, or return -1 if Alice and Bob cannot fully traverse the graph.
//    Example 1:
//    Input: n = 4, edges = [[3,1,2],[3,2,3],[1,1,3],[1,2,4],[1,1,2],[2,3,4]]
//    Output: 2
//    Explanation: If we remove the 2 edges [1,1,2] and [1,1,3]. The graph will still be fully traversable by Alice and Bob. Removing any additional edge will not make it so. So the maximum number of edges we can remove is 2.
//    Example 2:
//    Input: n = 4, edges = [[3,1,2],[3,2,3],[1,1,4],[2,1,4]]
//    Output: 0
//    Explanation: Notice that removing any edge will not make the graph fully traversable by Alice and Bob.
//    Example 3:
//    Input: n = 4, edges = [[3,2,3],[1,1,2],[2,3,4]]
//    Output: -1
//    Explanation: In the current graph, Alice cannot reach node 4 from the other nodes. Likewise, Bob cannot reach 1. Therefore it's impossible to make the graph fully traversable.
//    Constraints:
//    1 &lt;= n &lt;= 105
//    1 &lt;= edges.length &lt;= min(105, 3 * n * (n - 1) / 2)
//    edges[i].length == 3
//    1 &lt;= typei &lt;= 3
//    1 &lt;= ui &lt; vi &lt;= n
//    All tuples (typei, ui, vi) are distinct.


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
            $this->rank[$rootU] += $this->rank[$rootV];
        } else {
            $this->parent[$rootU] = $rootV;
            $this->rank[$rootV] += $this->rank[$rootU];
        }
        $this->count--;
        return 1;
    }

    function isConnected(): bool {
        return $this->count == 1;
    }
}
