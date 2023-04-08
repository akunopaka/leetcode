### 382. Linked List Random Node

Difficulty: `Medium`

https://leetcode.com/problems/linked-list-random-node/

My solutions on LeetCode:
https://leetcode.com/discuss/topic/3280604/php-beats-100javascript-93-3-best-solutions/

<p>&nbsp;</p>

<p>Given a singly linked list, return a random node's value from the linked list. Each node must have the <strong>same probability</strong> of being chosen.</p>

<p>Implement the <code>Solution</code> class:</p>

<ul>
	<li><code>Solution(ListNode head)</code> Initializes the object with the head of the singly-linked list <code>head</code>.</li>
	<li><code>int getRandom()</code> Chooses a node randomly from the list and returns its value. All the nodes of the list should be equally likely to be chosen.</li>
</ul>

<p><strong class="example">Example 1:</strong></p>
<img alt="" src="https://assets.leetcode.com/uploads/2021/03/16/getrand-linked-list.jpg" style="width: 302px; height: 62px;">
<pre><strong>Input</strong>
["Solution", "getRandom", "getRandom", "getRandom", "getRandom", "getRandom"]
[[[1, 2, 3]], [], [], [], [], []]
<strong>Output</strong>
[null, 1, 3, 2, 2, 3]

<strong>Explanation</strong>
Solution solution = new Solution([1, 2, 3]);
solution.getRandom(); // return 1
solution.getRandom(); // return 3
solution.getRandom(); // return 2
solution.getRandom(); // return 2
solution.getRandom(); // return 3
// getRandom() should return either 1, 2, or 3 randomly. Each element should have equal probability of returning.
</pre>

<p>&nbsp;</p>
<p><strong>Constraints:</strong></p>

<ul>
	<li>The number of nodes in the linked list will be in the range <code>[1, 10<sup>4</sup>]</code>.</li>
	<li><code>-10<sup>4</sup> &lt;= Node.val &lt;= 10<sup>4</sup></code></li>
	<li>At most <code>10<sup>4</sup></code> calls will be made to <code>getRandom</code>.</li>
</ul>

<p><strong>Follow up:</strong></p>

<ul>
	<li>What if the linked list is extremely large and its length is unknown to you?</li>
	<li>Could you solve this efficiently without using extra space?</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

* SOLUTION #**1**/3 - reservoir sampling
* SOLUTION #**2**/3 -- Count the nodes, get random number, traverse the list and return the node at random number
  position
* SOLUTION #**3**/3 -- make array from ListNode and get random element from there

##### JavaScript

```js
// SOLUTION #1/3 - reservoir sampling
/**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 */
var Solution = function (head) {
    this.head = head;
};
/**
 * @return {number}
 */
Solution.prototype.getRandom = function () {
    let node = this.head;
    let val;

    //  traverse the list
    let i = 0;
    while (node) {
        i++;
        // R algorithm
        if (Math.floor(Math.random() * i) + 1 == i) {
            val = node.val;
        }
        // go to next node
        node = node.next;
    }

    return val;
};
/**
 * Your Solution object will be instantiated and called as such:
 * var obj = new Solution(head)
 * var param_1 = obj.getRandom()
 */


// Solution #2/3 -- Count the nodes, get random number, traverse the list and return the node at random number position
/**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 */
var Solution = function (head) {
    let node = head;
    this.len = 0;
    this.head = head;
    while (node) {
        this.len++;
        node = node.next;
    }
};
/**
 * Returns a random node's value.
 * @return {number}
 */
Solution.prototype.getRandom = function () {
    let rand = Math.floor(Math.random() * this.len), node = this.head;
    for (let i = 0; i < rand; i++)
        node = node.next;
    return node.val;
};
/**
 * Your Solution object will be instantiated and called as such:
 * var obj = new Solution(head)
 * var param_1 = obj.getRandom()
 */


// SOLUTION 3/3  make array from ListNode and get random element from there
var Solution = function (head) {
    arr = [];
    while (head) {
        arr.push(head.val);
        head = head.next;
    }
};
Solution.prototype.getRandom = function () {
    let rand = Math.floor(Math.random() * arr.length)
    return arr[rand];
};
```

##### PHP

```php
// SOLUTION #1/3 - reservoir sampling
// R Algorithm, O(n) time, O(1) space,
class Solution
{
    private $head;

    /**
     * @param ListNode $head
     */
    function __construct(ListNode $head)
    {
        $this->head = $head;
    }

    /**
     * @return Integer
     */
    function getRandom(): int
    {
        $i = $val = 0;
        $node = $this->head;
        while ($node) {
            // R Algorithm
            if (rand(1, ++$i) == $i) $val = $node->val;
            $node = $node->next;
        }
        return $val;
    }
}
/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($head);
 * $ret_1 = $obj->getRandom();
 */


// Solution #2/3 -- Count the nodes, get random number, traverse the list and return the node at random number position
// Solution #2/3
// Solution #2/3
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution___2
{
    /**
     * @param ListNode $head
     */
    function __construct(ListNode $head)
    {
        $this->head = $head;
    }
    /**
     * @return Integer
     */
    function getRandom(): int
    {
        $node = $this->head;

        // Get count of nodes
        $countNodes = 0;
        while ($node != null) {
            $countNodes++;
            $node = $node->next;
        }

        // Generate a random number between 0 and n-1
        $rand = rand(0, $countNodes - 1);

        // Traverse the linked list and return the node at random number position
        $node = $this->head;
        while ($rand > 0) {
            $node = $node->next;
            $rand--;
        }
        return $node->val;
    }
}
/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($head);
 * $ret_1 = $obj->getRandom();
 */


// Solution #3/3 -- make array from ListNode and get random element from there
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution__3
{
    private array $storage;

    /**
     * @param ListNode $head
     */
    function __construct(ListNode $head)
    {
        while ($head) {
            $this->storage[] = $head->val;
            $head = $head->next;
        }
    }

    /**
     * @return Integer
     */
    function getRandom(): int
    {
        return $this->storage[array_rand($this->storage)];
    }
}
/**
 * Your Solution object will be instantiated and called as such:
 * $obj = Solution($head);
 * $ret_1 = $obj->getRandom();
 */
```

### Leetcode Solution POST

#### Randomly selecting a value from a singly linked list

Here you can get acquainted with **3 different solutions**. Solutions implemented in **PHP** and **JavaScript**

- SOLUTION #1 - Using a new array from ListNode and get random element from there
- SOLUTION #2 - Count the nodes, get random number, traverse the list and return the node at random number position
- SOLUTION #3 - RReservoir Sampling for Linked Lists

##### SOLUTION #1/3 -- make array from ListNode and get random element from there

This solution utilizes a while loop to traverse the linked list and push the values of each node into an array. The
getRandom function then selects a random index from the array, and returns the value stored in the corresponding index.
*Time complexity:* O(n) as we traverse through the linked list once and store the values in an array.
*Space complexity:* O(n) as the array created has to store all the elements in the linked list.

 ```JavaScript []
 /**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 */
var Solution = function (head) {
    array = [];
    while (head) {
        arr.push(head.val);
        head = head.next;
    }
};
/**
 * Returns a random node's value.
 * @return {number}
 */
Solution.prototype.getRandom = function () {
    return array[Math.floor(Math.random() * array.length)];
};
/**
 * Your Solution object will be instantiated and called as such:
 * var obj = new Solution(head)
 * var param_1 = obj.getRandom()
 */
 ```

 ```PHP []
 /**
  * Definition for a singly-linked list.
  * class ListNode {
  *     public $val = 0;
  *     public $next = null;
  *     function __construct($val = 0, $next = null) {
  *         $this->val = $val;
  *         $this->next = $next;
  *     }
  * }
  */
 class Solution
 {
     private array $storage;

     /**
      * @param ListNode $head
      */
     function __construct(ListNode $head)
     {
         while ($head) {
             $this->storage[] = $head->val;
             $head = $head->next;
         }
     }

     /**
      * @return Integer
      */
     function getRandom(): inT {
         return $this->storage[array_rand($this->storage)];
     }
 }

 /**
  * Your Solution object will be instantiated and called as such:
  * $obj = Solution($head);
  * $ret_1 = $obj->getRandom();
  */
 ```

##### SOLUTION #2/3 -- Count the nodes, get a random number, traverse the list, and return the node at the random number position.

This approach uses a combination of two techniques to solve the problem. The first is to traverse the linked list and
count the total number of nodes. Then, generate a random number between 0 and n-1, where n is the total number of nodes.
Finally, traverse the linked list again until the random number position is reached.
*Time complexity*: O(n), as it requires traversing the linked list *twice*.
*Space complexity*: O(1), as no extra space is used.

 ```javascript []
 /**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 */
var Solution = function (head) {
    let node = head;
    this.length = 0;
    this.head = head;
    while (node) {
        this.length++;
        node = node.next;
    }
};
/**
 * Returns a random node's value.
 * @return {number}
 */
Solution.prototype.getRandom = function () {
    let rand = Math.floor(Math.random() * this.length), node = this.head;
    for (let i = 0; i < rand; i++)
        node = node.next;
    return node.val;
};
/**
 * Your Solution object will be instantiated and called as such:
 * var obj = new Solution(head)
 * var param_1 = obj.getRandom()
 */
 ```

 ```PHP []
 /**
  * Definition for a singly-linked list.
  * class ListNode {
  *     public $val = 0;
  *     public $next = null;
  *     function __construct($val = 0, $next = null) {
  *         $this->val = $val;
  *         $this->next = $next;
  *     }
  * }
  */
 class Solution
 {
     /**
      * @param ListNode $head
      */
     function __construct(ListNode $head)
     {
         $this->head = $head;
     }

     /**
      * @return Integer
      */
     function getRandom(): int
     {
         $node = $this->head;

         // Get count of nodes
         $countNodes = 0;
         while ($node != null) {
             $countNodes++;
             $node = $node->next;
         }

         // Generate a random number between 0 and n-1
         $rand = rand(0, $countNodes - 1);

         // Traverse the linked list and return the node at random number position
         $node = $this->head;
         while ($rand > 0) {
             $node = $node->next;
             $rand--;
         }
         return $node->val;
     }
 }
 /**
  * Your Solution object will be instantiated and called as such:
  * $obj = Solution($head);
  * $ret_1 = $obj->getRandom();
  */
 ```

##### SOLUTION #3/3 -- Reservoir Sampling for Linked Lists

This solution implements the Reservoir Sampling algorithm, which is a technique used to randomly select a sample from a
given data set. The algorithm is based on the probability that each item in the data set has an equal chance of being
selected. In this case, the data set is a linked list.

This solution uses the R Select Algorithm to randomly select a node from a given linked list. The algorithm traverses
the list, and at each step it randomly chooses the node to be the result. After the loop exits, the last node that was
randomly chosen will be the result.

*Time Complexity:* O(N), where N is the number of nodes in the linked list.
*Space Complexity:* O(1), since only one variable is used to store the result. No extra space is required.

 ```javascript []
 /**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} head
 */
var Solution = function (head) {
    this.head = head;
};

/**
 * @return {number}
 */
Solution.prototype.getRandom = function () {
    let node = this.head;
    let val;

    //  traverse the list
    let i = 0;
    while (node) {
        i++;
        // R algorithm
        if (Math.floor(Math.random() * i) + 1 == i) {
            val = node.val;
        }
        // go to next node
        node = node.next;
    }

    return val;
};
/**
 * Your Solution object will be instantiated and called as such:
 * var obj = new Solution(head)
 * var param_1 = obj.getRandom()
 */
 ```

 ```PHP []
 class Solution
 {
     private $head;

     /**
      * @param ListNode $head
      */
     function __construct(ListNode $head)
     {
         $this->head = $head;
     }

     /**
      * @return Integer
      */
     function getRandom(): int
     {
         $i = $val = 0;
         $node = $this->head;
         while ($node) {
             // R Algorithm
             if (rand(1, ++$i) == $i) $val = $node->val;
             $node = $node->next;
         }
         return $val;
     }
 }

 /**
  * Your Solution object will be instantiated and called as such:
  * $obj = Solution($head);
  * $ret_1 = $obj->getRandom();
  */
 ```

# If my work was useful for you, please upvote

👍👍👍



