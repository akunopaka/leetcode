#  1965. Employees With Missing Information
#  https://leetcode.com/problems/employees-with-missing-information/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | employee_id | int     |
#    | name        | varchar |
#    +-------------+---------+
#    employee_id is the primary key for this table.
#    Each row of this table indicates the name of the employee whose ID is employee_id.
#    Table: Salaries
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | employee_id | int     |
#    | salary      | int     |
#    +-------------+---------+
#    employee_id is the primary key for this table.
#    Each row of this table indicates the salary of the employee whose ID is employee_id.
#    Write an SQL query to report the IDs of all the employees with missing information. The information of an employee is missing if:
#    	The employee's name is missing, or
#    	The employee's salary is missing.
#    Return the result table ordered by employee_id in ascending order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Employees table:
#    +-------------+----------+
#    | employee_id | name     |
#    +-------------+----------+
#    | 2           | Crew     |
#    | 4           | Haven    |
#    | 5           | Kristian |
#    +-------------+----------+
#    Salaries table:
#    +-------------+--------+
#    | employee_id | salary |
#    +-------------+--------+
#    | 5           | 76071  |
#    | 1           | 22517  |
#    | 4           | 63539  |
#    +-------------+--------+
#    Output: 
#    +-------------+
#    | employee_id |
#    +-------------+
#    | 1           |
#    | 2           |
#    +-------------+
#    Explanation: 
#    Employees 1, 2, 4, and 5 are working at this company.
#    The name of employee 1 is missing.
#    The salary of employee 2 is missing.
#  
#  
### SOLUTION:  

#  SELECT 
#     E.`employee_id` as `employee_id`
#     FROM `Employees` as E
#     LEFT JOIN `Salaries` AS S ON E.employee_id = S.employee_id 
#     WHERE S.employee_id IS NULL
# UNION

# SELECT `employee_id` FROM
# (SELECT 
#     S.`employee_id` as `employee_id`
#     FROM `Salaries` as S
#     LEFT JOIN `Employees` AS E ON E.employee_id = S.employee_id 
#     WHERE E.employee_id IS NULL
# ) R
# ORDER BY R.employee_id ASC

SELECT T.employee_id
FROM (SELECT *
      FROM Employees
               LEFT JOIN Salaries USING (employee_id)
      UNION
      SELECT *
      FROM Employees
               RIGHT JOIN Salaries USING (employee_id)) AS T
WHERE T.salary IS NULL
   OR T.name IS NULL
ORDER BY employee_id;

