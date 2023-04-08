### 208. Implement Trie (Prefix Tree)

Difficulty: `Medium`

https://leetcode.com/problems/implement-trie-prefix-tree/

<p>A <a href="https://en.wikipedia.org/wiki/Trie" target="_blank"><strong>trie</strong></a> (pronounced as "try") or <strong>prefix tree</strong> is a tree data structure used to efficiently store and retrieve keys in a dataset of strings. There are various applications of this data structure, such as autocomplete and spellchecker.</p>

<p>Implement the Trie class:</p>

<ul>
	<li><code>Trie()</code> Initializes the trie object.</li>
	<li><code>void insert(String word)</code> Inserts the string <code>word</code> into the trie.</li>
	<li><code>boolean search(String word)</code> Returns <code>true</code> if the string <code>word</code> is in the trie (i.e., was inserted before), and <code>false</code> otherwise.</li>
	<li><code>boolean startsWith(String prefix)</code> Returns <code>true</code> if there is a previously inserted string <code>word</code> that has the prefix <code>prefix</code>, and <code>false</code> otherwise.</li>
</ul>

<p><strong class="example">Example 1:</strong></p>

<pre><strong>Input</strong>
["Trie", "insert", "search", "search", "startsWith", "insert", "search"]
[[], ["apple"], ["apple"], ["app"], ["app"], ["app"], ["app"]]
<strong>Output</strong>
[null, null, true, false, true, null, true]

<strong>Explanation</strong>
Trie trie = new Trie();
trie.insert("apple");
trie.search("apple");   // return True
trie.search("app");     // return False
trie.startsWith("app"); // return True
trie.insert("app");
trie.search("app");     // return True
</pre>

<p><strong>Constraints:</strong></p>

<ul>
	<li><code>1 &lt;= word.length, prefix.length &lt;= 2000</code></li>
	<li><code>word</code> and <code>prefix</code> consist only of lowercase English letters.</li>
	<li>At most <code>3 * 10<sup>4</sup></code> calls <strong>in total</strong> will be made to <code>insert</code>, <code>search</code>, and <code>startsWith</code>.</li>
</ul>
<p>&nbsp;</p>

### My Solution(s):

##### JavaScript

```js
//  Solution 1

var Trie = function () {
    this.root = {};
};
/**
 * @param {string} word
 * @return {void}
 */
Trie.prototype.insert = function (word) {
    let node = this.root;
    for (const char of word) {
        if (!(char in node)) node[char] = {};
        node = node[char];
    }
    node.isEnd = true;
}
/**
 * @param {string} word
 * @return {boolean}
 */
Trie.prototype.search = function (word) {
    let node = this.root;
    for (const char of word) {
        if (!(char in node)) return false;
        node = root[char];
    }
    return node.isEnd === true;
}
/**
 * @param {string} prefix
 * @return {boolean}
 */
Trie.prototype.startsWith = function (prefix) {
    let node = this.root;
    for (const letter of prefix) {
        if (!(letter in node)) return false;
        node = node[letter];
    }
    return true;
}

// -- OR --
// -- OR --
// -- OR --

//  Solution 2
var TrieNode = function () {
    this.children = {};
    this.isWordEnd = false;
}


var Trie = function () {
    this.root = new TrieNode();
};

/**
 * @param {string} word
 * @return {void}
 */
Trie.prototype.insert = function (word) {
    let node = this.root;
    let wordLength = word.length;
    for (let i = 0; i < wordLength; i++) {
        if (!node.children[word[i]]) {
            node.children[word[i]] = new TrieNode();
        }
        node = node.children[word[i]];
    }
    node.isWordEnd = true;
};

/**
 * @param {string} word
 * @return {boolean}
 */
Trie.prototype.search = function (word) {
    let node = this.root;
    let wordLength = word.length;
    for (let i = 0; i < wordLength; i++) {
        if (!node.children[word[i]]) {
            return false;
        }
        node = node.children[word[i]];
    }
    return node.isWordEnd;
};

/**
 * @param {string} prefix
 * @return {boolean}
 */
Trie.prototype.startsWith = function (prefix) {
    let node = this.root;
    let wordLength = prefix.length;
    for (let i = 0; i < wordLength; i++) {
        if (!node.children[prefix[i]]) {
            return false;
        }
        node = node.children[prefix[i]];
    }
    return true;
};
```

##### PHP

```php
class TrieNode
{
    public $children = [];
    public $isEnd = false;
}

class Trie
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
    function insert(string $word)
    {
        $node = $this->root;
        $wordLength = strlen($word);
        for ($i = 0; $i < $wordLength; $i++) {
            if (!isset($node->children[$word[$i]])) {
                $node->children[$word[$i]] = new TrieNode();
            }
            $node = $node->children[$word[$i]];
        }
        $node->isEnd = true;
        return null;
    }

    /**
     * @param String $word
     * @return Boolean
     */
    function search(string $word): bool
    {
        $node = $this->root;
        $wordLength = strlen($word);
        for ($i = 0; $i < $wordLength; $i++) {
            if (isset($node->children[$word[$i]])) {
                $node = $node->children[$word[$i]];
            } else {
                return false;
            }
        }
        return $node->isEnd;
    }

    /**
     * @param String $prefix
     * @return Boolean
     */
    function startsWith(string $prefix): bool
    {
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
```