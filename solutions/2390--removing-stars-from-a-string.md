### 2390. Removing Stars From a String

Difficulty: `Medium`

https://leetcode.com/problems/removing-stars-from-a-string/
<p>&nbsp;</p>

My Solution on LeetCode:
https://leetcode.com/discuss/topic/3402285/phpjavascript-beats-100/

<p>&nbsp;</p>


<p>You are given a string <code>s</code>, which contains stars <code>*</code>.</p>

<p>In one operation, you can:</p>

<ul>
	<li>Choose a star in <code>s</code>.</li>
	<li>Remove the closest <strong>non-star</strong> character to its <strong>left</strong>, as well as remove the star itself.</li>
</ul>

<p>Return <em>the string after <strong>all</strong> stars have been removed</em>.</p>

<p><strong>Note:</strong></p>

<ul>
	<li>The input will be generated such that the operation is always possible.</li>
	<li>It can be shown that the resulting string will always be unique.</li>
</ul>

<p>&nbsp;</p>
<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input:</strong> s = "leet**cod*e"
<strong>Output:</strong> "lecoe"
<strong>Explanation:</strong> Performing the removals from left to right:
- The closest character to the 1<sup>st</sup> star is 't' in "lee<strong><u>t</u></strong>**cod*e". s becomes "lee*cod*e".
- The closest character to the 2<sup>nd</sup> star is 'e' in "le<strong><u>e</u></strong>*cod*e". s becomes "lecod*e".
- The closest character to the 3<sup>rd</sup> star is 'd' in "leco<strong><u>d</u></strong>*e". s becomes "lecoe".
There are no more stars, so we return "lecoe".</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> s = "erase*****"
<strong>Output:</strong> ""
<strong>Explanation:</strong> The entire string is removed, so we return an empty string.
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= s.length &lt;= 10<sup>5</sup></code></li>
	<li><code>s</code> consists of lowercase English letters and stars <code>*</code>.</li>
	<li>The operation above can be performed on <code>s</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
/**
 * @param {string} s
 * @return {string}
 */
var removeStars = function (s) {
        let result = '';
        let backspaces = 0;

        for (let i = s.length; i--;) {
            if (s[i] === '*') {
                backspaces += 1;
            } else if (backspaces > 0) {
                backspaces -= 1;
            } else {
                result = s[i] + result;
            }
        }
        return result;
    };
```

##### PHP

```php
class Solution {
    /**
     * @param String $s
     * @return String
     */
    function removeStars($s) {
        $backspaceCount = 0;
        $result = '';
        $sLength = strlen($s);
        for($i = $sLength; $i--;){
            if($s[$i] === "*"){
                $backspaceCount++;
            }
            elseif($backspaceCount > 0){
                $backspaceCount--;
            }
            else{
                $result = $s[$i].$result;
            }
        }
        return $result;
    }
}
```

