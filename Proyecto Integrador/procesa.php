<?php
session_start();

$usuario = $_POST['user'];
$pass = $_POST['password'];

include('conexion.php');

$sql = "SELECT * FROM mozo WHERE usu_mozo = '$usuario' AND pass_mozo = '$pass'";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['usuario'] = $usuario;
    header('Location: principal.php');
    exit; // importante para detener el script
} else {
    header('Location: index.php');
    exit;
}
?>
