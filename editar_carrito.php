<?php
session_start();

if (isset($_POST['index'], $_POST['cantidad'])) {
    $index = $_POST['index'];
    $cantidad = max(1, intval($_POST['cantidad'])); // mínimo 1

    if (isset($_SESSION['carrito'][$index])) {
        $_SESSION['carrito'][$index]['cantidad'] = $cantidad;
    }
}
?>
