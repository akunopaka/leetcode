### 211. Design Add and Search Words Data Structure

Difficulty: `Medium`

https://leetcode.com/problems/design-add-and-search-words-data-structure/

<p>Design a data structure that supports adding new words and finding if a string matches any previously added string.</p>

<p>Implement the <code>WordDictionary</code> class:</p>

<ul>
	<li><code>WordDictionary()</code>&nbsp;Initializes the object.</li>
	<li><code>void addWord(word)</code> Adds <code>word</code> to the data structure, it can be matched later.</li>
	<li><code>bool search(word)</code>&nbsp;Returns <code>true</code> if there is any string in the data structure that matches <code>word</code>&nbsp;or <code>false</code> otherwise. <code>word</code> may contain dots <code>'.'</code> where dots can be matched with any letter.</li>
</ul>

<p><strong class="example">Example:</strong></p>

<pre><strong>Input</strong>
["WordDictionary","addWord","addWord","addWord","search","search","search","search"]
[[],["bad"],["dad"],["mad"],["pad"],["bad"],[".ad"],["b.."]]
<strong>Output</strong>
[null,null,null,null,false,true,true,true]

<strong>Explanation</strong>
WordDictionary wordDictionary = new WordDictionary();
wordDictionary.addWord("bad");
wordDictionary.addWord("dad");
wordDictionary.addWord("mad");
wordDictionary.search("pad"); // return False
wordDictionary.search("bad"); // return True
wordDictionary.search(".ad"); // return True
wordDictionary.search("b.."); // return True
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>1 &lt;= word.length &lt;= 25</code></li>
	<li><code>word</code> in <code>addWord</code> consists of lowercase English letters.</li>
	<li><code>word</code> in <code>search</code> consist of <code>'.'</code> or lowercase English letters.</li>
	<li>There will be at most <code>2</code> dots in <code>word</code> for <code>search</code> queries.</li>
	<li>At most <code>10<sup>4</sup></code> calls will be made to <code>addWord</code> and <code>search</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
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

/**
 * Your WordDictionary object will be instantiated and called as such:
 * var obj = new WordDictionary()
 * obj.addWord(word)
 * var param_2 = obj.search(word)
 */
```

##### PHP

```php
class TrieNode
{
    public $children = [];
    public $isWordEnd = false;
}

class WordDictionary
{
    private $root;

    function __construct()
    {
        $this->root = new TrieNode();
    }

    /**
     * @param String $word
     * @return NULL
     */
    function addWord($word)
    {
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
    function search($word)
    {
        return $this->searchHelper($word, $this->root, 0);
    }

    function searchHelper($word, $node, $index)
    {
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
```
