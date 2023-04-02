### 121. Best Time to Buy and Sell Stock

Easy

https://leetcode.com/problems/best-time-to-buy-and-sell-stock/description/

<p>You are given an array <code>prices</code> where <code>prices[i]</code> is the price of a given stock on the <code>i<sup>th</sup></code> day.</p>
<p>You want to maximize your profit by choosing a <strong>single day</strong> to buy one stock and choosing a <strong>different day in the future</strong> to sell that stock.</p>
<p>Return <em>the maximum profit you can achieve from this transaction</em>. If you cannot achieve any profit, return <code>0</code>.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> prices = [7,1,5,3,6,4]
<strong>Output:</strong> 5
<strong>Explanation:</strong> Buy on day 2 (price = 1) and sell on day 5 (price = 6), profit = 6-1 = 5.
Note that buying on day 2 and selling on day 1 is not allowed because you must buy before you sell.
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> prices = [7,6,4,3,1]
<strong>Output:</strong> 0
<strong>Explanation:</strong> In this case, no transactions are done and the max profit = 0.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= prices.length &lt;= 10<sup>5</sup></code></li>
	<li><code>0 &lt;= prices[i] &lt;= 10<sup>4</sup></code></li>
</ul>

### My Solution

##### JavaScript

```js
var maxProfit = function (prices) {
    let minPrice = Infinity;
    let maxP = 0;
    for (let i = 0; i < prices.length; i++) {
        if (prices[i] < minPrice) {
            minPrice = prices[i]
        } else {
            maxP = Math.max(maxP, prices[i] - minPrice)
        }
    }
    return maxP;
}
//-- OR --
var maxProfit = function (prices) {
    let minPrice = prices[0];
    let profit = 0;
    for (let i = 0; i < prices.length; i++) {
        if (minPrice > prices[i]) {
            minPrice = prices[i];
        } else if (profit < (prices[i] - minPrice)) {
            profit = prices[i] - minPrice;
        }
    }
    return profit;
};
```

##### PHP

```php
class Solution {
    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        if(!$prices) return 0;
        $maxProfit = 0;
        $minPrice = $prices[0];
        $count = count($prices);
        for($i=1; $i < $count; $i++){
            if($prices[$i]<$minPrice) $minPrice = $prices[$i];
            elseif($maxProfit<($prices[$i] - $minPrice) ){
                $maxProfit  = $prices[$i] - $minPrice;
            }

        }
        return $maxProfit;
    }
}
//-- OR --
class Solution {
    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        if(!$prices) return 0;
        $maxProfit = 0;
        $minPrice = $prices[0];
        for($i=1; $i < count($prices); $i++){
                $minPrice = min($prices[$i], $minPrice);
                $maxProfit = max($maxProfit, ($prices[$i] - $minPrice));
        }
        return $maxProfit;
    }
}
```






