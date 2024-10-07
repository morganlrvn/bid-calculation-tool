<?php

/**
 * Abstract class Vehicle representing a generic vehicle.
 *
 * This class defines the structure for specific vehicle types (CommonVehicle, LuxuryVehicle).
 * It includes methods for calculating various fees and the total cost.
 * 
 * Properties:
 *      $basePrice: Base price of the vehicle.
 */

abstract class Vehicle
{
    protected $basePrice;

    public function __construct($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    public function getBasePrice()
    {
        return $this->basePrice;
    }

    // Abstract methods for calculating various fees that must be implemented in child classes
    abstract public function calculateBasicBuyerFee();
    abstract public function calculateSpecialFee();
    abstract public function calculateAssociationFee();

    /**
     * Method to calculate the total cost including base price and all fees
     *
     * @return string Total cost formatted with two decimals.
     */
    public function calculateTotal()
    {
        $calculation =  $this->getBasePrice() +
            $this->calculateBasicBuyerFee() +
            $this->calculateSpecialFee() +
            $this->calculateAssociationFee() + 100; // Fixed storage fee of 100

        return number_format($calculation, 2, '.', '');
    }
}

/**
 * Class representing a common vehicle, extends the Vehicle abstract class
 */
class CommonVehicle extends Vehicle
{
    /**
     * Calculates the basic buyer fee for a common vehicle.
     *
     * @return float Basic buyer fee.
     */    
    public function calculateBasicBuyerFee()
    {
        $fee = 0.10 * $this->getBasePrice();
        return min(max($fee, 10), 50);
    }

    /**
     * Calculates the special fee for a common vehicle.
     *
     * @return float Special fee.
     */
    public function calculateSpecialFee()
    {
        return number_format(0.02 * $this->getBasePrice(), 2, '.', '');
    }

    /**
     * Calculates the association fee based on the base price.
     *
     * @return int Association fee.
     */    
    public function calculateAssociationFee()
    {
        $price = $this->getBasePrice();
        if ($price <= 500) return 5;
        if ($price <= 1000) return 10;
        if ($price <= 3000) return 15;
        return 20;
    }
}

/**
 * Class representing a luxury vehicle, extends the Vehicle abstract class
 */
class LuxuryVehicle extends Vehicle
{
    /**
     * Calculates the basic buyer fee for a luxury vehicle.
     *
     * @return float Basic buyer fee.
     */
    public function calculateBasicBuyerFee()
    {
        $fee = 0.10 * $this->getBasePrice();
        return min(max($fee, 25), 200);
    }

    /**
     * Calculates the special fee for a luxury vehicle.
     *
     * @return float Special fee.
     */    
    public function calculateSpecialFee()
    {
        return 0.04 * $this->getBasePrice();
    }

    /**
     * Calculates the association fee based on the base price.
     *
     * @return int Association fee.
     */
    public function calculateAssociationFee()
    {
        $price = $this->getBasePrice();
        if ($price <= 500) return 5;
        if ($price <= 1000) return 10;
        if ($price <= 3000) return 15;
        return 20;
    }
}
