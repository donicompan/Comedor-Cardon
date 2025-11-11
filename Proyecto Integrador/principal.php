<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilos2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">--ABMC COMEDOR--</h1>

        <?php include 'menu.php'; ?>

        <section id="contenedor">
            <section id="form_consulta">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <!-- formulario para cargar empleado -->
                        <form action="cargar_empleado.php" method="post" enctype="multipart/form-data" class="p-4 shadow rounded">
                            <div class="mb-3">
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Descripción" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Elija su foto de PERFIL</label>
                                <input type="file" name="foto" id="foto" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cargar Empleado</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
