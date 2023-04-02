### 2300. Successful Pairs of Spells and Potions

Medium\
https://leetcode.com/problems/successful-pairs-of-spells-and-potions/

<p>You are given two positive integer arrays <code>spells</code> and <code>potions</code>, of length <code>n</code> and <code>m</code> respectively, where <code>spells[i]</code> represents the strength of the <code>i<sup>th</sup></code> spell and <code>potions[j]</code> represents the strength of the <code>j<sup>th</sup></code> potion.</p>
<p>You are also given an integer <code>success</code>. A spell and potion pair is considered <strong>successful</strong> if the <strong>product</strong> of their strengths is <strong>at least</strong> <code>success</code>.</p>
<p>Return <em>an integer array </em><code>pairs</code><em> of length </em><code>n</code><em> where </em><code>pairs[i]</code><em> is the number of <strong>potions</strong> that will form a successful pair with the </em><code>i<sup>th</sup></code><em> spell.</em></p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> spells = [5,1,3], potions = [1,2,3,4,5], success = 7
<strong>Output:</strong> [4,0,3]
<strong>Explanation:</strong>
- 0<sup>th</sup> spell: 5 * [1,2,3,4,5] = [5,<u><strong>10</strong></u>,<u><strong>15</strong></u>,<u><strong>20</strong></u>,<u><strong>25</strong></u>]. 4 pairs are successful.
- 1<sup>st</sup> spell: 1 * [1,2,3,4,5] = [1,2,3,4,5]. 0 pairs are successful.
- 2<sup>nd</sup> spell: 3 * [1,2,3,4,5] = [3,6,<u><strong>9</strong></u>,<u><strong>12</strong></u>,<u><strong>15</strong></u>]. 3 pairs are successful.
Thus, [4,0,3] is returned.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> spells = [3,1,2], potions = [8,5,8], success = 16
<strong>Output:</strong> [2,0,2]
<strong>Explanation:</strong>
- 0<sup>th</sup> spell: 3 * [8,5,8] = [<u><strong>24</strong></u>,15,<u><strong>24</strong></u>]. 2 pairs are successful.
- 1<sup>st</sup> spell: 1 * [8,5,8] = [8,5,8]. 0 pairs are successful. 
- 2<sup>nd</sup> spell: 2 * [8,5,8] = [<strong><u>16</u></strong>,10,<u><strong>16</strong></u>]. 2 pairs are successful. 
Thus, [2,0,2] is returned.
</pre>
<strong>Constraints:</strong>
<ul>
	<li><code>n == spells.length</code></li>
	<li><code>m == potions.length</code></li>
	<li><code>1 &lt;= n, m &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= spells[i], potions[i] &lt;= 10<sup>5</sup></code></li>
	<li><code>1 &lt;= success &lt;= 10<sup>10</sup></code></li>
</ul>
<p>&nbsp;</p>

##### PHP

```php
class Solution
{
    /**
     * @param Integer[] $spells
     * @param Integer[] $potions
     * @param Integer $success
     * @return Integer[]
     */
    function successfulPairs(array $spells, array $potions, int $success): array {
        $pairsResult = [];
        $potionsCount = count($potions);
        $spellsCount = count($spells);
        sort($potions);
        // binary search
        for ($i = 0; $i < $spellsCount; $i++) {
            $left = 0;
            $right = $potionsCount - 1;
            while ($left <= $right) {
                $mid = ($left + $right) >> 1;
                if ($spells[$i] * $potions[$mid] >= $success) {
                    $right = $mid - 1;
                } else {
                    $left = $mid + 1;
                }
            }
            $pairsResult[$i] = $potionsCount - $left;
        }
        return $pairsResult;
    }
}
```

```php
// 2nd solution - with optimization - $maxSpellValueWithZeroSuccess
class Solution
{
    /**
     * @param Integer[] $spells
     * @param Integer[] $potions
     * @param Integer $success
     * @return Integer[]
     */
    function successfulPairs(array $spells, array $potions, int $success): array {
        $pairsResult = [];
        $potionsCount = count($potions);
        $spellsCount = count($spells);
        $maxSpellValueWithZeroSuccess = 0;
        sort($potions);
        // binary search
        for ($i = 0; $i < $spellsCount; $i++) {
            if ($spells[$i] > $maxSpellValueWithZeroSuccess) {
                $left = 0;
                $right = $potionsCount - 1;
                while ($left <= $right) {
                    $mid = ($left + $right) >> 1;
                    if ($spells[$i] * $potions[$mid] >= $success) {
                        $right = $mid - 1;
                    } else {
                        $left = $mid + 1;
                    }
                }
                $pairsResult[$i] = $potionsCount - $left;
                if ($pairsResult[$i] == 0) $maxSpellValueWithZeroSuccess = $spells[$i];
            } else {
                $pairsResult[$i] = 0;
            }
        }
        return $pairsResult;
    }
}
```

##### JavaScript

```js
// solution - brute force approach O(n*m) - don't use it
/**
 * brute force approach O(n*m)
 * @param {number[]} spells
 * @param {number[]} potions
 * @param {number} success
 * @return {number[]}
 */
var successfulPairs = function (spells, potions, success) {
    const pairs = [];

    // spells = [3,1,2], potions = [8,5,8], success = 16
    potions.sort((a, b) => a - b);
    const spellsLength = spells.length;
    const potionsLength = potions.length;

    for (let i = 0; i < spellsLength; i++) {
        let count = 0;
        for (let j = 0; j < potionsLength; j++) {
            if (spells[i] * potions[j] >= success) {
                count = potionsLength - j;
                break;
            }
        }
        pairs.push(count);
    }
    return pairs;
};
```

```js
// solution - binary search approach O((n+m)*log(m))
/**
 * binary search approach O((n+m)*log(m))
 * @param {number[]} spells
 * @param {number[]} potions
 * @param {number} success
 * @return {number[]}
 */
var successfulPairs = function (spells, potions, success) {
    const pairs = [];
    potions.sort((a, b) => a - b);
    const spellsLength = spells.length;
    const potionsLength = potions.length;

    for (let i = 0; i < spellsLength; i++) {
        let count = 0;
        // binary search
        let left = 0;
        let right = potionsLength - 1;
        while (left <= right) {
            // const mid = Math.floor((left + right) / 2);
            const mid = (left + right) >> 1;
            if (spells[i] * potions[mid] >= success) {
                right = mid - 1;
            } else {
                left = mid + 1;
            }
        }
        count = potionsLength - left;
        pairs.push(count);
    }
    return pairs;
};
```

```js
// solution - binary search approach with small optimization
/**
 * binary search approach with optimization
 * @param {number[]} spells
 * @param {number[]} potions
 * @param {number} success
 * @return {number[]}
 */
var successfulPairs = function (spells, potions, success) {
    const pairs = [];
    potions.sort((a, b) => a - b);
    const spellsLength = spells.length;
    const potionsLength = potions.length;

    let maxSpellValueWithZeroSuccess = 0; // Optimize 1 -  max value of a spell that will never be successful

    for (let i = 0; i < spellsLength; i++) {
        let count = 0;
        // // Optimize 2 - save and reuse success result with the same spell value
        // // search spells[i] spell value in the previous spells
        // let cacheResultIndex = spells.indexOf(spells[i]);
        // if (cacheResultIndex !== -1 && cacheResultIndex < i) {
        //     count = pairs[cacheResultIndex];
        //
        // } else {
        //     cacheResultIndex = -1;
        // }

        // Optimize 1 - skip if the spell value is less than the max value of a spell that will never be successful
        // if (cacheResultIndex === -1 && spells[i] > maxSpellValueWithZeroSuccess) {
        if (spells[i] > maxSpellValueWithZeroSuccess) {
            // binary search
            let left = 0;
            let right = potionsLength - 1;
            while (left <= right) {
                // const mid = Math.floor((left + right) / 2);
                const mid = (left + right) >> 1;
                if (spells[i] * potions[mid] >= success) {
                    right = mid - 1;
                } else {
                    left = mid + 1;
                }
            }
            count = potionsLength - left;
            if (count == 0) maxSpellValueWithZeroSuccess = spells[i];
        }
        pairs.push(count);
    }
    return pairs;
};
```