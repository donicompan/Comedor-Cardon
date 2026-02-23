<?php
session_start();
include('conexion.php');

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$usuario  = trim($_POST['user'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($usuario === '' || $password === '') {
    header("Location: index.php?error=1");
    exit;
}

// Buscar en cajeros
$stmt = $conexion->prepare("SELECT id_cajero, usu_cajero, pass_cajero FROM cajero WHERE usu_cajero = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($resultado && $resultado['pass_cajero'] === $password) {
    $_SESSION['usuario']    = $resultado['usu_cajero'];
    $_SESSION['id_usuario'] = $resultado['id_cajero'];
    $_SESSION['rol']        = 'cajero';
    header("Location: principal.php");
    exit;
}

// Buscar en mozos
$stmt = $conexion->prepare("SELECT id_mozo, usu_mozo, pass_mozo FROM mozo WHERE usu_mozo = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($resultado && $resultado['pass_mozo'] === $password) {
    $_SESSION['usuario']    = $resultado['usu_mozo'];
    $_SESSION['id_usuario'] = $resultado['id_mozo'];
    $_SESSION['rol']        = 'mozo';
    header("Location: principal.php");
    exit;
}

// Credenciales incorrectas
header("Location: index.php?error=1");
exit;
