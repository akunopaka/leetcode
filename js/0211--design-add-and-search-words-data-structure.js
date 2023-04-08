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

// SOLUTION 00 - implement a trie
var WordDictionary = function () {
    this.trie = {};
};

/**
 * Adds a word into the data structure.
 * @param {string} word
 * @return {void}
 */
WordDictionary.prototype.addWord = function (word) {
    let root = this.trie;
    for (let i = 0; i < word.length; i++) {
        if (root[word[i]] == null) root[word[i]] = {};
        root = root[word[i]];
    }
    root.isEnd = true;
};

/**
 * Returns if the word is in the data structure. A word could contain the dot character '.' to represent any one letter.
 * @param {string} word
 * @return {boolean}
 */
WordDictionary.prototype.search = function (word) {
    return this.dfs(word, 0, this.trie);
};

WordDictionary.prototype.dfs = function (word, index, node) {
    if (index === word.length) return node.isEnd === true;

    if (word[index] == '.') {
        for (let key in node) {
            if (this.dfs(word, index + 1, node[key])) return true;
        }
    } else {
        if (node[word[index]] != null) {
            return this.dfs(word, index + 1, node[word[index]]);
        }
    }
    return false;
}


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
    const searchHelper = (node, word) => {
        if (word.length === 0) return node.isEnd === true;
        if (word[0] === '.') {
            for (const char in node) {
                if (char !== 'isEnd' && searchHelper(node[char], word.slice(1))) return true;
            }
            return false;
        }
        if (!(word[0] in node)) return false;
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