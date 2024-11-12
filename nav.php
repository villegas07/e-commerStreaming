<!-- nav.php -->
<?php
include 'conexion.php';

// Variables de sesión para el nombre y rol, en caso de que estén disponibles
$nombre_usuario = $_SESSION['nombre_usuario'] ?? '';
$rol = $_SESSION['rol'] ?? '';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Shop Streaming Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($rol == 'superadmin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_usuarios.php">Gestión de Usuarios</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="admin_servicios.php">Servicios Principales</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_promociones.php">Promociones Especiales</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_mejor_para_ti.php">Lo Mejor Para Ti</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_netflix_promo.php">Netflix Promo</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_streaming_total.php">Streaming Total</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_spotify_promo.php">Spotify Promo</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_otros_servicios.php">Otros Servicios</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
