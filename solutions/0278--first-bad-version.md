### 278. First Bad Version

Difficulty: `Easy`

https://leetcode.com/problems/first-bad-version/

<p>You are a product manager and currently leading a team to develop a new product. Unfortunately, the latest version of your product fails the quality check. Since each version is developed based on the previous version, all the versions after a bad version are also bad.</p>
<p>Suppose you have <code>n</code> versions <code>[1, 2, ..., n]</code> and you want to find out the first bad one, which causes all the following ones to be bad.</p>
<p>You are given an API <code>bool isBadVersion(version)</code> which returns whether <code>version</code> is bad. Implement a function to find the first bad version. You should minimize the number of calls to the API.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> n = 5, bad = 4
<strong>Output:</strong> 4
<strong>Explanation:</strong>
call isBadVersion(3) -&gt; false
call isBadVersion(5)&nbsp;-&gt; true
call isBadVersion(4)&nbsp;-&gt; true
Then 4 is the first bad version.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> n = 1, bad = 1
<strong>Output:</strong> 1
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= bad &lt;= n &lt;= 2<sup>31</sup> - 1</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
var solution = function (isBadVersion) {
    /**
     * @param {integer} n Total versions
     * @return {integer} The first bad version
     */
    return function (n) {
        let left = 1;
        let right = n;
        while (left < right) {
            let mid = Math.floor((left + right) / 2);
            if (isBadVersion(mid)) {
                right = mid;
            } else {
                left = mid + 1;
            }
        }
        return left;
    }
};
```

##### PHP

```php
class Solution extends VersionControl
{
    /**
     * @param Integer $n
     * @return Integer
     */
    function firstBadVersion(int $n): int {
        $leftVersion = 1;
        $rightVersion = $n;
        while ($leftVersion < $rightVersion) {
            $mid = floor(($leftVersion + $rightVersion) / 2);
            if ($this->isBadVersion($mid)) {
                $rightVersion = $mid;
            } else {
                $leftVersion = $mid + 1;
            }
        }
        return $leftVersion;
    }
}

-- OR --

class Solution extends VersionControl {
    /**
     * @param Integer $n
     * @return Integer
     */
    function firstBadVersion($n) : int{
        $leftGoodVersion = 1;
        $rightBadVersion = $n;
        $lowestBadVersion = $rightBadVersion;
        while ($leftGoodVersion<=$rightBadVersion){
            $midVersion = floor(($leftGoodVersion + $rightBadVersion) / 2);
            if($this->isBadVersion($midVersion)){
                $lowestBadVersion = $midVersion;
                $rightBadVersion = $midVersion-1;
            }
            else{
                $leftGoodVersion = $midVersion+1;
            }
        }
        return $lowestBadVersion;
    }
}
  
```
