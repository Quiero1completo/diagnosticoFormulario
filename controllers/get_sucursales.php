<?php
require '../conexion.php';

header('Content-Type: application/json');

$bodega_id = isset($_GET['bodega_id']) ? (int)$_GET['bodega_id'] : 0;

if ($bodega_id <= 0) {
    echo json_encode([]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, nombre FROM public.sucursales WHERE bodega_id = ? ORDER BY nombre");
    $stmt->execute([$bodega_id]);
    $sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sucursales);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'mensaje' => 'Error al obtener las sucursales: ' . $e->getMessage()
    ]);
}
?>