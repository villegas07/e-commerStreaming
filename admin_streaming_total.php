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
$editarElemento = null; // Variable para almacenar el elemento en edición

// Ruta de la carpeta de carga de imágenes
$uploadDir = 'uploads/';

// Crear Elemento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $garantia = $_POST['garantia'];
    $descripcion = $_POST['descripcion'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagenNombre = basename($_FILES['imagen']['name']);
        $imagenPath = $uploadDir . $imagenNombre;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath)) {
            $query = "INSERT INTO StreamingTotal (nombre, precio, garantia, descripcion, imagen_url) VALUES ('$nombre', '$precio', '$garantia', '$descripcion', '$imagenPath')";
            if ($conexion->query($query) === TRUE) {
                $exito = "Elemento creado exitosamente.";
            } else {
                $error = "Error al crear el elemento: " . $conexion->error;
            }
        } else {
            $error = "Error al subir la imagen.";
        }
    } else {
        $error = "Debe seleccionar una imagen válida.";
    }
}

// Cargar datos del elemento en edición
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $resultado = $conexion->query("SELECT * FROM StreamingTotal WHERE id=$id");
    $editarElemento = $resultado->fetch_assoc();
}

// Actualizar Elemento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $garantia = $_POST['garantia'];
    $descripcion = $_POST['descripcion'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagenNombre = basename($_FILES['imagen']['name']);
        $imagenPath = $uploadDir . $imagenNombre;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath)) {
            $query = "UPDATE StreamingTotal SET nombre='$nombre', precio='$precio', garantia='$garantia', descripcion='$descripcion', imagen_url='$imagenPath' WHERE id=$id";
        }
    } else {
        $query = "UPDATE StreamingTotal SET nombre='$nombre', precio='$precio', garantia='$garantia', descripcion='$descripcion' WHERE id=$id";
    }

    if ($conexion->query($query) === TRUE) {
        $exito = "Elemento actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el elemento: " . $conexion->error;
    }
}

// Eliminar Elemento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM StreamingTotal WHERE id=$id";
    if ($conexion->query($query) === TRUE) {
        $exito = "Elemento eliminado exitosamente.";
    } else {
        $error = "Error al eliminar el elemento: " . $conexion->error;
    }
}

// Obtener todos los elementos
$elementos = $conexion->query("SELECT * FROM StreamingTotal");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Streaming Total</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Gestión de "Streaming Total"</h1>

        <?php if ($exito): ?>
            <div class="alert alert-success"><?php echo $exito; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario para Crear o Editar un Elemento -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?php echo $editarElemento ? 'Editar Elemento' : 'Agregar Nuevo Elemento'; ?></h5>
                <form action="admin_streaming_total.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $editarElemento ? 'actualizar' : 'crear'; ?>" value="1">
                    <?php if ($editarElemento): ?>
                        <input type="hidden" name="id" value="<?php echo $editarElemento['id']; ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required value="<?php echo $editarElemento['nombre'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" required value="<?php echo $editarElemento['precio'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="garantia" class="form-label">Garantía</label>
                        <input type="text" name="garantia" id="garantia" class="form-control" value="<?php echo $editarElemento['garantia'] ?? '30 Días'; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"><?php echo $editarElemento['descripcion'] ?? ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                        <?php if ($editarElemento && $editarElemento['imagen_url']): ?>
                            <small>Imagen actual: <a href="<?php echo $editarElemento['imagen_url']; ?>" target="_blank">Ver Imagen</a></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $editarElemento ? 'Actualizar Elemento' : 'Crear Elemento'; ?></button>
                </form>
            </div>
        </div>

        <!-- Tabla de Elementos Existentes -->
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
                <?php while ($elemento = $elementos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $elemento['id']; ?></td>
                        <td><?php echo htmlspecialchars($elemento['nombre']); ?></td>
                        <td><?php echo number_format($elemento['precio'], 2); ?> COP</td>
                        <td><?php echo htmlspecialchars($elemento['garantia']); ?></td>
                        <td><?php echo htmlspecialchars($elemento['descripcion']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($elemento['imagen_url']); ?>" alt="<?php echo htmlspecialchars($elemento['nombre']); ?>" style="width: 50px;"></td>
                        <td>
                            <!-- Botón para Editar -->
                            <form action="admin_streaming_total.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $elemento['id']; ?>">
                                <input type="hidden" name="editar" value="1">
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <!-- Botón para Eliminar -->
                            <form action="admin_streaming_total.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $elemento['id']; ?>">
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
