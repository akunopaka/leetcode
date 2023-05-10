#  176. Second Highest Salary
#  https://leetcode.com/problems/second-highest-salary/
#  Medium
#  
#    +-------------+------+
#    | Column Name | Type |
#    +-------------+------+
#    | id          | int  |
#    | salary      | int  |
#    +-------------+------+
#    id is the primary key column for this table.
#    Each row of this table contains information about the salary of an employee.
#    Write an SQL query to report the second highest salary from the Employee table. If there is no second highest salary, the query should report null.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Employee table:
#    +----+--------+
#    | id | salary |
#    +----+--------+
#    | 1  | 100    |
#    | 2  | 200    |
#    | 3  | 300    |
#    +----+--------+
#    Output: 
#    +---------------------+
#    | SecondHighestSalary |
#    +---------------------+
#    | 200                 |
#    +---------------------+
#    Example 2:
#    Input: 
#    Employee table:
#    +----+--------+
#    | id | salary |
#    +----+--------+
#    | 1  | 100    |
#    +----+--------+
#    Output: 
#    +---------------------+
#    | SecondHighestSalary |
#    +---------------------+
#    | null                |
#    +---------------------+
#  
#  
### SOLUTION:

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
SELECT (SELECT DISTINCT `salary`
        FROM `Employee`
        ORDER BY `Salary` DESC
        LIMIT 1 OFFSET 1) AS SecondHighestSalary;

