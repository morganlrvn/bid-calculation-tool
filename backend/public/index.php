<?php
// Include autoloader if necessary
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Retrieve environment variables
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASSWORD'];

// Test database connection
try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Successfully connected to the database $dbName";
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
