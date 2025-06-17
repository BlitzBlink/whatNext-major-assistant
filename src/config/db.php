<?php
$host = 'localhost';
$db   = 'whatnext';      
$user = 'root';
$pass = '';     

$conn = new mysqli($host, $user, $pass, $db);

// Check for connection error
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
