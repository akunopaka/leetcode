//  399. Evaluate Division
//  https://leetcode.com/problems/evaluate-division/
//  Medium
//  
//    You are also given some queries, where queries[j] = [Cj, Dj] represents the jth query where you must find the answer for Cj / Dj = ?.
//    Return the answers to all queries. If a single answer cannot be determined, return -1.0.
//    Note: The input is always valid. You may assume that evaluating the queries will not result in division by zero and that there is no contradiction.
//    Example 1:
//    Input: equations = [["a","b"],["b","c"]], values = [2.0,3.0], queries = [["a","c"],["b","a"],["a","e"],["a","a"],["x","x"]]
//    Output: [6.00000,0.50000,-1.00000,1.00000,-1.00000]
//    Explanation: 
//    Given: a / b = 2.0, b / c = 3.0
//    queries are: a / c = ?, b / a = ?, a / e = ?, a / a = ?, x / x = ?
//    return: [6.0, 0.5, -1.0, 1.0, -1.0 ]
//    Example 2:
//    Input: equations = [["a","b"],["b","c"],["bc","cd"]], values = [1.5,2.5,5.0], queries = [["a","c"],["c","b"],["bc","cd"],["cd","bc"]]
//    Output: [3.75000,0.40000,5.00000,0.20000]
//    Example 3:
//    Input: equations = [["a","b"]], values = [0.5], queries = [["a","b"],["b","a"],["a","c"],["x","y"]]
//    Output: [0.50000,2.00000,-1.00000,-1.00000]
//    Constraints:
//    1 &lt;= equations.length &lt;= 20
//    equations[i].length == 2
//    1 &lt;= Ai.length, Bi.length &lt;= 5
//    values.length == equations.length
//    0.0 &lt; values[i] &lt;= 20.0
//    1 &lt;= queries.length &lt;= 20
//    queries[i].length == 2
//    1 &lt;= Cj.length, Dj.length &lt;= 5
//    Ai, Bi, Cj, Dj consist of lower case English letters and digits.

/**
 * @param {string[][]} equations
 * @param {number[]} values
 * @param {string[][]} queries
 * @return {number[]}
 */
var calcEquation = function (equations, values, queries) {
    const graph = {};
    const result = [];

    for (let i = 0; i < equations.length; i++) {
        const [a, b] = equations[i];
        const value = values[i];

        if (!graph[a]) graph[a] = {};
        if (!graph[b]) graph[b] = {};

        graph[a][b] = value;
        graph[b][a] = 1 / value;
    }

    for (let i = 0; i < queries.length; i++) {
        const [a, b] = queries[i];
        const value = dfs(graph, a, b, {});
        result.push(value);
    }

    return result;

};

function dfs(graph, a, b, visited) {
    if (!graph[a]) return -1;
    if (a === b) return 1;

    visited[a] = true;

    const neighbors = Object.keys(graph[a]);
    for (let i = 0; i < neighbors.length; i++) {
        const neighbor = neighbors[i];
        if (visited[neighbor]) continue;

        const value = dfs(graph, neighbor, b, visited);
        if (value !== -1) {
            return value * graph[a][neighbor];
        }
    }

    return -1;
}


