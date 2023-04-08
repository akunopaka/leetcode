<?php
// 208. Implement Trie (Prefix Tree)
// https://leetcode.com/problems/implement-trie-prefix-tree/
// Medium
//
//     A trie (pronounced as "try") or prefix tree is a tree data structure used to efficiently store and retrieve keys in a dataset of strings. There are various applications of this data structure, such as autocomplete and spellchecker.
//     Implement the Trie class:
//     Trie() Initializes the trie object.
//     void insert(String word) Inserts the string word into the trie.
//     boolean search(String word) Returns true if the string word is in the trie (i.e., was inserted before), and false otherwise.
//     boolean startsWith(String prefix) Returns true if there is a previously inserted string word that has the prefix prefix, and false otherwise.
//
//     Example 1:
//     Input
//     ["Trie", "insert", "search", "search", "startsWith", "insert", "search"]
//     [[], ["apple"], ["apple"], ["app"], ["app"], ["app"], ["app"]]
//     Output
//     [null, null, true, false, true, null, true]
//
//     Explanation
//     Trie trie = new Trie();
//     trie.insert("apple");
//     trie.search("apple");   // return True
//     trie.search("app");     // return False
//     trie.startsWith("app"); // return True
//     trie.insert("app");
//     trie.search("app");     // return True
//
//     Constraints:
//     1 <= word.length, prefix.length <= 2000
//     word and prefix consist only of lowercase English letters.
//     At most 3 * 104 calls in total will be made to insert, search, and startsWith.


class TrieNode
{
    public $children = [];
    public $isWordEnd = false;
}

class Trie
{
    private $root;

    function __construct() {
        $this->root = new TrieNode();
    }

    /**
     * @param String $word
     * @return NULL
     */
    function insert(string $word) {
        $node = $this->root;
        $wordLength = strlen($word);
        for ($i = 0; $i < $wordLength; $i++) {
            if (!isset($node->children[$word[$i]])) {
                $node->children[$word[$i]] = new TrieNode();
            }
            $node = $node->children[$word[$i]];
        }
        $node->isWordEnd = true;
        return null;
    }

    /**
     * @param String $word
     * @return Boolean
     */
    function search(string $word): bool {
        $node = $this->root;
        $wordLength = strlen($word);
        for ($i = 0; $i < $wordLength; $i++) {
            if (isset($node->children[$word[$i]])) {
                $node = $node->children[$word[$i]];
            } else {
                return false;
            }
        }
        return $node->isWordEnd;
    }

    /**
     * @param String $prefix
     * @return Boolean
     */
    function startsWith(string $prefix): bool {
        $node = $this->root;
        $prefixLength = strlen($prefix);
        for ($i = 0; $i < $prefixLength; $i++) {
            if (isset($node->children[$prefix[$i]])) {
                $node = $node->children[$prefix[$i]];
            } else {
                return false;
            }
        }
        return true;
    }
}


/**
 * Your Trie object will be instantiated and called as such:
 * $obj = Trie();
 * $obj->insert($word);
 * $ret_2 = $obj->search($word);
 * $ret_3 = $obj->startsWith($prefix);
 */

$word = 'ade';
$word1 = 'instantiated';
$word5 = 'inst';
$word6 = 'ge';

$obj = new Trie();
$obj->insert($word1);
$res1 = $obj->search($word);
$res2 = $obj->search($word1);
$res3 = $obj->startsWith($word5);
$res4 = $obj->startsWith($word6);
var_export($word);
var_export($res1);
var_export($res2);
var_export($res3);
var_export($res4);