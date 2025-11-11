<?php
    $emp_nombre = $_POST['nombre'];
    $emp_apellido = $_POST['apellido'];
    $emp_descripcion = $_POST['descripcion'];
    $emp_foto = $_FILES['foto'];

    include('conexion.php');

    $sql = "INSERT INTO empleados (emp_nombre, emp_apellido, emp_descripcion, emp_foto) VALUES ('$emp_nombre', '$emp_apellido', '$emp_descripcion', '$emp_foto')";

    $resultado = mysqli_query($conexion, $sql);

    mysqli_close($conexion);//cerrar la conexion
    header('Location: index.php');

?>