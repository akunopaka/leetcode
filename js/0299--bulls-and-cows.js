// 299. Bulls and Cows
// https://leetcode.com/problems/bulls-and-cows/
// Medium
//
//  My Solution on LeetCode:
//  https://leetcode.com/discuss/topic/3388273/javascriptphp-fast-simple-counting-with-hashmap/
//
//     You are playing the Bulls and Cows game with your friend.
//     You write down a secret number and ask your friend to guess what the number is. When your friend makes a guess, you provide a hint with the following info:
//     The number of "bulls", which are digits in the guess that are in the correct position.
//     The number of "cows", which are digits in the guess that are in your secret number but are located in the wrong position. Specifically, the non-bull digits in the guess that could be rearranged such that they become bulls.
//     Given the secret number secret and your friend's guess guess, return the hint for your friend's guess.
//     The hint should be formatted as "xAyB", where x is the number of bulls and y is the number of cows. Note that both secret and guess may contain duplicate digits.
//
//     Example 1:
//     Input: secret = "1807", guess = "7810"
//     Output: "1A3B"
//     Explanation: Bulls are connected with a '|' and cows are underlined:
//     "1807"
//      |
//     "7810"
//     Example 2:
//     Input: secret = "1123", guess = "0111"
//     Output: "1A1B"
//     Explanation: Bulls are connected with a '|' and cows are underlined:
//     "1123"        "1123"
//      |      or     |
//     "0111"        "0111"
//     Note that only one of the two unmatched 1s is counted as a cow since the non-bull digits can only be rearranged to allow one 1 to be a bull.
//     Constraints:
//     1 <= secret.length, guess.length <= 1000
//     secret.length == guess.length
//     secret and guess consist of digits only.


var getHint___MAP = function (secret, guess) {
    let bulls = 0;
    let cows = 0;
    let length = secret.length;
    for (let i = 0; i < length; i++) {
        if (secret[i] == guess[i]) bulls++;
    }
    let s = new Map();
    let g = new Map();
    for (let i = 0; i < length; i++) {
        if (s.has(secret[i])) {
            s.set(secret[i], s.get(secret[i]) + 1);
        } else {
            s.set(secret[i], 1);
        }
        if (g.has(guess[i])) {
            g.set(guess[i], g.get(guess[i]) + 1);
        } else {
            g.set(guess[i], 1);
        }
    }
    for (let [key, value] of s) {
        if (g.has(key)) cows += Math.min(s.get(key), g.get(key));
    }
    cows -= bulls;
    return bulls + 'A' + cows + 'B';
};


var getHint = function (secret, guess) {
    var bull = 0;
    var cow = 0;
    // var map = {};
    // for (var i = 0; i < 10; i++) map[i] = 0;
    const map = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    const secretLength = secret.length;
    for (let i = 0; i < secretLength; i++) {
        if (secret[i] === guess[i]) bull++;
        else {
            // map[secret[i]]++;
            // map[guess[i]]--;
            if (++map[secret[i]] <= 0) cow++;
            if (--map[guess[i]] >= 0) cow++;
            // cow += map[secret[i]] <= 0 ? 1 : 0;
            // cow += map[guess[i]] >= 0 ? 1 : 0;
        }
    }
    return `${bull}A${cow}B`;
};