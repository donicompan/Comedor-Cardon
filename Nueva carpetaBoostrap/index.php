<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Registro</title>
        <link rel="stylesheet" href="css/estilos.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-4">
            <h1 class="text-center mb-4">ABMC en PHP</h1>

            <?php include 'menu.php'; ?>

            <section id ="contenedor">
              <section id ="form_consulta">
                <div class="row">
                <div class="col-md-6 offset-md-3 ">
                    <form action="cargar_empleado.php" method="post" enctype="multipart/form-data" class=" p-4 shadow rounded" >
                        <div class="mb-3">
                            <input 
                            type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required >
                        </div>
                        <div class="mb-3">
                            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Descripción" required ></textarea>
                        </div>
                        <div class="mb-3" >
                            <label for="foto" class="form-label" style="color:black;font-family: Arial, Helvetica, sans-serif;font-weight:600;font-size: 15px;text-align:center;border-radius: 10px;text-shadow: 0px 0px 10px cyan,0px 0px 10px cyan,0px 0px 10px cyan,0px 0px 10px cyan;margin: 10px 0px;"
                            >Elija su foto de PERFIL</label>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
