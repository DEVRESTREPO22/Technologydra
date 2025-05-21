<?php 
session_start();
include 'conexion.php';

$mensajeConexion = "Conexión exitosa a la base de datos 'technologydra'.";

function limpiar($conn, $campo) {
    return mysqli_real_escape_string($conn, trim($campo));
}

// Crear carpeta img si no existe
if (!is_dir('img')) {
    mkdir('img', 0777, true);
}

// AGREGAR PRODUCTO
if (isset($_POST['agregar'])) {
    $nombre = limpiar($conn, $_POST['nombre']);
    $descripcion = limpiar($conn, $_POST['descripcion']);
    $precio = limpiar($conn, str_replace('.', '', $_POST['precio']));
    $stock = (int) $_POST['stock'];
    $categoria_id = (int) $_POST['categoria_id'];

    // Subida de imagen
    $nombreImagen = '';
    if (!empty($_FILES['imagen']['name'])) {
        $nombreImagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaImagen = 'img/' . $nombreImagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
    }

    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, imagen) 
            VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$categoria_id', '$nombreImagen')";
    mysqli_query($conn, $sql);
}

// ACTUALIZAR PRODUCTO
// ACTUALIZAR PRODUCTO
if (isset($_POST['actualizar'])) {
    $id = (int) $_POST['id_producto'];
    $nombre = limpiar($conn, $_POST['nombre']);
    $descripcion = limpiar($conn, $_POST['descripcion']);
    $precio = limpiar($conn, str_replace('.', '', $_POST['precio']));
    $stock = (int) $_POST['stock'];
    $categoria_id = (int) $_POST['categoria_id'];

    // Obtener imagen actual
    $consultaImagen = mysqli_query($conn, "SELECT imagen FROM productos WHERE id_producto = $id");
    $imagenActual = '';
    if ($consultaImagen && mysqli_num_rows($consultaImagen) > 0) {
        $imagenActual = mysqli_fetch_assoc($consultaImagen)['imagen'];
    }

    // Subida nueva imagen (si se proporciona una nueva)
    $nombreImagen = $imagenActual;
    if (!empty($_FILES['imagen']['name'])) {
        $nombreImagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaImagen = 'img/' . $nombreImagen;

        // Opcional: eliminar imagen anterior si existía
        if (!empty($imagenActual) && file_exists('img/' . $imagenActual)) {
            unlink('img/' . $imagenActual);
        }

        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
    }

    $sql = "UPDATE productos 
            SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', categoria_id='$categoria_id', imagen='$nombreImagen'
            WHERE id_producto=$id";
    mysqli_query($conn, $sql);
}

// ELIMINAR PRODUCTO
if (isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];

    // Eliminar imagen del servidor
    $producto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT imagen FROM productos WHERE id_producto = $id"));
    if ($producto && !empty($producto['imagen']) && file_exists('img/' . $producto['imagen'])) {
        unlink('img/' . $producto['imagen']);
    }

    mysqli_query($conn, "DELETE FROM productos WHERE id_producto=$id");
}

// BUSCAR PRODUCTO
$filtro = "";
if (isset($_GET['buscar'])) {
    $buscar = limpiar($conn, $_GET['buscar']);
    $filtro = "WHERE p.nombre LIKE '%$buscar%'";
}

// RESULTADOS Y EDICIÓN
$resultado = mysqli_query($conn, "SELECT p.*, c.nombre AS nombre_categoria FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id_categoria $filtro");

if (isset($_GET['editar'])) {
    $id_editar = (int) $_GET['editar'];
    $editar_result = mysqli_query($conn, "SELECT * FROM productos WHERE id_producto = $id_editar");
    $producto_editar = mysqli_fetch_assoc($editar_result);
}

$categorias = mysqli_query($conn, "SELECT * FROM categorias");
?>

<!-- HTML igual que antes con campo de imagen agregado -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Inventario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #000; color: white; }
        header { display: flex; align-items: center; padding: 20px; }
        header img { height: 50px; margin-right: 10px; }
        h2 { color: #00e0ff; margin-bottom: 30px; font-weight: bold; }
        .form-control, .form-control:focus {
            background-color: #121212; color: white;
            border: 1px solid #00e0ff; box-shadow: none;
        }
        .form-control::placeholder { color: #b0b0b0; }
        .btn-success { background-color: #00e0ff; border: none; font-weight: bold; }
        .btn-success:hover { background-color: #00b8d4; }
        .btn-primary { background-color:rgb(255, 217, 0); border: none; font-weight: bold; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-danger { background-color: #dc3545; font-weight: bold; }
        .btn-danger:hover { background-color: #b02a37; }
        .table { background-color: #121212; color: white; }
        .table thead { background-color: #00e0ff; color: black; }
        .table tbody tr:hover { background-color: #222; }
        .form-inline .form-control { width: auto; margin-right: 10px; }
        .alert-success { background-color: #00e0ff; color: black; border: none; }
        .close { color: black; opacity: 1; }
        .logo-link {
            text-decoration: none; font-weight: bold;
            font-size: 24px; color: #00e0ff;
            display: flex; align-items: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="container py-5">

<a href="index.php" class="logo-link">
    <img src="img/logo2.png" alt="Logo TechnologyDRA">
</a>

<?php if (isset($mensajeConexion)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $mensajeConexion; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span>&times;</span></button>
    </div>
<?php endif; ?>

<h2>Gestor de Inventario</h2>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <input type="hidden" name="id_producto" value="<?php echo $producto_editar['id_producto'] ?? ''; ?>">
    <div class="form-row">
        <!-- tus campos anteriores -->
        <div class="form-group col-md-3">
            <input class="form-control" type="text" name="nombre" placeholder="Nombre" required value="<?php echo $producto_editar['nombre'] ?? ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <input class="form-control" type="text" name="descripcion" placeholder="Descripción" value="<?php echo $producto_editar['descripcion'] ?? ''; ?>">
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" type="text" name="precio" placeholder="Precio" required value="<?php echo isset($producto_editar['precio']) ? number_format($producto_editar['precio'], 0, '', '.') : ''; ?>">
        </div>
        <div class="form-group col-md-1">
            <input class="form-control" type="number" name="stock" placeholder="Stock" required value="<?php echo $producto_editar['stock'] ?? ''; ?>">
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="categoria_id" required>
                <option value="">Categoría</option>
                <?php while($cat = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?= $cat['id_categoria']; ?>" <?= (isset($producto_editar['categoria_id']) && $producto_editar['categoria_id'] == $cat['id_categoria']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['nombre']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group col-md-4 mt-2">
            <input class="form-control-file" type="file" name="imagen" accept="image/*">
            <?php if (!empty($producto_editar['imagen'])): ?>
                <small>Imagen actual:</small><br>
                <img src="img/<?php echo $producto_editar['imagen']; ?>" width="100" class="mt-1">
            <?php endif; ?>
        </div>
    </div>
    <button type="submit" name="agregar" class="btn btn-success" <?= isset($producto_editar) ? 'style="display:none;"' : ''; ?>>Agregar</button>
    <button type="submit" name="actualizar" class="btn btn-primary" <?= !isset($producto_editar) ? 'style="display:none;"' : ''; ?>>Actualizar</button>
</form>

<form method="GET" class="form-inline mb-3">
    <input class="form-control mr-2" type="text" name="buscar" placeholder="Buscar por nombre" value="<?= $_GET['buscar'] ?? ''; ?>">
    <button type="submit" class="btn btn-secondary btn-sm">Buscar</button>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td><?= $row['id_producto']; ?></td>
            <td>
                <?php if ($row['imagen']): ?>
                    <img src="img/<?= $row['imagen']; ?>" width="60">
                <?php else: ?>
                    <span>Sin imagen</span>
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['nombre']); ?></td>
            <td><?= htmlspecialchars($row['descripcion']); ?></td>
            <td>$<?= number_format((int)$row['precio'], 0, ',', '.'); ?></td>
            <td><?= $row['stock']; ?></td>
            <td><?= htmlspecialchars($row['nombre_categoria']); ?></td>
            <td>
                <a href="?editar=<?= $row['id_producto']; ?>" class="btn btn-primary btn-sm">Editar</a>
                <a href="?eliminar=<?= $row['id_producto']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
