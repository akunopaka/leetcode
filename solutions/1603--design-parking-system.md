### 1603. Design Parking System

Difficulty: `Easy`

https://leetcode.com/problems/design-parking-system/


<p>Implement the <code>ParkingSystem</code> class:</p>
<ul>
	<li><code>ParkingSystem(int big, int medium, int small)</code> Initializes object of the <code>ParkingSystem</code> class. The number of slots for each parking space are given as part of the constructor.</li>
	<li><code>bool addCar(int carType)</code> Checks whether there is a parking space of <code>carType</code> for the car that wants to get into the parking lot. <code>carType</code> can be of three kinds: big, medium, or small, which are represented by <code>1</code>, <code>2</code>, and <code>3</code> respectively. <strong>A car can only park in a parking space of its </strong><code>carType</code>. If there is no space available, return <code>false</code>, else park the car in that size space and return <code>true</code>.</li>
</ul>
<p><strong class="example">Example 1:</strong></p>
<pre><strong>Input</strong>
["ParkingSystem", "addCar", "addCar", "addCar", "addCar"]
[[1, 1, 0], [1], [2], [3], [1]]
<strong>Output</strong>
[null, true, true, false, false]
<strong>Explanation</strong>
ParkingSystem parkingSystem = new ParkingSystem(1, 1, 0);
parkingSystem.addCar(1); // return true because there is 1 available slot for a big car
parkingSystem.addCar(2); // return true because there is 1 available slot for a medium car
parkingSystem.addCar(3); // return false because there is no available slot for a small car
parkingSystem.addCar(1); // return false because there is no available slot for a big car. It is already occupied.
</pre>
<p><strong>Constraints:</strong></p>
<ul>
	<li><code>0 &lt;= big, medium, small &lt;= 1000</code></li>
	<li><code>carType</code> is <code>1</code>, <code>2</code>, or <code>3</code></li>
	<li>At most <code>1000</code> calls will be made to <code>addCar</code></li>
</ul>

### My Solution(s):

##### JavaScript

```js
/**
 * @param {number} big
 * @param {number} medium
 * @param {number} small
 */
var ParkingSystem = function (big, medium, small) {
        this.count = [big, medium, small];
    };

/**
 * @param {number} carType
 * @return {boolean}
 */
ParkingSystem.prototype.addCar = function (carType) {
    return this.count[carType - 1]-- > 0;
};

```

##### PHP

```php
class ParkingSystem
{

    private $big;
    private $medium;
    private $small;

    /**
     * @param Integer $big
     * @param Integer $medium
     * @param Integer $small
     */
    function __construct($big, $medium, $small) {
        $this->big = $big;
        $this->medium = $medium;
        $this->small = $small;
    }

    /**
     * @param Integer $carType
     * @return Boolean
     */
    function addCar($carType) {
        return match ($carType) {
            1 => --$this->big >= 0,
            2 => --$this->medium >= 0,
            3 => --$this->small >= 0
        };
    }
}

/**
 * Your ParkingSystem object will be instantiated and called as such:
 * $obj = ParkingSystem($big, $medium, $small);
 * $ret_1 = $obj->addCar($carType);
 */
```

