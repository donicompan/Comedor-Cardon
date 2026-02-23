<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="principal.php">Comedor Cardon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="principal.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="cargar_empleado.php">Cargar Empleado</a></li>
        <li class="nav-item"><a class="nav-link" href="ver_empleados.php">Ver Empleados</a></li>
        <li class="nav-item"><a class="nav-link" href="modificar_empleado.php">Modificar Empleado</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <span class="navbar-text me-3">Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="logout.php">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
