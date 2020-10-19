<?php
$servername = "cPanel";
$username = "studypeers";
$password = "(V3a7?S8PaKWBL(m";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>