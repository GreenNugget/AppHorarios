<?php
/*
Este archivo sirve para conectar a la base de datos
se llama con 'require 'database.php';' al inicio de archivo
*/
$dbInfo = json_decode(file_get_contents("../model/db_info.json"));
mysqli_connect($dbInfo->host, $dbInfo->user, $dbInfo->password, $dbInfo->database);

try {
    $conn = new PDO("mysql:host=$dbInfo->host;dbname=$dbInfo->database;", $dbInfo->user, $dbInfo->password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}
?>