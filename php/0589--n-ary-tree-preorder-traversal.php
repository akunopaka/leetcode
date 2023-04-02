<?php
//    589. N-ary Tree Preorder Traversal
//    Easy
//    https://leetcode.com/problems/n-ary-tree-preorder-traversal/
//    Given the root of an n-ary tree, return the preorder traversal of its nodes' values.
//    Nary-Tree input serialization is represented in their level order traversal. Each group of children is separated by the null value (See examples)
//
//    Example 1:
//    Input: root = [1,null,3,2,4,null,5,6]
//    Output: [1,3,5,6,2,4]
//    Example 2:
//    Input: root = [1,null,2,3,4,5,null,null,6,7,null,8,null,9,10,null,null,11,null,12,null,13,null,null,14]
//    Output: [1,2,3,6,7,11,14,4,8,12,5,9,13,10]
//    Constraints:
//    The number of nodes in the tree is in the range [0, 104].
//    0 <= Node.val <= 104
//    The height of the n-ary tree is less than or equal to 1000.
//
//    Follow up: Recursive solution is trivial, could you do it iteratively?

/**
 * Definition for a Node.
 * class Node {
 *     public $val = null;
 *     public $children = null;
 *     function __construct($val = 0) {
 *         $this->val = $val;
 *         $this->children = array();
 *     }
 * }
 */
class Node
{
    public $val = null;
    public $children = null;

    function __construct($val = 0) {
        $this->val = $val;
        $this->children = array();
    }
}

class Solution
{
    /**
     * @param Node $root
     * @return integer[]
     */
    function preorder_sulution_Recursive($root) {
        $res = [];
        if ($root == null) {
            return $res;
        }
        $res[] = $root->val;
        foreach ($root->children as $child) {
            $res = array_merge($res, $this->preorder($child));
        }
        return $res;
    }

    function preorder($root) {
        $res = [];
        if ($root == null) return $res;
        $queue = [];
        while ($root != null) {
            $res[] = $root->val;
            $queue = array_merge($queue, array_reverse($root->children));
            $root = array_pop($queue);
        }
        return $res;
    }
}


// MAKE 4 LEVEL N-ary Tree
$tree = new NaryTree();
$tree->addNode(new Node(0));
$tree->addNode(new Node(2), $tree->root);
$tree->addNode(new Node(4), $tree->root->children[0]);
$tree->addNode(new Node(6), $tree->root->children[0]->children[0]);
$tree->addNode(new Node(5), $tree->root->children[0]);
$tree->addNode(new Node(3), $tree->root);
$tree->addNode(new Node(7), $tree->root->children[1]);
$tree->addNode(new Node(8), $tree->root->children[1]);
$tree->addNode(new Node(9), $tree->root->children[1]->children[0]);
$tree->addNode(new Node(10), $tree->root->children[1]->children[0]);
$tree->addNode(new Node(11), $tree->root->children[1]->children[0]->children[0]);
$tree->addNode(new Node(12), $tree->root->children[1]->children[0]->children[0]);
$tree->addNode(new Node(13), $tree->root->children[1]->children[0]->children[0]->children[0]);
$tree->addNode(new Node(14), $tree->root->children[1]->children[0]->children[0]->children[0]);
// print tree root to leaf
$tree->printTreeWithLevelNewLine($tree->root);
$cases = [];
$cases[0]['Input'] = $tree->root;
$cases[0]['Output'] = 7;


$run = new Solution();
foreach ($cases as $case) {
    $result = $run->preorder($case['Input']);
    printResult($result, $case);
    $result = $run->preorder_sulution_Recursive($case['Input']);
    printResult($result, $case);
}

function printResult($result, $case) {
    echo '<pre>' . '--------' . PHP_EOL;
    echo 'Result:' . PHP_EOL;
    var_export($result);
    echo PHP_EOL . 'Valid is:' . PHP_EOL;
    var_export($case['Output']);
    echo '</pre>' . PHP_EOL;
}


// N-ary Tree CLASS FROM Node
class NaryTree
{
    public $root;

    function __construct(Node $root = null) {
        $this->root = $root;
    }

    function addNode(Node $node, Node $parent = null) {
        if ($parent == null) {
            $this->root = $node;
        } else {
            $parent->children[] = $node;
        }
    }

    public function printTree(Node $node = null) {
        if ($node == null) {
            return;
        }
        echo $node->val . " ";
        foreach ($node->children as $child) {
            $this->printTree($child);
        }
    }

    // print tree root to leaf
    public function printTreeWithLevelNewLine(Node $node = null, $level = 0) {
        if ($node == null) {
            return;
        }
        echo str_repeat(" ", $level) . $node->val . " ";
        if (count($node->children) == 0) {
            echo '<br>';
        }
        foreach ($node->children as $child) {
            $this->printTreeWithLevelNewLine($child, $level + 1);
        }
    }
}


