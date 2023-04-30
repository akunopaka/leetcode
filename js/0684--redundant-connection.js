//  684. Redundant Connection
//  https://leetcode.com/problems/redundant-connection/
//  Medium
//  
//    In this problem, a tree is an undirected graph that is connected and has no cycles.
//    You are given a graph that started as a tree with n nodes labeled from 1 to n, with one additional edge added. The added edge has two different vertices chosen from 1 to n, and was not an edge that already existed. The graph is represented as an array edges of length n where edges[i] = [ai, bi] indicates that there is an edge between nodes ai and bi in the graph.
//    Return an edge that can be removed so that the resulting graph is a tree of n nodes. If there are multiple answers, return the answer that occurs last in the input.
//    Example 1:
//    Input: edges = [[1,2],[1,3],[2,3]]
//    Output: [2,3]
//    Example 2:
//    Input: edges = [[1,2],[2,3],[3,4],[1,4],[1,5]]
//    Output: [1,4]
//    Constraints:
//    n == edges.length
//    3 &lt;= n &lt;= 1000
//    edges[i].length == 2
//    1 &lt;= ai &lt; bi &lt;= edges.length
//    ai != bi
//    There are no repeated edges.
//    The given graph is connected.


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


