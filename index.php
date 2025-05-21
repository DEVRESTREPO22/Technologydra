<?php
session_start(); // Iniciar la sesión

// Comprobar si el usuario está logueado
$usuarioLogueado = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technology DRA</title>

    <!-- FUENTE GOOGLE FONTS : Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ICONS: Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- ICONS: Line Awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Animaciones AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

    <!-- Mis Estilos -->
    <link rel="stylesheet" href="css/estilos.css">

</head>
<body>

    <div class="hm-wrapper">

        <!-- =================================
           HEADER MENU
        ================================== -->
        <div class="hm-header">
            <div class="container">
                <div class="header-menu">

                    <div class="hm-logo">
                        <a href="index.php">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>

                    <nav class="hm-menu">
                        <ul>
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="categorias.html">Categorias</a></li>
                            <li><a href="Productos.php">Productos</a></li>
                            <?php if ($usuarioLogueado): ?>
                                <li><a href="perfil.php"><?php echo $usuarioLogueado; ?></a></li> <!-- Nombre del usuario -->
                                <li><a href="logout.php">Cerrar sesión</a></li> <!-- Enlace para cerrar sesión -->
                            <?php else: ?>
                                <li><a href="login.html">Iniciar sesión</a></li>
                            <?php endif; ?>
                        </ul>

                        <div class="hm-icon-cart">
                            <a href="carrito.php">
                                <i class="las la-shopping-cart"></i>
                                <span>0</span>
                            </a>
                        </div>

                        <div class="icon-menu">
                            <button type="button"><i class="fas fa-bars"></i></button>
                        </div>

                    </nav>

                </div>
            </div>
        </div>

        <!-- =================================
           HEADER MENU Movil
        ================================== -->
        <div class="header-menu-movil">
            <button class="cerrar-menu"><i class="fas fa-times"></i></button>
            <ul>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Campañas</a></li>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Iniciar Seccion</a></li>
            </ul>
        </div>

        <!-- =================================
           BANNER
        ================================== -->
        <div class="hm-banner">
            <div class="img-banner">
                <img src="img/fondo.svg" alt="">
            </div>
            <a href=""></a>
        </div>

        <!-- =================================
           HOME CATEGORIAS
        ================================== -->
        <div class="hm-page-block">
            <div class="container">
                <div class="header-title">
                    <h1 data-aos="fade-up" data-aos-duration="3000">Categorías</h1>
                </div>

                <div class="hm-grid-category">

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="#">
                            <img src="img/pc.webp" alt="">
                            <div class="c-info">
                                <h3>Todo Gamer</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="1500">
                        <a href="#">
                            <img src="img/portatil.jpg" alt="">
                            <div class="c-info">
                                <h3>Todo en Portatiles</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="2000">
                        <a href="#">
                            <img src="img/accesorios.webp" alt="">
                            <div class="c-info">
                                <h3>Accesorios</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="2000">
                        <a href="#">
                            <img src="img/todo.webp" alt="">
                            <div class="c-info">
                                <h3>Otros</h3>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </div>


         <!-- =================================
           HOME PRODUCTOS DESTACADOS
        ================================== -->
        <div class="hm-page-block bg-fondo">

            <div class="container">

                <div class="header-title" data-aos="fade-up">
                    <h1>Productos populares</h1>
                </div>

                <!-- TABS -->
                <ul class="hm-tabs" data-aos="fade-up">
                    <li class="hm-tab-link">
                        Pc Gamer
                    </li>

                    <li class="hm-tab-link">
                        Pack Mause + Teclado
                    </li>

                    <li class="hm-tab-link">
                        Portatil
                    </li>

                    <li class="hm-tab-link active">
                        En oferta
                    </li>

                </ul>

                <!-- CONTENIDO DE LOS TABS -->
                <!-- Zapatillas -->
                <div class="tabs-content" data-aos="fade-up">
                    <div class="grid-product">

                        <!-- Aquí los productos destacados -->
                    </div>
                </div>

            </div>

        </div>

        <!-- =================================
           FOOTER
        ================================== -->
        <footer>
            <div class="container">
                <div class="foo-row">
                    <div class="foo-col">
                        <h2>Suscríbete <br>Mundo de Tecnologia</h2>
                        <form action="" method="GET">
                            <div class="f-input">
                                <input type="text" placeholder="Ingrese su correo">
                                <button type="submit" class="hm-btn-round btn-primary"><i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="foo-col">
                        <ul>
                           <li><a href="http://">Productos</a></li>
                           <li><a href="http://">Campañas</a></li>
                           <li><a href="http://">Nosotros</a></li>
                           <li><a href="http://">Contacto</a></li>
                           <li><a href="http://">Enlace 01</a></li>
                           <li><a href="http://">Enlace 02</a></li>
                           <li><a href="http://">Enlace 03</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <div class="foo-copy">
            <div class="container">
                <p>TECHNOLOGY DRA 2025 © Todos los derechos reservados</p>
            </div>
        </div>

    </div>

    <!-- Animaciones : AOS-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Mi Script -->
    <script src="js/app.js"></script>

    <script>
        AOS.init({
            duration: 1200,
        })
    </script>

</body>
</html>
