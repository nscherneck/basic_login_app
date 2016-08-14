<?php //database.php

$server = 'localhost';
$username = 'homestead';
$password = 'secret';
$database = 'loginapp';

try {
$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  }
catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage() . "...shit got fuckered up, y'all");
}

?>
