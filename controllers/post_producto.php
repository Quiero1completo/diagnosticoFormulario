<?php
require '../conexion.php';

header('Content-Type: application/json');
$response = ['success' => false, 'message' => 'Error: La solicitud debe ser de tipo POST.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $codigo = trim($_POST['codigo'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $bodega_id = (int)($_POST['bodega'] ?? 0);
        $sucursal_id = (int)($_POST['sucursal'] ?? 0);
        $moneda_id = (int)($_POST['moneda'] ?? 0);
        $precio = (float)($_POST['precio'] ?? 0.0);
        $descripcion = trim($_POST['descripcion'] ?? '');

        $materiales = '';
        if (isset($_POST['material'])) {
            if (is_array($_POST['material'])) {
                $materiales = implode(', ', $_POST['material']);
            } else {
                $materiales = trim($_POST['material']); 
            }
        }

        if (empty($codigo) || empty($nombre) || $bodega_id === 0 || $moneda_id === 0) {
            $response['message'] = 'Error: Faltan campos requeridos (Código, Nombre, Bodega, Moneda).';
            echo json_encode($response);
            exit;
        }

        $stmt = $pdo->prepare("SELECT id FROM public.productos WHERE codigo_producto = ?");
        $stmt->execute([$codigo]);
        
        if ($stmt->fetch()) {
            $response['message'] = 'El código del producto ya existe. Ingrese uno diferente.';
        } else {
            $sql = "INSERT INTO public.productos (codigo_producto, nombre_producto, bodega_id, sucursal_id, moneda_id, precio, materiales, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$codigo, $nombre, $bodega_id, $sucursal_id, $moneda_id, $precio, $materiales, $descripcion]);

            $response['success'] = true;
            $response['message'] = 'Producto guardado exitosamente.';
        }
    } catch (PDOException $e) {
        http_response_code(500);
        $response['message'] = 'Error de base de datos: ' . $e->getMessage();
    }
}

echo json_encode($response);
?>