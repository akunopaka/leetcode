<?php
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

class Solution
{
    /**
     * @param String[][] $equations
     * @param Float[] $values
     * @param String[][] $queries
     * @return Float[]
     */
    function calcEquation(array $equations, array $values, array $queries): array {
        $graph = [];
        $result = [];

        // Build Graph
        foreach ($equations as $key => $equation) {
            $graph[$equation[0]][$equation[1]] = $values[$key];
            $graph[$equation[1]][$equation[0]] = 1 / $values[$key];
        }

        foreach ($queries as $query) {
            $visited = [];
            $tmp = $this->dfs($graph, $query[0], $query[1], 1, $visited);
            $result[] = $tmp == null ? -1 : $tmp;
        }

        return $result;
    }

    function dfs(array $graph, $node, $end, $count, &$visited) {
        if (!isset($graph[$node]) || !isset($graph[$end])) {
            return -1;
        }

        if ($node == $end) {
            return $count;
        }

        if (isset($visited[$node])) {
            return null;
        }

        $visited[$node] = true;
        foreach ($graph[$node] as $key => $value) {
            $result = $this->dfs($graph, $key, $end, $count * $value, $visited);
            if ($result) {
                return $result;
            }
        }

        return null;
    }


    function calcEquation____lol($equations, $values, $queries) {
        $map = [];

        foreach ($equations as $key => $equation) {
            foreach ($map[$key] as $k => $v) {
                foreach ($map[$k] as $kk => $vv) {
                    $map[$key][$kk] = $v * $vv;
                    $map[$kk][$key] = 1 / ($v * $vv);
                }
            }
            $map[$equation[0]][$equation[1]] = $values[$key];
            $map[$equation[1]][$equation[0]] = 1 / $values[$key];

        }

        foreach ($map as $key => $value) {
            $map[$key][$key] = 1;
            foreach ($map[$key] as $k => $v) {
                foreach ($map[$k] as $kk => $vv) {
                    $map[$key][$kk] = $v * $vv;
                    $map[$kk][$key] = 1 / ($v * $vv);
                }
            }
        }

        $result = [];
        foreach ($queries as $query) {
            if (isset($map[$query[0]][$query[1]])) {
                $result[] = $map[$query[0]][$query[1]];
            } else {
                $result[] = -1;
            }
        }

        return $result;
    }
}