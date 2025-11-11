<?php
   include("conexion.php");
   $id = $_GET['id'];
   $sql = "DELETE FROM empleados WHERE emp_id = '$id'";
   $resultado = mysqli_query($conexion, $sql);
   //echo $sql;
   header("Location: ver_empleados.php");

?>