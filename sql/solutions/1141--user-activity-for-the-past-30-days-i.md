### 1141. User Activity for the Past 30 Days I

Difficulty: `Easy`

https://leetcode.com/problems/user-activity-for-the-past-30-days-i/


<pre>+---------------+---------+
| Column Name   | Type    |
+---------------+---------+
| user_id       | int     |
| session_id    | int     |
| activity_date | date    |
| activity_type | enum    |
+---------------+---------+
There is no primary key for this table, it may have duplicate rows.
The activity_type column is an ENUM of type ("open_session", "end_session", "scroll_down", "send_message").
The table shows the user activities for a social media website. 
Note that each session belongs to exactly one user.
</pre>
<p>Write an SQL query to find the daily active user count for a period of <code>30</code> days ending <code>2019-07-27</code> inclusively. A user was active on someday if they made at least one activity on that day.</p>
<p>Return the result table in <strong>any order</strong>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Activity table:
+---------+------------+---------------+---------------+
| user_id | session_id | activity_date | activity_type |
+---------+------------+---------------+---------------+
| 1       | 1          | 2019-07-20    | open_session  |
| 1       | 1          | 2019-07-20    | scroll_down   |
| 1       | 1          | 2019-07-20    | end_session   |
| 2       | 4          | 2019-07-20    | open_session  |
| 2       | 4          | 2019-07-21    | send_message  |
| 2       | 4          | 2019-07-21    | end_session   |
| 3       | 2          | 2019-07-21    | open_session  |
| 3       | 2          | 2019-07-21    | send_message  |
| 3       | 2          | 2019-07-21    | end_session   |
| 4       | 3          | 2019-06-25    | open_session  |
| 4       | 3          | 2019-06-25    | end_session   |
+---------+------------+---------------+---------------+
<strong>Output:</strong> 
+------------+--------------+ 
| day        | active_users |
+------------+--------------+ 
| 2019-07-20 | 2            |
| 2019-07-21 | 2            |
+------------+--------------+ 
<strong>Explanation:</strong> Note that we do not care about days with zero active users.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
# SELECT activity_date AS day, COUNT(DISTINCT user_id) AS active_users
# FROM Activity
# WHERE (activity_date > "2019-06-27" AND activity_date <= "2019-07-27")
# GROUP BY activity_date;
# SELECT `activity_date` AS `day`, 
#        COUNT(DISTINCT `user_id`) AS `active_users`
# FROM `Activity`
# WHERE `activity_date` BETWEEN DATE_SUB("2019-07-27",interval 29 day) AND "2019-07-27"
# GROUP BY activity_date
SELECT activity_date           AS DAY,
       COUNT(DISTINCT user_id) AS active_users
FROM   activity
WHERE  activity_date BETWEEN Date_add("2019-07-27", interval - 29 DAY) AND
                             "2019-07-27"
GROUP  BY activity_date;
```
