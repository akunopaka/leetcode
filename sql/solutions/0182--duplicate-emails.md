### 182. Duplicate Emails

Difficulty: `Easy`

https://leetcode.com/problems/duplicate-emails/


<pre>+-------------+---------+
| Column Name | Type    |
+-------------+---------+
| id          | int     |
| email       | varchar |
+-------------+---------+
id is the primary key column for this table.
Each row of this table contains an email. The emails will not contain uppercase letters.
</pre>
<p>Write an SQL query to report all the duplicate emails. Note that it's guaranteed that the email&nbsp;field is not NULL.</p>
<p>Return the result table in <strong>any order</strong>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong>
Person table:
+----+---------+
| id | email   |
+----+---------+
| 1  | a@b.com |
| 2  | c@d.com |
| 3  | a@b.com |
+----+---------+
<strong>Output:</strong>
+---------+
| Email   |
+---------+
| a@b.com |
+---------+
<strong>Explanation:</strong> a@b.com is repeated two times.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
SELECT      email
FROM        Person
GROUP BY    email
HAVING      COUNT(email) > 1;
```
