#  197. Rising Temperature
#  https://leetcode.com/problems/rising-temperature/
#  Easy
#  
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | id            | int     |
#    | recordDate    | date    |
#    | temperature   | int     |
#    +---------------+---------+
#    id is the primary key for this table.
#    This table contains information about the temperature on a certain day.
#    Write an SQL query to find all dates Id with higher temperatures compared to its previous dates (yesterday).
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input:
#    Weather table:
#    +----+------------+-------------+
#    | id | recordDate | temperature |
#    +----+------------+-------------+
#    | 1  | 2015-01-01 | 10          |
#    | 2  | 2015-01-02 | 25          |
#    | 3  | 2015-01-03 | 20          |
#    | 4  | 2015-01-04 | 30          |
#    +----+------------+-------------+
#    Output:
#    +----+
#    | id |
#    +----+
#    | 2  |
#    | 4  |
#    +----+
#    Explanation:
#    In 2015-01-02, the temperature was higher than the previous day (10 -&gt; 25).
#    In 2015-01-04, the temperature was higher than the previous day (20 -&gt; 30).
#  
#  
### SOLUTION:  

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
FROM Weather w1
         JOIN Weather w2 ON w1.recordDate = DATE_ADD(w2.recordDate, INTERVAL 1 DAY)
WHERE w1.temperature > w2.temperature;

