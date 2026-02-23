<?php
// navbar.php — incluir DESPUÉS de session_start() y conexion.php
$ventas_hoy = $conexion->query("
    SELECT COALESCE(SUM(total_pedido), 0)
    FROM pedido
    WHERE DATE(fecha_pedido) = CURDATE()
      AND estado_pedido = 'Completado'
")->fetch_row()[0];

$pedidos_activos = $conexion->query("
    SELECT COUNT(*) FROM pedido
    WHERE estado_pedido IN ('En Proceso')
")->fetch_row()[0];

$es_cajero = ($_SESSION['rol'] ?? '') === 'cajero';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid px-3">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="principal.php">
            <i class="bi bi-house-door-fill"></i>
            <span>Cardón</span>
        </a>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <!-- Links principales -->
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3" href="principal.php">
                        <i class="bi bi-grid-3x3"></i>
                        <span class="ms-1">Mesas</span>
                    </a>
                </li>

                <?php if ($es_cajero): ?>
                <li class="nav-item">
                    <a class="nav-link px-3" href="ventas.php">
                        <i class="bi bi-bar-chart-line"></i>
                        <span class="ms-1">Ventas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="admin.php">
                        <i class="bi bi-gear"></i>
                        <span class="ms-1">Administración</span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link px-3" href="cocina.php" target="_blank">
                        <i class="bi bi-fire"></i>
                        <span class="ms-1">Cocina</span>
                        <?php if ($pedidos_activos > 0): ?>
                        <span class="badge bg-danger ms-1"><?= $pedidos_activos ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>

            <!-- Info usuario -->
            <ul class="navbar-nav align-items-lg-center gap-2 mt-2 mt-lg-0">
                <?php if ($es_cajero): ?>
                <li class="nav-item">
                    <span class="navbar-text text-success fw-bold">
                        <i class="bi bi-cash-stack"></i>
                        $<?= number_format($ventas_hoy, 0, ',', '.') ?> hoy
                    </span>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <span class="navbar-text text-white-50 small">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['usuario']) ?>
                        <span class="badge bg-secondary ms-1"><?= $_SESSION['rol'] ?></span>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i> Salir
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
