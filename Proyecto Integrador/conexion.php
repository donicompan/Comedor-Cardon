<?php
   $servidor = "localhost";
   $usuario = "root";
   $password = "thor";
   $basededatos = "comedor";

   // Crear conexión
   $conexion = mysqli_connect($servidor, $usuario, $password, $basededatos);

   // Comprobar conexión
   if (!$conexion) {
       die("Conexión fallida: " );
   }
//    echo "Conexión exitosa";
?>