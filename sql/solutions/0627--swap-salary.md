### 627. Swap Salary

Difficulty: `Easy`

https://leetcode.com/problems/swap-salary/?envType=study-plan&id=sql-i


<pre>+-------------+----------+
| Column Name | Type     |
+-------------+----------+
| id          | int      |
| name        | varchar  |
| sex         | ENUM     |
| salary      | int      |
+-------------+----------+
id is the primary key for this table.
The sex column is ENUM value of type ('m', 'f').
The table contains information about an employee.
</pre>
<p>Write an SQL query to swap all <code>'f'</code> and <code>'m'</code> values (i.e., change all <code>'f'</code> values to <code>'m'</code> and vice versa) with a <strong>single update statement</strong> and no intermediate temporary tables.</p>
<p>Note that you must write a single update statement, <strong>do not</strong> write any select statement for this problem.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Salary table:
+----+------+-----+--------+
| id | name | sex | salary |
+----+------+-----+--------+
| 1  | A    | m   | 2500   |
| 2  | B    | f   | 1500   |
| 3  | C    | m   | 5500   |
| 4  | D    | f   | 500    |
+----+------+-----+--------+
<strong>Output:</strong> 
+----+------+-----+--------+
| id | name | sex | salary |
+----+------+-----+--------+
| 1  | A    | f   | 2500   |
| 2  | B    | m   | 1500   |
| 3  | C    | f   | 5500   |
| 4  | D    | m   | 500    |
+----+------+-----+--------+
<strong>Explanation:</strong> 
(1, A) and (3, C) were changed from 'm' to 'f'.
(2, B) and (4, D) were changed from 'f' to 'm'.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below

# Update Salary set sex = if (sex = "f","m","f")
UPDATE  Salary 
SET     sex = 
   CASE 
      WHEN `sex`="f" THEN "m"
      WHEN `sex`="m" THEN "f"
   END
```
