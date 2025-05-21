<?php
session_start();
include 'conexion.php'; // Asegúrate de tener tu archivo de conexión correctamente configurado
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo3.css">
    <style>
        #modal-carrito, #modal-carrito * {
            color: #000 !important;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 15px;
        }
        
    </style>
</head>
<body>
<header class="d-flex justify-content-between align-items-center p-3 bg-dark text-white">
    <div class="logo">
        <a href="index.php" class="text-decoration-none">
            <img src="img/logo2.png" alt="Logo de Tienda" height="50">
        </a>
    </div>

    <div class="d-flex align-items-center">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info text-white">
                <strong>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></strong>

                <?php if (isset($_SESSION['correo']) && $_SESSION['correo'] === 'restrepoa09072@gmail.com'): ?>
                    <a href="crud_inventario.php" class="btn btn-warning btn-sm">Gestor de Inventario</a>
                <?php endif; ?>

                <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
            </div>
        <?php else: ?>
            <a href="login.html">
                <button id="login-btn" class="btn btn-danger">Iniciar Sesión</button>
            </a>
        <?php endif; ?>

        <div class="las la-shopping-cart ms-3" style="position: relative;">
            <i id="carrito-icono" class="bi bi-cart-fill" style="font-size: 1.5rem; color: #04e8ff; cursor: pointer;"></i>
            <span id="contador-carrito" style="position: absolute; top: -8px; right: -8px; background: red; color: white; border-radius: 50%; padding: 0px 6px; font-size: 12px;">0</span>
        </div>
    </div>
</header>

<!-- Modal del carrito -->
<div id="modal-carrito" style="display:none; position:fixed; top:10%; right:10px; width:320px; background:#fff; border:1px solid #ccc; padding:15px; box-shadow:0 2px 10px rgba(0,0,0,0.2); z-index:9999; border-radius:8px;">
    <h5>Carrito de Compras</h5>
    <div id="contenido-carrito" style="max-height: 300px; overflow-y: auto;"></div>
    <div class="mt-2 text-end">
        <a href="carrito.php" class="btn btn-sm btn-primary">Ver Carrito</a>
    </div>
</div>

<!-- Catálogo -->
<section class="catalog">
    <?php
    $sql = "SELECT * FROM productos";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0):
        while ($producto = $resultado->fetch_assoc()):
    ?>
    <div class="product">
        <img src="img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
        <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
        <span class="price">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></span>
        <form class="form-agregar-carrito" method="post">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
            <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
            <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion']); ?>">
            <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
            <button type="submit" class="btn btn-sm btn-success mt-2">
                <i class="bi bi-cart-plus-fill"></i> Agregar al carrito
            </button>
        </form>
    </div>
    <?php
        endwhile;
    else:
        echo "<p class='text-center'>No hay productos disponibles en este momento.</p>";
    endif;
    ?>
</section>

<!-- Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".form-agregar-carrito");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const datos = new FormData(form);
            fetch("agregar_carrito.php", {
                method: "POST",
                body: datos
            }).then(() => {
                actualizarCarrito();
                document.getElementById("modal-carrito").style.display = "block";
            });
        });
    });

    document.getElementById("carrito-icono").addEventListener("click", function () {
        const modal = document.getElementById("modal-carrito");
        if (modal.style.display === "none" || modal.style.display === "") {
            actualizarCarrito();
            modal.style.display = "block";
        } else {
            modal.style.display = "none";
        }
    });

    function actualizarCarrito() {
        fetch("carrito.php?modal=true")
            .then(res => res.text())
            .then(html => {
                document.getElementById("contenido-carrito").innerHTML = html;
                const count = (html.match(/class="producto-en-carrito"/g) || []).length;
                document.getElementById("contador-carrito").textContent = count;

                document.querySelectorAll(".cantidad-input").forEach(input => {
                    input.addEventListener("change", function () {
                        const index = this.dataset.index;
                        const cantidad = this.value;
                        fetch("editar_carrito.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                            body: `index=${index}&cantidad=${cantidad}`
                        }).then(() => actualizarCarrito());
                    });
                });

                document.querySelectorAll(".eliminar-btn").forEach(btn => {
                    btn.addEventListener("click", function () {
                        const index = this.dataset.index;
                        fetch("eliminar_carrito.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                            body: `index=${index}`
                        }).then(() => actualizarCarrito());
                    });
                });
            });
    }

    actualizarCarrito();
});
</script>
</body>
</html>
