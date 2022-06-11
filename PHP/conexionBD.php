<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "aldoups_proyecto";

try {
    /** Se realiza la conexión */
    $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "connection successfully\n"; 

} catch (PDOException $e) {
    die('ERROR' . $e->getMessage());
}