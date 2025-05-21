<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // Nombre del servidor (usualmente localhost)
$username = "root";         // Usuario por defecto en XAMPP
$password = "";             // Contraseña (por defecto vacía en XAMPP)
$dbname = "technologydra";  // Nombre de la base de datos que vas a usar

// Crear la conexión usando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si ocurrió un error en la conexión
if ($conn->connect_error) {
    // En caso de error, detener el script y mostrar el error
    die("La conexión falló: " . $conn->connect_error);
}
?>
