### 733. Flood Fill

Difficulty: `Easy`

https://leetcode.com/problems/flood-fill/

My Solution on LeetCode:
https://leetcode.com/discuss/topic/3384143/phpjavascript-recursive-approach/

<p>An image is represented by an <code>m x n</code> integer grid <code>image</code> where <code>image[i][j]</code> represents the pixel value of the image.</p>

<p>You are also given three integers <code>sr</code>, <code>sc</code>, and <code>color</code>. You should perform a <strong>flood fill</strong> on the image starting from the pixel <code>image[sr][sc]</code>.</p>

<p>To perform a <strong>flood fill</strong>, consider the starting pixel, plus any pixels connected <strong>4-directionally</strong> to the starting pixel of the same color as the starting pixel, plus any pixels connected <strong>4-directionally</strong> to those pixels (also with the same color), and so on. Replace the color of all of the aforementioned pixels with <code>color</code>.</p>

<p>Return <em>the modified image after performing the flood fill</em>.</p>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/06/01/flood1-grid.jpg" style="width: 613px; height: 253px;">
<pre><strong>Input:</strong> image = [[1,1,1],[1,1,0],[1,0,1]], sr = 1, sc = 1, color = 2
<strong>Output:</strong> [[2,2,2],[2,2,0],[2,0,1]]
<strong>Explanation:</strong> From the center of the image with position (sr, sc) = (1, 1) (i.e., the red pixel), all pixels connected by a path of the same color as the starting pixel (i.e., the blue pixels) are colored with the new color.
Note the bottom corner is not colored 2, because it is not 4-directionally connected to the starting pixel.
</pre>

<p><strong class="example">Example 2:</strong></p>

<pre><strong>Input:</strong> image = [[0,0,0],[0,0,0]], sr = 0, sc = 0, color = 0
<strong>Output:</strong> [[0,0,0],[0,0,0]]
<strong>Explanation:</strong> The starting pixel is already colored 0, so no changes are made to the image.
</pre>

<p><strong>Constraints:</strong></p>
<ul>
	<li><code>m == image.length</code></li>
	<li><code>n == image[i].length</code></li>
	<li><code>1 &lt;= m, n &lt;= 50</code></li>
	<li><code>0 &lt;= image[i][j], color &lt; 2<sup>16</sup></code></li>
	<li><code>0 &lt;= sr &lt; m</code></li>
	<li><code>0 &lt;= sc &lt; n</code></li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
var floodFill = function (image, sr, sc, color) {
    let startColor = image[sr][sc];
    if (startColor === color) return image;
    let fill = (r, c) => {
        if (image[r] === undefined || image[r][c] === undefined) return;
        if (image[r][c] === startColor) {
            image[r][c] = color;
            fill(r + 1, c);
            fill(r - 1, c);
            fill(r, c + 1);
            fill(r, c - 1);
        }
    }
    fill(sr, sc);
    return image;
};
```

##### PHP

```php
class Solution
{
    function floodFill(&$image, $sr, $sc, $color)
    {
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

//-- OR --
class Solution_akuno1 {
    function checkNeighbours(&$image, $sr, $sc, $color, $targetColor): void
    {
        if (!isset($image[$sr][$sc]) || $image[$sr][$sc] != $targetColor) return;
        $image[$sr][$sc] = $color;
        $this->checkNeighbours($image, $sr-1, $sc, $color, $targetColor);
        $this->checkNeighbours($image, $sr+1, $sc, $color, $targetColor);
        $this->checkNeighbours($image, $sr, $sc-1, $color, $targetColor);
        $this->checkNeighbours($image, $sr, $sc+1, $color, $targetColor);
        return;
    }

    function floodFill($image, $sr, $sc, $color)
    {
        $targetColor = $image[$sr][$sc];
        if ($targetColor == $color) return $image;
        $this->checkNeighbours($image, $sr, $sc, $color, $targetColor);
        return $image;
    }
}
//-- OR --
class Solution_akuno2 {
    function floodFill($image, $sr, $sc, $color)
    {
        $targetColor = $image[$sr][$sc];
        if ($targetColor == $color) return $image;
        $this->checkNeighbours($image, $sr, $sc, $color, $targetColor);
        return $image;
    }
    function checkNeighbours(&$image, $sr, $sc, $color, $targetColor): void
    {
        if (!isset($image[$sr][$sc]) || $image[$sr][$sc] != $targetColor) return;
        $image[$sr][$sc] = $color;
        $neighbours = [
            [$sr-1, $sc], // top
            [$sr+1, $sc], // bottom
            [$sr, $sc-1], // left
            [$sr, $sc+1]  // right
        ];
        foreach($neighbours as $neighbour){
            $this->checkNeighbours($image, $neighbour[0], $neighbour[1], $color, $targetColor);
        }
        return;
    }
}
```

