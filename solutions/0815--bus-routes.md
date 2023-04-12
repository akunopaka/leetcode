### 815. Bus Routes

Difficulty: `Hard`

https://leetcode.com/problems/bus-routes/



<p>You are given an array <code>routes</code> representing bus routes where <code>routes[i]</code> is a bus route that the <code>i<sup>th</sup></code> bus repeats forever.</p>
<ul>
	<li>For example, if <code>routes[0] = [1, 5, 7]</code>, this means that the <code>0<sup>th</sup></code> bus travels in the sequence <code>1 -&gt; 5 -&gt; 7 -&gt; 1 -&gt; 5 -&gt; 7 -&gt; 1 -&gt; ...</code> forever.</li>
</ul>
<p>You will start at the bus stop <code>source</code> (You are not on any bus initially), and you want to go to the bus stop <code>target</code>. You can travel between bus stops by buses only.</p>
<p>Return <em>the least number of buses you must take to travel from </em><code>source</code><em> to </em><code>target</code>. Return <code>-1</code> if it is not possible.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> routes = [[1,2,7],[3,6,7]], source = 1, target = 6
<strong>Output:</strong> 2
<strong>Explanation:</strong> The best strategy is take the first bus to the bus stop 7, then take the second bus to the bus stop 6.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> routes = [[7,12],[4,5,15],[6],[15,19],[9,12,13]], source = 15, target = 12
<strong>Output:</strong> -1
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= routes.length &lt;= 500</code>.</li>
	<li><code>1 &lt;= routes[i].length &lt;= 10<sup>5</sup></code></li>
	<li>All the values of <code>routes[i]</code> are <strong>unique</strong>.</li>
	<li><code>sum(routes[i].length) &lt;= 10<sup>5</sup></code></li>
	<li><code>0 &lt;= routes[i][j] &lt; 10<sup>6</sup></code></li>
	<li><code>0 &lt;= source, target &lt; 10<sup>6</sup></code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var numBusesToDestination = function (routes, source, target) {
    if (source === target) return 0;

    // Create a map of bus stops to buses
    let stops = new Map();
    for (let busRouteID = 0; busRouteID < routes.length; busRouteID++) {
        for (let stopID = 0; stopID < routes[busRouteID].length; stopID++) {
            if (stops.has(routes[busRouteID][stopID])) {
                stops.get(routes[busRouteID][stopID]).push(busRouteID);
            } else {
                stops.set(routes[busRouteID][stopID], [busRouteID]);
            }
        }
    }

    // Create a queue for BFS
    let queue = new Set();
    let visited = new Set();

    // Add all buses that can take us to source
    for (let busRouteID of stops.get(source)) {
        queue.add(busRouteID);
        visited.add(busRouteID);
    }

    // BFS
    let busCount = 1;
    while (queue.size > 0) {
        let nextQueue = new Set();
        for (let busRouteID of queue) {
            for (let stop of routes[busRouteID]) {
                if (stop === target) return busCount;
                for (let nextBus of stops.get(stop)) {
                    if (!visited.has(nextBus)) {
                        nextQueue.add(nextBus);
                        visited.add(nextBus);
                    }
                }
            }
        }
        queue = nextQueue;
        busCount++;
    }
    return -1;
};
```

##### PHP

```php
}class Solution
{
    /**
     * @param Integer[][] $routes
     * @param Integer $source
     * @param Integer $target
     * @return Integer
     */
    function numBusesToDestination(array $routes, int $source, int $target): int {
        if ($source === $target) return 0;

        $stops = [];
        $routesCount = count($routes);
        for ($i = 0; $i < $routesCount; $i++) {
            $stopsCount = count($routes[$i]);
            for ($j = 0; $j < $stopsCount; $j++) {
                // add route to stop with route index as value
                $stops[$routes[$i][$j]][] = $i;
            }
        }

        $queue = [];
        $visited = [];
        // add all routes that have source
        foreach ($stops[$source] as $route) {
            $queue[] = $route;
            $visited[$route] = true;
        }

        // BFS
        $stopCount = 0;
        while (!empty($queue)) {
            // increment stop count
            $stopCount++;
            $queueSize = count($queue);
            // loop through queue
            for ($i = 0; $i < $queueSize; $i++) {
                $route = array_shift($queue);
                foreach ($routes[$route] as $stop) {
                    if ($stop === $target) return $stopCount;
                    foreach ($stops[$stop] as $nextRoute) {
                        if (!isset($visited[$nextRoute])) {
                            $visited[$nextRoute] = true;
                            $queue[] = $nextRoute;
                        }
                    }
                }
            }
        }
        return -1;
    }
}
```

