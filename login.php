<?php
// login.php
session_start();
include 'conexion.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    
    $query = "SELECT * FROM Administradores WHERE email = '$email'";
    $resultado = $conexion->query($query);
    
    if ($resultado->num_rows == 1) {
        $admin = $resultado->fetch_assoc();
        
        // Verifica la contraseña
        if (password_verify($contrasena, $admin['contrasena'])) {
            $_SESSION['nombre_usuario'] = $admin['nombre_usuario'];
            $_SESSION['rol'] = $admin['rol'];
            
            echo "Redireccionando..."; // Mensaje de depuración
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 bg-light" style="width: 100%; max-width: 400px;">
        <h2 class="text-center">Iniciar Sesión</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
        <div class="mt-3 text-center">
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
