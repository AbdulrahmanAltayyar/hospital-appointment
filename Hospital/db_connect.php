<?php
/**
 * db_connect.php
 * Connects to the MySQL database (hospital_db).
 * Update credentials as needed.
 */
$servername = "localhost:3307";
$username   = "root";
$password   = "";        // Default XAMPP root password is empty
$dbname     = "hospital_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
