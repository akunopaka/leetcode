<?php
// 733. Flood Fill
// https://leetcode.com/problems/flood-fill/?envType=study-plan&id=level-1
// Easy
// My Solution on LeetCode: https://leetcode.com/discuss/topic/3384143/phpjavascript-recursive-approach/
//    An image is represented by an m x n integer grid image where image[i][j] represents the pixel value of the image.
//    You are also given three integers sr, sc, and color. You should perform a flood fill on the image starting from the pixel image[sr][sc].
//    To perform a flood fill, consider the starting pixel, plus any pixels connected 4-directionally to the starting pixel of the same color as the starting pixel, plus any pixels connected 4-directionally to those pixels (also with the same color), and so on. Replace the color of all of the aforementioned pixels with color.
//    Return the modified image after performing the flood fill.
//
//    Example 1:
//    Input: image = [[1,1,1],[1,1,0],[1,0,1]], sr = 1, sc = 1, color = 2
//    Output: [[2,2,2],[2,2,0],[2,0,1]]
//    Explanation: From the center of the image with position (sr, sc) = (1, 1) (i.e., the red pixel), all pixels connected by a path of the same color as the starting pixel (i.e., the blue pixels) are colored with the new color.
//    Note the bottom corner is not colored 2, because it is not 4-directionally connected to the starting pixel.
//    Example 2:
//    Input: image = [[0,0,0],[0,0,0]], sr = 0, sc = 0, color = 0
//    Output: [[0,0,0],[0,0,0]]
//    Explanation: The starting pixel is already colored 0, so no changes are made to the image.
//
//    Constraints:
//    m == image.length
//    n == image[i].length
//    1 <= m, n <= 50
//    0 <= image[i][j], color < 216
//    0 <= sr < m
//    0 <= sc < n

class Solution____2
{
    /**
     * @param Integer[][] $image
     * @param Integer $sr
     * @param Integer $sc
     * @param Integer $color
     * @return Integer[][]
     */
    function floodFill($image, $sr, $sc, $color) {
        $targetColor = $image[$sr][$sc];
        if ($targetColor == $color) return $image;
        $this->checkNeighbours($image, $sr, $sc, $color, $targetColor);
        return $image;
    }

    function checkNeighbours(&$image, $sr, $sc, $color, $targetColor): void {
        if (!isset($image[$sr][$sc]) || $image[$sr][$sc] != $targetColor) return;
        $image[$sr][$sc] = $color;
        $this->checkNeighbours($image, $sr - 1, $sc, $color, $targetColor);
        $this->checkNeighbours($image, $sr + 1, $sc, $color, $targetColor);
        $this->checkNeighbours($image, $sr, $sc - 1, $color, $targetColor);
        $this->checkNeighbours($image, $sr, $sc + 1, $color, $targetColor);
//        $neighbours = [[$sr - 1, $sc], [$sr + 1, $sc], [$sr, $sc - 1], [$sr, $sc + 1]];
//        foreach ($neighbours as $neighbour) {
//            $this->checkNeighbours($image, $neighbour[0], $neighbour[1], $color, $targetColor);
//        }
    }
}


class Solution
{

    /**
     * @param Integer[][] $image
     * @param Integer $sr
     * @param Integer $sc
     * @param Integer $color
     * @return Integer[][]
     */
    function floodFill(&$image, $sr, $sc, $color) {
        $targetColor = $image[$sr][$sc];
        if ($targetColor == $color) return $image;
        $image[$sr][$sc] = $color;

        $left = $sr - 1;
        $right = $sr + 1;
        $top = $sc - 1;
        $bottom = $sc + 1;

        if (isset($image[$left][$sc]) && $image[$left][$sc] == $targetColor) $this->floodFill($image, $left, $sc, $color);
        if (isset($image[$right][$sc]) && $image[$right][$sc] == $targetColor) $this->floodFill($image, $right, $sc, $color);
        if (isset($image[$sr][$top]) && $image[$sr][$top] == $targetColor) $this->floodFill($image, $sr, $top, $color);
        if (isset($image[$sr][$bottom]) && $image[$sr][$bottom] == $targetColor) $this->floodFill($image, $sr, $bottom, $color);

        return $image;
    }
}

$cases = [];
$cases[0]['Input']['image'] = [[1, 1, 1], [1, 1, 0], [1, 0, 1]];
$cases[0]['Input']['sr'] = 1;
$cases[0]['Input']['sc'] = 1;
$cases[0]['Input']['color'] = 2;
$cases[0]['Output'] = [[2, 2, 2], [2, 2, 0], [2, 0, 1]];

//$cases[1]['Input']['image'] = [[1,1,1],[1,1,0],[1,0,1],[1,0,1],[1,0,1]];
//$cases[1]['Input']['sr'] = 1;
//$cases[1]['Input']['sc'] = 1;
//$cases[1]['Input']['color'] = 2;
//$cases[1]['Output'] = [[2,2,2],[2,2,0],[2,0,1]];

$run = new Solution();
foreach ($cases as $case) {
    $result = $run->floodFill($case['Input']['image'], $case['Input']['sr'], $case['Input']['sc'], $case['Input']['color']);
    printResult($result, $case);
}


function printResult($result, $case) {
    echo '<pre>' . '--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    var_export($case['Output']);
    echo '</pre>' . PHP_EOL;
}