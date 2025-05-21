<?php 
session_start();

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "technologydra";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Inicializar variable de error
$error_message = '';

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($email) || empty($password)) {
        $error_message = "Todos los campos son obligatorios.";
    } else {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['contrasena'])) {
                    $_SESSION['user_id'] = $user['id_usuario'];
                    $_SESSION['username'] = $user['nombre'];
                    $_SESSION['correo'] = $user['email']; // ✅ Agregado aquí

                    header("Location: index.php");
                    exit;
                } else {
                    $error_message = "Contraseña incorrecta.";
                }
            } else {
                $error_message = "El usuario no existe.";
            }
        } else {
            $error_message = "Error al preparar la consulta.";
        }
    }
}

