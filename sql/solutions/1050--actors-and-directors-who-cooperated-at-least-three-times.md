### 1050. Actors and Directors Who Cooperated At Least Three Times

Difficulty: `Easy`

https://leetcode.com/problems/actors-and-directors-who-cooperated-at-least-three-times/


<pre>+-------------+---------+
| Column Name | Type    |
+-------------+---------+
| actor_id    | int     |
| director_id | int     |
| timestamp   | int     |
+-------------+---------+
timestamp is the primary key column for this table.
</pre>
<p>Write a SQL query for a report that provides the pairs <code>(actor_id, director_id)</code> where the actor has cooperated with the director at least three times.</p>
<p>Return the result table in <strong>any order</strong>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
ActorDirector table:
+-------------+-------------+-------------+
| actor_id    | director_id | timestamp   |
+-------------+-------------+-------------+
| 1           | 1           | 0           |
| 1           | 1           | 1           |
| 1           | 1           | 2           |
| 1           | 2           | 3           |
| 1           | 2           | 4           |
| 2           | 1           | 5           |
| 2           | 1           | 6           |
+-------------+-------------+-------------+
<strong>Output:</strong> 
+-------------+-------------+
| actor_id    | director_id |
+-------------+-------------+
| 1           | 1           |
+-------------+-------------+
<strong>Explanation:</strong> The only pair is (1, 1) where they cooperated exactly 3 times.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
SELECT      actor_id, 
            director_id
FROM        ActorDirector
GROUP BY    actor_id, director_id
HAVING      COUNT(timestamp) >= 3;
```
