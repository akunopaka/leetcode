### 881. Boats to Save People

Difficulty: Medium

https://leetcode.com/problems/boats-to-save-people/

<p>You are given an array <code>people</code> where <code>people[i]</code> is the weight of the <code>i<sup>th</sup></code> person, and an <strong>infinite number of boats</strong> where each boat can carry a maximum weight of <code>limit</code>. Each boat carries at most two people at the same time, provided the sum of the weight of those people is at most <code>limit</code>.</p>
<p>Return <em>the minimum number of boats to carry every given person</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> people = [1,2], limit = 3
<strong>Output:</strong> 1
<strong>Explanation:</strong> 1 boat (1, 2)
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> people = [3,2,2,1], limit = 3
<strong>Output:</strong> 3
<strong>Explanation:</strong> 3 boats (1, 2), (2) and (3)
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> people = [3,5,3,4], limit = 5
<strong>Output:</strong> 4
<strong>Explanation:</strong> 4 boats (3), (3), (4), (5)
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= people.length &lt;= 5 * 10<sup>4</sup></code></li>
	<li><code>1 &lt;= people[i] &lt;= limit &lt;= 3 * 10<sup>4</sup></code></li>
</ul>

### My Solution(s):

##### JavaScript

```js

/**
 * Two pointer approach - move left and right pointers
 * @param {number[]} people
 * @param {number} limit
 * @return {number}
 */
var numRescueBoats = function (people, limit) {
    people.sort((a, b) => a - b);
    let leftPointer = 0;
    let rightPointer = people.length - 1;
    let boatsCount = 0;

    while (leftPointer <= rightPointer) {
        if (people[rightPointer] != limit && (people[rightPointer] + people[leftPointer]) <= limit) {
            leftPointer++;
        }
        rightPointer--;
        boatsCount++;
    }
    return boatsCount;
};

// -- OR --

/**
 * 1st attempt - shift and pop people array
 * Slow approach - shift and pop people array
 * @param {number[]} people
 * @param {number} limit
 * @return {number}
 */
var numRescueBoats__slow = function (people, limit) {
    people.sort((a, b) => a - b);

    let boatsCount = 0;

    while (people.length > 0) {
        let personOne = people.pop();
        if (personOne != limit && (personOne + people[0]) <= limit) {
            people.shift();
        }
        boatsCount++;
    }

    return boatsCount;
};
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[] $people
     * @param Integer $limit
     * @return Integer
     */
    function numRescueBoats($people, $limit) {
        // the idea is to collect the maximum sum to limit for each boat
        // two poiners approach
        // sort the array
        sort($people);
        // set the pointers
        $leftPointer = 0;
        $rightPointer = count($people) - 1;
        // set the counter
        $boatsCounter = 0;
        // loop until the pointers meet
        while ($leftPointer <= $rightPointer) {
            // we can always put the heaviest person in a boat
            // also we can put up to two people in a boat
            // So, if the sum of the two people is less than the limit
            if ($people[$leftPointer] + $people[$rightPointer] <= $limit) {
                // increment the left pointer
                $leftPointer++;
            }
            // decrement the right pointer
            $rightPointer--;
            // increment the boats counter
            $boatsCounter++;
        }
        // return the boats counter
        return $boatsCounter;
    }
}
```

### My Submission:


