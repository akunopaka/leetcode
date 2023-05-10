### 176. Second Highest Salary

Difficulty: `Medium`

https://leetcode.com/problems/second-highest-salary/


<pre>+-------------+------+
| Column Name | Type |
+-------------+------+
| id          | int  |
| salary      | int  |
+-------------+------+
id is the primary key column for this table.
Each row of this table contains information about the salary of an employee.
</pre>
<p>Write an SQL query to report the second highest salary from the <code>Employee</code> table. If there is no second highest salary, the query should report <code>null</code>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Employee table:
+----+--------+
| id | salary |
+----+--------+
| 1  | 100    |
| 2  | 200    |
| 3  | 300    |
+----+--------+
<strong>Output:</strong> 
+---------------------+
| SecondHighestSalary |
+---------------------+
| 200                 |
+---------------------+
</pre>
<p><strong class="example">Example 2:</strong></p>
<pre><strong>Input:</strong> 
Employee table:
+----+--------+
| id | salary |
+----+--------+
| 1  | 100    |
+----+--------+
<strong>Output:</strong> 
+---------------------+
| SecondHighestSalary |
+---------------------+
| null                |
+---------------------+
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below
#   ( SELECT `salary` as `SecondHighestSalary`
#     FROM `Employee`
#     GROUP BY `salary`
#     ORDER BY `salary` DESC 
#     LIMIT 1,1
#   ) 
# UNION
#   (SELECT null as `SecondHighestSalary`)
# LIMIT 1
# SELECT
#     IFNULL(
#       (SELECT DISTINCT Salary
#        FROM Employee
#        ORDER BY Salary DESC
#         LIMIT 1 OFFSET 1),
#     NULL) AS SecondHighestSalary
SELECT
    (SELECT DISTINCT `salary`
        FROM `Employee`
        ORDER BY `Salary` DESC
        LIMIT 1 OFFSET 1
    ) AS SecondHighestSalary;
```
