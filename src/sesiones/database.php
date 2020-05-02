<?php
/*
Este archivo sirve para conectar a la base de datos
se llama con 'require 'database.php';' al inicio de archivo
*/

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'schedexproject';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}
?>