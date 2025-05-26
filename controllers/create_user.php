<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../includes/db.php";
$edit_id = $_POST['edit_id'] ?? '';
$identifier = $_POST['identifier'] ?? '';
$host = $_POST['host'] ?? '';
$port = $_POST['port'] ?? '';
$macaroon = $_POST['macaroon'] ?? '';

if ($edit_id) {
    // Actualizar
    $stmt = $conn->prepare("UPDATE users SET identifier=?, host=?, port=?, macaroon=? WHERE id=?");
    $stmt->execute([$identifier, $host, $port, $macaroon, $edit_id]);
} else {
    // Insertar nuevo
    $stmt = $conn->prepare("INSERT INTO users (identifier, host, port, macaroon) VALUES (?, ?, ?, ?)");
    $stmt->execute([$identifier, $host, $port, $macaroon]);
}

header("Location: ../views/dashboard.php");
exit;
?>
