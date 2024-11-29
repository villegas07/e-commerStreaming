<?php
$host = 'localhost';
$user = 'root';         // Reemplaza con tu usuario de MySQL
$password = '';   // Reemplaza con tu contraseña de MySQL
$db = 'plataformastreaming';   // Nombre de la base de datos

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
