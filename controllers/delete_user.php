<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../includes/db.php";
if (!isset($_GET['id'])) {
    header("Location: ../views/dashboard.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../views/dashboard.php");
exit;
?>
