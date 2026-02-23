<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'cajero') {
    header("Location: principal.php");
    exit;
}
include('conexion.php');

$seccion = $_GET['s'] ?? 'productos';
$secciones_validas = ['productos', 'mozos', 'cajeros'];
if (!in_array($seccion, $secciones_validas)) $seccion = 'productos';

$ok    = $_GET['ok']    ?? '';
$error = $_GET['error'] ?? '';

// ============================================================
// PROCESAR FORMULARIOS POST
// ============================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    // ── PRODUCTOS ────────────────────────────────────────────
    if ($accion === 'nuevo_producto') {
        $tipo   = $_POST['tipo']   ?? '';
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = intval($_POST['precio'] ?? 0);
        $desc   = trim($_POST['desc'] ?? '');
        $tablas = ['plato' => ['plato','nom_plato','descr_plato','precio_plato'],
                   'bebida'=> ['bebida','nom_bebida','desc_bebida','precio_bebida'],
                   'postre'=> ['postre','nom_postre','desc_postre','precio_postre']];
        if (isset($tablas[$tipo]) && $nombre && $precio > 0) {
            [$t, $cn, $cd, $cp] = $tablas[$tipo];
            $stmt = $conexion->prepare("INSERT INTO $t ($cn, $cd, $cp) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $nombre, $desc, $precio);
            $stmt->execute() ? $ok = 'producto_creado' : $error = 'error_db';
            $stmt->close();
        } else { $error = 'datos_invalidos'; }
        header("Location: admin.php?s=productos&ok=$ok&error=$error"); exit;
    }

    if ($accion === 'editar_producto') {
        $tipo   = $_POST['tipo']   ?? '';
        $id     = intval($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = intval($_POST['precio'] ?? 0);
        $desc   = trim($_POST['desc'] ?? '');
        $tablas = ['plato' => ['plato','nom_plato','descr_plato','precio_plato','id_plato'],
                   'bebida'=> ['bebida','nom_bebida','desc_bebida','precio_bebida','id_bebida'],
                   'postre'=> ['postre','nom_postre','desc_postre','precio_postre','id_postre']];
        if (isset($tablas[$tipo]) && $id && $nombre && $precio > 0) {
            [$t, $cn, $cd, $cp, $ci] = $tablas[$tipo];
            $stmt = $conexion->prepare("UPDATE $t SET $cn=?, $cd=?, $cp=? WHERE $ci=?");
            $stmt->bind_param("ssii", $nombre, $desc, $precio, $id);
            $stmt->execute() ? $ok = 'producto_editado' : $error = 'error_db';
            $stmt->close();
        } else { $error = 'datos_invalidos'; }
        header("Location: admin.php?s=productos&ok=$ok&error=$error"); exit;
    }

    if ($accion === 'eliminar_producto') {
        $tipo = $_POST['tipo'] ?? '';
        $id   = intval($_POST['id'] ?? 0);
        $tablas = ['plato'=>['plato','id_plato'],'bebida'=>['bebida','id_bebida'],'postre'=>['postre','id_postre']];
        if (isset($tablas[$tipo]) && $id) {
            [$t, $ci] = $tablas[$tipo];
            $stmt = $conexion->prepare("DELETE FROM $t WHERE $ci=?");
            $stmt->bind_param("i", $id);
            $stmt->execute() ? $ok = 'producto_eliminado' : $error = 'error_db';
            $stmt->close();
        }
        header("Location: admin.php?s=productos&ok=$ok&error=$error"); exit;
    }

    // ── MOZOS ────────────────────────────────────────────────
    if ($accion === 'nuevo_mozo') {
        $nom = trim($_POST['nom'] ?? '');
        $ape = trim($_POST['ape'] ?? '');
        $usu = trim($_POST['usu'] ?? '');
        $pas = trim($_POST['pas'] ?? '');
        if ($nom && $ape && $usu && $pas) {
            $stmt = $conexion->prepare("INSERT INTO mozo (nom_mozo,ape_mozo,usu_mozo,pass_mozo) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $nom, $ape, $usu, $pas);
            $stmt->execute() ? $ok = 'mozo_creado' : $error = 'error_db';
            $stmt->close();
        } else { $error = 'datos_invalidos'; }
        header("Location: admin.php?s=mozos&ok=$ok&error=$error"); exit;
    }

    if ($accion === 'eliminar_mozo') {
        $id = intval($_POST['id'] ?? 0);
        if ($id) {
            $stmt = $conexion->prepare("DELETE FROM mozo WHERE id_mozo=?");
            $stmt->bind_param("i", $id);
            $stmt->execute() ? $ok = 'mozo_eliminado' : $error = 'error_db';
            $stmt->close();
        }
        header("Location: admin.php?s=mozos&ok=$ok&error=$error"); exit;
    }

    // ── CAJEROS ──────────────────────────────────────────────
    if ($accion === 'nuevo_cajero') {
        $nom = trim($_POST['nom'] ?? '');
        $ape = trim($_POST['ape'] ?? '');
        $usu = trim($_POST['usu'] ?? '');
        $pas = trim($_POST['pas'] ?? '');
        if ($nom && $ape && $usu && $pas) {
            $stmt = $conexion->prepare("INSERT INTO cajero (nom_cajero,ape_cajero,usu_cajero,pass_cajero) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $nom, $ape, $usu, $pas);
            $stmt->execute() ? $ok = 'cajero_creado' : $error = 'error_db';
            $stmt->close();
        } else { $error = 'datos_invalidos'; }
        header("Location: admin.php?s=cajeros&ok=$ok&error=$error"); exit;
    }

    if ($accion === 'eliminar_cajero') {
        $id = intval($_POST['id'] ?? 0);
        // No permitir eliminarse a uno mismo
        if ($id && $id !== intval($_SESSION['id_usuario'])) {
            $stmt = $conexion->prepare("DELETE FROM cajero WHERE id_cajero=?");
            $stmt->bind_param("i", $id);
            $stmt->execute() ? $ok = 'cajero_eliminado' : $error = 'error_db';
            $stmt->close();
        } else { $error = 'no_autoeliminacion'; }
        header("Location: admin.php?s=cajeros&ok=$ok&error=$error"); exit;
    }
}

// ============================================================
// CARGAR DATOS PARA MOSTRAR
// ============================================================
$platos  = $conexion->query("SELECT * FROM plato  ORDER BY nom_plato")->fetch_all(MYSQLI_ASSOC);
$bebidas = $conexion->query("SELECT * FROM bebida ORDER BY nom_bebida")->fetch_all(MYSQLI_ASSOC);
$postres = $conexion->query("SELECT * FROM postre ORDER BY nom_postre")->fetch_all(MYSQLI_ASSOC);
$mozos   = $conexion->query("SELECT * FROM mozo   ORDER BY nom_mozo")->fetch_all(MYSQLI_ASSOC);
$cajeros = $conexion->query("SELECT * FROM cajero ORDER BY nom_cajero")->fetch_all(MYSQLI_ASSOC);

$mensajes_ok = [
    'producto_creado'   => 'Producto creado correctamente.',
    'producto_editado'  => 'Producto actualizado.',
    'producto_eliminado'=> 'Producto eliminado.',
    'mozo_creado'       => 'Mozo creado correctamente.',
    'mozo_eliminado'    => 'Mozo eliminado.',
    'cajero_creado'     => 'Cajero creado correctamente.',
    'cajero_eliminado'  => 'Cajero eliminado.',
];
$mensajes_error = [
    'datos_invalidos'    => 'Completá todos los campos correctamente.',
    'error_db'           => 'Error en la base de datos.',
    'no_autoeliminacion' => 'No podés eliminar tu propio usuario.',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración — Cardón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family:'Poppins',sans-serif; background:#f0f2f5; }
        .admin-card { background:white; border-radius:14px; box-shadow:0 2px 10px rgba(0,0,0,.07); }
        .admin-card .card-header { background:transparent; border-bottom:1px solid #f0f0f0; font-weight:700; padding:16px 20px; }
        .seccion-tab { border-radius:10px; font-weight:500; font-size:.9rem; }
        .seccion-tab.active { background:#0d6efd; color:white; }
        .precio-input { max-width:150px; }
        @media(max-width:576px) { .precio-input { max-width:100%; } }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container-fluid px-3 px-md-4 pb-5">

    <h4 class="fw-bold mb-1"><i class="bi bi-gear"></i> Administración</h4>
    <p class="text-muted small mb-4">Solo visible para cajeros</p>

    <!-- Alertas -->
    <?php if ($ok && isset($mensajes_ok[$ok])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i> <?= $mensajes_ok[$ok] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php elseif ($error && isset($mensajes_error[$error])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle"></i> <?= $mensajes_error[$error] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Pestañas de sección -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="?s=productos" class="btn seccion-tab <?= $seccion==='productos' ? 'active' : 'btn-outline-secondary' ?>">
            <i class="bi bi-egg-fried"></i> Productos
        </a>
        <a href="?s=mozos" class="btn seccion-tab <?= $seccion==='mozos' ? 'active' : 'btn-outline-secondary' ?>">
            <i class="bi bi-person-badge"></i> Mozos
        </a>
        <a href="?s=cajeros" class="btn seccion-tab <?= $seccion==='cajeros' ? 'active' : 'btn-outline-secondary' ?>">
            <i class="bi bi-cash-register"></i> Cajeros
        </a>
    </div>

    <!-- ══════════════════════════════════════════════════════
         SECCIÓN: PRODUCTOS
    ══════════════════════════════════════════════════════ -->
    <?php if ($seccion === 'productos'): ?>

    <!-- Formulario nuevo producto -->
    <div class="admin-card mb-4">
        <div class="card-header"><i class="bi bi-plus-circle text-success"></i> Nuevo producto</div>
        <div class="p-3 p-md-4">
            <form method="POST" class="row g-3">
                <input type="hidden" name="accion" value="nuevo_producto">
                <div class="col-12 col-sm-4 col-lg-2">
                    <label class="form-label fw-semibold">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option value="">— elegí —</option>
                        <option value="plato">🍽 Plato</option>
                        <option value="bebida">🥤 Bebida</option>
                        <option value="postre">🍰 Postre</option>
                    </select>
                </div>
                <div class="col-12 col-sm-5 col-lg-3">
                    <label class="form-label fw-semibold">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej: Milanesa napolitana" required>
                </div>
                <div class="col-12 col-sm-5 col-lg-3">
                    <label class="form-label fw-semibold">Descripción <span class="text-muted fw-normal">(opcional)</span></label>
                    <input type="text" name="desc" class="form-control" placeholder="Ej: con papas fritas">
                </div>
                <div class="col-12 col-sm-3 col-lg-2">
                    <label class="form-label fw-semibold">Precio ($)</label>
                    <input type="number" name="precio" class="form-control" placeholder="0" min="1" required>
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-plus-lg"></i> Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Listados por tipo -->
    <?php
    $grupos = [
        ['titulo'=>'Platos',  'icono'=>'egg-fried',  'badge'=>'danger',    'items'=>$platos,  'tipo'=>'plato',  'col_id'=>'id_plato',  'col_nom'=>'nom_plato',  'col_desc'=>'descr_plato',  'col_precio'=>'precio_plato'],
        ['titulo'=>'Bebidas', 'icono'=>'cup-straw',  'badge'=>'info',      'items'=>$bebidas, 'tipo'=>'bebida', 'col_id'=>'id_bebida', 'col_nom'=>'nom_bebida', 'col_desc'=>'desc_bebida',  'col_precio'=>'precio_bebida'],
        ['titulo'=>'Postres', 'icono'=>'cake2',      'badge'=>'secondary', 'items'=>$postres, 'tipo'=>'postre', 'col_id'=>'id_postre', 'col_nom'=>'nom_postre', 'col_desc'=>'desc_postre',  'col_precio'=>'precio_postre'],
    ];
    foreach ($grupos as $g):
    ?>
    <div class="admin-card mb-4">
        <div class="card-header">
            <i class="bi bi-<?= $g['icono'] ?>"></i> <?= $g['titulo'] ?>
            <span class="badge bg-<?= $g['badge'] ?> ms-2"><?= count($g['items']) ?></span>
        </div>
        <div class="p-3">
            <?php if (empty($g['items'])): ?>
                <p class="text-muted text-center py-3">No hay <?= strtolower($g['titulo']) ?> cargados.</p>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th class="d-none d-md-table-cell">Descripción</th>
                            <th class="text-end">Precio</th>
                            <th class="text-end" style="width:160px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($g['items'] as $item): ?>
                        <tr>
                            <td class="fw-semibold"><?= htmlspecialchars($item[$g['col_nom']]) ?></td>
                            <td class="text-muted small d-none d-md-table-cell"><?= htmlspecialchars($item[$g['col_desc']] ?? '') ?></td>
                            <td class="text-end">$<?= number_format($item[$g['col_precio']], 0, ',', '.') ?></td>
                            <td class="text-end">
                                <!-- Editar -->
                                <button class="btn btn-sm btn-outline-primary me-1"
                                        onclick="abrirEditar('<?= $g['tipo'] ?>',<?= $item[$g['col_id']] ?>,'<?= addslashes($item[$g['col_nom']]) ?>','<?= addslashes($item[$g['col_desc']] ?? '') ?>',<?= $item[$g['col_precio']] ?>)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <!-- Eliminar -->
                                <form method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar <?= htmlspecialchars($item[$g['col_nom']]) ?>?')">
                                    <input type="hidden" name="accion" value="eliminar_producto">
                                    <input type="hidden" name="tipo"   value="<?= $g['tipo'] ?>">
                                    <input type="hidden" name="id"     value="<?= $item[$g['col_id']] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal editar producto -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Editar producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="accion" value="editar_producto">
                        <input type="hidden" name="tipo" id="edit_tipo">
                        <input type="hidden" name="id"   id="edit_id">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descripción <span class="text-muted fw-normal">(opcional)</span></label>
                            <input type="text" name="desc" id="edit_desc" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Precio ($)</label>
                            <input type="number" name="precio" id="edit_precio" class="form-control" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════
         SECCIÓN: MOZOS
    ══════════════════════════════════════════════════════ -->
    <?php elseif ($seccion === 'mozos'): ?>

    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="admin-card">
                <div class="card-header"><i class="bi bi-plus-circle text-success"></i> Nuevo mozo</div>
                <div class="p-3 p-md-4">
                    <form method="POST" class="row g-3">
                        <input type="hidden" name="accion" value="nuevo_mozo">
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="nom" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Apellido</label>
                            <input type="text" name="ape" class="form-control" placeholder="Apellido" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Usuario</label>
                            <input type="text" name="usu" class="form-control" placeholder="@usuario" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Contraseña</label>
                            <input type="text" name="pas" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-person-plus"></i> Agregar mozo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7">
            <div class="admin-card">
                <div class="card-header">
                    <i class="bi bi-people"></i> Mozos registrados
                    <span class="badge bg-secondary ms-2"><?= count($mozos) ?></span>
                </div>
                <div class="p-3">
                    <?php if (empty($mozos)): ?>
                        <p class="text-muted text-center py-4">No hay mozos registrados.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr><th>Nombre</th><th>Usuario</th><th class="text-end">Acción</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($mozos as $m): ?>
                                <tr>
                                    <td class="fw-semibold"><?= htmlspecialchars($m['nom_mozo'].' '.$m['ape_mozo']) ?></td>
                                    <td class="text-muted">@<?= htmlspecialchars($m['usu_mozo']) ?></td>
                                    <td class="text-end">
                                        <form method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Eliminar a <?= htmlspecialchars($m['nom_mozo']) ?>?')">
                                            <input type="hidden" name="accion" value="eliminar_mozo">
                                            <input type="hidden" name="id"     value="<?= $m['id_mozo'] ?>">
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════
         SECCIÓN: CAJEROS
    ══════════════════════════════════════════════════════ -->
    <?php elseif ($seccion === 'cajeros'): ?>

    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="admin-card">
                <div class="card-header"><i class="bi bi-plus-circle text-success"></i> Nuevo cajero</div>
                <div class="p-3 p-md-4">
                    <form method="POST" class="row g-3">
                        <input type="hidden" name="accion" value="nuevo_cajero">
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="nom" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Apellido</label>
                            <input type="text" name="ape" class="form-control" placeholder="Apellido" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Usuario</label>
                            <input type="text" name="usu" class="form-control" placeholder="@usuario" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold">Contraseña</label>
                            <input type="text" name="pas" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-person-plus"></i> Agregar cajero
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7">
            <div class="admin-card">
                <div class="card-header">
                    <i class="bi bi-people"></i> Cajeros registrados
                    <span class="badge bg-secondary ms-2"><?= count($cajeros) ?></span>
                </div>
                <div class="p-3">
                    <?php if (empty($cajeros)): ?>
                        <p class="text-muted text-center py-4">No hay cajeros registrados.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr><th>Nombre</th><th>Usuario</th><th class="text-end">Acción</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($cajeros as $c): ?>
                                <tr>
                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($c['nom_cajero'].' '.$c['ape_cajero']) ?>
                                        <?php if ($c['id_cajero'] == $_SESSION['id_usuario']): ?>
                                            <span class="badge bg-primary ms-1">vos</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-muted">@<?= htmlspecialchars($c['usu_cajero']) ?></td>
                                    <td class="text-end">
                                        <?php if ($c['id_cajero'] != $_SESSION['id_usuario']): ?>
                                        <form method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Eliminar a <?= htmlspecialchars($c['nom_cajero']) ?>?')">
                                            <input type="hidden" name="accion" value="eliminar_cajero">
                                            <input type="hidden" name="id"     value="<?= $c['id_cajero'] ?>">
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        <?php else: ?>
                                            <span class="text-muted small">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function abrirEditar(tipo, id, nombre, desc, precio) {
    document.getElementById('edit_tipo').value    = tipo;
    document.getElementById('edit_id').value      = id;
    document.getElementById('edit_nombre').value  = nombre;
    document.getElementById('edit_desc').value    = desc;
    document.getElementById('edit_precio').value  = precio;
    new bootstrap.Modal(document.getElementById('modalEditar')).show();
}
</script>
</body>
</html>