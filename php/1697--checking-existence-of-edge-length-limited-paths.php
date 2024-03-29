<?php
//  1697. Checking Existence of Edge Length Limited Paths
//  https://leetcode.com/problems/checking-existence-of-edge-length-limited-paths/
//  Hard
//  
//    An undirected graph of n nodes is defined by edgeList, where edgeList[i] = [ui, vi, disi] denotes an edge between nodes ui and vi with distance disi. Note that there may be multiple edges between two nodes.
//    Given an array queries, where queries[j] = [pj, qj, limitj], your task is to determine for each queries[j] whether there is a path between pj and qj such that each edge on the path has a distance strictly less than limitj .
//    Return a boolean array answer, where answer.length == queries.length and the jth value of answer is true if there is a path for queries[j] is true, and false otherwise.
//    Example 1:
//    Input: n = 3, edgeList = [[0,1,2],[1,2,4],[2,0,8],[1,0,16]], queries = [[0,1,2],[0,2,5]]
//    Output: [false,true]
//    Explanation: The above figure shows the given graph. Note that there are two overlapping edges between 0 and 1 with distances 2 and 16.
//    For the first query, between 0 and 1 there is no path where each distance is less than 2, thus we return false for this query.
//    For the second query, there is a path (0 -&gt; 1 -&gt; 2) of two edges with distances less than 5, thus we return true for this query.
//    Example 2:
//    Input: n = 5, edgeList = [[0,1,10],[1,2,5],[2,3,9],[3,4,13]], queries = [[0,4,14],[1,4,13]]
//    Output: [true,false]
//    Exaplanation: The above figure shows the given graph.
//    Constraints:
//    2 &lt;= n &lt;= 105
//    1 &lt;= edgeList.length, queries.length &lt;= 105
//    edgeList[i].length == 3
//    queries[j].length == 3
//    0 &lt;= ui, vi, pj, qj &lt;= n - 1
//    ui != vi
//    pj != qj
//    1 &lt;= disi, limitj &lt;= 109
//    There may be multiple edges between two nodes.

//
//class Solution
//{
//    /**
//     * @param Integer $n
//     * @param Integer[][] $edgeList
//     * @param Integer[][] $queries
//     * @return Boolean[]
//     */
//    function distanceLimitedPathsExist(int $n, array $edgeList, array $queries): array {
//        $result = [];
//
//        // sort and remove edges with distance >= limit
//        usort($edgeList, function ($a, $b) {
//            return $a[2] <=> $b[2];
//        });
//
//
//        foreach ($queries as $query) {
//            $result[] = $this->checkPath($query, $edgeList);
//        }
//        return $result;
//    }
//
//    function checkPath(array $query, array $edgeList): bool {
//        $startPathNode = $query[0];
//        $finishPathNode = $query[1];
//        $limit = $query[2];
//        $visited = [];
//        $queue = [$startPathNode];
//        while (!empty($queue)) {
//            $currentNode = array_shift($queue);
//            if ($currentNode == $finishPathNode) return true;
//            $visited[] = $currentNode;
//            foreach ($edgeList as $edge) {
//                if ($edge[2] >= $limit) break;
//                if ($edge[0] == $currentNode && !in_array($edge[1], $visited)) {
//                    $queue[] = $edge[1];
//                }
//                if ($edge[1] == $currentNode && !in_array($edge[0], $visited)) {
//                    $queue[] = $edge[0];
//                }
//            }
//        }
//        return false;
//    }
//}


class Solution
{
    /**
     * @param Integer $n
     * @param Integer[][] $edges
     * @param Integer[][] $queries
     * @return Boolean[]
     */
    public static function distanceLimitedPathsExist($n, $edges, $queries) {
        $unionFind = new UnionFind($n);
        $queriesCount = count($queries);
        $answer = array_fill(0, $queriesCount, False);
        $queriesWithIndex = [];
        foreach ($queries as $i => $q) {
            $queriesWithIndex[] = [$q[0], $q[1], $q[2], $i];
        }
        usort($edges, function ($e1, $e2) {
            return $e1[2] - $e2[2];
        });
        usort($queriesWithIndex, function ($q1, $q2) {
            return $q1[2] - $q2[2];
        });
        $edgesIndex = 0;
        foreach ($queriesWithIndex as $q) {
            list($p, $q, $limit, $queryOriginalIndex) = $q;
            while ($edgesIndex < count($edges) && $edges[$edgesIndex][2] < $limit) {
                $node1 = $edges[$edgesIndex][0];
                $node2 = $edges[$edgesIndex][1];
                $unionFind->join($node1, $node2);
                $edgesIndex++;
            }
            $answer[$queryOriginalIndex] = $unionFind->areConnected($p, $q);
        }
        return $answer;
    }
}

class UnionFind
{
    private $group;
    private $rank;

    public function __construct($size) {
        $this->group = array_fill(0, $size, 0);
        $this->rank = array_fill(0, $size, 0);
        for ($i = 0; $i < $size; $i++) {
            $this->group[$i] = $i;
        }
    }

    public function find($node) {
        if ($this->group[$node] !== $node) {
            $this->group[$node] = $this->find($this->group[$node]);
        }
        return $this->group[$node];
    }

    public function join($node1, $node2) {
        $group1 = $this->find($node1);
        $group2 = $this->find($node2);
        if ($group1 === $group2) {
            return;
        }
        if ($this->rank[$group1] > $this->rank[$group2]) {
            $this->group[$group2] = $group1;
        } elseif ($this->rank[$group1] < $this->rank[$group2]) {
            $this->group[$group1] = $group2;
        } else {
            $this->group[$group1] = $group2;
            $this->rank[$group2]++;
        }
    }

    public function areConnected($node1, $node2) {
        $group1 = $this->find($node1);
        $group2 = $this->find($node2);
        return $group1 === $group2;
    }
}

// Test Cases
$cases = [];
$cases[0]['Input']['n'] = 3;
$cases[0]['Input']['edgeList'] = [[0, 1, 2], [1, 2, 4], [2, 0, 8], [1, 0, 16]];
$cases[0]['Input']['queries'] = [[0, 1, 2], [0, 2, 5]];
$cases[0]['expectedOutput'] = [false, true];
$cases[1]['Input']['n'] = 5;
$cases[1]['Input']['edgeList'] = [[0, 1, 10], [1, 2, 5], [2, 3, 9], [3, 4, 13]];
$cases[1]['Input']['queries'] = [[0, 4, 14], [1, 4, 13]];
$cases[1]['expectedOutput'] = [true, false];
$cases[2]['Input']['n'] = 402;
$cases[2]['Input']['edgeList'] = [[61, 42, 519], [341, 76, 228], [239, 174, 407], [52, 309, 155], [138, 201, 833], [292, 194, 771], [168, 400, 803], [183, 358, 48], [123, 206, 236], [133, 162, 530], [222, 344, 586], [61, 284, 724], [111, 211, 301], [53, 70, 591], [196, 17, 178], [233, 384, 983], [313, 66, 922], [301, 156, 950], [399, 381, 875], [64, 31, 568], [154, 316, 312], [42, 309, 291], [215, 342, 734], [254, 393, 407], [355, 235, 349], [119, 235, 654], [35, 267, 978], [308, 75, 357], [86, 127, 61], [343, 214, 42], [226, 386, 793], [227, 178, 213], [52, 12, 886], [9, 292, 193], [260, 298, 812], [8, 281, 457], [215, 227, 422], [224, 389, 409], [13, 222, 205], [23, 254, 547], [32, 16, 972], [81, 187, 184], [217, 399, 827], [79, 232, 16], [133, 347, 602], [98, 150, 362], [375, 286, 302], [50, 382, 987], [299, 97, 110], [310, 101, 627], [215, 274, 951], [18, 215, 69], [267, 292, 475], [255, 5, 545], [156, 159, 324], [93, 270, 138], [232, 252, 664], [111, 49, 984], [175, 327, 149], [215, 68, 810], [99, 208, 965], [343, 252, 488], [31, 172, 61], [44, 220, 108], [90, 274, 624], [85, 37, 253], [276, 129, 343], [207, 18, 461], [161, 170, 219], [252, 318, 324], [84, 291, 743], [47, 336, 399], [39, 85, 12], [39, 253, 480], [102, 197, 877], [272, 379, 739], [351, 100, 411], [66, 160, 162], [65, 313, 875], [314, 290, 774], [382, 89, 383], [349, 281, 504], [388, 314, 118], [224, 68, 499], [367, 105, 175], [389, 145, 587], [18, 299, 147], [151, 25, 433], [398, 25, 788], [259, 60, 152], [48, 130, 473], [19, 258, 419], [214, 241, 375], [364, 226, 974], [179, 181, 772], [4, 323, 510], [43, 284, 306], [41, 116, 438], [384, 168, 474], [357, 233, 161], [141, 265, 759], [296, 255, 291], [64, 390, 26], [31, 388, 273], [375, 342, 5], [363, 342, 965], [252, 188, 31], [69, 299, 290], [112, 191, 471], [86, 99, 475], [237, 223, 93], [24, 175, 749], [19, 197, 460], [58, 177, 806], [205, 50, 912], [169, 115, 29], [14, 121, 416], [332, 198, 198], [34, 79, 762], [69, 266, 522], [213, 359, 520], [256, 298, 698], [66, 93, 346], [326, 357, 436], [96, 328, 433], [328, 55, 460], [232, 83, 968], [19, 76, 404], [210, 123, 710], [274, 54, 735], [139, 358, 862], [214, 305, 686], [48, 273, 970], [360, 339, 160], [215, 235, 451], [247, 219, 766], [157, 8, 565], [359, 75, 397], [389, 157, 568], [227, 337, 551], [269, 83, 151], [393, 60, 798], [251, 366, 884], [196, 56, 56], [112, 358, 165], [73, 295, 473], [153, 77, 662], [47, 289, 231], [100, 226, 512], [313, 331, 237], [311, 138, 238], [169, 44, 638], [239, 14, 142], [102, 163, 468], [237, 375, 560], [215, 69, 46], [4, 401, 435], [330, 343, 998], [284, 188, 812], [310, 201, 390], [46, 255, 518], [210, 105, 293], [208, 185, 775], [106, 320, 669], [120, 338, 481], [295, 42, 600], [348, 232, 629], [240, 367, 99], [397, 118, 912], [300, 138, 228], [173, 98, 661], [305, 330, 680], [146, 137, 976], [306, 128, 79], [198, 323, 806], [146, 179, 121], [236, 331, 597], [27, 260, 168], [14, 315, 398], [188, 214, 792], [127, 145, 492], [54, 305, 276], [13, 25, 732], [7, 271, 646], [66, 169, 810], [92, 106, 324], [292, 186, 204], [269, 27, 727], [374, 269, 755], [25, 110, 142], [271, 350, 935], [20, 400, 871], [377, 279, 999], [370, 324, 310], [378, 113, 855], [6, 390, 711], [48, 350, 136], [293, 115, 171], [361, 320, 594], [297, 147, 971], [203, 359, 736], [166, 22, 584], [77, 7, 471], [240, 196, 748], [150, 181, 814], [121, 269, 620], [126, 197, 389], [76, 71, 299], [26, 14, 292], [144, 314, 452], [355, 94, 477], [375, 193, 978], [147, 12, 121], [141, 319, 492], [119, 73, 879], [67, 82, 908], [91, 401, 322], [258, 88, 738], [173, 268, 445], [309, 176, 876], [123, 1, 971], [256, 307, 287], [230, 4, 39], [32, 217, 181], [379, 369, 342], [159, 256, 276], [96, 207, 209], [170, 282, 760], [282, 355, 898], [13, 136, 745], [79, 314, 369], [22, 255, 845], [17, 190, 804], [359, 284, 645], [197, 24, 114], [322, 80, 381], [108, 291, 188], [316, 200, 358], [336, 141, 297], [66, 163, 994], [398, 15, 805], [248, 154, 115], [361, 341, 106], [271, 18, 23], [52, 180, 485], [135, 383, 213], [395, 46, 127], [273, 51, 667], [332, 247, 769], [389, 312, 205], [69, 323, 201], [170, 337, 315], [343, 193, 278], [343, 236, 496], [183, 383, 290], [143, 262, 994], [115, 166, 238], [259, 73, 179], [148, 380, 13], [272, 140, 673], [12, 299, 745], [249, 352, 313], [222, 230, 669], [341, 42, 960], [42, 13, 21], [152, 11, 163], [78, 111, 977], [246, 316, 478], [136, 340, 163], [233, 218, 330], [78, 157, 330], [14, 136, 394], [98, 225, 59], [41, 70, 103], [202, 302, 716], [56, 225, 53], [124, 238, 197], [150, 219, 54], [192, 210, 25], [308, 252, 158], [306, 170, 657], [119, 124, 818], [163, 297, 855], [103, 224, 997], [170, 109, 833], [302, 217, 816], [143, 298, 107], [136, 372, 630], [21, 275, 791], [23, 220, 5], [147, 332, 277], [285, 389, 632], [52, 15, 319], [399, 363, 48], [246, 209, 866], [106, 80, 474], [201, 321, 233], [318, 305, 789], [287, 0, 66], [61, 34, 96], [274, 295, 370], [285, 300, 898], [285, 352, 210], [46, 143, 594], [181, 335, 144], [31, 9, 87], [386, 159, 903], [122, 181, 720], [24, 44, 667], [195, 215, 673], [162, 150, 472], [294, 92, 82], [350, 343, 339], [375, 317, 169], [252, 279, 22], [199, 172, 545], [159, 29, 276], [274, 56, 960], [180, 393, 519], [237, 349, 193], [350, 101, 513], [355, 149, 307], [246, 290, 585], [94, 115, 586], [292, 156, 281], [323, 241, 608], [302, 187, 875], [270, 297, 731], [228, 118, 631], [302, 326, 958], [115, 96, 566], [204, 400, 266], [233, 65, 826], [258, 390, 476], [343, 67, 334], [294, 217, 456], [22, 39, 512], [190, 17, 405], [25, 215, 33], [84, 45, 140], [93, 368, 752], [318, 36, 195], [319, 294, 988], [35, 294, 587], [168, 25, 732], [221, 17, 351], [263, 161, 513], [332, 239, 1], [188, 301, 223], [30, 276, 131], [123, 35, 540], [294, 362, 810], [80, 72, 573], [324, 24, 366], [7, 300, 480], [47, 95, 271], [326, 98, 355], [344, 200, 722], [113, 189, 925], [317, 38, 605], [38, 163, 889], [158, 41, 690], [324, 94, 806], [132, 145, 453], [384, 178, 745], [345, 380, 507], [157, 265, 618], [134, 220, 581], [332, 184, 222], [83, 244, 650], [125, 162, 992], [372, 227, 785], [84, 359, 952], [16, 321, 492], [241, 211, 438], [326, 287, 839], [185, 175, 41], [70, 194, 58], [167, 170, 670], [217, 8, 685], [217, 307, 351], [145, 97, 972], [169, 290, 457], [283, 347, 565], [113, 96, 554], [255, 114, 422], [118, 47, 947], [334, 381, 831], [252, 383, 137], [185, 96, 285], [91, 108, 989], [256, 164, 694], [128, 204, 370], [77, 43, 547], [244, 36, 393], [351, 216, 351], [196, 392, 124], [5, 206, 927], [134, 252, 785], [343, 67, 263], [107, 229, 557], [172, 360, 373], [227, 151, 615], [194, 342, 438], [342, 65, 889], [19, 275, 259], [327, 89, 631], [24, 147, 155], [11, 161, 800], [315, 278, 787], [42, 254, 989], [80, 275, 690], [97, 96, 393], [212, 5, 18], [20, 232, 797], [273, 186, 173], [147, 181, 204], [387, 205, 713], [220, 180, 758], [347, 37, 561], [99, 353, 761], [98, 150, 605], [289, 150, 999], [277, 350, 485], [97, 81, 255], [114, 190, 67], [73, 374, 149], [199, 238, 294], [68, 222, 999], [347, 36, 690], [76, 260, 256], [317, 90, 2], [315, 155, 543], [307, 313, 692], [328, 320, 601], [175, 202, 883], [147, 383, 197], [347, 90, 283], [19, 364, 591], [88, 351, 414], [366, 387, 862], [200, 202, 432], [310, 360, 729], [20, 243, 984], [237, 297, 44], [63, 380, 660], [374, 101, 145], [319, 95, 652], [137, 22, 130], [94, 323, 912], [114, 357, 58], [158, 121, 56], [211, 256, 392], [43, 81, 560], [155, 349, 312], [310, 10, 168], [55, 205, 468], [7, 89, 198], [18, 383, 611], [114, 242, 752], [169, 227, 987], [245, 343, 77], [284, 304, 988], [292, 40, 617], [43, 333, 534], [193, 69, 655], [110, 219, 144], [115, 193, 41], [184, 172, 1], [275, 167, 860], [248, 168, 450], [358, 374, 218], [203, 223, 93], [54, 336, 358], [42, 88, 272], [340, 225, 391], [92, 6, 689], [276, 252, 437], [264, 336, 417], [75, 365, 861], [142, 170, 766], [360, 144, 262], [288, 134, 47], [268, 123, 137], [65, 95, 906], [129, 31, 652], [135, 125, 497], [249, 244, 86], [275, 93, 766], [332, 364, 301], [200, 268, 343], [260, 175, 64], [37, 330, 825], [204, 336, 313], [218, 335, 90], [103, 151, 823], [178, 75, 349], [270, 353, 400], [88, 155, 148], [362, 230, 984], [208, 278, 470], [331, 302, 977], [278, 203, 827], [119, 179, 580], [140, 138, 590], [341, 283, 253], [364, 342, 519], [25, 205, 450], [182, 377, 75], [133, 396, 336], [8, 375, 659], [18, 113, 706], [163, 95, 72], [132, 232, 932], [19, 111, 347], [219, 305, 499], [196, 10, 532], [71, 333, 605], [215, 104, 547], [10, 62, 908], [121, 169, 686], [260, 122, 503], [219, 323, 247], [118, 82, 255], [198, 293, 520], [380, 381, 91], [356, 31, 640], [246, 231, 152], [278, 140, 575], [343, 321, 99], [140, 217, 12], [204, 280, 696], [0, 261, 847], [372, 221, 818], [207, 27, 713], [211, 330, 718], [271, 258, 279], [379, 327, 389], [12, 13, 864], [16, 400, 201], [112, 291, 484], [97, 242, 899], [39, 186, 705], [117, 334, 964], [232, 255, 855], [239, 188, 456], [122, 163, 392], [333, 313, 476], [360, 110, 750], [63, 260, 912], [236, 6, 539], [370, 10, 406], [341, 196, 273], [360, 397, 853], [226, 115, 794], [233, 228, 477], [264, 84, 433], [343, 207, 586], [391, 66, 249], [76, 248, 179], [316, 60, 659], [27, 36, 489], [114, 370, 576], [240, 304, 610], [307, 90, 539], [234, 309, 787], [195, 338, 261], [26, 153, 993], [123, 226, 568], [219, 11, 506], [229, 248, 630], [230, 57, 993], [331, 189, 969], [280, 141, 661], [353, 208, 361], [334, 174, 241], [358, 321, 740], [19, 335, 218], [119, 31, 845], [351, 117, 236], [158, 283, 335], [379, 260, 949], [133, 177, 707], [92, 124, 867], [47, 153, 761], [92, 62, 573], [203, 187, 637], [165, 308, 352], [135, 157, 849], [326, 232, 124], [157, 324, 960], [329, 72, 363], [223, 165, 780], [44, 103, 121], [349, 387, 266], [250, 158, 664], [140, 63, 828], [56, 6, 928], [341, 207, 951], [31, 213, 812], [316, 113, 883], [163, 358, 84], [396, 214, 259], [170, 380, 990], [108, 240, 986], [11, 286, 10], [67, 24, 932], [65, 108, 637], [79, 49, 451], [181, 78, 640], [206, 369, 22], [255, 258, 79], [196, 259, 540]];
$cases[2]['Input']['queries'] = [[99, 326, 553], [31, 26, 706], [76, 379, 781], [348, 288, 98], [23, 50, 486], [352, 305, 375], [141, 260, 830], [272, 329, 291], [54, 328, 561], [71, 170, 333], [77, 126, 418], [125, 120, 509], [206, 161, 241], [169, 335, 751], [116, 50, 888], [188, 274, 988], [105, 260, 853], [312, 233, 89], [154, 245, 84], [319, 85, 658], [348, 285, 620], [293, 180, 920], [134, 398, 773], [166, 25, 804], [157, 369, 850], [110, 12, 134], [181, 132, 875], [130, 145, 247], [388, 216, 746], [322, 84, 567], [351, 2, 696], [205, 265, 455], [170, 260, 637], [36, 94, 574], [64, 100, 521], [194, 269, 474], [335, 218, 436], [393, 129, 979], [35, 302, 267], [340, 142, 173], [170, 200, 702], [34, 206, 899], [329, 104, 96], [190, 397, 192], [51, 53, 201], [375, 14, 747], [12, 223, 516], [398, 178, 48], [125, 131, 483], [157, 161, 469], [168, 221, 400], [356, 232, 891], [336, 239, 59], [234, 266, 679], [166, 336, 788], [342, 67, 465], [82, 129, 572], [231, 355, 887], [266, 346, 923], [377, 195, 727], [28, 66, 429], [162, 0, 202], [9, 57, 147], [154, 56, 289], [23, 145, 615], [130, 199, 168], [232, 207, 802], [269, 29, 964], [295, 94, 331], [202, 210, 371], [151, 106, 891], [261, 34, 542], [265, 238, 748], [348, 202, 336], [101, 170, 66], [81, 44, 217], [156, 36, 569], [82, 175, 897], [358, 211, 265], [337, 68, 57], [162, 354, 788], [304, 287, 697], [24, 103, 346], [387, 72, 825], [276, 23, 729], [272, 233, 154], [239, 375, 511], [247, 72, 935], [268, 249, 506], [78, 336, 707], [61, 47, 699], [220, 128, 127], [307, 177, 849], [121, 343, 791], [252, 173, 800], [86, 164, 691], [220, 141, 288], [139, 384, 665], [121, 267, 145], [166, 250, 622], [5, 150, 423], [106, 389, 651], [253, 245, 385], [59, 277, 426], [234, 43, 319], [372, 76, 693], [314, 313, 150], [340, 96, 96], [283, 186, 176], [353, 262, 148], [50, 57, 653], [17, 308, 748], [86, 397, 658], [160, 48, 980], [376, 388, 615], [172, 135, 959], [41, 293, 839], [266, 352, 128], [342, 345, 228], [120, 60, 989], [249, 11, 891], [74, 156, 383], [303, 17, 486], [7, 255, 220], [140, 165, 87], [16, 101, 824], [16, 111, 535], [199, 132, 38], [2, 161, 548], [368, 369, 882], [363, 357, 216], [309, 302, 185], [147, 139, 73], [233, 241, 435], [110, 367, 670], [145, 140, 969], [3, 311, 183], [231, 209, 276], [267, 200, 734], [38, 374, 492], [337, 397, 618], [257, 361, 51], [286, 25, 772], [292, 163, 609], [231, 395, 341], [209, 240, 428], [165, 118, 986], [98, 6, 167], [10, 114, 588], [80, 283, 548], [86, 103, 291], [87, 276, 632], [88, 189, 95], [144, 372, 802], [110, 61, 993], [348, 175, 906], [141, 195, 696], [164, 328, 594], [92, 256, 176], [220, 127, 109], [56, 29, 184], [102, 263, 109], [240, 369, 107], [125, 193, 149], [57, 98, 282], [358, 160, 102], [187, 380, 693], [266, 385, 360], [8, 383, 453], [325, 0, 777], [137, 202, 327], [351, 181, 918], [132, 7, 650], [253, 128, 928], [190, 276, 320], [149, 357, 364], [289, 7, 908], [326, 251, 439], [111, 156, 313], [304, 5, 45], [223, 137, 611], [222, 14, 891], [392, 397, 750], [83, 384, 469], [270, 31, 984], [115, 43, 351], [106, 50, 390], [269, 325, 144], [397, 42, 13], [200, 43, 105], [301, 351, 347], [209, 12, 691], [31, 232, 496], [102, 276, 339], [318, 113, 589], [188, 220, 867], [254, 32, 193], [336, 122, 791], [25, 193, 636], [197, 147, 292], [28, 211, 371], [218, 235, 28], [239, 395, 356], [94, 279, 167], [223, 126, 661], [98, 367, 634], [255, 75, 845], [188, 186, 102], [304, 248, 859], [33, 274, 476], [185, 263, 261], [116, 162, 957], [347, 397, 445], [11, 115, 220], [231, 389, 89], [313, 381, 316], [358, 125, 191], [222, 377, 463], [61, 176, 97], [296, 118, 778], [390, 143, 705], [220, 169, 856], [377, 96, 469], [154, 328, 931], [74, 361, 398], [328, 297, 958], [271, 303, 470], [249, 8, 461], [34, 212, 416], [328, 386, 445], [124, 134, 200], [392, 189, 895], [292, 144, 231], [387, 334, 880], [129, 126, 66], [97, 265, 628], [33, 297, 557], [86, 85, 593], [43, 308, 812], [270, 310, 630], [90, 72, 979], [208, 28, 14], [305, 120, 117], [238, 112, 19], [149, 127, 148], [107, 335, 306], [188, 35, 433], [279, 382, 997], [160, 146, 608], [359, 388, 894], [229, 41, 428], [26, 222, 260], [357, 122, 764], [395, 314, 834], [318, 197, 295], [191, 390, 554], [212, 91, 402], [295, 369, 347], [29, 302, 257], [259, 343, 254], [129, 391, 373], [64, 214, 263], [139, 179, 429], [82, 59, 499], [191, 71, 337], [1, 10, 426], [174, 277, 925], [267, 6, 727], [9, 302, 889], [326, 346, 271], [310, 69, 372], [129, 214, 49], [284, 35, 515], [367, 222, 160], [248, 76, 972], [310, 78, 519], [59, 229, 202], [286, 392, 353], [205, 191, 381], [155, 137, 130], [20, 384, 253], [62, 107, 780], [181, 340, 803], [13, 141, 703], [256, 188, 204], [10, 337, 77], [329, 151, 746], [50, 395, 118], [12, 4, 782], [20, 44, 285], [283, 58, 801], [375, 88, 971], [221, 331, 629], [30, 324, 934], [63, 196, 947], [33, 384, 42], [201, 288, 758], [125, 374, 569], [107, 52, 881], [355, 1, 800], [37, 272, 108], [260, 308, 630], [58, 98, 301], [215, 105, 284], [364, 64, 389], [113, 128, 657], [38, 92, 715], [124, 237, 328], [326, 155, 399], [219, 270, 664], [351, 110, 934], [101, 356, 12], [74, 276, 448], [37, 8, 543], [160, 269, 623], [293, 320, 518], [234, 76, 725], [132, 346, 176], [332, 291, 490], [200, 53, 465], [33, 148, 329], [36, 23, 266], [381, 234, 890], [389, 185, 178], [207, 31, 36], [339, 379, 152], [170, 198, 59], [138, 298, 77], [175, 176, 723], [125, 165, 980], [18, 177, 221], [136, 121, 501], [49, 236, 514], [163, 159, 914], [104, 338, 616], [262, 115, 205], [136, 57, 564], [389, 82, 210], [136, 353, 567], [165, 199, 22], [25, 397, 15], [236, 212, 628], [294, 400, 572], [145, 180, 255], [44, 295, 622], [52, 157, 721], [191, 114, 42], [277, 254, 11], [81, 44, 858], [239, 212, 171], [20, 201, 367], [206, 387, 901], [61, 400, 777], [51, 38, 768], [325, 190, 714], [208, 379, 11], [65, 217, 838], [74, 58, 473], [287, 2, 765], [63, 79, 464], [118, 376, 789], [222, 252, 218], [149, 327, 958], [239, 296, 600], [146, 103, 104], [61, 30, 755], [59, 327, 178], [158, 47, 501], [149, 156, 935], [291, 236, 231], [108, 299, 609], [149, 339, 76], [314, 373, 271], [164, 137, 59], [24, 289, 414], [73, 312, 573], [186, 198, 657], [106, 313, 264], [35, 291, 548], [35, 357, 686], [10, 396, 966], [286, 237, 751], [306, 338, 148], [282, 118, 847], [270, 94, 36], [274, 158, 419], [281, 364, 800], [348, 191, 130], [207, 56, 614], [168, 185, 82], [183, 265, 867], [301, 175, 536], [294, 133, 771], [130, 374, 82], [259, 151, 114], [251, 117, 99], [315, 329, 664], [173, 284, 260], [195, 38, 726], [326, 25, 771], [271, 62, 466], [365, 351, 785], [262, 188, 143], [230, 151, 739], [83, 251, 633], [277, 239, 473], [304, 209, 589], [375, 61, 955], [160, 123, 197], [187, 387, 807], [112, 241, 354], [337, 198, 263], [307, 20, 282], [345, 179, 525], [166, 143, 897], [162, 350, 384], [311, 156, 242], [162, 88, 839], [116, 359, 441], [379, 17, 548], [214, 248, 805], [352, 162, 171], [87, 342, 796], [42, 237, 558], [49, 365, 467], [376, 316, 704], [109, 315, 113], [230, 142, 254], [93, 266, 44], [114, 50, 215], [353, 254, 10], [295, 59, 960], [38, 286, 680], [206, 363, 80], [323, 379, 196], [159, 357, 598], [63, 249, 956], [25, 357, 936], [183, 73, 142], [161, 55, 907], [377, 272, 410], [394, 220, 963], [239, 137, 398], [341, 145, 586], [30, 44, 960], [45, 195, 871], [145, 268, 201], [293, 257, 70], [206, 176, 343], [393, 400, 352], [163, 387, 567], [143, 192, 949], [116, 86, 814], [249, 14, 600], [250, 122, 236], [270, 289, 780], [164, 149, 254], [20, 160, 132], [272, 211, 552], [347, 200, 143], [61, 374, 521], [337, 227, 590], [138, 24, 626], [401, 151, 892], [140, 289, 685], [142, 94, 366], [146, 314, 376], [255, 139, 491], [232, 186, 427], [383, 282, 523], [337, 300, 261], [80, 199, 831], [33, 395, 855], [12, 399, 375], [358, 130, 952], [101, 29, 718], [8, 143, 585], [367, 134, 134], [247, 313, 383], [274, 174, 95], [28, 214, 367], [267, 333, 401], [120, 94, 460], [72, 156, 335], [399, 171, 564], [34, 279, 710], [141, 59, 797], [356, 308, 118], [48, 317, 659], [173, 328, 726], [88, 65, 682], [357, 159, 436], [117, 17, 939], [344, 261, 604], [272, 401, 875], [310, 237, 376], [77, 378, 269], [168, 235, 523], [128, 259, 611], [194, 49, 212], [288, 238, 161], [273, 49, 849], [261, 100, 615], [107, 130, 763], [267, 359, 590], [26, 240, 969], [31, 147, 627], [290, 177, 917], [223, 83, 587], [400, 194, 157], [26, 321, 521], [374, 289, 5], [213, 334, 719], [230, 59, 142], [386, 187, 288], [375, 283, 975], [91, 224, 203], [318, 26, 117], [53, 75, 221], [393, 386, 88], [47, 39, 76], [395, 129, 66], [277, 225, 925], [326, 26, 226], [29, 59, 834], [89, 4, 925], [127, 157, 863], [289, 92, 483], [211, 45, 923], [286, 41, 484], [138, 146, 723], [394, 343, 650], [101, 42, 197], [45, 146, 815], [184, 206, 649], [6, 384, 168], [368, 326, 173], [369, 145, 306], [325, 65, 690], [134, 150, 859], [375, 359, 30], [74, 168, 896], [226, 183, 893], [156, 107, 450], [266, 260, 410], [256, 400, 859], [48, 318, 661], [101, 175, 248], [46, 225, 47], [81, 165, 13], [321, 144, 348], [171, 74, 683], [269, 319, 775], [41, 88, 755], [149, 45, 798], [209, 150, 741], [62, 202, 455], [50, 135, 463], [400, 261, 736], [37, 224, 436], [136, 127, 760], [379, 218, 282], [399, 9, 554], [395, 111, 295], [178, 179, 89], [353, 152, 177], [283, 131, 549], [202, 80, 474], [357, 371, 831], [254, 215, 317], [232, 101, 743], [78, 38, 174], [353, 53, 718], [247, 122, 999], [286, 192, 785], [398, 275, 915], [103, 397, 869], [287, 172, 893], [358, 1, 470], [339, 13, 975], [123, 235, 198], [80, 125, 985], [40, 254, 591], [254, 393, 721], [8, 263, 757], [228, 382, 236], [384, 301, 918], [150, 399, 903], [301, 210, 226], [367, 137, 184], [50, 320, 504], [353, 114, 525], [134, 143, 601], [212, 237, 336], [278, 204, 888], [321, 197, 706], [130, 65, 378], [273, 235, 86], [358, 124, 16], [77, 165, 629], [371, 375, 408], [296, 85, 309], [212, 155, 356], [392, 241, 183], [229, 127, 703], [204, 80, 306], [242, 291, 455], [34, 83, 741], [375, 335, 445], [79, 357, 495], [349, 73, 178], [315, 184, 628], [161, 359, 608]];
$cases[2]['expectedOutput'] = '';
// $cases[3]['Input']['n'] = '';
// $cases[3]['Input']['edgeList'] = '';
// $cases[3]['expectedOutput'] = '';
// $cases[4]['Input']['n'] = '';
// $cases[4]['Input']['edgeList'] = '';
// $cases[4]['expectedOutput'] = '';

// Check solution
$solution = new Solution();
foreach ($cases as $case) {
    $result = $solution->distanceLimitedPathsExist($case['Input']['n'], $case['Input']['edgeList'], $case['Input']['queries']);
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