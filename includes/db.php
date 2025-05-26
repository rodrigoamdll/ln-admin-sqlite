<?php
try {
    $db_path = dirname(__DIR__) . "/lightning.db"; 
    $conn = new PDO("sqlite:" . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        identifier TEXT UNIQUE,
        host TEXT,
        port INTEGER,
        macaroon TEXT
    )");
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
