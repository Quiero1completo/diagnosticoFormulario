<?php
require '../conexion.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id, nombre FROM public.monedas ORDER BY nombre");
    $monedas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($monedas);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'mensaje' => 'Error al obtener las monedas: ' . $e->getMessage()
    ]);
}
?>