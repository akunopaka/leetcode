<?php
//  71. Simplify Path
//  https://leetcode.com/problems/simplify-path/
//  Medium
//
//   My Solution on LeetCode:
//   https://leetcode.com/discuss/topic/3409259/phpbeats-100javascript-simplifying-a-path-using-stack/
//
//    Given a string path, which is an absolute path (starting with a slash ' / ') to a file or directory in a Unix-style file system, convert it to the simplified canonical path.
//    In a Unix-style file system, a period ' . ' refers to the current directory, a double period '..' refers to the directory up a level, and any multiple consecutive slashes (i.e. '//') are treated as a single slash ' / '. For this problem, any other format of periods such as '...' are treated as file/directory names.
//    The canonical path should have the following format:
//    The path starts with a single slash ' / '.
//    Any two directories are separated by a single slash ' / '.
//    The path does not end with a trailing ' / '.
//    The path only contains the directories on the path from the root directory to the target file or directory (i.e., no period ' . ' or double period '..')
//    Return the simplified canonical path.
//    Example 1:
//    Input: path = "/home/"
//    Output: "/home"
//    Explanation: Note that there is no trailing slash after the last directory name.
//    Example 2:
//    Input: path = "/../"
//    Output: "/"
//    Explanation: Going one level up from the root directory is a no-op, as the root level is the highest level you can go.
//    Example 3:
//    Input: path = "/home//foo/"
//    Output: "/home/foo"
//    Explanation: In the canonical path, multiple consecutive slashes are replaced by a single one.
//    Constraints:
//    1 &lt;= path.length &lt;= 3000
//    path consists of English letters, digits, period '.', slash '/' or '_'.
//    path is a valid absolute Unix path.
class Solution
{
    function simplifyPath(string $path): string {
        $pathArray = explode('/', $path);
        $result = [];
        foreach ($pathArray as $key => $value) {
            if ($value == '..') {
                array_pop($result);
            } elseif ($value != '.' && $value != '') {
                $result[] = $value;
            }
        }
        return '/' . implode('/', $result);
    }
}


// Test Cases
$cases = [];
$cases[0]['Input']['path'] = "/home/";
$cases[0]['expectedOutput'] = "/home";
$cases[1]['Input']['path'] = "/../";
$cases[1]['expectedOutput'] = "/";
$cases[2]['Input']['path'] = "/home//foo/";
$cases[2]['expectedOutput'] = "/home/foo";
$cases[3]['Input']['path'] = '/home/./foo/../eee/ok//del/../test/.../';
$cases[3]['expectedOutput'] = '/home/eee/ok/test/...';
$cases[4]['Input']['path'] = "/a/./b/../../c/";
$cases[4]['expectedOutput'] = "/c";
$cases[5]['Input']['path'] = "/a/../../b/../c//.//";
$cases[5]['expectedOutput'] = "/c";
$cases[6]['Input']['path'] = "/a//b////c/d//././/..";
$cases[6]['expectedOutput'] = "/a/b/c";

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->simplifyPath($case['Input']['path']);
    echoResult($result, $case['expectedOutput']);
}

/**
 * function to print Result
 *
 * @param $result
 * @param $expectedOutput
 * @return void
 */
function echoResult($result, $expectedOutput): void {
    echo '<pre>' . PHP_EOL . '-------' . PHP_EOL . 'Result:' . PHP_EOL . var_export($result, true) . PHP_EOL;
    if ($result != $expectedOutput) echo PHP_EOL . '!!! >>FAIL<< !!!' . PHP_EOL . 'Valid/Expected Output is: ' . PHP_EOL . var_export($expectedOutput, true);
    else echo ' << OK!' . PHP_EOL;
    echo '</pre>' . PHP_EOL;
}