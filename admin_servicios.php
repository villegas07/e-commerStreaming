<?php
session_start();
include 'conexion.php';
include 'nav.php';

// Verificar si el usuario tiene el rol necesario (admin o superadmin)
if (!isset($_SESSION['nombre_usuario']) || ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'superadmin')) {
    header("Location: login.php");
    exit();
}

// Variables para mostrar mensajes
$error = '';
$exito = '';
$editarServicio = null; // Variable para almacenar el servicio en edición

// Ruta de la carpeta de carga de imágenes
$uploadDir = 'uploads/';

// Crear Servicio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $garantia = $_POST['garantia'];
    $descripcion = $_POST['descripcion'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagenNombre = basename($_FILES['imagen']['name']);
        $imagenPath = $uploadDir . $imagenNombre;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath)) {
            $query = "INSERT INTO Servicios (nombre, precio, garantia, descripcion, imagen_url) VALUES ('$nombre', '$precio', '$garantia', '$descripcion', '$imagenPath')";
            if ($conexion->query($query) === TRUE) {
                $exito = "Servicio creado exitosamente.";
            } else {
                $error = "Error al crear el servicio: " . $conexion->error;
            }
        } else {
            $error = "Error al subir la imagen.";
        }
    } else {
        $error = "Debe seleccionar una imagen válida.";
    }
}

// Cargar datos del servicio en edición
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $resultado = $conexion->query("SELECT * FROM Servicios WHERE id=$id");
    $editarServicio = $resultado->fetch_assoc();
}

// Actualizar Servicio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $garantia = $_POST['garantia'];
    $descripcion = $_POST['descripcion'];

    // Verificar si se ha cargado una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagenNombre = basename($_FILES['imagen']['name']);
        $imagenPath = $uploadDir . $imagenNombre;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath)) {
            $query = "UPDATE Servicios SET nombre='$nombre', precio='$precio', garantia='$garantia', descripcion='$descripcion', imagen_url='$imagenPath' WHERE id=$id";
        }
    } else {
        $query = "UPDATE Servicios SET nombre='$nombre', precio='$precio', garantia='$garantia', descripcion='$descripcion' WHERE id=$id";
    }

    if ($conexion->query($query) === TRUE) {
        $exito = "Servicio actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el servicio: " . $conexion->error;
    }
}

// Eliminar Servicio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM Servicios WHERE id=$id";
    if ($conexion->query($query) === TRUE) {
        $exito = "Servicio eliminado exitosamente.";
    } else {
        $error = "Error al eliminar el servicio: " . $conexion->error;
    }
}

// Obtener todos los servicios
$servicios = $conexion->query("SELECT * FROM Servicios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios Principales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Gestión de Servicios Principales</h1>

        <?php if ($exito): ?>
            <div class="alert alert-success"><?php echo $exito; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario para Crear un Nuevo Servicio -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?php echo $editarServicio ? 'Editar Servicio' : 'Agregar Nuevo Servicio'; ?></h5>
                <form action="admin_servicios.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $editarServicio ? 'actualizar' : 'crear'; ?>" value="1">
                    <?php if ($editarServicio): ?>
                        <input type="hidden" name="id" value="<?php echo $editarServicio['id']; ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Servicio</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required value="<?php echo $editarServicio['nombre'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" required value="<?php echo $editarServicio['precio'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="garantia" class="form-label">Garantía</label>
                        <input type="text" name="garantia" id="garantia" class="form-control" value="<?php echo $editarServicio['garantia'] ?? '30 Días'; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"><?php echo $editarServicio['descripcion'] ?? ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen del Servicio</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                        <?php if ($editarServicio && $editarServicio['imagen_url']): ?>
                            <small>Imagen actual: <a href="<?php echo $editarServicio['imagen_url']; ?>" target="_blank">Ver Imagen</a></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $editarServicio ? 'Actualizar Servicio' : 'Crear Servicio'; ?></button>
                </form>
            </div>
        </div>

        <!-- Tabla de Servicios Existentes -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Garantía</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($servicio = $servicios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $servicio['id']; ?></td>
                        <td><?php echo htmlspecialchars($servicio['nombre']); ?></td>
                        <td><?php echo number_format($servicio['precio'], 2); ?> COP</td>
                        <td><?php echo htmlspecialchars($servicio['garantia']); ?></td>
                        <td><?php echo htmlspecialchars($servicio['descripcion']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($servicio['imagen_url']); ?>" alt="<?php echo htmlspecialchars($servicio['nombre']); ?>" style="width: 50px;"></td>
                        <td>
                            <!-- Botón para Editar -->
                            <form action="admin_servicios.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">
                                <input type="hidden" name="editar" value="1">
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <!-- Botón para Eliminar -->
                            <form action="admin_servicios.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">
                                <input type="hidden" name="eliminar" value="1">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
