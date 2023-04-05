### 299. Bulls and Cows

Difficulty: `Medium`

https://leetcode.com/problems/bulls-and-cows/


<p>You are playing the <strong><a href="https://en.wikipedia.org/wiki/Bulls_and_Cows" target="_blank">Bulls and Cows</a></strong> game with your friend.</p>

<p>You write down a secret number and ask your friend to guess what the number is. When your friend makes a guess, you provide a hint with the following info:</p>

<ul>
	<li>The number of "bulls", which are digits in the guess that are in the correct position.</li>
	<li>The number of "cows", which are digits in the guess that are in your secret number but are located in the wrong position. Specifically, the non-bull digits in the guess that could be rearranged such that they become bulls.</li>
</ul>
<p>Given the secret number <code>secret</code> and your friend's guess <code>guess</code>, return <em>the hint for your friend's guess</em>.</p>
<p>The hint should be formatted as <code>"xAyB"</code>, where <code>x</code> is the number of bulls and <code>y</code> is the number of cows. Note that both <code>secret</code> and <code>guess</code> may contain duplicate digits.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> secret = "1807", guess = "7810"
<strong>Output:</strong> "1A3B"
<strong>Explanation:</strong> Bulls are connected with a '|' and cows are underlined:
"1807"
  |
"<u>7</u>8<u>10</u>"</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> secret = "1123", guess = "0111"
<strong>Output:</strong> "1A1B"
<strong>Explanation:</strong> Bulls are connected with a '|' and cows are underlined:
"1123"        "1123"
  |      or     |
"01<u>1</u>1"        "011<u>1</u>"
Note that only one of the two unmatched 1s is counted as a cow since the non-bull digits can only be rearranged to allow one 1 to be a bull.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= secret.length, guess.length &lt;= 1000</code></li>
	<li><code>secret.length == guess.length</code></li>
	<li><code>secret</code> and <code>guess</code> consist of digits only.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### PHP

```php
class Solution
{
    function getHint($secret, $guess)
    {
        $bulls = 0; // correct position
        $cows = 0;  // located in the wrong position
        $length = strlen($secret);
        for ($i = 0; $i < $length; $i++) {
            if ($secret[$i] == $guess[$i]) $bulls++;
        }
        $s = count_chars($secret, 1);
        $g = count_chars($guess, 1);
        foreach (array_intersect_key($s, $g) as $charN => $freq) {
            $cows += min($s[$charN], $g[$charN]);
        }
        $cows -= $bulls;
        return $bulls . 'A' . $cows . 'B';
    }
}


// -- OR in one iteration --
class Solution {
    function getHint($secret, $guess) {
        $bulls = 0;
        $cows = 0;
        $counts = array_fill(0, 10, 0);
        for ($i = 0; $i < strlen($secret); $i++) {
            if ($secret[$i] == $guess[$i]) {
                $bulls++;
            } else {
                if ($counts[$secret[$i]]++ < 0) {
                    $cows++;
                }
                if ($counts[$guess[$i]]-- > 0) {
                    $cows++;
                }
            }
        }

        return "{$bulls}A{$cows}B";
    }
}
```

##### JavaScript

```js
var getHint = function (secret, guess) {
    let bulls = 0;
    let cows = 0;
    let length = secret.length;
    for (let i = 0; i < length; i++) {
        if (secret[i] == guess[i]) bulls++;
    }
    let s = new Map();
    let g = new Map();
    for (let i = 0; i < length; i++) {
        if (s.has(secret[i])) {
            s.set(secret[i], s.get(secret[i]) + 1);
        } else {
            s.set(secret[i], 1);
        }
        if (g.has(guess[i])) {
            g.set(guess[i], g.get(guess[i]) + 1);
        } else {
            g.set(guess[i], 1);
        }
    }
    for (let [key, value] of s) {
        if (g.has(key)) cows += Math.min(s.get(key), g.get(key));
    }
    cows -= bulls;
    return bulls + 'A' + cows + 'B';
};


// -- OR in one iteration --
var getHint = function (secret, guess) {
    var bull = 0;
    var cow = 0;
    // var map = {};
    // for (var i = 0; i < 10; i++) map[i] = 0;
    const map = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    const secretLength = secret.length;
    for (let i = 0; i < secretLength; i++) {
        if (secret[i] === guess[i]) bull++;
        else {
            map[secret[i]]++;
            map[guess[i]]--;
            if (map[secret[i]] <= 0) cow++;
            if (map[guess[i]] >= 0) cow++;
            // cow += map[secret[i]] <= 0 ? 1 : 0;
            // cow += map[guess[i]] >= 0 ? 1 : 0;
        }
    }
    return `${bull}A${cow}B`;
};

```
