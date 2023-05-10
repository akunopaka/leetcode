### 1965. Employees With Missing Information

Difficulty: `Easy`

https://leetcode.com/problems/employees-with-missing-information/


<pre>+-------------+---------+
| Column Name | Type    |
+-------------+---------+
| employee_id | int     |
| name        | varchar |
+-------------+---------+
employee_id is the primary key for this table.
Each row of this table indicates the name of the employee whose ID is employee_id.
</pre>
<p>Table: <code>Salaries</code></p>
<pre>+-------------+---------+
| Column Name | Type    |
+-------------+---------+
| employee_id | int     |
| salary      | int     |
+-------------+---------+
employee_id is the primary key for this table.
Each row of this table indicates the salary of the employee whose ID is employee_id.
</pre>
<p>Write an SQL query to report the IDs of all the employees with <strong>missing information</strong>. The information of an employee is missing if:</p>
<ul>
	<li>The employee's <strong>name</strong> is missing, or</li>
	<li>The employee's <strong>salary</strong> is missing.</li>
</ul>
<p>Return the result table ordered by <code>employee_id</code> <strong>in ascending order</strong>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Employees table:
+-------------+----------+
| employee_id | name     |
+-------------+----------+
| 2           | Crew     |
| 4           | Haven    |
| 5           | Kristian |
+-------------+----------+
Salaries table:
+-------------+--------+
| employee_id | salary |
+-------------+--------+
| 5           | 76071  |
| 1           | 22517  |
| 4           | 63539  |
+-------------+--------+
<strong>Output:</strong> 
+-------------+
| employee_id |
+-------------+
| 1           |
| 2           |
+-------------+
<strong>Explanation:</strong> 
Employees 1, 2, 4, and 5 are working at this company.
The name of employee 1 is missing.
The salary of employee 2 is missing.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
#  SELECT 
#     E.`employee_id` as `employee_id`
#     FROM `Employees` as E
#     LEFT JOIN `Salaries` AS S ON E.employee_id = S.employee_id 
#     WHERE S.employee_id IS NULL
# UNION
# Write your MySQL query statement below
# SELECT `employee_id` FROM
# (SELECT 
#     S.`employee_id` as `employee_id`
#     FROM `Salaries` as S
#     LEFT JOIN `Employees` AS E ON E.employee_id = S.employee_id 
#     WHERE E.employee_id IS NULL
# ) R
# ORDER BY R.employee_id ASC

SELECT   T.employee_id 
FROM     (
         SELECT * FROM Employees LEFT JOIN Salaries USING(employee_id)
         UNION
         SELECT * FROM Employees RIGHT JOIN Salaries USING(employee_id)
         ) AS T
WHERE    T.salary IS NULL OR T.name IS NULL
ORDER BY employee_id;
```
