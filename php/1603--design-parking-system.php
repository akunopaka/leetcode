<?php
//  1603. Design Parking System
//  https://leetcode.com/problems/design-parking-system/
//  Easy
//  
//    Implement the ParkingSystem class:
//    ParkingSystem(int big, int medium, int small) Initializes object of the ParkingSystem class. The number of slots for each parking space are given as part of the constructor.
//    bool addCar(int carType) Checks whether there is a parking space of carType for the car that wants to get into the parking lot. carType can be of three kinds: big, medium, or small, which are represented by 1, 2, and 3 respectively. A car can only park in a parking space of its carType. If there is no space available, return false, else park the car in that size space and return true.
//    Example 1:
//    Input
//    ["ParkingSystem", "addCar", "addCar", "addCar", "addCar"]
//    [[1, 1, 0], [1], [2], [3], [1]]
//    Output
//    [null, true, true, false, false]
//    Explanation
//    ParkingSystem parkingSystem = new ParkingSystem(1, 1, 0);
//    parkingSystem.addCar(1); // return true because there is 1 available slot for a big car
//    parkingSystem.addCar(2); // return true because there is 1 available slot for a medium car
//    parkingSystem.addCar(3); // return false because there is no available slot for a small car
//    parkingSystem.addCar(1); // return false because there is no available slot for a big car. It is already occupied.
//    Constraints:
//    0 &lt;= big, medium, small &lt;= 1000
//    carType is 1, 2, or 3
//    At most 1000 calls will be made to addCar


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