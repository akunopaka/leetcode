//  946. Validate Stack Sequences
//  https://leetcode.com/problems/validate-stack-sequences/
//  Medium
//  
//    Given two integer arrays pushed and popped each with distinct values, return true if this could have been the result of a sequence of push and pop operations on an initially empty stack, or false otherwise.
//    Example 1:
//    Input: pushed = [1,2,3,4,5], popped = [4,5,3,2,1]
//    Output: true
//    Explanation: We might do the following sequence:
//    push(1), push(2), push(3), push(4),
//    pop() -&gt; 4,
//    push(5),
//    pop() -&gt; 5, pop() -&gt; 3, pop() -&gt; 2, pop() -&gt; 1
//    Example 2:
//    Input: pushed = [1,2,3,4,5], popped = [4,3,5,1,2]
//    Output: false
//    Explanation: 1 cannot be popped before 2.
//    Constraints:
//    1 &lt;= pushed.length &lt;= 1000
//    0 &lt;= pushed[i] &lt;= 1000
//    All the elements of pushed are unique.
//    popped.length == pushed.length
//    popped is a permutation of pushed.

/**
 * @param {number[]} pushed
 * @param {number[]} popped
 * @return {boolean}
 */
var validateStackSequences = function (pushed, popped) {
    let stack = [];
    let i = 0;
    for (let j = 0; j < pushed.length; j++) {
        stack.push(pushed[j]);
        while (stack.length && stack[stack.length - 1] === popped[i]) {
            stack.pop();
            i++;
        }
    }
    return stack.length === 0;
};