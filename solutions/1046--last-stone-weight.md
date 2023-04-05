### 1046. Last Stone Weight

Difficulty: `Easy`

https://leetcode.com/problems/last-stone-weight/

<p>You are given an array of integers <code>stones</code> where <code>stones[i]</code> is the weight of the <code>i<sup>th</sup></code> stone.</p>

<p>We are playing a game with the stones. On each turn, we choose the <strong>heaviest two stones</strong> and smash them together. Suppose the heaviest two stones have weights <code>x</code> and <code>y</code> with <code>x &lt;= y</code>. The result of this smash is:</p>

<ul>
	<li>If <code>x == y</code>, both stones are destroyed, and</li>
	<li>If <code>x != y</code>, the stone of weight <code>x</code> is destroyed, and the stone of weight <code>y</code> has new weight <code>y - x</code>.</li>
</ul>

<p>At the end of the game, there is <strong>at most one</strong> stone left.</p>

<p>Return <em>the weight of the last remaining stone</em>. If there are no stones left, return <code>0</code>.</p>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> stones = [2,7,4,1,8,1]
<strong>Output:</strong> 1
<strong>Explanation:</strong> 
We combine 7 and 8 to get 1 so the array converts to [2,4,1,1,1] then,
we combine 2 and 4 to get 2 so the array converts to [2,1,1,1] then,
we combine 2 and 1 to get 1 so the array converts to [1,1,1] then,
we combine 1 and 1 to get 0 so the array converts to [1] then that's the value of the last stone.
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> stones = [1]
<strong>Output:</strong> 1
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= stones.length &lt;= 30</code></li>
	<li><code>1 &lt;= stones[i] &lt;= 1000</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### PHP

```php
class Solution_____akunopaka__HEAP
{
    /**
     * @param Integer[] $stones
     * @return Integer
     */
    function lastStoneWeight($stones)
    {
        $heap = new SplMaxHeap();
        foreach ($stones as $stone) {
            $heap->insert($stone);
        }
        while (!$heap->isEmpty()) {
            // get two stones
            $stone1 = $heap->extract();
            if ($heap->isEmpty()) {
                // no remain stones
                return $stone1;
            }
            $stone2 = $heap->extract();
//            echo PHP_EOL . 'S1: ' . $stone1 . ' S2: ' . $stone2 . ' Remain: ' . ($stone1 - $stone2);
            if ($stone1 != $stone2) {
                $heap->insert($stone1 - $stone2);
            }
        }
        return 0;
    }
}
```

##### JavaScript

```js
var lastStoneWeight = function (stones) {
    while (stones.length > 1) {
        stones.sort((a, b) => a - b);
        let stone1 = stones.pop();
        let stone2 = stones.pop();
        if (stone1 === stone2) continue;
        else stones.push(stone1 - stone2);
    }
    return stones;
}
//-- OR --
var lastStoneWeight = function (stones) {
    // https://github.com/datastructures-js/priority-queue
    const queue = new MaxPriorityQueue();

    for (stone of stones) queue.enqueue(stone);

    while (queue.size() > 1) {
        let stone1 = queue.dequeue().element;
        let stone2 = queue.dequeue().element;
        if (stone1 !== stone2) queue.enqueue(stone1 - stone2);
    }

    return queue.size() === 0 ? 0 : queue.front().element;
};
```

