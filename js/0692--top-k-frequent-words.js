// 692. Top K Frequent Words
// https://leetcode.com/problems/top-k-frequent-words/
// Medium
//     Given an array of strings words and an integer k, return the k most frequent strings.
//     Return the answer sorted by the frequency from highest to lowest. Sort the words with the same frequency by their lexicographical order.
//
//
//
//     Example 1:
//     Input: words = ["i","love","leetcode","i","love","coding"], k = 2
//     Output: ["i","love"]
//     Explanation: "i" and "love" are the two most frequent words.
//     Note that "i" comes before "love" due to a lower alphabetical order.
//     Example 2:
//     Input: words = ["the","day","is","sunny","the","the","the","sunny","is","is"], k = 4
//     Output: ["the","is","sunny","day"]
//     Explanation: "the", "is", "sunny" and "day" are the four most frequent words, with the number of occurrence being 4, 3, 2 and 1 respectively.
//
//
//     Constraints:
//     1 <= words.length <= 500
//     1 <= words[i].length <= 10
//     words[i] consists of lowercase English letters.
//     k is in the range [1, The number of unique words[i]]
//
//     Follow-up: Could you solve it in O(n log(k)) time and O(n) extra space?

/**
 * @param {string[]} words
 * @param {number} k
 * @return {string[]}
 */
var topKFrequent = function (words, k) {
    // Create a hash table to store the frequency of each word
    let hash = {};
    for (let i = 0; i < words.length; i += 1) {
        if (hash[words[i]]) {
            hash[words[i]] += 1;
        } else {
            hash[words[i]] = 1;
        }
    }
    // Create an array of the words in the hash table
    let arr = Object.keys(hash);
    // Sort the array by frequency and lexicographical order
    arr.sort((a, b) => {
        if (hash[a] === hash[b]) {
            return a.localeCompare(b);
        } else {
            return hash[b] - hash[a];
        }
    });
    // Return the first k elements of the array
    return arr.slice(0, k);
};