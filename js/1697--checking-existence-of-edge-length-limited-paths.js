//  1697. Checking Existence of Edge Length Limited Paths
//  https://leetcode.com/problems/checking-existence-of-edge-length-limited-paths/
//  Hard
//  
//    An undirected graph of n nodes is defined by edgeList, where edgeList[i] = [ui, vi, disi] denotes an edge between nodes ui and vi with distance disi. Note that there may be multiple edges between two nodes.
//    Given an array queries, where queries[j] = [pj, qj, limitj], your task is to determine for each queries[j] whether there is a path between pj and qj such that each edge on the path has a distance strictly less than limitj .
//    Return a boolean array answer, where answer.length == queries.length and the jth value of answer is true if there is a path for queries[j] is true, and false otherwise.
//    Example 1:
//    Input: n = 3, edgeList = [[0,1,2],[1,2,4],[2,0,8],[1,0,16]], queries = [[0,1,2],[0,2,5]]
//    Output: [false,true]
//    Explanation: The above figure shows the given graph. Note that there are two overlapping edges between 0 and 1 with distances 2 and 16.
//    For the first query, between 0 and 1 there is no path where each distance is less than 2, thus we return false for this query.
//    For the second query, there is a path (0 -&gt; 1 -&gt; 2) of two edges with distances less than 5, thus we return true for this query.
//    Example 2:
//    Input: n = 5, edgeList = [[0,1,10],[1,2,5],[2,3,9],[3,4,13]], queries = [[0,4,14],[1,4,13]]
//    Output: [true,false]
//    Exaplanation: The above figure shows the given graph.
//    Constraints:
//    2 &lt;= n &lt;= 105
//    1 &lt;= edgeList.length, queries.length &lt;= 105
//    edgeList[i].length == 3
//    queries[j].length == 3
//    0 &lt;= ui, vi, pj, qj &lt;= n - 1
//    ui != vi
//    pj != qj
//    1 &lt;= disi, limitj &lt;= 109
//    There may be multiple edges between two nodes.


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