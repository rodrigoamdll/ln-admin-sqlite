<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !isset($_SESSION['error_user_exists'])) {
    header("Location: dashboard.php");
    exit;
}

// Limpiar la variable de sesión para que no se repita el error al recargar
unset($_SESSION['error_user_exists']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error - Usuario Existente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0c24c0;
            color: #1d1d3c;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #f5f4ef;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }

        .error-image {
            width: 100px;
            height: auto;
            margin-bottom: 1rem;
        }

        .btn-orange {
            background-color: #f19524;
            border: none;
            color: white;
        }

        .btn-orange:hover {
            background-color: #d17f1b;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="../assets/img/error.png" alt="Error" class="error-image mx-auto">
        <h3>¡Error al registrar usuario!</h3>
        <p>Ya existe un usuario con ese identificador. Intenta con otro número de lista.</p>
        <a href="dashboard.php" class="btn btn-orange mt-3">Volver al panel</a>
    </div>
</body>
</html>
