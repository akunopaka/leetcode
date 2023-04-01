<?php
//    704. Binary Search
//    https://leetcode.com/problems/binary-search/
//    Easy
//    Given an array of integers nums which is sorted in ascending order, and an integer target, write a function to search target in nums. If target exists, then return its index. Otherwise, return -1.
//    You must write an algorithm with O(log n) runtime complexity.
//
//    Example 1:
//    Input: nums = [-1,0,3,5,9,12], target = 9
//    Output: 4
//    Explanation: 9 exists in nums and its index is 4
//    Example 2:
//    Input: nums = [-1,0,3,5,9,12], target = 2
//    Output: -1
//    Explanation: 2 does not exist in nums so return -1
//    Constraints:
//    1 <= nums.length <= 104
//    -104 < nums[i], target < 104
//    All the integers in nums are unique.
//    nums is sorted in ascending order.

class Solution
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search(array $nums, int $target): int
    {
        if (!in_array($target, $nums)) return -1;
        $left = 0;
        $right = count($nums) - 1;
        while ($left <= $right) {
            $mid = round(($left + $right) / 2);
            if ($nums[$mid] > $target) {
                $right = $mid - 1;
            } elseif ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else {
                return $mid;
            }
        }
        return -1;
    }
}

class Solution____akuno
{

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search(array $nums, int $target): int
    {
        if ($nums == null) return (int)-1;
        $res = $this->getIndex($nums, $target, 0);
        return (int)$res;
    }

    function getIndex($nums, $target, $offset = 0)
    {
        if (!in_array($target, $nums)) return -1;
        $index = -1;
        $length = count($nums);
        if ($length == 1 && $nums[0] != $target) {
            return (int)-1;
        } elseif ($length == 1 && $nums[0] == $target) {
            return $offset;
        }
        $mid = floor($length / 2);
        if ($nums[$mid] == $target) {
            return $mid + $offset;
        } else if ($nums[$mid] > $target) {
            $index = $this->getIndex(array_slice($nums, 0, $mid), $target, $offset);
        } else {
            $index = $this->getIndex(array_slice($nums, $mid), $target, $mid + $offset);
        }
        return $index;
    }
}


$cases = [];
$cases[0]['Input']['nums'] = [-1, 0, 3, 5, 9, 12];
$cases[0]['Input']['target'] = 12;
$cases[0]['Output'] = 5;
$cases[1]['Input']['nums'] = [-997, -995, -994, -991, -986, -984, -982, -981, -980, -978, -975, -973, -972, -970, -968, -967, -966, -962, -961, -960, -959, -958, -954, -953, -952, -950, -947, -946, -945, -944, -943, -942, -941, -773, -772, -770, -767, -766, -763, -762, -759, -757, -751, -750, -748, -744, -743, -741, -740, -738, -737, -736, -733, -729, -727, -726, -725, -724, -723, -720, -718, -716, -715, -714, -710, -709, -703, -702, -701, -699, -698, -695, -694, -693, -690, -688, -686, -685, -682, -681, -680, -678, -674, -673, -672, -670, -668, -667, -666, -661, -657, -656, -655, -653, -651, -650, -646, -645, -644, -643, -642, -636, -635, -634, -633, -632, -631, -630, -629, -627, -626, -625, -624, -623, 0, 122, 988, 989, 990, 991, 992, 993, 994, 995, 996, 997, 1001, 1002, 1003, 1004];
$cases[1]['Input']['target'] = 988;
$cases[1]['Output'] = -1;


$run = new Solution();
foreach ($cases as $case) {
    $result = $run->search($case['Input']['nums'], $case['Input']['target']);
    printResult($result, $case);
}

function printResult($result, $case)
{
    echo '<pre>' . '--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    var_export($case['Output']);
    echo '</pre>' . PHP_EOL;
}
