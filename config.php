<?php
$host = 'localhost';
$user = 'root';      
$pass = '';
$db   = 'product_admin_panel';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Помилка зʼєднання: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
