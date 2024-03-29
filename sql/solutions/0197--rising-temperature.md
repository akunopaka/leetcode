### 197. Rising Temperature

Difficulty: `Easy`

https://leetcode.com/problems/rising-temperature/


<pre>+---------------+---------+
| Column Name   | Type    |
+---------------+---------+
| id            | int     |
| recordDate    | date    |
| temperature   | int     |
+---------------+---------+
id is the primary key for this table.
This table contains information about the temperature on a certain day.
</pre>
<p>Write an SQL query to find all dates <code>Id</code> with higher temperatures compared to its previous dates (yesterday).</p>
<p>Return the result table in <strong>any order</strong>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong>
Weather table:
+----+------------+-------------+
| id | recordDate | temperature |
+----+------------+-------------+
| 1  | 2015-01-01 | 10          |
| 2  | 2015-01-02 | 25          |
| 3  | 2015-01-03 | 20          |
| 4  | 2015-01-04 | 30          |
+----+------------+-------------+
<strong>Output:</strong>
+----+
| id |
+----+
| 2  |
| 4  |
+----+
<strong>Explanation:</strong>
In 2015-01-02, the temperature was higher than the previous day (10 -&gt; 25).
In 2015-01-04, the temperature was higher than the previous day (20 -&gt; 30).
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
# SELECT `id`
# FROM (
# SELECT `id`, `temperature` - LAG(`temperature`) OVER w as `diff`
#     FROM `Weather`
#     WINDOW w AS (ORDER BY `recordDate`)
#     ORDER BY `recordDate` ASC 
#     ) as T
# WHERE T.`diff` > 0
# SELECT `id`
# FROM `Weather` W
# WHERE (`temperature` - 
#           (
#               SELECT `temperature` 
#               FROM `Weather` T
#               WHERE T.`recordDate` = DATE_SUB(W.`recordDate`, INTERVAL 1 DAY)
#               ORDER BY `recordDate` ASC 
#           )
#       ) > 0

SELECT w1.id
FROM   Weather w1
JOIN   Weather w2 ON w1.recordDate = DATE_ADD(w2.recordDate, INTERVAL 1 DAY)
WHERE  w1.temperature > w2.temperature;
```
