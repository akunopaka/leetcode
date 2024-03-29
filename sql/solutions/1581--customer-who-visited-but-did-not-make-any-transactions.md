### 1581. Customer Who Visited but Did Not Make Any Transactions

Difficulty: `Easy`

https://leetcode.com/problems/customer-who-visited-but-did-not-make-any-transactions/


<pre>+-------------+---------+
| Column Name | Type    |
+-------------+---------+
| visit_id    | int     |
| customer_id | int     |
+-------------+---------+
visit_id is the primary key for this table.
This table contains information about the customers who visited the mall.
</pre>
<p>Table: <code>Transactions</code></p>
<pre>+----------------+---------+
| Column Name    | Type    |
+----------------+---------+
| transaction_id | int     |
| visit_id       | int     |
| amount         | int     |
+----------------+---------+
transaction_id is the primary key for this table.
This table contains information about the transactions made during the visit_id.
</pre>
<p>Write a&nbsp;SQL query to find the IDs of the users who visited without making any transactions and the number of times they made these types of visits.</p>
<p>Return the result table sorted in <strong>any order</strong>.</p>
<p>The query result format is in the following example.</p>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input:</strong> 
Visits
+----------+-------------+
| visit_id | customer_id |
+----------+-------------+
| 1        | 23          |
| 2        | 9           |
| 4        | 30          |
| 5        | 54          |
| 6        | 96          |
| 7        | 54          |
| 8        | 54          |
+----------+-------------+
Transactions
+----------------+----------+--------+
| transaction_id | visit_id | amount |
+----------------+----------+--------+
| 2              | 5        | 310    |
| 3              | 5        | 300    |
| 9              | 5        | 200    |
| 12             | 1        | 910    |
| 13             | 2        | 970    |
+----------------+----------+--------+
<strong>Output:</strong> 
+-------------+----------------+
| customer_id | count_no_trans |
+-------------+----------------+
| 54          | 2              |
| 30          | 1              |
| 96          | 1              |
+-------------+----------------+
<strong>Explanation:</strong> 
Customer with id = 23 visited the mall once and made one transaction during the visit with id = 12.
Customer with id = 9 visited the mall once and made one transaction during the visit with id = 13.
Customer with id = 30 visited the mall once and did not make any transactions.
Customer with id = 54 visited the mall three times. During 2 visits they did not make any transactions, and during one visit they made 3 transactions.
Customer with id = 96 visited the mall once and did not make any transactions.
As we can see, users with IDs 30 and 96 visited the mall one time without making any transactions. Also, user 54 visited the mall twice and did not make any transactions.
</pre>

### My Solution(s):

##### SQL:

```sql
# Write your MySQL query statement below

SELECT   `Visits`.`customer_id`, COUNT(`Visits`.`visit_id`) AS `count_no_trans` 
FROM     `Visits`
WHERE    `Visits`.`visit_id` NOT IN (SELECT `Transactions`.`visit_id` FROM `Transactions`)
GROUP BY `Visits`.`customer_id`
ORDER BY `Visits`.`customer_id`;


# select V.customer_id, count(V.customer_id) as count_no_trans  from Visits V
# left join Transactions T 
# on V.visit_id = T.visit_id 
# where T.visit_id is null
# group by V.customer_id;
```
