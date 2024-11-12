<?php
session_start();
include 'conexion.php';
include 'nav.php';

// Verificar si el usuario es superadmin
if (!isset($_SESSION['nombre_usuario']) || $_SESSION['rol'] != 'superadmin') {
    header("Location: login.php");
    exit();
}

// Variables para mensajes de éxito o error
$error = '';
$exito = '';
$editarUsuario = null;

// Crear Usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $query = "INSERT INTO Administradores (nombre_usuario, email, contrasena, rol) VALUES ('$nombre_usuario', '$email', '$contrasena', '$rol')";
    if ($conexion->query($query) === TRUE) {
        $exito = "Usuario creado exitosamente.";
    } else {
        $error = "Error al crear el usuario: " . $conexion->error;
    }
}

// Cargar datos del usuario en edición
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $resultado = $conexion->query("SELECT * FROM Administradores WHERE id=$id");
    $editarUsuario = $resultado->fetch_assoc();
}

// Actualizar Usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $query = "UPDATE Administradores SET nombre_usuario='$nombre_usuario', email='$email', rol='$rol' WHERE id=$id";

    // Si se proporciona una nueva contraseña
    if (!empty($_POST['contrasena'])) {
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        $query = "UPDATE Administradores SET nombre_usuario='$nombre_usuario', email='$email', contrasena='$contrasena', rol='$rol' WHERE id=$id";
    }

    if ($conexion->query($query) === TRUE) {
        $exito = "Usuario actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el usuario: " . $conexion->error;
    }
}

// Eliminar Usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM Administradores WHERE id=$id";
    if ($conexion->query($query) === TRUE) {
        $exito = "Usuario eliminado exitosamente.";
    } else {
        $error = "Error al eliminar el usuario: " . $conexion->error;
    }
}

// Obtener todos los usuarios
$usuarios = $conexion->query("SELECT * FROM Administradores");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Gestión de Usuarios</h1>

        <?php if ($exito): ?>
            <div class="alert alert-success"><?php echo $exito; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario para Crear o Editar un Usuario -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?php echo $editarUsuario ? 'Editar Usuario' : 'Agregar Nuevo Usuario'; ?></h5>
                <form action="admin_usuarios.php" method="POST">
                    <input type="hidden" name="<?php echo $editarUsuario ? 'actualizar' : 'crear'; ?>" value="1">
                    <?php if ($editarUsuario): ?>
                        <input type="hidden" name="id" value="<?php echo $editarUsuario['id']; ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required value="<?php echo $editarUsuario['nombre_usuario'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required value="<?php echo $editarUsuario['email'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" id="contrasena" class="form-control" <?php echo $editarUsuario ? '' : 'required'; ?>>
                        <?php if ($editarUsuario): ?>
                            <small>Dejar en blanco si no desea cambiar la contraseña</small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select name="rol" id="rol" class="form-control" required>
                            <option value="admin" <?php echo (isset($editarUsuario) && $editarUsuario['rol'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="superadmin" <?php echo (isset($editarUsuario) && $editarUsuario['rol'] == 'superadmin') ? 'selected' : ''; ?>>Superadmin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $editarUsuario ? 'Actualizar Usuario' : 'Crear Usuario'; ?></button>
                </form>
            </div>
        </div>

        <!-- Tabla de Usuarios Existentes -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['fecha_registro']); ?></td>
                        <td>
                            <!-- Botón para Editar -->
                            <form action="admin_usuarios.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                <input type="hidden" name="editar" value="1">
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <!-- Botón para Eliminar -->
                            <form action="admin_usuarios.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
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
