### 1406. Stone Game III

Difficulty: `Hard`

https://leetcode.com/problems/stone-game-iii/description/


<p>Alice and Bob take turns, with Alice starting first. On each player's turn, that player can take <code>1</code>, <code>2</code>, or <code>3</code> stones from the <strong>first</strong> remaining stones in the row.</p>
<p>The score of each player is the sum of the values of the stones taken. The score of each player is <code>0</code> initially.</p>
<p>The objective of the game is to end with the highest score, and the winner is the player with the highest score and there could be a tie. The game continues until all the stones have been taken.</p>
<p>Assume Alice and Bob <strong>play optimally</strong>.</p>
<p>Return <code>"Alice"</code><em> if Alice will win, </em><code>"Bob"</code><em> if Bob will win, or </em><code>"Tie"</code><em> if they will end the game with the same score</em>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> values = [1,2,3,7]
    <strong>Output:</strong> "Bob"
<strong>Explanation:</strong> Alice will always lose. Her best move will be to take three piles and the score become 6. Now the score of Bob is 7 and Bob wins.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> values = [1,2,3,-9]
    <strong>Output:</strong> "Alice"
<strong>Explanation:</strong> Alice must choose all the three piles at the first move to win and leave Bob with negative score.
If Alice chooses one pile her score will be 1 and the next move Bob's score becomes 5. In the next move, Alice will take the pile with value = -9 and lose.
If Alice chooses two piles her score will be 3 and the next move Bob's score becomes 3. In the next move, Alice will take the pile with value = -9 and also lose.
Remember that both play optimally so here Alice will choose the scenario that makes her win.
</pre>
<p><strong class="example">Example 3:</strong></p>
<pre><strong>Input:</strong> values = [1,2,3,6]
    <strong>Output:</strong> "Tie"
<strong>Explanation:</strong> Alice cannot win this game. She can end the game in a draw if she decided to choose all the first three piles, otherwise she will lose.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= stoneValue.length &lt;= 5 * 10<sup>4</sup></code></li>
	<li><code>-1000 &lt;= stoneValue[i] &lt;= 1000</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
const stoneGameIII = function (stoneValue) {
    let n = stoneValue.length;
    let dp = new Array(n + 1).fill(0);

    for (let i = n - 1; i >= 0; i--) {
        dp[i] = stoneValue[i] - dp[i + 1];
        if (i + 2 <= n) {
            dp[i] = Math.max(dp[i], stoneValue[i] + stoneValue[i + 1] - dp[i + 2]);
        }
        if (i + 3 <= n) {
            dp[i] = Math.max(dp[i], stoneValue[i] + stoneValue[i + 1] + stoneValue[i + 2] - dp[i + 3]);
        }
    }

    if (dp[0] > 0) {
        return "Alice";
    } else if (dp[0] < 0) {
        return "Bob";
    }
    return "Tie";
}
```

##### PHP

```php
class Solution
{
    /**
     * @param Integer[] $stoneValue
     * @return String
     */
    function stoneGameIII(array $stoneValue): string {
        $n = count($stoneValue);
        $dp = array_fill(0, $n + 1, 0);
        for ($i = $n; $i--;) {
            $dp[$i] = $stoneValue[$i] - $dp[$i + 1];
            if ($i + 2 <= $n) {
                $dp[$i] = max($dp[$i], $stoneValue[$i] + $stoneValue[$i + 1] - $dp[$i + 2]);
            }
            if ($i + 3 <= $n) {
                $dp[$i] = max($dp[$i], $stoneValue[$i] + $stoneValue[$i + 1] + $stoneValue[$i + 2] - $dp[$i + 3]);
            }
        }
        if ($dp[0] > 0) {
            return "Alice";
        }
        if ($dp[0] < 0) {
            return "Bob";
        }
        return "Tie";
    }
}
```

