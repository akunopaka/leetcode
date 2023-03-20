<?php
// https://leetcode.com/problems/can-place-flowers/description/
// 605. Can Place Flowers
// Easy
// You have a long flowerbed in which some of the plots are planted, and some are not. However, flowers cannot be planted in adjacent plots.
// Given an integer array flowerbed containing 0's and 1's, where 0 means empty and 1 means not empty, and an integer n, return if n new flowers can be planted in the flowerbed without violating the no-adjacent-flowers rule.
//
// Example 1:
// Input: flowerbed = [1,0,0,0,1], n = 1
// Output: true
// Example 2:
// Input: flowerbed = [1,0,0,0,1], n = 2
// Output: false
//
// Constraints:
// 1 <= flowerbed.length <= 2 * 104
// flowerbed[i] is 0 or 1.
// There are no two adjacent flowers in flowerbed.
// 0 <= n <= flowerbed.length

class Solution____2
{
    /**
     *  SOLUTION 3 - without modifying the input array
     * @param Integer[] $flowerbed
     * @param Integer $n
     * @return Boolean
     */
    function canPlaceFlowers($flowerbed, $n)
    {
        $count = 0;
        $flowerbedLength = count($flowerbed);
        for ($i = 0; $i <= $flowerbedLength; $i++) {
            if ($flowerbed[$i] == 0 &&
                $i < $flowerbedLength) {
                $count++;
                if ($i == 0) $count++;
                if ($i == $flowerbedLength - 1) $count++;
            } else {
                $n -= intdiv($count - 1, 2);
                if ($n <= 0) return true;
                $count = 0;
            }
        }
        return false;
    }
}