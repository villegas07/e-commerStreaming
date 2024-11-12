<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit();
}

// Conectar a la base de datos
include 'conexion.php';

// Obtener información del usuario
$nombre_usuario = $_SESSION['nombre_usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Barra de navegación simplificada -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Shop Streaming Dashboard</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></h1>
        <p class="text-center text-muted">Rol: <?php echo htmlspecialchars($rol); ?></p>

        <!-- Opciones del Superadmin -->
        <?php if ($rol == 'superadmin'): ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gestión de Usuarios</h5>
                            <p class="card-text">Crea, actualiza o elimina usuarios.</p>
                            <a href="admin_usuarios.php" class="btn btn-primary">Administrar Usuarios</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Opciones de Gestión de Secciones (para ambos roles) -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Servicios Principales</h5>
                        <p class="card-text">Administra los servicios y sus precios en la sección principal.</p>
                        <a href="admin_servicios.php" class="btn btn-primary">Administrar Servicios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Promociones Especiales</h5>
                        <p class="card-text">Administra las promociones especiales como el "Combo Plus".</p>
                        <a href="admin_promociones.php" class="btn btn-primary">Administrar Promociones</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de "Lo Mejor Para Ti"</h5>
                        <p class="card-text">Administra la sección "Lo Mejor Para Ti".</p>
                        <a href="admin_mejor_para_ti.php" class="btn btn-primary">Administrar Lo Mejor Para Ti</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Netflix Promo</h5>
                        <p class="card-text">Administra la sección de promoción de Netflix.</p>
                        <a href="admin_netflix_promo.php" class="btn btn-primary">Administrar Netflix Promo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Streaming Total</h5>
                        <p class="card-text">Administra la sección de "Streaming Total".</p>
                        <a href="admin_streaming_total.php" class="btn btn-primary">Administrar Streaming Total</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Spotify Promo</h5>
                        <p class="card-text">Administra la promoción de Spotify.</p>
                        <a href="admin_spotify_promo.php" class="btn btn-primary">Administrar Spotify Promo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Otros Servicios</h5>
                        <p class="card-text">Administra la sección de "Otros Servicios".</p>
                        <a href="admin_otros_servicios.php" class="btn btn-primary">Administrar Otros Servicios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
