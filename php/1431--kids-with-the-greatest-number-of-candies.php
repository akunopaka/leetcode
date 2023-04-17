<?php
//  1431. Kids With the Greatest Number of Candies
//  https://leetcode.com/problems/kids-with-the-greatest-number-of-candies/
//  Easy
//
//   My Solution on LeetCode:
//   https://leetcode.com/discuss/topic/3427322/phpjavascript-3-approaches/
//
//    There are n kids with candies. You are given an integer array candies, where each candies[i] represents the number of candies the ith kid has, and an integer extraCandies, denoting the number of extra candies that you have.
//    Return a boolean array result of length n, where result[i] is true if, after giving the ith kid all the extraCandies, they will have the greatest number of candies among all the kids, or false otherwise.
//    Note that multiple kids can have the greatest number of candies.
//    Example 1:
//    Input: candies = [2,3,5,1,3], extraCandies = 3
//    Output: [true,true,true,false,true] 
//    Explanation: If you give all extraCandies to:
//    - Kid 1, they will have 2 + 3 = 5 candies, which is the greatest among the kids.
//    - Kid 2, they will have 3 + 3 = 6 candies, which is the greatest among the kids.
//    - Kid 3, they will have 5 + 3 = 8 candies, which is the greatest among the kids.
//    - Kid 4, they will have 1 + 3 = 4 candies, which is not the greatest among the kids.
//    - Kid 5, they will have 3 + 3 = 6 candies, which is the greatest among the kids.
//    Example 2:
//    Input: candies = [4,2,1,1,2], extraCandies = 1
//    Output: [true,false,false,false,false] 
//    Explanation: There is only 1 extra candy.
//    Kid 1 will always have the greatest number of candies, even if a different kid is given the extra candy.
//    Example 3:
//    Input: candies = [12,1,12], extraCandies = 10
//    Output: [true,false,true]
//    Constraints:
//    n == candies.length
//    2 &lt;= n &lt;= 100
//    1 &lt;= candies[i] &lt;= 100
//    1 &lt;= extraCandies &lt;= 50

class Solution
{
    function kidsWithCandies(array $candies, int $extraCandies): array {
        $max = max($candies);
        return array_map(function ($candy) use ($max, $extraCandies) {
            return $max <= ($candy + $extraCandies);
        }, $candies);
    }
}

// -- OR --
class Solution2
{
    function kidsWithCandies(array $candies, int $extraCandies): array {
        $max = max($candies);
        $length = count($candies);
        $res = [];
        for ($i = 0; $i < $length; $i++) $res[] = $max <= ($candies[$i] + $extraCandies);
        return $res;
    }
}

// -- OR --
class Solution3
{
    function kidsWithCandies(array $candies, int $extraCandies): array {
        $max = max($candies);
        $res = [];
        foreach ($candies as $candy) $res[] = $max <= ($candy + $extraCandies);
        return $res;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['candies'] = [2, 3, 5, 1, 3];
$cases[0]['Input']['extraCandies'] = 3;
$cases[0]['expectedOutput'] = [true, true, true, false, true];
//$cases[1]['Input']['candies'] = '';
//$cases[1]['Input']['extraCandies'] = '';
//$cases[1]['expectedOutput'] = '';
// $cases[2]['Input']['candies'] = '';
// $cases[2]['Input']['extraCandies'] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['candies'] = '';
// $cases[3]['Input']['extraCandies'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['candies'] = '';
// $cases[4]['Input']['extraCandies'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->kidsWithCandies($case['Input']['candies'], $case['Input']['extraCandies']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}