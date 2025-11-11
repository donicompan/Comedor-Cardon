<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Empleados</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>                  
    <div class="container mt-4">
        <h1 class="text-center mb-4">ABMC en PHP</h1>
        <?php include("menu.php"); ?>

        <div class="row "> <!-- Aseguramos que las tarjetas se alineen correctamente -->
            <?php
                include("conexion.php");
                $sql = "SELECT * FROM empleados";
                $resultado = mysqli_query($conexion, $sql);
                while($fila = mysqli_fetch_array($resultado)){
            ?>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- Ajuste de columnas -->             
                    <div class="card shadow-sm"> <!-- Asegúrate de que la tarjeta ocupe el 100% del ancho -->
                        <img src="img/<?php echo $fila['emp_foto']; ?>" class="card-img-top img-fluid" alt="Imagen de empleado"> <!-- Imagen responsiva -->
                        <div class="card-body">
                            <h5 class="card-title">Nombre: <?php echo $fila['emp_nombre']; ?></h5>
                            <p class="card-text">Apellido: <?php echo $fila['emp_apellido']; ?></p>
                            <p class="card-text">Descripción: <?php echo $fila['emp_descripcion']; ?></p>
                            <a href="actualizar_empleado.php?id=<?php echo $fila['emp_id']; ?>" class="btn btn-warning">Actualizar</a>
                            <a onclick='return confirm("¿Estás seguro que quieres eliminar este empleado?")' href="eliminar_empleado.php?id=<?php echo $fila['emp_id']; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                        
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
