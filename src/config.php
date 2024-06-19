<?php
// Database configuration
$servername = "mariadb-service"; // Kubernetes service name for MySQL
$username = "root";
$password = "password";
$dbname = "myapp_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
