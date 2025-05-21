<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$nombre = $_POST['nombre'] ?? '';
$precio = $_POST['precio'] ?? 0;
$descripcion = $_POST['descripcion'] ?? '';
$imagen = $_POST['imagen'] ?? '';
$encontrado = false;

// Buscar si ya está en el carrito
foreach ($_SESSION['carrito'] as &$producto) {
    if ($producto['nombre'] === $nombre) {
        $producto['cantidad']++;
        $encontrado = true;
        break;
    }
}

if (!$encontrado) {
    $_SESSION['carrito'][] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => 1,
        'descripcion' => $descripcion,
        'imagen' => $imagen
    ];
}

// Opcionalmente puedes devolver una respuesta JSON si el JS la necesita
echo json_encode(['status' => 'ok']);
exit;
?>
