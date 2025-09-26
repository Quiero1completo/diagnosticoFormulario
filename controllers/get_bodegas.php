<?php
require '../conexion.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id, nombre FROM public.bodegas ORDER BY nombre");
    $bodegas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($bodegas);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'mensaje' => 'Error al obtener las bodegas: ' . $e->getMessage()
    ]);
}
?>