<?php
session_start();

include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$usuario = $_POST['user'] ?? '';
$pass = $_POST['password'] ?? '';



// Usamos prepared statements para mayor seguridad
$sql = "SELECT * FROM mozo WHERE usu_mozo = ? AND pass_mozo = ?";
$stmt = mysqli_prepare($conexion, $sql);
if (!$stmt) {
    // En caso de error preparando la consulta
    header('Location: index.php?error=1');
    exit;
}
mysqli_stmt_bind_param($stmt, "ss", $usuario, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $_SESSION['usuario'] = $usuario;
    header('Location: principal.php');
    exit;
} else {
    header('Location: index.php?error=1');
    exit;
}
?>
