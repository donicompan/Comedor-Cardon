<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Comedor</title>
    <link rel="stylesheet" href="css/estilosIndex.css">
</head>
<body>
    
    <img src="img/LogoCardon.jpeg" alt="logo" class="logo">
    

    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;">Usuario o contraseña incorrectos</p>
    <?php endif; ?>

    <form action="procesa.php" method="post">
        <input type="text" name="user" id="user" required placeholder="usuario"><br><br>
        <input type="password" name="password" id="password" required placeholder="contraseña"><br><br>
        <input type="submit" value="Acceder">
    </form>
</body>
</html>
