<?php
session_start();

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: ../views/dashboard.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    //Aca pueden cambiar las credenciales
    if ($user === "admin" && $pass === "nodenation2025") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ../views/dashboard.php");
        exit;
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            position: relative;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0c24c0;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: -60%;
            left: -60%;
            width: 220%;
            height: 220%;
            background-image: url('../assets/img/flash.png');
            background-repeat: repeat;
            background-size: 70px 70px;
            transform: rotate(45deg);
            opacity: 0.15;
            pointer-events: none;
            z-index: -1;
        }

        .login-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .login-container img {
            width: 100px;
            margin-bottom: 1rem;
        }

        .brand-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1d1d3c;
        }

        .brand-subtitle {
            font-size: 1rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .form-label {
            text-align: left;
            color: #1d1d3c;
            font-weight: 500;
        }

        .btn-login {
            background-color: #f19524;
            color: white;
            border: none;
        }

        .btn-login:hover {
            background-color: #e58c1f;
        }

        .alert {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="../assets/img/logo.jpg" alt="Logo">
        <div class="brand-title">Node Nation</div>
        <div class="brand-subtitle">Acceso de Administrador</div>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3 text-start">
                <label class="form-label">Usuario</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3 text-start position-relative">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control pr-5" required>
                <span class="toggle-password" onclick="togglePassword()"
                    style="position:absolute; top:38px; right:15px; cursor:pointer;">
                    <i class="fa-solid fa-eye-slash" id="eye-icon"></i>
                </span>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-login">Iniciar sesión</button>
            </div>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("eye-icon");
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }
    </script>
</body>
</html>
