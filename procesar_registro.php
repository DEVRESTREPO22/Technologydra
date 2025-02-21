<?php
// Incluir archivo de configuración de la base de datos
include('conexion.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $firstName = $_POST['firstName'];    // Nombre
    $lastName = $_POST['lastName'];      // Apellido
    $email = $_POST['email'];            // Correo Electrónico
    $password = $_POST['password'];      // Contraseña
    $birthdate = $_POST['birthdate'];    // Fecha de Nacimiento

    // Validar que el correo no esté registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el correo ya está registrado, redirigir al formulario de registro con un mensaje
        echo "<script>alert('El correo electrónico ya está registrado');</script>";
        echo "<script>window.location.href = 'registro.html';</script>";
        exit;
    }

    // Hashear la contraseña antes de insertarla en la base de datos
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Comenzar una transacción
    $conn->begin_transaction();

    try {
        // Insertar en la tabla 'usuarios'
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $firstName, $email, $hashedPassword);
        $stmt->execute();

        // Obtener el ID del usuario insertado
        $userId = $stmt->insert_id;

        // Insertar en la tabla 'registro' con los nuevos campos
        $stmt = $conn->prepare("INSERT INTO registro (id_usuario, nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $firstName, $lastName, $birthdate);
        $stmt->execute();

        // Commit de la transacción
        $conn->commit();

        echo "<script>alert('Registro exitoso');</script>";
        echo "<script>window.location.href = 'login.html';</script>";

    } catch (Exception $e) {
        // Si hay algún error, hacer rollback de la transacción
        $conn->rollback();
        echo "<script>alert('Error al registrar el usuario: " . $e->getMessage() . "');</script>";
    }

    // Cerrar la conexión y las consultas
    $stmt->close();
    $conn->close();
}
?>
