//  815. Bus Routes
//  https://leetcode.com/problems/bus-routes/
//  Hard
//  
//    You are given an array routes representing bus routes where routes[i] is a bus route that the ith bus repeats forever.
//    For example, if routes[0] = [1, 5, 7], this means that the 0th bus travels in the sequence 1 -&gt; 5 -&gt; 7 -&gt; 1 -&gt; 5 -&gt; 7 -&gt; 1 -&gt; ... forever.
//    You will start at the bus stop source (You are not on any bus initially), and you want to go to the bus stop target. You can travel between bus stops by buses only.
//    Return the least number of buses you must take to travel from source to target. Return -1 if it is not possible.
//    Example 1:
//    Input: routes = [[1,2,7],[3,6,7]], source = 1, target = 6
//    Output: 2
//    Explanation: The best strategy is take the first bus to the bus stop 7, then take the second bus to the bus stop 6.
//    Example 2:
//    Input: routes = [[7,12],[4,5,15],[6],[15,19],[9,12,13]], source = 15, target = 12
//    Output: -1
//    Constraints:
//    1 &lt;= routes.length &lt;= 500.
//    1 &lt;= routes[i].length &lt;= 105
//    All the values of routes[i] are unique.
//    sum(routes[i].length) &lt;= 105
//    0 &lt;= routes[i][j] &lt; 106
//    0 &lt;= source, target &lt; 106

/**
 * @param {number[][]} routes
 * @param {number} source
 * @param {number} target
 * @return {number}
 */
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