// 211. Design Add and Search Words Data Structure
// https://leetcode.com/problems/design-add-and-search-words-data-structure/
// Medium
// Design a data structure that supports adding new words and finding if a string matches any previously added string.
//
// Implement the WordDictionary class:
// WordDictionary() Initializes the object.
// void addWord(word) Adds word to the data structure, it can be matched later.
// bool search(word) Returns true if there is any string in the data structure that matches word or false otherwise. word may contain dots '.' where dots can be matched with any letter.
// Example:
// Input
// ["WordDictionary","addWord","addWord","addWord","search","search","search","search"]
// [[],["bad"],["dad"],["mad"],["pad"],["bad"],[".ad"],["b.."]]
// Output
// [null,null,null,null,false,true,true,true]
//
// Explanation
// WordDictionary wordDictionary = new WordDictionary();
// wordDictionary.addWord("bad");
// wordDictionary.addWord("dad");
// wordDictionary.addWord("mad");
// wordDictionary.search("pad"); // return False
// wordDictionary.search("bad"); // return True
// wordDictionary.search(".ad"); // return True
// wordDictionary.search("b.."); // return True
//
// Constraints:
// 1 <= word.length <= 25
// word in addWord consists of lowercase English letters.
// word in search consist of '.' or lowercase English letters.
// There will be at most 3 dots in word for search queries.
// At most 104 calls will be made to addWord and search.


// SOLUTION 1 - implement a trie
var WordDictionary = function () {
    // Implement a trie
    this.root = {};
};

/**
 * @param {string} word
 * @return {void}
 */
WordDictionary.prototype.addWord = function (word) {
    let node = this.root;
    for (const char of word) {
        if (!(char in node)) node[char] = {};
        node = node[char];
    }
    node.isEnd = true;
};

/**
 * @param {string} word
 * @return {boolean}
 */
WordDictionary.prototype.search = function (word) {
    // Recursive helper function
    const searchHelper = (node, word) => {
        // Base case: if the word is empty, return true if the node is an end of a word
        if (word.length === 0) return node.isEnd === true;
        // If the first character is a dot, loop through all the possible characters
        if (word[0] === '.') {
            for (const char in node) {
                if (char !== 'isEnd' && searchHelper(node[char], word.slice(1))) return true;
            }
            return false;
        }
        // If the first character is not a dot, check if the node has the character
        if (!(word[0] in node)) return false;
        // If the node has the character, continue searching
        return searchHelper(node[word[0]], word.slice(1));
    };
    return searchHelper(this.root, word);
};
/**
 * Your WordDictionary object will be instantiated and called as such:
 * var obj = new WordDictionary()
 * obj.addWord(word)
 * var param_2 = obj.search(word)
 */

//-- OR --

// Solution 2 -  SET
var WordDictionary = function () {
    this.words = new Set();
};

/**
 * @param {string} word
 * @return {void}
 */
WordDictionary.prototype.addWord = function (word) {
    this.words.add(word);
};

/**
 * @param {string} word
 * @return {boolean}
 */
WordDictionary.prototype.search = function (word) {
    if (this.words.has(word)) return true;
    for (const w of this.words) {
        if (w.length !== word.length) continue;
        let match = true;
        for (let i = 0; i < w.length; i++) {
            if (word[i] !== '.' && w[i] !== word[i]) {
                match = false;
                break;
            }
        }
        if (match) return true;
    }
    return false;
};