<?php
//  1964. Find the Longest Valid Obstacle Course at Each Position
//  https://leetcode.com/problems/find-the-longest-valid-obstacle-course-at-each-position/
//  Hard
//  
//    For every index i between 0 and n - 1 (inclusive), find the length of the longest obstacle course in obstacles such that:
//    You choose any number of obstacles between 0 and i inclusive.
//    You must include the ith obstacle in the course.
//    You must put the chosen obstacles in the same order as they appear in obstacles.
//    Every obstacle (except the first) is taller than or the same height as the obstacle immediately before it.
//    Return an array ans of length n, where ans[i] is the length of the longest obstacle course for index i as described above.
//    Example 1:
//    Input: obstacles = [1,2,3,2]
//    Output: [1,2,3,3]
//    Explanation: The longest valid obstacle course at each position is:
//    - i = 0: [1], [1] has length 1.
//    - i = 1: [1,2], [1,2] has length 2.
//    - i = 2: [1,2,3], [1,2,3] has length 3.
//    - i = 3: [1,2,3,2], [1,2,2] has length 3.
//    Example 2:
//    Input: obstacles = [2,2,1]
//    Output: [1,2,1]
//    Explanation: The longest valid obstacle course at each position is:
//    - i = 0: [2], [2] has length 1.
//    - i = 1: [2,2], [2,2] has length 2.
//    - i = 2: [2,2,1], [1] has length 1.
//    Example 3:
//    Input: obstacles = [3,1,5,6,4,2]
//    Output: [1,1,2,3,2,2]
//    Explanation: The longest valid obstacle course at each position is:
//    - i = 0: [3], [3] has length 1.
//    - i = 1: [3,1], [1] has length 1.
//    - i = 2: [3,1,5], [3,5] has length 2. [1,5] is also valid.
//    - i = 3: [3,1,5,6], [3,5,6] has length 3. [1,5,6] is also valid.
//    - i = 4: [3,1,5,6,4], [3,4] has length 2. [1,4] is also valid.
//    - i = 5: [3,1,5,6,4,2], [1,2] has length 2.
//    Constraints:
//    n == obstacles.length
//    1 &lt;= n &lt;= 105
//    1 &lt;= obstacles[i] &lt;= 107

class Solution
{
    /**
     * @param Integer[] $obstacles
     * @return Integer[]
     */
    function longestObstacleCourseAtEachPosition(array $obstacles): array {
        $dp = [];
        $res = [];
        foreach ($obstacles as $obstacle) {
            $index = $this->binarySearch($dp, $obstacle);
            $dp[$index] = $obstacle;
            $res[] = $index + 1;
        }
        return $res;
    }

    /**
     * @param array $arr
     * @param int $target
     * @return int
     */
    function binarySearch(array $arr, int $target): int {
        $left = 0;
        $right = count($arr) - 1;
        while ($left <= $right) {
            $mid = floor(($left + $right) / 2);
            if ($arr[$mid] <= $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }
        return $left;
    }
}