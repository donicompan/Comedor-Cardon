<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Configura la codificación de caracteres como UTF-8. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Hace que el diseño sea responsive. -->
    <title>Formulario de Registro</title> <!-- Título de la página. -->
    <link rel="stylesheet" href="css/estilos.css"> <!-- Enlace al archivo de estilos CSS. -->
</head>
<body>
    <h1>ABMC EN PHP</h1> <!-- Título principal del sitio. -->

    <?php include 'menu.php'; ?> <!-- Incluir el menú de navegación. -->

    <section id="contenedor">
        <!-- Sección principal que contiene el formulario. -->
        <section id="form_consulta">
            <form action="cargar_empleado.php" method="post" enctype="multipart/form-data">
                <!-- Formulario para registrar un nuevo empleado. -->
                <input type="text" name="nombre" placeholder="Nombre" required> <!-- Campo de texto para el nombre. -->
                <input type="text" name="apellido" placeholder="Apellido" required> <!-- Campo de texto para el apellido. -->
                <textarea name="descripcion" placeholder="Descripción" required cols="30" rows="10"></textarea> <!-- Área de texto para la descripción del empleado. -->
                <label for="foto">Elija una imagen de perfil</label> <!-- Etiqueta para el campo de archivo. -->
                <input type="file" name="foto" required> <!-- Campo para subir una imagen. -->
                <input type="submit" id="boton" value="Cargar Empleado"> <!-- Botón para enviar el formulario. -->
            </form>
        </section>
    </section>
</body>
</html>
