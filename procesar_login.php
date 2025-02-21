<?php 
// Iniciar sesión al principio del archivo para usar sesiones
session_start();

// Conectar a la base de datos
$servername = "localhost";  // Ajusta estos datos a tu configuración
$username = "root";         // Ajusta el nombre de usuario
$password = "";             // Ajusta la contraseña
$dbname = "technologydra";  // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    // Si ya está logueado, redirigir al inicio
    header("Location: index.php");
    exit;
}

// Inicializar variable de error
$error_message = '';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        $error_message = "Todos los campos son obligatorios.";
    } else {
        // Buscar el usuario en la base de datos
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si el usuario existe
            if ($result->num_rows > 0) {
                // El usuario existe, ahora verificamos la contraseña
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['contrasena'])) {
                    // Contraseña correcta, iniciar sesión
                    $_SESSION['user_id'] = $user['id_usuario'];
                    $_SESSION['username'] = $user['nombre'];

                    // Redirigir al index o a una página de bienvenida
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

// Mostrar mensaje de error si existe
if ($error_message) {
    echo "<p style='color:red;'>$error_message</p>";
}

// Cerrar la conexión
$conn->close();
?>
