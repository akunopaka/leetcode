### 1667. Fix Names in a Table

Difficulty: `Easy`

https://leetcode.com/problems/fix-names-in-a-table/


<pre>+----------------+---------+
| Column Name    | Type    |
+----------------+---------+
| user_id        | int     |
| name           | varchar |
+----------------+---------+
user_id is the primary key for this table.
This table contains the ID and the name of the user. The name consists of only lowercase and uppercase characters.
</pre>
<p>Write an SQL query to fix the names so that only the first character is uppercase and the rest are lowercase.</p>
<p>Return the result table ordered by <code>user_id</code>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Users table:
+---------+-------+
| user_id | name  |
+---------+-------+
| 1       | aLice |
| 2       | bOB   |
+---------+-------+
<strong>Output:</strong> 
+---------+-------+
| user_id | name  |
+---------+-------+
| 1       | Alice |
| 2       | Bob   |
+---------+-------+
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
SELECT      user_id, 
            CONCAT(UCASE(LEFT(name, 1)), LCASE(SUBSTRING(name, 2))) AS name
FROM        Users
ORDER BY    user_id;
```
