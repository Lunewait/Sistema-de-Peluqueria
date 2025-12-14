<?php

$host = '127.0.0.1';
$port = '5432';
$username = 'postgres';
$password = 'admin123';
$database = 'beauty_salon';

try {
    // Connect to valid 'postgres' db first
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=postgres", $username, $password);

    // Check if database exists
    $stmt = $pdo->query("SELECT 1 FROM pg_database WHERE datname = '$database'");
    $exists = $stmt->fetchColumn();

    if (!$exists) {
        $pdo->exec("CREATE DATABASE $database");
        echo "Database '$database' created successfully.\n";
    } else {
        echo "Database '$database' already exists.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
