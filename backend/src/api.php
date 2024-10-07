<?php

// Include the Vehicle class definition from the specified path
require_once __DIR__ . '\Vehicle.php';

// Add headers to allow CORS requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Max-Age: 3600');

// Handle OPTIONS requests (CORS preflight requests)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Decode the JSON input data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the base price and vehicle type from the decoded data
    $basePrice = $data['base_price'];
    $vehicleType = $data['vehicle_type'];

    // Instantiate the appropriate vehicle object based on the vehicle type and create instance
    if ($vehicleType === 'common') {
        $vehicle = new CommonVehicle($basePrice);
    } elseif ($vehicleType === 'luxury') {
        $vehicle = new LuxuryVehicle($basePrice);
    }


     // Prepare the response data with calculated fees and total price
    $response = [
        'base_price' => $basePrice,
        'basic_buyer_fee' => $vehicle->calculateBasicBuyerFee(),
        'special_fee' => $vehicle->calculateSpecialFee(),
        'association_fee' => $vehicle->calculateAssociationFee(),
        'storage_fee' => 100,
        'total' => $vehicle->calculateTotal()
    ];

    // Encode the response data as JSON 
    echo json_encode($response);
}
