<?php

// Importing the TestCase class from PHPUnit to create unit tests
use PHPUnit\Framework\TestCase;

// Including the file containing the classes CommonVehicle and LuxuryVehicle
require_once __DIR__ . '/../src/Vehicle.php';

class VehicleTest extends TestCase
{
    /**
     * Tests the total calculation for a common vehicle with a base price of 1000 for a Common Vehicle
     * 
     * This test checks if the calculateTotal(), supposed to return 1180.00 CAD */
    public function testCommonVehicleTotalCalculation()
    {
        $vehicle = new CommonVehicle(1000);
        $this->assertEquals('1180.00', $vehicle->calculateTotal());
    }

    /**
     * Tests the total calculation for a common vehicle with a base price of 1000 (CAD) for a Luxury Vehicle
     * 
     * This test checks if the calculateTotal(), supposed to return 5520.00 (CAD) */
    public function testLuxuryVehicleTotalCalculation()
    {
        $vehicle = new LuxuryVehicle(5000);
        $this->assertEquals('5520.00', $vehicle->calculateTotal());
    }
}
