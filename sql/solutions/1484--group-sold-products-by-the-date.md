### 1484. Group Sold Products By The Date

Difficulty: `Easy`

https://leetcode.com/problems/group-sold-products-by-the-date/


<pre>+-------------+---------+
| Column Name | Type    |
+-------------+---------+
| sell_date   | date    |
| product     | varchar |
+-------------+---------+
There is no primary key for this table, it may contain duplicates.
Each row of this table contains the product name and the date it was sold in a market.
</pre>
<p>Write an SQL query to find for each date the number of different products sold and their names.</p>
<p>The sold products names for each date should be sorted lexicographically.</p>
<p>Return the result table ordered by <code>sell_date</code>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Activities table:
+------------+------------+
| sell_date  | product     |
+------------+------------+
| 2020-05-30 | Headphone  |
| 2020-06-01 | Pencil     |
| 2020-06-02 | Mask       |
| 2020-05-30 | Basketball |
| 2020-06-01 | Bible      |
| 2020-06-02 | Mask       |
| 2020-05-30 | T-Shirt    |
+------------+------------+
<strong>Output:</strong> 
+------------+----------+------------------------------+
| sell_date  | num_sold | products                     |
+------------+----------+------------------------------+
| 2020-05-30 | 3        | Basketball,Headphone,T-shirt |
| 2020-06-01 | 2        | Bible,Pencil                 |
| 2020-06-02 | 1        | Mask                         |
+------------+----------+------------------------------+
<strong>Explanation:</strong> 
For 2020-05-30, Sold items were (Headphone, Basketball, T-shirt), we sort them lexicographically and separate them by a comma.
For 2020-06-01, Sold items were (Pencil, Bible), we sort them lexicographically and separate them by a comma.
For 2020-06-02, the Sold item is (Mask), we just return it.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
SELECT   sell_date, 
         COUNT(DISTINCT `product`) as `num_sold`,
         GROUP_CONCAT(DISTINCT `product` ORDER BY `product` ASC) AS products
FROM     Activities
GROUP BY sell_date
ORDER BY sell_date;
```
