<?php
//    278. First Bad Version
//    https://leetcode.com/problems/first-bad-version/
//    Easy
//    You are a product manager and currently leading a team to develop a new product. Unfortunately, the latest version of your product fails the quality check. Since each version is developed based on the previous version, all the versions after a bad version are also bad.
//    Suppose you have n versions [1, 2, ..., n] and you want to find out the first bad one, which causes all the following ones to be bad.
//    You are given an API bool isBadVersion(version) which returns whether version is bad. Implement a function to find the first bad version. You should minimize the number of calls to the API.
//
//    Example 1:
//    Input: n = 5, bad = 4
//    Output: 4
//    Explanation:
//    call isBadVersion(3) -> false
//    call isBadVersion(5) -> true
//    call isBadVersion(4) -> true
//    Then 4 is the first bad version.
//    Example 2:
//    Input: n = 1, bad = 1
//    Output: 1
//
//    Constraints:
//    1 <= bad <= n <= 231 - 1

/* The isBadVersion API is defined in the parent class VersionControl.
      public function isBadVersion($version){} */

class VersionControl
{
    // TEST CASE
    public function isBadVersion($version) {
        if ($version >= 4) return true;
        return false;
    }
}

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


$cases = [];
$cases[0]['Input']['n'] = 11;
$cases[0]['Output'] = 4;

$run = new Solution();
$result = $run->firstBadVersion($cases[0]['Input']['n']);
printResult($result, $cases[0]);


//foreach ($cases as $case) {
//    $result = $run->search($case['Input']['nums'], $case['Input']['target']);
//    printResult($result, $case);
//}

function printResult($result, $case) {
    echo '<pre>' . '--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    var_export($case['Output']);
    echo '</pre>' . PHP_EOL;
}
