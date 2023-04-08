<?php
// 211. Design Add and Search Words Data Structure
// https://leetcode.com/problems/design-add-and-search-words-data-structure/
// Medium
//
//     Design a data structure that supports adding new words and finding if a string matches any previously added string.
//
//     Implement the WordDictionary class:
//     WordDictionary() Initializes the object.
//     void addWord(word) Adds word to the data structure, it can be matched later.
//     bool search(word) Returns true if there is any string in the data structure that matches word or false otherwise. word may contain dots '.' where dots can be matched with any letter.
//     Example:
//     Input
//     ["WordDictionary","addWord","addWord","addWord","search","search","search","search"]
//     [[],["bad"],["dad"],["mad"],["pad"],["bad"],[".ad"],["b.."]]
//     Output
//     [null,null,null,null,false,true,true,true]
//
//     Explanation
//     WordDictionary wordDictionary = new WordDictionary();
//     wordDictionary.addWord("bad");
//     wordDictionary.addWord("dad");
//     wordDictionary.addWord("mad");
//     wordDictionary.search("pad"); // return False
//     wordDictionary.search("bad"); // return True
//     wordDictionary.search(".ad"); // return True
//     wordDictionary.search("b.."); // return True
//
//     Constraints:
//     1 <= word.length <= 25
//     word in addWord consists of lowercase English letters.
//     word in search consist of '.' or lowercase English letters.
//     There will be at most 3 dots in word for search queries.
//     At most 104 calls will be made to addWord and search.


class TrieNode
{
    public $children = [];
    public $isWordEnd = false;
}

class WordDictionary
{
    private $root;

    function __construct() {
        $this->root = new TrieNode();
    }

    /**
     * @param String $word
     * @return NULL
     */
    function addWord($word) {
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
    function search($word) {
        return $this->searchHelper($word, $this->root, 0);
    }

    function searchHelper($word, $node, $index) {
        if ($index == strlen($word)) {
            return $node->isWordEnd;
        }
        if ($word[$index] == '.') {
            foreach ($node->children as $child) {
                if ($this->searchHelper($word, $child, $index + 1)) {
                    return true;
                }
            }
            return false;
        } else {
            if (!isset($node->children[$word[$index]])) {
                return false;
            }
            return $this->searchHelper($word, $node->children[$word[$index]], $index + 1);
        }
    }
}

/**
 * Your WordDictionary object will be instantiated and called as such:
 * $obj = WordDictionary();
 * $obj->addWord($word);
 * $ret_2 = $obj->search($word);
 */