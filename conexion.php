<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // Nombre del servidor (usualmente localhost)
$username = "root";         // Nombre de usuario de la base de datos (por lo general "root")
$password = "";             // Contraseña de la base de datos (si no hay, dejarlo vacío)
$dbname = "technologydra";  // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos 'technologydra'.";
}
?>
