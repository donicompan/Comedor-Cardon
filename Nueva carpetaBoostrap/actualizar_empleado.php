<?php 
    $id = $_GET['id'];
    include 'conexion.php';
    $sql = "SELECT * FROM empleados WHERE emp_id = $id";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($resultado);
    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Empleado</title>
    <link rel="stylesheet" href="css/estilos2.css">
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center my-4">Actualizar Empleado</h1>

        <?php include 'menu.php'; ?>

        <section id="contenedor2">
            <section id="form_consulta" >
            <div class="row">
            <div class="col-md-6 offset-md-3 ">
                <form action="modificar.php" method="post" enctype="multipart/form-data" class=" p-4 shadow rounded">
                    <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $fila['emp_id']; ?>">
                    <input type="text" name="nombre" value="<?php echo $fila['emp_nombre'] ?>" required class="form-control">
                </div>
                <div class="mb-3">
                        <input type="text" name="apellido" value="<?php echo $fila['emp_apellido'] ?>" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea name="descripcion" required class="form-control" cols="30" rows="10"><?php echo $fila['emp_descripcion'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Elija una imagen de perfil</label>
                        <input type="file" name="foto" class="form-control mb-3">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="boton" value="Modificar Empleado" class="btn btn-primary btn-block">
                    </div>
                </form>
                </div>
                </div>
            </section>
        </section>
    </div>
    <footer class="footer bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p>&copy; 2024 Matias. Todos los derechos reservados.</p>
        <p><a href="#" class="text-white">Contacto</a> | <a href="#" class="text-white">Política de privacidad</a></p>
    </div>
</footer>

    <!-- Agregar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
