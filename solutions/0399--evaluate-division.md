### 399. Evaluate Division

Difficulty: `Medium`

https://leetcode.com/problems/evaluate-division/


<p>You are given an array of variable pairs <code>equations</code> and an array of real numbers <code>values</code>, where <code>equations[i] = [A<sub>i</sub>, B<sub>i</sub>]</code> and <code>values[i]</code> represent the equation <code>A<sub>i</sub> / B<sub>i</sub> = values[i]</code>. Each <code>A<sub>i</sub></code> or <code>B<sub>i</sub></code> is a string that represents a single variable.</p>

<p>You are also given some <code>queries</code>, where <code>queries[j] = [C<sub>j</sub>, D<sub>j</sub>]</code> represents the <code>j<sup>th</sup></code> query where you must find the answer for <code>C<sub>j</sub> / D<sub>j</sub> = ?</code>.</p>

<p>Return <em>the answers to all queries</em>. If a single answer cannot be determined, return <code>-1.0</code>.</p>

<p><strong>Note:</strong> The input is always valid. You may assume that evaluating the queries will not result in division by zero and that there is no contradiction.</p>

<p>&nbsp;</p>
<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> equations = [["a","b"],["b","c"]], values = [2.0,3.0], queries = [["a","c"],["b","a"],["a","e"],["a","a"],["x","x"]]
<strong>Output:</strong> [6.00000,0.50000,-1.00000,1.00000,-1.00000]
<strong>Explanation:</strong> 
Given: <em>a / b = 2.0</em>, <em>b / c = 3.0</em>
queries are: <em>a / c = ?</em>, <em>b / a = ?</em>, <em>a / e = ?</em>, <em>a / a = ?</em>, <em>x / x = ?</em>
return: [6.0, 0.5, -1.0, 1.0, -1.0 ]
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> equations = [["a","b"],["b","c"],["bc","cd"]], values = [1.5,2.5,5.0], queries = [["a","c"],["c","b"],["bc","cd"],["cd","bc"]]
<strong>Output:</strong> [3.75000,0.40000,5.00000,0.20000]
</pre>

<p><strong class="example">Example 3:</strong></p>

<pre><strong>Input:</strong> equations = [["a","b"]], values = [0.5], queries = [["a","b"],["b","a"],["a","c"],["x","y"]]
<strong>Output:</strong> [0.50000,2.00000,-1.00000,-1.00000]
</pre>

<p>&nbsp;</p>
<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= equations.length &lt;= 20</code></li>
	<li><code>equations[i].length == 2</code></li>
	<li><code>1 &lt;= A<sub>i</sub>.length, B<sub>i</sub>.length &lt;= 5</code></li>
	<li><code>values.length == equations.length</code></li>
	<li><code>0.0 &lt; values[i] &lt;= 20.0</code></li>
	<li><code>1 &lt;= queries.length &lt;= 20</code></li>
	<li><code>queries[i].length == 2</code></li>
	<li><code>1 &lt;= C<sub>j</sub>.length, D<sub>j</sub>.length &lt;= 5</code></li>
	<li><code>A<sub>i</sub>, B<sub>i</sub>, C<sub>j</sub>, D<sub>j</sub></code> consist of lower case English letters and digits.</li>
</ul>

### My Solution(s):

##### JavaScript

```js
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
```

##### PHP

```php
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
}
```

