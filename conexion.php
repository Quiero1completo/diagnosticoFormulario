<?php

$config = parse_ini_file(__DIR__ . '/.env');


$host = $config['DB_HOST'];
$port = $config['DB_PORT'];
$dbname = $config['DB_DATABASE'];
$user = $config['DB_USER'];
$password = $config['DB_PASSWORD'];

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'mensaje' => 'Error de conexión a la base de datos: ' . $e->getMessage()
    ]);
    exit();
}