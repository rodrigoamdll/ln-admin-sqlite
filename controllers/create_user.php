<?php
session_start();

// Verifica que el usuario esté autenticado como administrador
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../includes/db.php";

// Captura los datos del formulario
$edit_id    = $_POST['edit_id'] ?? '';
$identifier = $_POST['identifier'] ?? '';
$host       = $_POST['host'] ?? '';
$port       = $_POST['port'] ?? '';
$macaroon   = $_POST['macaroon'] ?? '';

try {
    if ($edit_id) {
        // Actualizar usuario existente
        $stmt = $conn->prepare("UPDATE users SET identifier = ?, host = ?, port = ?, macaroon = ? WHERE id = ?");
        $stmt->execute([$identifier, $host, $port, $macaroon, $edit_id]);
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO users (identifier, host, port, macaroon) VALUES (?, ?, ?, ?)");
        $stmt->execute([$identifier, $host, $port, $macaroon]);
    }

    // Redirige al dashboard si todo salió bien
    header("Location: ../views/dashboard.php");
    exit;

} catch (PDOException $e) {
    // Si el error es por clave duplicada (identificador existente)
    if ($e->getCode() === "23000") {
        $_SESSION['error_user_exists'] = true;
        header("Location: ../views/error_user_exists.php");
        exit;
    } else {
        // Otros errores de base de datos
        die("Error de base de datos: " . $e->getMessage());
    }
}
?>
