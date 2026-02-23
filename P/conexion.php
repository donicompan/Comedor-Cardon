<?php

$host     = "localhost";
$usuario  = "root";
$password = "thor";
$base     = "comedor";

$conexion = new mysqli($host, $usuario, $password, $base);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");
