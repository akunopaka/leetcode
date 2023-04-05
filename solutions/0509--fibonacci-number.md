### 509. Fibonacci Number

Difficulty: `Easy`

https://leetcode.com/problems/fibonacci-number/description/

### My Solution(s):

##### JavaScript

```js
var fib = function (n) {
//    const answersLOL = [0,1,1,2,3,5,8,13,21,34,55,89,144,233,377,610,987,1597,2584,4181,6765,10946,17711,28657,46368,75025,121393,196418,317811,514229,832040];
//    return answersLOL[n];

    if (n == 0 || n == 1) return n;
    const cache = [0, 1];
    for (let i = 2; i <= n; i++) {
        cache[2] = cache[1] + cache[0];
        cache.shift();
    }
    return cache[1];
};

```

##### PHP

```php
class Solution
{
    /**
     * @param Integer $n
     * @return Integer
     */
    function fib(int $n): int
    {
        if ($n == 0 || $n == 1) return $n;
        $cache = [0, 1];
        for ($i = 2; $i <= $n; $i++) {
            $cache[2] = $cache[0] + $cache[1];
            array_shift($cache);
        }
        return $cache[1];
    }
}
//-- OR --
class Solution
{
    /**
     * @param Integer $n
     * @return Integer
     */
    function fib(int $n): int
    {
        // Constraints: 0 <= n <= 30
        // $answersLOL = [0,1,1,2,3,5,8,13,21,34,55,89,144,233,377,610,987,1597,2584,4181,6765,10946,17711,28657,46368,75025,121393,196418,317811,514229,832040];
        // return $answersLOL[$n];

        if ($n == 0 || $n == 1) return $n;
         $fPrev1 = 0;
         $fPrev2 = 1;
         for($i=2; $i<=$n; $i++){
            $fibonacci = $fPrev1 + $fPrev2;
            $fPrev1 = $fPrev2;
            $fPrev2 = $fibonacci;
         }
         return $fibonacci;
    }
}
```
