<?php
include 'conexion.php';

// Obtener datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$descripcion = $_POST['descripcion'];
$foto = $_FILES['foto'];

// Manejar la subida de la imagen si se seleccionó una nueva
$foto_nombre = null;
if ($foto['error'] == UPLOAD_ERR_OK) {
    $foto_nombre = basename($foto['name']);
    $ruta_destino = "img/" . $foto_nombre;
}
// Crear la consulta SQL con o sin imagen
if ($foto_nombre) {
    $sql = "UPDATE empleados SET emp_nombre = ?, emp_apellido = ?, emp_descripcion = ?, emp_foto = ? WHERE emp_id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $descripcion, $foto_nombre, $id);
} else {
    $sql = "UPDATE empleados SET emp_nombre = ?, emp_apellido = ?, emp_descripcion = ? WHERE emp_id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nombre, $apellido, $descripcion, $id);
}

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    header("Location: ver_empleados.php");
} else {
    echo "Error al actualizar el empleado.";
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
