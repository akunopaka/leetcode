// 382. Linked List Random Node
// https://leetcode.com/problems/linked-list-random-node/
// Medium
//Given a singly linked list, return a random node's value from the linked list. Each node must have the same probability of being chosen.
//Implement the Solution class:
//Solution(ListNode head) Initializes the object with the head of the singly-linked list head.
//int getRandom() Chooses a node randomly from the list and returns its value. All the nodes of the list should be equally likely to be chosen.
//
//Example 1:
//Input
//["Solution", "getRandom", "getRandom", "getRandom", "getRandom", "getRandom"]
//[[[1, 2, 3]], [], [], [], [], []]
//Output
//[null, 1, 3, 2, 2, 3]
//Explanation
//Solution solution = new Solution([1, 2, 3]);
//solution.getRandom(); // return 1
//solution.getRandom(); // return 3
//solution.getRandom(); // return 2
//solution.getRandom(); // return 2
//solution.getRandom(); // return 3
//// getRandom() should return either 1, 2, or 3 randomly. Each element should have equal probability of returning.
//
//Constraints:
//The number of nodes in the linked list will be in the range [1, 104].
//-104 <= Node.val <= 104
//At most 104 calls will be made to getRandom.
//Follow up:
//What if the linked list is extremely large and its length is unknown to you?
//Could you solve this efficiently without using extra space?


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