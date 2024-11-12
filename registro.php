<?php
// registro.php
session_start();
include 'conexion.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];
    
    // Registrar nuevo usuario
    $query = "INSERT INTO Administradores (nombre_usuario, email, contrasena, rol) 
              VALUES ('$nombre_usuario', '$email', '$contrasena', '$rol')";
    
    if ($conexion->query($query) === TRUE) {
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['rol'] = $rol;
        
        echo "Redireccionando al dashboard..."; // Mensaje de depuración
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error al registrar el usuario: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center">Registrar Administrador</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" id="rol" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Superadmin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>
</body>
</html>
