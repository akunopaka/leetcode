# SQL I - Level 1
#
# https://leetcode.com/study-plan/sql/
#
# By https://leetcode.com/akunopaka/


#  -------------------------------------------------
#  175. Combine Two Tables
#  https://leetcode.com/problems/combine-two-tables/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | personId    | int     |
#    | lastName    | varchar |
#    | firstName   | varchar |
#    +-------------+---------+
#    personId is the primary key column for this table.
#    This table contains information about the ID of some persons and their first and last names.
#    Table: Address
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | addressId   | int     |
#    | personId    | int     |
#    | city        | varchar |
#    | state       | varchar |
#    +-------------+---------+
#    addressId is the primary key column for this table.
#    Each row of this table contains information about the city and state of one person with ID = PersonId.
#    Write an SQL query to report the first name, last name, city, and state of each person in the Person table. If the address of a personId is not present in the Address table, report null instead.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Person table:
#    +----------+----------+-----------+
#    | personId | lastName | firstName |
#    +----------+----------+-----------+
#    | 1        | Wang     | Allen     |
#    | 2        | Alice    | Bob       |
#    +----------+----------+-----------+
#    Address table:
#    +-----------+----------+---------------+------------+
#    | addressId | personId | city          | state      |
#    +-----------+----------+---------------+------------+
#    | 1         | 2        | New York City | New York   |
#    | 2         | 3        | Leetcode      | California |
#    +-----------+----------+---------------+------------+
#    Output: 
#    +-----------+----------+---------------+----------+
#    | firstName | lastName | city          | state    |
#    +-----------+----------+---------------+----------+
#    | Allen     | Wang     | Null          | Null     |
#    | Bob       | Alice    | New York City | New York |
#    +-----------+----------+---------------+----------+
#    Explanation: 
#    There is no address in the address table for the personId = 1 so we return null in their city and state.
#    addressId = 1 contains information about the address of personId = 2.
#  
#  
### SOLUTION:  

SELECT Person.firstName,
       Person.lastName,
       Address.city,
       Address.state
FROM Person
         LEFT JOIN Address ON Person.personId = Address.personId;

#  -------------------------------------------------
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

#  -------------------------------------------------
#  182. Duplicate Emails
#  https://leetcode.com/problems/duplicate-emails/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | id          | int     |
#    | email       | varchar |
#    +-------------+---------+
#    id is the primary key column for this table.
#    Each row of this table contains an email. The emails will not contain uppercase letters.
#    Write an SQL query to report all the duplicate emails. Note that it's guaranteed that the email&nbsp;field is not NULL.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input:
#    Person table:
#    +----+---------+
#    | id | email   |
#    +----+---------+
#    | 1  | a@b.com |
#    | 2  | c@d.com |
#    | 3  | a@b.com |
#    +----+---------+
#    Output:
#    +---------+
#    | Email   |
#    +---------+
#    | a@b.com |
#    +---------+
#    Explanation: a@b.com is repeated two times.
#  
#  
### SOLUTION:  

SELECT email
FROM Person
GROUP BY email
HAVING COUNT(email) > 1;

#  -------------------------------------------------
#  183. Customers Who Never Order
#  https://leetcode.com/problems/customers-who-never-order/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | id          | int     |
#    | name        | varchar |
#    +-------------+---------+
#    id is the primary key column for this table.
#    Each row of this table indicates the ID and name of a customer.
#    Table: Orders
#    +-------------+------+
#    | Column Name | Type |
#    +-------------+------+
#    | id          | int  |
#    | customerId  | int  |
#    +-------------+------+
#    id is the primary key column for this table.
#    customerId is a foreign key of the ID from the Customers table.
#    Each row of this table indicates the ID of an order and the ID of the customer who ordered it.
#    Write an SQL query to report all customers who never order anything.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Customers table:
#    +----+-------+
#    | id | name  |
#    +----+-------+
#    | 1  | Joe   |
#    | 2  | Henry |
#    | 3  | Sam   |
#    | 4  | Max   |
#    +----+-------+
#    Orders table:
#    +----+------------+
#    | id | customerId |
#    +----+------------+
#    | 1  | 3          |
#    | 2  | 1          |
#    +----+------------+
#    Output: 
#    +-----------+
#    | Customers |
#    +-----------+
#    | Henry     |
#    | Max       |
#    +-----------+
#  
#  
### SOLUTION:  

SELECT name AS Customers
FROM Customers
WHERE id NOT IN (SELECT customerId FROM Orders);

#  -------------------------------------------------
#  196. Delete Duplicate Emails
#  https://leetcode.com/problems/delete-duplicate-emails/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | id          | int     |
#    | email       | varchar |
#    +-------------+---------+
#    id is the primary key column for this table.
#    Each row of this table contains an email. The emails will not contain uppercase letters.
#    Write an SQL query to delete all the duplicate emails, keeping only one unique email with the smallest id. Note that you are supposed to write a DELETE statement and not a SELECT one.
#    After running your script, the answer shown is the Person table. The driver will first compile and run your piece of code and then show the Person table. The final order of the Person table does not matter.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Person table:
#    +----+------------------+
#    | id | email            |
#    +----+------------------+
#    | 1  | john@example.com |
#    | 2  | bob@example.com  |
#    | 3  | john@example.com |
#    +----+------------------+
#    Output: 
#    +----+------------------+
#    | id | email            |
#    +----+------------------+
#    | 1  | john@example.com |
#    | 2  | bob@example.com  |
#    +----+------------------+
#    Explanation: john@example.com is repeated two times. We keep the row with the smallest Id = 1.
#  
#  
### SOLUTION:  

DELETE p1
FROM Person p1
         INNER JOIN Person p2
WHERE p1.id > p2.id
  AND p1.email = p2.email;

#  -------------------------------------------------
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

#  -------------------------------------------------
#  511. Game Play Analysis I
#  https://leetcode.com/problems/game-play-analysis-i/
#  Easy
#  
#    +--------------+---------+
#    | Column Name  | Type    |
#    +--------------+---------+
#    | player_id    | int     |
#    | device_id    | int     |
#    | event_date   | date    |
#    | games_played | int     |
#    +--------------+---------+
#    (player_id, event_date) is the primary key of this table.
#    This table shows the activity of players of some games.
#    Each row is a record of a player who logged in and played a number of games (possibly 0) before logging out on someday using some device.
#    Write an SQL query to report the first login date for each player.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Activity table:
#    +-----------+-----------+------------+--------------+
#    | player_id | device_id | event_date | games_played |
#    +-----------+-----------+------------+--------------+
#    | 1         | 2         | 2016-03-01 | 5            |
#    | 1         | 2         | 2016-05-02 | 6            |
#    | 2         | 3         | 2017-06-25 | 1            |
#    | 3         | 1         | 2016-03-02 | 0            |
#    | 3         | 4         | 2018-07-03 | 5            |
#    +-----------+-----------+------------+--------------+
#    Output: 
#    +-----------+-------------+
#    | player_id | first_login |
#    +-----------+-------------+
#    | 1         | 2016-03-01  |
#    | 2         | 2017-06-25  |
#    | 3         | 2016-03-02  |
#    +-----------+-------------+
#  
#  
### SOLUTION:  

SELECT player_id,
       MIN(event_dat) AS first_login
FROM Activity
GROUP BY player_id
ORDER BY player_id, first_login;

#  -------------------------------------------------
#  584. Find Customer Referee
#  https://leetcode.com/problems/find-customer-referee/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | id          | int     |
#    | name        | varchar |
#    | referee_id  | int     |
#    +-------------+---------+
#    id is the primary key column for this table.
#    Each row of this table indicates the id of a customer, their name, and the id of the customer who referred them.
#    Write an SQL query to report the names of the customer that are not referred by the customer with id = 2.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Customer table:
#    +----+------+------------+
#    | id | name | referee_id |
#    +----+------+------------+
#    | 1  | Will | null       |
#    | 2  | Jane | null       |
#    | 3  | Alex | 2          |
#    | 4  | Bill | null       |
#    | 5  | Zack | 1          |
#    | 6  | Mark | 2          |
#    +----+------+------------+
#    Output: 
#    +------+
#    | name |
#    +------+
#    | Will |
#    | Jane |
#    | Bill |
#    | Zack |
#    +------+
#  
#  
### SOLUTION:  

SELECT name
FROM Customer
WHERE referee_id <> 2 || referee_id IS NULL;

#  -------------------------------------------------
#  586. Customer Placing the Largest Number of Orders
#  https://leetcode.com/problems/customer-placing-the-largest-number-of-orders/
#  Easy
#  
#    +-----------------+----------+
#    | Column Name     | Type     |
#    +-----------------+----------+
#    | order_number    | int      |
#    | customer_number | int      |
#    +-----------------+----------+
#    order_number is the primary key for this table.
#    This table contains information about the order ID and the customer ID.
#    Write an SQL query to find the customer_number for the customer who has placed the largest number of orders.
#    The test cases are generated so that exactly one customer will have placed more orders than any other customer.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Orders table:
#    +--------------+-----------------+
#    | order_number | customer_number |
#    +--------------+-----------------+
#    | 1            | 1               |
#    | 2            | 2               |
#    | 3            | 3               |
#    | 4            | 3               |
#    +--------------+-----------------+
#    Output: 
#    +-----------------+
#    | customer_number |
#    +-----------------+
#    | 3               |
#    +-----------------+
#    Explanation: 
#    The customer with number 3 has two orders, which is greater than either customer 1 or 2 because each of them only has one order. 
#    So the result is customer_number 3.
#    Follow up: What if more than one customer has the largest number of orders, can you find all the customer_number in this case?
#  
#  
### SOLUTION:  

SELECT customer_number
FROM Orders
GROUP BY customer_number
ORDER BY COUNT(customer_number) DESC
LIMIT 1;

#  -------------------------------------------------
#  595. Big Countries
#  https://leetcode.com/problems/big-countries/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type|
#    +-------------+---------+
#    | name| varchar |
#    | continent   | varchar |
#    | area| int |
#    | population  | int |
#    | gdp | bigint  |
#    +-------------+---------+
#    name is the primary key column for this table.
#    Each row of this table gives information about the name of a country, the continent to which it belongs, its area, the population, and its GDP value.
#    A country is big if:
#    it has an area of at least&nbsp;three million (i.e., 3000000 km2), or
#    it has a population of at least&nbsp;twenty-five million (i.e., 25000000).
#    Write an SQL query to report the name, population, and area of the big countries.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    World table:
#    +-------------+-----------+---------+------------+--------------+
#    | name| continent | area| population | gdp  |
#    +-------------+-----------+---------+------------+--------------+
#    | Afghanistan | Asia  | 652230  | 25500100   | 20343000000  |
#    | Albania | Europe| 28748   | 2831741| 12960000000  |
#    | Algeria | Africa| 2381741 | 37100000   | 188681000000 |
#    | Andorra | Europe| 468 | 78115  | 3712000000   |
#    | Angola  | Africa| 1246700 | 20609294   | 100990000000 |
#    +-------------+-----------+---------+------------+--------------+
#    Output: 
#    +-------------+------------+---------+
#    | name| population | area|
#    +-------------+------------+---------+
#    | Afghanistan | 25500100   | 652230  |
#    | Algeria | 37100000   | 2381741 |
#    +-------------+------------+---------+
#  
#  
### SOLUTION:  

SELECT name,
       population,
       area
FROM World
WHERE area >= 3000000
   OR population >= 25000000;

#  -------------------------------------------------
#  607. Sales Person
#  https://leetcode.com/problems/sales-person/
#  Easy
#  
#    +-----------------+---------+
#    | Column Name     | Type    |
#    +-----------------+---------+
#    | sales_id        | int     |
#    | name            | varchar |
#    | salary          | int     |
#    | commission_rate | int     |
#    | hire_date       | date    |
#    +-----------------+---------+
#    sales_id is the primary key column for this table.
#    Each row of this table indicates the name and the ID of a salesperson alongside their salary, commission rate, and hire date.
#    Table: Company
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | com_id      | int     |
#    | name        | varchar |
#    | city        | varchar |
#    +-------------+---------+
#    com_id is the primary key column for this table.
#    Each row of this table indicates the name and the ID of a company and the city in which the company is located.
#    Table: Orders
#    +-------------+------+
#    | Column Name | Type |
#    +-------------+------+
#    | order_id    | int  |
#    | order_date  | date |
#    | com_id      | int  |
#    | sales_id    | int  |
#    | amount      | int  |
#    +-------------+------+
#    order_id is the primary key column for this table.
#    com_id is a foreign key to com_id from the Company table.
#    sales_id is a foreign key to sales_id from the SalesPerson table.
#    Each row of this table contains information about one order. This includes the ID of the company, the ID of the salesperson, the date of the order, and the amount paid.
#    Write an SQL query to report the names of all the salespersons who did not have any orders related to the company with the name "RED".
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    SalesPerson table:
#    +----------+------+--------+-----------------+------------+
#    | sales_id | name | salary | commission_rate | hire_date  |
#    +----------+------+--------+-----------------+------------+
#    | 1        | John | 100000 | 6               | 4/1/2006   |
#    | 2        | Amy  | 12000  | 5               | 5/1/2010   |
#    | 3        | Mark | 65000  | 12              | 12/25/2008 |
#    | 4        | Pam  | 25000  | 25              | 1/1/2005   |
#    | 5        | Alex | 5000   | 10              | 2/3/2007   |
#    +----------+------+--------+-----------------+------------+
#    Company table:
#    +--------+--------+----------+
#    | com_id | name   | city     |
#    +--------+--------+----------+
#    | 1      | RED    | Boston   |
#    | 2      | ORANGE | New York |
#    | 3      | YELLOW | Boston   |
#    | 4      | GREEN  | Austin   |
#    +--------+--------+----------+
#    Orders table:
#    +----------+------------+--------+----------+--------+
#    | order_id | order_date | com_id | sales_id | amount |
#    +----------+------------+--------+----------+--------+
#    | 1        | 1/1/2014   | 3      | 4        | 10000  |
#    | 2        | 2/1/2014   | 4      | 5        | 5000   |
#    | 3        | 3/1/2014   | 1      | 1        | 50000  |
#    | 4        | 4/1/2014   | 1      | 4        | 25000  |
#    +----------+------------+--------+----------+--------+
#    Output: 
#    +------+
#    | name |
#    +------+
#    | Amy  |
#    | Mark |
#    | Alex |
#    +------+
#    Explanation: 
#    According to orders 3 and 4 in the Orders table, it is easy to tell that only salesperson John and Pam have sales to company RED, so we report all the other names in the table salesperson.
#  
#  
### SOLUTION:  

# SELECT `SalesPerson`.`name`
# FROM `SalesPerson`
# WHERE `SalesPerson`.`sales_id` NOT IN 
#             (
#               SELECT `SalesPerson`.`sales_id`
#               FROM `SalesPerson`
#               INNER JOIN `Orders` ON `Orders`.`sales_id`=`SalesPerson`.`sales_id` 
#               INNER JOIN `Company` ON `Orders`.`com_id`=`Company`.`com_id` AND `Company`.`name` = "RED"
#             )
# GROUP BY `SalesPerson`.`sales_id`

SELECT SalesPerson.name
FROM SalesPerson
WHERE sales_id NOT IN
      (SELECT Orders.sales_id
       FROM Orders
                LEFT JOIN Company
                          ON Orders.com_id = Company.com_id
       WHERE Company.name = "RED");

#  -------------------------------------------------
#  608. Tree Node
#  https://leetcode.com/problems/tree-node/
#  Medium
#  
#    +-------------+------+
#    | Column Name | Type |
#    +-------------+------+
#    | id          | int  |
#    | p_id        | int  |
#    +-------------+------+
#    id is the primary key column for this table.
#    Each row of this table contains information about the id of a node and the id of its parent node in a tree.
#    The given structure is always a valid tree.
#    Each node in the tree can be one of three types:
#    	"Leaf": if the node is a leaf node.
#    	"Root": if the node is the root of the tree.
#    	"Inner": If the node is neither a leaf node nor a root node.
#    Write an SQL query to report the type of each node in the tree.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Tree table:
#    +----+------+
#    | id | p_id |
#    +----+------+
#    | 1  | null |
#    | 2  | 1    |
#    | 3  | 1    |
#    | 4  | 2    |
#    | 5  | 2    |
#    +----+------+
#    Output: 
#    +----+-------+
#    | id | type  |
#    +----+-------+
#    | 1  | Root  |
#    | 2  | Inner |
#    | 3  | Leaf  |
#    | 4  | Leaf  |
#    | 5  | Leaf  |
#    +----+-------+
#    Explanation: 
#    Node 1 is the root node because its parent node is null and it has child nodes 2 and 3.
#    Node 2 is an inner node because it has parent node 1 and child node 4 and 5.
#    Nodes 3, 4, and 5 are leaf nodes because they have parent nodes and they do not have child nodes.
#    Example 2:
#    Input: 
#    Tree table:
#    +----+------+
#    | id | p_id |
#    +----+------+
#    | 1  | null |
#    +----+------+
#    Output: 
#    +----+-------+
#    | id | type  |
#    +----+-------+
#    | 1  | Root  |
#    +----+-------+
#    Explanation: If there is only one node on the tree, you only need to output its root attributes.
#  
#  
### SOLUTION:  

# SELECT `id`, 
# (
#     CASE
#         WHEN (`p_id` IS NULL) THEN "Root"
#         WHEN (`p_id` IS NOT NULL AND EXISTS(SELECT `id` FROM `Tree` WHERE T.id = `p_id`) ) THEN "Inner"
#         WHEN (`p_id` IS NOT NULL AND NOT EXISTS(SELECT `id` FROM `Tree` WHERE T.id = `p_id`) )THEN "Leaf"
#     END 
# ) AS `type`
# FROM `Tree` T
SELECT `id`,
       CASE
           WHEN p_id IS NULL THEN 'Root'
           WHEN `id` IN (SELECT `p_id` FROM `Tree` WHERE `p_id` IS NOT NULL) THEN 'Inner'
           ELSE 'Leaf'
           END AS `type`
FROM `Tree`;

#  -------------------------------------------------
#  627. Swap Salary
#  https://leetcode.com/problems/swap-salary/
#  Easy
#  
#    +-------------+----------+
#    | Column Name | Type     |
#    +-------------+----------+
#    | id          | int      |
#    | name        | varchar  |
#    | sex         | ENUM     |
#    | salary      | int      |
#    +-------------+----------+
#    id is the primary key for this table.
#    The sex column is ENUM value of type ('m', 'f').
#    The table contains information about an employee.
#    Write an SQL query to swap all 'f' and 'm' values (i.e., change all 'f' values to 'm' and vice versa) with a single update statement and no intermediate temporary tables.
#    Note that you must write a single update statement, do not write any select statement for this problem.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Salary table:
#    +----+------+-----+--------+
#    | id | name | sex | salary |
#    +----+------+-----+--------+
#    | 1  | A    | m   | 2500   |
#    | 2  | B    | f   | 1500   |
#    | 3  | C    | m   | 5500   |
#    | 4  | D    | f   | 500    |
#    +----+------+-----+--------+
#    Output: 
#    +----+------+-----+--------+
#    | id | name | sex | salary |
#    +----+------+-----+--------+
#    | 1  | A    | f   | 2500   |
#    | 2  | B    | m   | 1500   |
#    | 3  | C    | f   | 5500   |
#    | 4  | D    | m   | 500    |
#    +----+------+-----+--------+
#    Explanation: 
#    (1, A) and (3, C) were changed from 'm' to 'f'.
#    (2, B) and (4, D) were changed from 'f' to 'm'.
#  
#  
### SOLUTION:  


# Update Salary set sex = if (sex = "f","m","f")
UPDATE Salary
SET sex =
        CASE
            WHEN `sex` = "f" THEN "m"
            WHEN `sex` = "m" THEN "f"
            END;

#  -------------------------------------------------
#  1050. Actors and Directors Who Cooperated At Least Three Times
#  https://leetcode.com/problems/actors-and-directors-who-cooperated-at-least-three-times/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | actor_id    | int     |
#    | director_id | int     |
#    | timestamp   | int     |
#    +-------------+---------+
#    timestamp is the primary key column for this table.
#    Write a SQL query for a report that provides the pairs (actor_id, director_id) where the actor has cooperated with the director at least three times.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    ActorDirector table:
#    +-------------+-------------+-------------+
#    | actor_id    | director_id | timestamp   |
#    +-------------+-------------+-------------+
#    | 1           | 1           | 0           |
#    | 1           | 1           | 1           |
#    | 1           | 1           | 2           |
#    | 1           | 2           | 3           |
#    | 1           | 2           | 4           |
#    | 2           | 1           | 5           |
#    | 2           | 1           | 6           |
#    +-------------+-------------+-------------+
#    Output: 
#    +-------------+-------------+
#    | actor_id    | director_id |
#    +-------------+-------------+
#    | 1           | 1           |
#    +-------------+-------------+
#    Explanation: The only pair is (1, 1) where they cooperated exactly 3 times.
#  
#  
### SOLUTION:  

SELECT actor_id,
       director_id
FROM ActorDirector
GROUP BY actor_id, director_id
HAVING COUNT(timestamp) >= 3;

#  -------------------------------------------------
#  1084. Sales Analysis III
#  https://leetcode.com/problems/sales-analysis-iii/
#  Easy
#  
#    +--------------+---------+
#    | Column Name  | Type    |
#    +--------------+---------+
#    | product_id   | int     |
#    | product_name | varchar |
#    | unit_price   | int     |
#    +--------------+---------+
#    product_id is the primary key of this table.
#    Each row of this table indicates the name and the price of each product.
#    Table: Sales
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | seller_id   | int     |
#    | product_id  | int     |
#    | buyer_id    | int     |
#    | sale_date   | date    |
#    | quantity    | int     |
#    | price       | int     |
#    +-------------+---------+
#    This table has no primary key, it can have repeated rows.
#    product_id is a foreign key to the Product table.
#    Each row of this table contains some information about one sale.
#    Write an SQL query that reports the products that were only sold in the first quarter of 2019. That is, between 2019-01-01 and 2019-03-31 inclusive.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Product table:
#    +------------+--------------+------------+
#    | product_id | product_name | unit_price |
#    +------------+--------------+------------+
#    | 1          | S8           | 1000       |
#    | 2          | G4           | 800        |
#    | 3          | iPhone       | 1400       |
#    +------------+--------------+------------+
#    Sales table:
#    +-----------+------------+----------+------------+----------+-------+
#    | seller_id | product_id | buyer_id | sale_date  | quantity | price |
#    +-----------+------------+----------+------------+----------+-------+
#    | 1         | 1          | 1        | 2019-01-21 | 2        | 2000  |
#    | 1         | 2          | 2        | 2019-02-17 | 1        | 800   |
#    | 2         | 2          | 3        | 2019-06-02 | 1        | 800   |
#    | 3         | 3          | 4        | 2019-05-13 | 2        | 2800  |
#    +-----------+------------+----------+------------+----------+-------+
#    Output: 
#    +-------------+--------------+
#    | product_id  | product_name |
#    +-------------+--------------+
#    | 1           | S8           |
#    +-------------+--------------+
#    Explanation: 
#    The product with id 1 was only sold in the spring of 2019.
#    The product with id 2 was sold in the spring of 2019 but was also sold after the spring of 2019.
#    The product with id 3 was sold after spring 2019.
#    We return only product 1 as it is the product that was only sold in the spring of 2019.
#  
#  
### SOLUTION:  

SELECT P.product_id,
       P.product_name
FROM Product P
         LEFT JOIN Sales S
                   ON P.product_id = S.product_id
GROUP BY P.product_id
HAVING MIN(S.sale_date) >= "2019-01-01"
   AND MAX(S.sale_date) <= "2019-03-31";

# HAVING    MIN(sale_date) >= CAST("2019-01-01" AS DATE) AND
#    MAX(sale_date) <= CAST("2019-03-31" AS DATE)

#  -------------------------------------------------
#  1141. User Activity for the Past 30 Days I
#  https://leetcode.com/problems/user-activity-for-the-past-30-days-i/
#  Easy
#  
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | user_id       | int     |
#    | session_id    | int     |
#    | activity_date | date    |
#    | activity_type | enum    |
#    +---------------+---------+
#    There is no primary key for this table, it may have duplicate rows.
#    The activity_type column is an ENUM of type ("open_session", "end_session", "scroll_down", "send_message").
#    The table shows the user activities for a social media website. 
#    Note that each session belongs to exactly one user.
#    Write an SQL query to find the daily active user count for a period of 30 days ending 2019-07-27 inclusively. A user was active on someday if they made at least one activity on that day.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Activity table:
#    +---------+------------+---------------+---------------+
#    | user_id | session_id | activity_date | activity_type |
#    +---------+------------+---------------+---------------+
#    | 1       | 1          | 2019-07-20    | open_session  |
#    | 1       | 1          | 2019-07-20    | scroll_down   |
#    | 1       | 1          | 2019-07-20    | end_session   |
#    | 2       | 4          | 2019-07-20    | open_session  |
#    | 2       | 4          | 2019-07-21    | send_message  |
#    | 2       | 4          | 2019-07-21    | end_session   |
#    | 3       | 2          | 2019-07-21    | open_session  |
#    | 3       | 2          | 2019-07-21    | send_message  |
#    | 3       | 2          | 2019-07-21    | end_session   |
#    | 4       | 3          | 2019-06-25    | open_session  |
#    | 4       | 3          | 2019-06-25    | end_session   |
#    +---------+------------+---------------+---------------+
#    Output: 
#    +------------+--------------+ 
#    | day        | active_users |
#    +------------+--------------+ 
#    | 2019-07-20 | 2            |
#    | 2019-07-21 | 2            |
#    +------------+--------------+ 
#    Explanation: Note that we do not care about days with zero active users.
#  
#  
### SOLUTION:  

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
FROM activity
WHERE activity_date BETWEEN DATE_ADD("2019-07-27", INTERVAL - 29 DAY) AND
          "2019-07-27"
GROUP BY activity_date;

#  -------------------------------------------------
#  1148. Article Views I
#  https://leetcode.com/problems/article-views-i/
#  Easy
#  
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | article_id    | int     |
#    | author_id     | int     |
#    | viewer_id     | int     |
#    | view_date     | date    |
#    +---------------+---------+
#    There is no primary key for this table, it may have duplicate rows.
#    Each row of this table indicates that some viewer viewed an article (written by some author) on some date. 
#    Note that equal author_id and viewer_id indicate the same person.
#    Write an SQL query to find all the authors that viewed at least one of their own articles.
#    Return the result table sorted by id in ascending order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Views table:
#    +------------+-----------+-----------+------------+
#    | article_id | author_id | viewer_id | view_date  |
#    +------------+-----------+-----------+------------+
#    | 1          | 3         | 5         | 2019-08-01 |
#    | 1          | 3         | 6         | 2019-08-02 |
#    | 2          | 7         | 7         | 2019-08-01 |
#    | 2          | 7         | 6         | 2019-08-02 |
#    | 4          | 7         | 1         | 2019-07-22 |
#    | 3          | 4         | 4         | 2019-07-21 |
#    | 3          | 4         | 4         | 2019-07-21 |
#    +------------+-----------+-----------+------------+
#    Output: 
#    +------+
#    | id   |
#    +------+
#    | 4    |
#    | 7    |
#    +------+
#  
#  
### SOLUTION:  

SELECT DISTINCT author_id AS id
FROM Views
WHERE author_id = viewer_id
ORDER BY id;

#  -------------------------------------------------
#  1158. Market Analysis I
#  https://leetcode.com/problems/market-analysis-i/
#  Medium
#  
#    +----------------+---------+
#    | Column Name    | Type    |
#    +----------------+---------+
#    | user_id        | int     |
#    | join_date      | date    |
#    | favorite_brand | varchar |
#    +----------------+---------+
#    user_id is the primary key of this table.
#    This table has the info of the users of an online shopping website where users can sell and buy items.
#    Table: Orders
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | order_id      | int     |
#    | order_date    | date    |
#    | item_id       | int     |
#    | buyer_id      | int     |
#    | seller_id     | int     |
#    +---------------+---------+
#    order_id is the primary key of this table.
#    item_id is a foreign key to the Items table.
#    buyer_id and seller_id are foreign keys to the Users table.
#    Table: Items
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | item_id       | int     |
#    | item_brand    | varchar |
#    +---------------+---------+
#    item_id is the primary key of this table.
#    Write an SQL query to find for each user, the join date and the number of orders they made as a buyer in 2019.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Users table:
#    +---------+------------+----------------+
#    | user_id | join_date  | favorite_brand |
#    +---------+------------+----------------+
#    | 1       | 2018-01-01 | Lenovo         |
#    | 2       | 2018-02-09 | Samsung        |
#    | 3       | 2018-01-19 | LG             |
#    | 4       | 2018-05-21 | HP             |
#    +---------+------------+----------------+
#    Orders table:
#    +----------+------------+---------+----------+-----------+
#    | order_id | order_date | item_id | buyer_id | seller_id |
#    +----------+------------+---------+----------+-----------+
#    | 1        | 2019-08-01 | 4       | 1        | 2         |
#    | 2        | 2018-08-02 | 2       | 1        | 3         |
#    | 3        | 2019-08-03 | 3       | 2        | 3         |
#    | 4        | 2018-08-04 | 1       | 4        | 2         |
#    | 5        | 2018-08-04 | 1       | 3        | 4         |
#    | 6        | 2019-08-05 | 2       | 2        | 4         |
#    +----------+------------+---------+----------+-----------+
#    Items table:
#    +---------+------------+
#    | item_id | item_brand |
#    +---------+------------+
#    | 1       | Samsung    |
#    | 2       | Lenovo     |
#    | 3       | LG         |
#    | 4       | HP         |
#    +---------+------------+
#    Output: 
#    +-----------+------------+----------------+
#    | buyer_id  | join_date  | orders_in_2019 |
#    +-----------+------------+----------------+
#    | 1         | 2018-01-01 | 1              |
#    | 2         | 2018-02-09 | 2              |
#    | 3         | 2018-01-19 | 0              |
#    | 4         | 2018-05-21 | 0              |
#    +-----------+------------+----------------+
#  
#  
### SOLUTION:  

SELECT U.user_id      AS buyer_id,
       U.join_date,
       COUNT(item_id) AS orders_in_2019
FROM Users U
         LEFT JOIN Orders O
                   ON U.user_id = O.buyer_id AND
                      YEAR(O.order_date) = 2019
GROUP BY U.user_id;

#  -------------------------------------------------
#  1393. Capital Gain/Loss
#  https://leetcode.com/problems/capital-gainloss/
#  Medium
#  
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | stock_name    | varchar |
#    | operation     | enum    |
#    | operation_day | int     |
#    | price         | int     |
#    +---------------+---------+
#    (stock_name, operation_day) is the primary key for this table.
#    The operation column is an ENUM of type ("Sell", "Buy")
#    Each row of this table indicates that the stock which has stock_name had an operation on the day operation_day with the price.
#    It is guaranteed that each "Sell" operation for a stock has a corresponding "Buy" operation in a previous day. It is also guaranteed that each "Buy" operation for a stock has a corresponding "Sell" operation in an upcoming day.
#    Write an SQL query to report the Capital gain/loss for each stock.
#    The Capital gain/loss of a stock is the total gain or loss after buying and selling the stock one or many times.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Stocks table:
#    +---------------+-----------+---------------+--------+
#    | stock_name    | operation | operation_day | price  |
#    +---------------+-----------+---------------+--------+
#    | Leetcode      | Buy       | 1             | 1000   |
#    | Corona Masks  | Buy       | 2             | 10     |
#    | Leetcode      | Sell      | 5             | 9000   |
#    | Handbags      | Buy       | 17            | 30000  |
#    | Corona Masks  | Sell      | 3             | 1010   |
#    | Corona Masks  | Buy       | 4             | 1000   |
#    | Corona Masks  | Sell      | 5             | 500    |
#    | Corona Masks  | Buy       | 6             | 1000   |
#    | Handbags      | Sell      | 29            | 7000   |
#    | Corona Masks  | Sell      | 10            | 10000  |
#    +---------------+-----------+---------------+--------+
#    Output: 
#    +---------------+-------------------+
#    | stock_name    | capital_gain_loss |
#    +---------------+-------------------+
#    | Corona Masks  | 9500              |
#    | Leetcode      | 8000              |
#    | Handbags      | -23000            |
#    +---------------+-------------------+
#    Explanation: 
#    Leetcode stock was bought at day 1 for 1000$ and was sold at day 5 for 9000$. Capital gain = 9000 - 1000 = 8000$.
#    Handbags stock was bought at day 17 for 30000$ and was sold at day 29 for 7000$. Capital loss = 7000 - 30000 = -23000$.
#    Corona Masks stock was bought at day 1 for 10$ and was sold at day 3 for 1010$. It was bought again at day 4 for 1000$ and was sold at day 5 for 500$. At last, it was bought at day 6 for 1000$ and was sold at day 10 for 10000$. Capital gain/loss is the sum of capital gains/losses for each ('Buy' --&gt; 'Sell') operation = (1010 - 10) + (500 - 1000) + (10000 - 1000) = 1000 - 500 + 9000 = 9500$.
#  
#  
### SOLUTION:  

SELECT stock_name,
       SUM(IF(operation = "Buy", price * -1, price)) AS capital_gain_loss
FROM Stocks
GROUP BY stock_name;

#  -------------------------------------------------
#  1407. Top Travellers
#  https://leetcode.com/problems/top-travellers/
#  Easy
#  
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | id            | int     |
#    | name          | varchar |
#    +---------------+---------+
#    id is the primary key for this table.
#    name is the name of the user.
#    Table: Rides
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | id            | int     |
#    | user_id       | int     |
#    | distance      | int     |
#    +---------------+---------+
#    id is the primary key for this table.
#    user_id is the id of the user who traveled the distance "distance".
#    Write an SQL query to report the distance traveled by each user.
#    Return the result table ordered by travelled_distance in descending order, if two or more users traveled the same distance, order them by their name in ascending order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Users table:
#    +------+-----------+
#    | id   | name      |
#    +------+-----------+
#    | 1    | Alice     |
#    | 2    | Bob       |
#    | 3    | Alex      |
#    | 4    | Donald    |
#    | 7    | Lee       |
#    | 13   | Jonathan  |
#    | 19   | Elvis     |
#    +------+-----------+
#    Rides table:
#    +------+----------+----------+
#    | id   | user_id  | distance |
#    +------+----------+----------+
#    | 1    | 1        | 120      |
#    | 2    | 2        | 317      |
#    | 3    | 3        | 222      |
#    | 4    | 7        | 100      |
#    | 5    | 13       | 312      |
#    | 6    | 19       | 50       |
#    | 7    | 7        | 120      |
#    | 8    | 19       | 400      |
#    | 9    | 7        | 230      |
#    +------+----------+----------+
#    Output: 
#    +----------+--------------------+
#    | name     | travelled_distance |
#    +----------+--------------------+
#    | Elvis    | 450                |
#    | Lee      | 450                |
#    | Bob      | 317                |
#    | Jonathan | 312                |
#    | Alex     | 222                |
#    | Alice    | 120                |
#    | Donald   | 0                  |
#    +----------+--------------------+
#    Explanation: 
#    Elvis and Lee traveled 450 miles, Elvis is the top traveler as his name is alphabetically smaller than Lee.
#    Bob, Jonathan, Alex, and Alice have only one ride and we just order them by the total distances of the ride.
#    Donald did not have any rides, the distance traveled by him is 0.
#  
#  
### SOLUTION:  

SELECT name,
       IFNULL(SUM(distance), 0) AS travelled_distance
FROM Users U
         LEFT JOIN Rides R
                   ON U.id = R.user_id
GROUP BY U.ID
ORDER BY travelled_distance DESC, name ASC;

#  -------------------------------------------------
#  1484. Group Sold Products By The Date
#  https://leetcode.com/problems/group-sold-products-by-the-date/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | sell_date   | date    |
#    | product     | varchar |
#    +-------------+---------+
#    There is no primary key for this table, it may contain duplicates.
#    Each row of this table contains the product name and the date it was sold in a market.
#    Write an SQL query to find for each date the number of different products sold and their names.
#    The sold products names for each date should be sorted lexicographically.
#    Return the result table ordered by sell_date.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Activities table:
#    +------------+------------+
#    | sell_date  | product     |
#    +------------+------------+
#    | 2020-05-30 | Headphone  |
#    | 2020-06-01 | Pencil     |
#    | 2020-06-02 | Mask       |
#    | 2020-05-30 | Basketball |
#    | 2020-06-01 | Bible      |
#    | 2020-06-02 | Mask       |
#    | 2020-05-30 | T-Shirt    |
#    +------------+------------+
#    Output: 
#    +------------+----------+------------------------------+
#    | sell_date  | num_sold | products                     |
#    +------------+----------+------------------------------+
#    | 2020-05-30 | 3        | Basketball,Headphone,T-shirt |
#    | 2020-06-01 | 2        | Bible,Pencil                 |
#    | 2020-06-02 | 1        | Mask                         |
#    +------------+----------+------------------------------+
#    Explanation: 
#    For 2020-05-30, Sold items were (Headphone, Basketball, T-shirt), we sort them lexicographically and separate them by a comma.
#    For 2020-06-01, Sold items were (Pencil, Bible), we sort them lexicographically and separate them by a comma.
#    For 2020-06-02, the Sold item is (Mask), we just return it.
#  
#  
### SOLUTION:  

SELECT sell_date,
       COUNT(DISTINCT `product`)                               AS `num_sold`,
       GROUP_CONCAT(DISTINCT `product` ORDER BY `product` ASC) AS products
FROM Activities
GROUP BY sell_date
ORDER BY sell_date;

#  -------------------------------------------------
#  1527. Patients With a Condition
#  https://leetcode.com/problems/patients-with-a-condition/
#  Easy
#  
#    +--------------+---------+
#    | Column Name  | Type    |
#    +--------------+---------+
#    | patient_id   | int     |
#    | patient_name | varchar |
#    | conditions   | varchar |
#    +--------------+---------+
#    patient_id is the primary key for this table.
#    'conditions' contains 0 or more code separated by spaces. 
#    This table contains information of the patients in the hospital.
#    Write an SQL query to report the patient_id, patient_name and conditions of the patients who have Type I Diabetes. Type I Diabetes always starts with DIAB1 prefix.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Patients table:
#    +------------+--------------+--------------+
#    | patient_id | patient_name | conditions   |
#    +------------+--------------+--------------+
#    | 1          | Daniel       | YFEV COUGH   |
#    | 2          | Alice        |              |
#    | 3          | Bob          | DIAB100 MYOP |
#    | 4          | George       | ACNE DIAB100 |
#    | 5          | Alain        | DIAB201      |
#    +------------+--------------+--------------+
#    Output: 
#    +------------+--------------+--------------+
#    | patient_id | patient_name | conditions   |
#    +------------+--------------+--------------+
#    | 3          | Bob          | DIAB100 MYOP |
#    | 4          | George       | ACNE DIAB100 | 
#    +------------+--------------+--------------+
#    Explanation: Bob and George both have a condition that starts with DIAB1.
#  
#  
### SOLUTION:  

SELECT patient_id,
       patient_name,
       conditions
FROM Patients
WHERE conditions LIKE "DIAB1%"
   OR conditions LIKE "% DIAB1%";

#  -------------------------------------------------
#  1581. Customer Who Visited but Did Not Make Any Transactions
#  https://leetcode.com/problems/customer-who-visited-but-did-not-make-any-transactions/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | visit_id    | int     |
#    | customer_id | int     |
#    +-------------+---------+
#    visit_id is the primary key for this table.
#    This table contains information about the customers who visited the mall.
#    Table: Transactions
#    +----------------+---------+
#    | Column Name    | Type    |
#    +----------------+---------+
#    | transaction_id | int     |
#    | visit_id       | int     |
#    | amount         | int     |
#    +----------------+---------+
#    transaction_id is the primary key for this table.
#    This table contains information about the transactions made during the visit_id.
#    Write a&nbsp;SQL query to find the IDs of the users who visited without making any transactions and the number of times they made these types of visits.
#    Return the result table sorted in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Visits
#    +----------+-------------+
#    | visit_id | customer_id |
#    +----------+-------------+
#    | 1        | 23          |
#    | 2        | 9           |
#    | 4        | 30          |
#    | 5        | 54          |
#    | 6        | 96          |
#    | 7        | 54          |
#    | 8        | 54          |
#    +----------+-------------+
#    Transactions
#    +----------------+----------+--------+
#    | transaction_id | visit_id | amount |
#    +----------------+----------+--------+
#    | 2              | 5        | 310    |
#    | 3              | 5        | 300    |
#    | 9              | 5        | 200    |
#    | 12             | 1        | 910    |
#    | 13             | 2        | 970    |
#    +----------------+----------+--------+
#    Output: 
#    +-------------+----------------+
#    | customer_id | count_no_trans |
#    +-------------+----------------+
#    | 54          | 2              |
#    | 30          | 1              |
#    | 96          | 1              |
#    +-------------+----------------+
#    Explanation: 
#    Customer with id = 23 visited the mall once and made one transaction during the visit with id = 12.
#    Customer with id = 9 visited the mall once and made one transaction during the visit with id = 13.
#    Customer with id = 30 visited the mall once and did not make any transactions.
#    Customer with id = 54 visited the mall three times. During 2 visits they did not make any transactions, and during one visit they made 3 transactions.
#    Customer with id = 96 visited the mall once and did not make any transactions.
#    As we can see, users with IDs 30 and 96 visited the mall one time without making any transactions. Also, user 54 visited the mall twice and did not make any transactions.
#  
#  
### SOLUTION:  


SELECT `Visits`.`customer_id`, COUNT(`Visits`.`visit_id`) AS `count_no_trans`
FROM `Visits`
WHERE `Visits`.`visit_id` NOT IN (SELECT `Transactions`.`visit_id` FROM `Transactions`)
GROUP BY `Visits`.`customer_id`
ORDER BY `Visits`.`customer_id`;


# select V.customer_id, count(V.customer_id) as count_no_trans  from Visits V
# left join Transactions T 
# on V.visit_id = T.visit_id 
# where T.visit_id is null
# group by V.customer_id;

#  -------------------------------------------------
#  1587. Bank Account Summary II
#  https://leetcode.com/problems/bank-account-summary-ii/
#  Easy
#  
#    +--------------+---------+
#    | Column Name  | Type    |
#    +--------------+---------+
#    | account      | int     |
#    | name         | varchar |
#    +--------------+---------+
#    account is the primary key for this table.
#    Each row of this table contains the account number of each user in the bank.
#    There will be no two users having the same name in the table.
#    Table: Transactions
#    +---------------+---------+
#    | Column Name   | Type    |
#    +---------------+---------+
#    | trans_id      | int     |
#    | account       | int     |
#    | amount        | int     |
#    | transacted_on | date    |
#    +---------------+---------+
#    trans_id is the primary key for this table.
#    Each row of this table contains all changes made to all accounts.
#    amount is positive if the user received money and negative if they transferred money.
#    All accounts start with a balance of 0.
#    Write an SQL query to report the name and balance of users with a balance higher than 10000. The balance of an account is equal to the sum of the amounts of all transactions involving that account.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Users table:
#    +------------+--------------+
#    | account    | name         |
#    +------------+--------------+
#    | 900001     | Alice        |
#    | 900002     | Bob          |
#    | 900003     | Charlie      |
#    +------------+--------------+
#    Transactions table:
#    +------------+------------+------------+---------------+
#    | trans_id   | account    | amount     | transacted_on |
#    +------------+------------+------------+---------------+
#    | 1          | 900001     | 7000       |  2020-08-01   |
#    | 2          | 900001     | 7000       |  2020-09-01   |
#    | 3          | 900001     | -3000      |  2020-09-02   |
#    | 4          | 900002     | 1000       |  2020-09-12   |
#    | 5          | 900003     | 6000       |  2020-08-07   |
#    | 6          | 900003     | 6000       |  2020-09-07   |
#    | 7          | 900003     | -4000      |  2020-09-11   |
#    +------------+------------+------------+---------------+
#    Output: 
#    +------------+------------+
#    | name       | balance    |
#    +------------+------------+
#    | Alice      | 11000      |
#    +------------+------------+
#    Explanation: 
#    Alice's balance is (7000 + 7000 - 3000) = 11000.
#    Bob's balance is 1000.
#    Charlie's balance is (6000 + 6000 - 4000) = 8000.
#  
#  
### SOLUTION:  

SELECT U.name,
       SUM(amount) AS balance
FROM Users U
         LEFT JOIN Transactions T
                   ON U.account = T.account
GROUP BY U.name
HAVING SUM(amount) > 10000;

#  -------------------------------------------------
#  1667. Fix Names in a Table
#  https://leetcode.com/problems/fix-names-in-a-table/
#  Easy
#  
#    +----------------+---------+
#    | Column Name    | Type    |
#    +----------------+---------+
#    | user_id        | int     |
#    | name           | varchar |
#    +----------------+---------+
#    user_id is the primary key for this table.
#    This table contains the ID and the name of the user. The name consists of only lowercase and uppercase characters.
#    Write an SQL query to fix the names so that only the first character is uppercase and the rest are lowercase.
#    Return the result table ordered by user_id.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Users table:
#    +---------+-------+
#    | user_id | name  |
#    +---------+-------+
#    | 1       | aLice |
#    | 2       | bOB   |
#    +---------+-------+
#    Output: 
#    +---------+-------+
#    | user_id | name  |
#    +---------+-------+
#    | 1       | Alice |
#    | 2       | Bob   |
#    +---------+-------+
#  
#  
### SOLUTION:  

SELECT user_id,
       CONCAT(UCASE(LEFT(name, 1)), LCASE(SUBSTRING(name, 2))) AS name
FROM Users
ORDER BY user_id;

#  -------------------------------------------------
#  1693. Daily Leads and Partners
#  https://leetcode.com/problems/daily-leads-and-partners/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | date_id     | date    |
#    | make_name   | varchar |
#    | lead_id     | int     |
#    | partner_id  | int     |
#    +-------------+---------+
#    This table does not have a primary key.
#    This table contains the date and the name of the product sold and the IDs of the lead and partner it was sold to.
#    The name consists of only lowercase English letters.
#    Write an SQL query that will, for each date_id and make_name, return the number of distinct lead_id's and distinct partner_id's.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    DailySales table:
#    +-----------+-----------+---------+------------+
#    | date_id   | make_name | lead_id | partner_id |
#    +-----------+-----------+---------+------------+
#    | 2020-12-8 | toyota    | 0       | 1          |
#    | 2020-12-8 | toyota    | 1       | 0          |
#    | 2020-12-8 | toyota    | 1       | 2          |
#    | 2020-12-7 | toyota    | 0       | 2          |
#    | 2020-12-7 | toyota    | 0       | 1          |
#    | 2020-12-8 | honda     | 1       | 2          |
#    | 2020-12-8 | honda     | 2       | 1          |
#    | 2020-12-7 | honda     | 0       | 1          |
#    | 2020-12-7 | honda     | 1       | 2          |
#    | 2020-12-7 | honda     | 2       | 1          |
#    +-----------+-----------+---------+------------+
#    Output: 
#    +-----------+-----------+--------------+-----------------+
#    | date_id   | make_name | unique_leads | unique_partners |
#    +-----------+-----------+--------------+-----------------+
#    | 2020-12-8 | toyota    | 2            | 3               |
#    | 2020-12-7 | toyota    | 1            | 2               |
#    | 2020-12-8 | honda     | 2            | 2               |
#    | 2020-12-7 | honda     | 3            | 2               |
#    +-----------+-----------+--------------+-----------------+
#    Explanation: 
#    For 2020-12-8, toyota gets leads = [0, 1] and partners = [0, 1, 2] while honda gets leads = [1, 2] and partners = [1, 2].
#    For 2020-12-7, toyota gets leads = [0] and partners = [1, 2] while honda gets leads = [0, 1, 2] and partners = [1, 2].
#  
#  
### SOLUTION:  

SELECT `date_id`,
       `make_name`,
       COUNT(DISTINCT `lead_id`)    AS unique_leads,
       COUNT(DISTINCT `partner_id`) AS `unique_partners`
FROM DailySales
GROUP BY `date_id`, `make_name`;

#  -------------------------------------------------
#  1729. Find Followers Count
#  https://leetcode.com/problems/find-followers-count/
#  Easy
#  
#    +-------------+------+
#    | Column Name | Type |
#    +-------------+------+
#    | user_id     | int  |
#    | follower_id | int  |
#    +-------------+------+
#    (user_id, follower_id) is the primary key for this table.
#    This table contains the IDs of a user and a follower in a social media app where the follower follows the user.
#    Write an SQL query that will, for each user, return the number of followers.
#    Return the result table ordered by user_id in ascending order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Followers table:
#    +---------+-------------+
#    | user_id | follower_id |
#    +---------+-------------+
#    | 0       | 1           |
#    | 1       | 0           |
#    | 2       | 0           |
#    | 2       | 1           |
#    +---------+-------------+
#    Output: 
#    +---------+----------------+
#    | user_id | followers_count|
#    +---------+----------------+
#    | 0       | 1              |
#    | 1       | 1              |
#    | 2       | 2              |
#    +---------+----------------+
#    Explanation: 
#    The followers of 0 are {1}
#    The followers of 1 are {0}
#    The followers of 2 are {0,1}
#  
#  
### SOLUTION:  

SELECT user_id,
       COUNT(follower_id) AS followers_count
FROM Followers
GROUP BY user_id
ORDER BY user_id;

#  -------------------------------------------------
#  1741. Find Total Time Spent by Each Employee
#  https://leetcode.com/problems/find-total-time-spent-by-each-employee/
#  Easy
#  
#    +-------------+------+
#    | Column Name | Type |
#    +-------------+------+
#    | emp_id      | int  |
#    | event_day   | date |
#    | in_time     | int  |
#    | out_time    | int  |
#    +-------------+------+
#    (emp_id, event_day, in_time) is the primary key of this table.
#    The table shows the employees' entries and exits in an office.
#    event_day is the day at which this event happened, in_time is the minute at which the employee entered the office, and out_time is the minute at which they left the office.
#    in_time and out_time are between 1 and 1440.
#    It is guaranteed that no two events on the same day intersect in time, and in_time &lt; out_time.
#    Write an SQL query to calculate the total time in minutes spent by each employee on each day at the office. Note that within one day, an employee can enter and leave more than once. The time spent in the office for a single entry is out_time - in_time.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input:
#    Employees table:
#    +--------+------------+---------+----------+
#    | emp_id | event_day  | in_time | out_time |
#    +--------+------------+---------+----------+
#    | 1      | 2020-11-28 | 4       | 32       |
#    | 1      | 2020-11-28 | 55      | 200      |
#    | 1      | 2020-12-03 | 1       | 42       |
#    | 2      | 2020-11-28 | 3       | 33       |
#    | 2      | 2020-12-09 | 47      | 74       |
#    +--------+------------+---------+----------+
#    Output:
#    +------------+--------+------------+
#    | day        | emp_id | total_time |
#    +------------+--------+------------+
#    | 2020-11-28 | 1      | 173        |
#    | 2020-11-28 | 2      | 30         |
#    | 2020-12-03 | 1      | 41         |
#    | 2020-12-09 | 2      | 27         |
#    +------------+--------+------------+
#    Explanation:
#    Employee 1 has three events: two on day 2020-11-28 with a total of (32 - 4) + (200 - 55) = 173, and one on day 2020-12-03 with a total of (42 - 1) = 41.
#    Employee 2 has two events: one on day 2020-11-28 with a total of (33 - 3) = 30, and one on day 2020-12-09 with a total of (74 - 47) = 27.
#  
#  
### SOLUTION:  

SELECT event_day               AS day,
       emp_id,
       SUM(out_time - in_time) AS total_time
FROM Employees
GROUP BY event_day,
         emp_id
ORDER BY day,
         emp_id

#  -------------------------------------------------
#  1757. Recyclable and Low Fat Products
#  https://leetcode.com/problems/recyclable-and-low-fat-products/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | product_id  | int     |
#    | low_fats    | enum    |
#    | recyclable  | enum    |
#    +-------------+---------+
#    product_id is the primary key for this table.
#    low_fats is an ENUM of type ('Y', 'N') where 'Y' means this product is low fat and 'N' means it is not.
#    recyclable is an ENUM of types ('Y', 'N') where 'Y' means this product is recyclable and 'N' means it is not.
#    Write an SQL query to find the ids of products that are both low fat and recyclable.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Products table:
#    +-------------+----------+------------+
#    | product_id  | low_fats | recyclable |
#    +-------------+----------+------------+
#    | 0           | Y        | N          |
#    | 1           | Y        | Y          |
#    | 2           | N        | Y          |
#    | 3           | Y        | Y          |
#    | 4           | N        | N          |
#    +-------------+----------+------------+
#    Output: 
#    +-------------+
#    | product_id  |
#    +-------------+
#    | 1           |
#    | 3           |
#    +-------------+
#    Explanation: Only products 1 and 3 are both low fat and recyclable.
#  
#  
### SOLUTION:  

SELECT product_id
FROM Products
WHERE low_fats = "Y"
  AND recyclable = "Y";

#  -------------------------------------------------
#  1795. Rearrange Products Table
#  https://leetcode.com/problems/rearrange-products-table/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | product_id  | int     |
#    | store1      | int     |
#    | store2      | int     |
#    | store3      | int     |
#    +-------------+---------+
#    product_id is the primary key for this table.
#    Each row in this table indicates the product's price in 3 different stores: store1, store2, and store3.
#    If the product is not available in a store, the price will be null in that store's column.
#    Write an SQL query to rearrange the Products table so that each row has (product_id, store, price). If a product is not available in a store, do not include a row with that product_id and store combination in the result table.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Products table:
#    +------------+--------+--------+--------+
#    | product_id | store1 | store2 | store3 |
#    +------------+--------+--------+--------+
#    | 0          | 95     | 100    | 105    |
#    | 1          | 70     | null   | 80     |
#    +------------+--------+--------+--------+
#    Output: 
#    +------------+--------+-------+
#    | product_id | store  | price |
#    +------------+--------+-------+
#    | 0          | store1 | 95    |
#    | 0          | store2 | 100   |
#    | 0          | store3 | 105   |
#    | 1          | store1 | 70    |
#    | 1          | store3 | 80    |
#    +------------+--------+-------+
#    Explanation: 
#    Product 0 is available in all three stores with prices 95, 100, and 105 respectively.
#    Product 1 is available in store1 with price 70 and store3 with price 80. The product is not available in store2.
#  
#  
### SOLUTION:  

SELECT `product_id`, "store1" AS `store`, `store1` AS `price`
FROM `Products`
WHERE `store1` IS NOT NULL
UNION
SELECT `product_id`, "store2" AS `store`, `store2` AS `price`
FROM `Products`
WHERE `store2` IS NOT NULL
UNION
SELECT `product_id`, "store3" AS `store`, `store3` AS `price`
FROM `Products`
WHERE `store3` IS NOT NULL;

#  -------------------------------------------------
#  1873. Calculate Special Bonus
#  https://leetcode.com/problems/calculate-special-bonus/
#  Easy
#  
#    +-------------+---------+
#    | Column Name | Type    |
#    +-------------+---------+
#    | employee_id | int     |
#    | name        | varchar |
#    | salary      | int     |
#    +-------------+---------+
#    employee_id is the primary key for this table.
#    Each row of this table indicates the employee ID, employee name, and salary.
#    Write an SQL query to calculate the bonus of each employee. The bonus of an employee is 100% of their salary if the ID of the employee is an odd number and the employee name does not start with the character 'M'. The bonus of an employee is 0 otherwise.
#    Return the result table ordered by employee_id.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Employees table:
#    +-------------+---------+--------+
#    | employee_id | name    | salary |
#    +-------------+---------+--------+
#    | 2           | Meir    | 3000   |
#    | 3           | Michael | 3800   |
#    | 7           | Addilyn | 7400   |
#    | 8           | Juan    | 6100   |
#    | 9           | Kannon  | 7700   |
#    +-------------+---------+--------+
#    Output: 
#    +-------------+-------+
#    | employee_id | bonus |
#    +-------------+-------+
#    | 2           | 0     |
#    | 3           | 0     |
#    | 7           | 7400  |
#    | 8           | 0     |
#    | 9           | 7700  |
#    +-------------+-------+
#    Explanation: 
#    The employees with IDs 2 and 8 get 0 bonus because they have an even employee_id.
#    The employee with ID 3 gets 0 bonus because their name starts with 'M'.
#    The rest of the employees get a 100% bonus.
#  
#  
### SOLUTION:  

SELECT employee_id,
       IF((MOD(employee_id, 2) <> 0 AND `name` NOT LIKE "M%"), salary, 0) AS bonus
FROM Employees
ORDER BY employee_id;

#  -------------------------------------------------
#  1890. The Latest Login in 2020
#  https://leetcode.com/problems/the-latest-login-in-2020/
#  Easy
#  
#    +----------------+----------+
#    | Column Name    | Type     |
#    +----------------+----------+
#    | user_id        | int      |
#    | time_stamp     | datetime |
#    +----------------+----------+
#    (user_id, time_stamp) is the primary key for this table.
#    Each row contains information about the login time for the user with ID user_id.
#    Write an SQL query to report the latest login for all users in the year 2020. Do not include the users who did not login in 2020.
#    Return the result table in any order.
#    The query result format is in the following example.
#    Example 1:
#    Input: 
#    Logins table:
#    +---------+---------------------+
#    | user_id | time_stamp          |
#    +---------+---------------------+
#    | 6       | 2020-06-30 15:06:07 |
#    | 6       | 2021-04-21 14:06:06 |
#    | 6       | 2019-03-07 00:18:15 |
#    | 8       | 2020-02-01 05:10:53 |
#    | 8       | 2020-12-30 00:46:50 |
#    | 2       | 2020-01-16 02:49:50 |
#    | 2       | 2019-08-25 07:59:08 |
#    | 14      | 2019-07-14 09:00:00 |
#    | 14      | 2021-01-06 11:59:59 |
#    +---------+---------------------+
#    Output: 
#    +---------+---------------------+
#    | user_id | last_stamp          |
#    +---------+---------------------+
#    | 6       | 2020-06-30 15:06:07 |
#    | 8       | 2020-12-30 00:46:50 |
#    | 2       | 2020-01-16 02:49:50 |
#    +---------+---------------------+
#    Explanation: 
#    User 6 logged into their account 3 times but only once in 2020, so we include this login in the result table.
#    User 8 logged into their account 2 times in 2020, once in February and once in December. We include only the latest one (December) in the result table.
#    User 2 logged into their account 2 times but only once in 2020, so we include this login in the result table.
#    User 14 did not login in 2020, so we do not include them in the result table.
#  
#  
### SOLUTION:  

# SELECT    user_id, 
#           time_stamp AS last_stamp     
# FROM      Logins
# WHERE     time_stamp IN
#           (     SELECT     MAX(time_stamp) 
#                 FROM       Logins 
#                 WHERE      YEAR(time_stamp) = 2020 
#                 GROUP BY   user_id 
#           )
# GROUP BY  user_id      
SELECT user_id,
       MAX(time_stamp) AS last_stamp
FROM Logins
WHERE YEAR(time_stamp) = 2020
GROUP BY user_id;

#  -------------------------------------------------
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

