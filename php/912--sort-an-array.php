<?php
// 912. Sort an Array
// https://leetcode.com/problems/sort-an-array/
// Medium
//Given an array of integers nums, sort the array in ascending order and return it.
//You must solve the problem without using any built-in functions in O(nlog(n)) time complexity and with the smallest space complexity possible.
//
//Example 1:
//Input: nums = [5,2,3,1]
//Output: [1,2,3,5]
//Explanation: After sorting the array, the positions of some numbers are not changed (for example, 2 and 3), while the positions of other numbers are changed (for example, 1 and 5).
//Example 2:
//Input: nums = [5,1,1,2,0,0]
//Output: [0,0,1,1,2,5]
//Explanation: Note that the values of nums are not necessairly unique.
//
//Constraints:
//1 <= nums.length <= 5 * 104
//-5 * 104 <= nums[i] <= 5 * 104

class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer[]
     */

    function sortArray(array $nums): array
    {
        $this->sortMerge($nums);
//        $nums = sortHeap($nums);
        return $nums;
    }

    // #1 Merge_Sorter
    function sortMerge(array &$array, $first = 0, $last = null): void
    {
        if (is_null($last)) $last = count($array) - 1;
        if ($first < $last) {
            $this->sortMerge($array, $first, floor(($first + $last) / 2));
            $this->sortMerge($array, floor(($first + $last) / 2) + 1, $last);

            $tmp = [];
            $middle = floor(($first + $last) / 2);
            $start = $first;
            $final = $middle + 1;
            for ($i = $first; $i <= $last; $i++) {
                if (($start <= $middle) && (($final > $last) || ($array[$start] < $array[$final]))) {
                    $tmp[$i] = $array[$start];
                    $start++;
                } else {
                    $tmp[$i] = $array[$final];
                    $final++;
                }
            }
            for ($i = $first; $i <= $last; $i++) {
                $array[$i] = $tmp[$i];
            }
        }
    }

    // #2 HEAP_Sorter
    function sortHeap(array $nums): array
    {
        $n = count($nums);
        for ($i = (int)($n / 2); $i >= 0; $i--) {
            $this->heapify($nums, $n - 1, $i);
        }
        for ($i = $n - 1; $i >= 0; $i--) {
            //swap last element of the max-heap with the first element
            list($nums[$i], $nums[0]) = array($nums[$i], $nums[$i]);
            //exclude the last element from the heap and rebuild the heap
            $this->heapify($nums, $i - 1, 0);
        }
        return $nums;
    }
    // heapify function is used to build the max heap.
    // max heap has maximum element at the root which means
    // first element of the array will be maximum in max heap
    function heapify(&$nums, $n, $i): void
    {
        $max = $i;
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;
        if ($left <= $n && $nums[$left] > $nums[$max]) $max = $left;
        if ($right <= $n && $nums[$right] > $nums[$max]) $max = $right;
        if ($max != $i) {
            list($nums[$i], $nums[$max]) = array($nums[$max], $nums[$i]);
            $this->heapify($nums, $n, $max);
        }
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['nums'] = [5, 1, 1, 2, 0, 0];
$cases[0]['expectedOutput'] = [0, 0, 1, 1, 2, 5];
$cases[1]['Input']['nums'] = [5, 2, 3, 1];
$cases[1]['expectedOutput'] = [1, 2, 3, 5];
// $cases[2]['Input']['nums'] = '';
// $cases[2]['Input'][''] = '';
// $cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['nums'] = '';
// $cases[3]['Input'][''] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['nums'] = '';
// $cases[4]['Input'][''] = '';
// $cases[4]['expectedOutput'] = '';
// Check solution
foreach ($cases as $case) {
    $solution = new Solution();
    $result = $solution->sortArray($case['Input']['nums']);
    echoResult($result, $case['expectedOutput']);
}
/**
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void
{
    echo PHP_EOL . '<pre>' . '--------' . PHP_EOL . 'Result:' . PHP_EOL;
    var_export($result);
    if ($result != $expectedOutput) {
        echo PHP_EOL . '!!! >>FAIL<< !!!';
        echo PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL;
        var_export($expectedOutput);
    } else echo ' << OK!' . PHP_EOL;
    echo '</pre>';
}