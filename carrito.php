<?php
session_start();

$esModal = isset($_GET['modal']) && $_GET['modal'] === 'true';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (!$esModal):
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/estilo3.css">
</head>
<body>
<header>
    <div class="logo">
        <a href="index.php" class="text-decoration-none">
            <img src="img/logo2.png" alt="Logo de Tienda" height="50">
        </a>
    </div>
    <h2 style="margin-left: 20px;">Carrito de Compras</h2>
</header>
<main style="padding: 20px;">
<?php endif; ?>

<?php if (empty($_SESSION['carrito'])): ?>
    <p>No hay productos en el carrito.</p>
<?php else: ?>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #04e8ff;">
                <th style="padding: 10px;">Imagen</th>
                <th style="padding: 10px;">Producto</th>
                <th style="padding: 10px;">Descripción</th>
                <th style="padding: 10px;">Precio</th>
                <th style="padding: 10px;">Cantidad</th>
                <th style="padding: 10px;">Total</th>
                <th style="padding: 10px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalCarrito = 0;
            foreach ($_SESSION['carrito'] as $index => $item):
                $totalProducto = $item['precio'] * $item['cantidad'];
                $totalCarrito += $totalProducto;
            ?>
            <tr class="producto-en-carrito">
                <td style="padding: 10px;">
                    <?php
                    if (!empty($item['imagen'])):
                        $rutaImagen = 'img/' . basename($item['imagen']);
                        if (file_exists($rutaImagen)): ?>
                            <img src="<?php echo $rutaImagen; ?>" alt="Producto" style="width: 60px; height: 60px; object-fit: cover;">
                        <?php else: ?>
                            <span>Sin imagen</span>
                        <?php endif;
                    endif;
                    ?>
                </td>
                <td style="padding: 10px;"><?php echo htmlspecialchars($item['nombre']); ?></td>
                <td style="padding: 10px;"><?php echo htmlspecialchars($item['descripcion'] ?? ''); ?></td>
                <td style="padding: 10px;">$<?php echo number_format($item['precio'], 0, ',', '.'); ?></td>
                <td style="padding: 10px;">
                    <input type="number" min="1" value="<?php echo $item['cantidad']; ?>" data-index="<?php echo $index; ?>" class="cantidad-input" style="width: 60px;">
                </td>
                <td style="padding: 10px;">$<?php echo number_format($totalProducto, 0, ',', '.'); ?></td>
                <td style="padding: 10px;">
                    <button class="eliminar-btn" data-index="<?php echo $index; ?>" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Eliminar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p style="text-align: right; font-weight: bold; margin-top: 15px;">Total: $<?php echo number_format($totalCarrito, 0, ',', '.'); ?></p>
<?php endif; ?>

<?php if (!$esModal): ?>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".cantidad-input").forEach(input => {
            input.addEventListener("change", function () {
                const index = this.dataset.index;
                const cantidad = this.value;
                fetch("editar_carrito.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `index=${index}&cantidad=${cantidad}`
                }).then(() => location.reload());
            });
        });

        document.querySelectorAll(".eliminar-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                const index = this.dataset.index;
                fetch("eliminar_carrito.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `index=${index}`
                }).then(() => location.reload());
            });
        });
    });
</script>
</body>
</html>
<?php else: ?>
<script>
    function recargarModalCarrito() {
        fetch("carrito.php?modal=true")
            .then(res => res.text())
            .then(html => {
                const contenedor = document.getElementById("contenido-carrito");
                contenedor.innerHTML = html;
                asignarEventosModal();
            });
    }

    function asignarEventosModal() {
        document.querySelectorAll(".cantidad-input").forEach(input => {
            input.addEventListener("change", function () {
                const index = this.dataset.index;
                const cantidad = this.value;
                fetch("editar_carrito.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `index=${index}&cantidad=${cantidad}`
                }).then(() => recargarModalCarrito());
            });
        });

        document.querySelectorAll(".eliminar-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                const index = this.dataset.index;
                fetch("eliminar_carrito.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `index=${index}`
                }).then(() => recargarModalCarrito());
            });
        });
    }

    asignarEventosModal();
</script>
<?php endif; ?>
