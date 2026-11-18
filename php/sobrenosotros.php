<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - PetCenter</title>
    
    <!-- Google Fonts para mantener una tipografía moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="../css/sobrenosotros.css">
        <link rel="stylesheet" href="../css/estil.css">
</head>
<body>
     <!-- Es lo de hasta arriba donde podemos poner anuncios y asi -->
    <div class="top-bar">
        <span>🚚 Envío gratis en compras mayores a $500 | 10% de descuento en tu primera compra con el código: <strong>PETNEW</strong></span>
    </div>

    <!-- Donde va el logo de la pagina y el nombre -->
    <header class="site-header">
        <div class="header-container">
            <a href="../Lay-Proy.php" class="logo-container">
                <span class="logo-icon">🐾</span>
                <span class="site-title">PetCenter</span>
            </a>

            <!-- Codigo del buscador -->
            <div class="search-container">
                <form action="busquedas.php" method="GET" class="search-form">
                    <input type="text" name="busqueda" id="input-busqueda" placeholder="Buscar alimentos, ropa, juguetes..." autocomplete="off" required>
                    <button type="button" id="btn-limpiar" class="btn-clear">&times;</button>
                    <button type="submit" class="btn-search">🔍</button>
                </form>
                
                <div id="box-sugerencias" class="sugerencias-box hidden">
                    <div class="sugerencias-header">SUGERENCIAS</div>
                    <ul id="lista-sugerencias"></ul>
                </div>
            </div>

            <!-- Aqui va lo que el usuario puede hacer dentro de la pagina -->
            <div class="header-actions">
                <a href="Sesion.php" class="action-btn">
                    <span class="icon">👤</span>
                    <span class="label">Mi Cuenta</span>
                </a>
                <a href="contacto2.php" class="action-btn">
                    <span class="icon">📞</span>
                    <span class="label">Ayuda</span>
                </a>
                <a href="ver_carrito.php" class="action-btn cart-btn">
                    <span class="icon">🛒</span>
                    <span id="num_cart" class="cart-badge"><?php echo array_sum($_SESSION['carrito'] ?? []); ?></span>
                </a>
            </div>
        </div>

        <!-- El menu de opciones como la anterior pagina de accesorios etc -->
        <nav class="main-nav">
            <ul>
                <li><a href="../Lay-Proy.php" class="active">Inicio</a></li>
                <li><a href="perros.php">Perros</a></li>
                <li><a href="gatos.php">Gatos</a></li>
                <li><a href="peces.php">Peces</a></li>
                <li><a href="aves.php">Aves</a></li>
                <li><a href="#ofertas" class="nav-highlight">Ofertas 🏷️</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <!-- Banner Principal -->
        <section class="hero-section">
            <h1>Sobre PetCenter</h1>
            <p>Apasionados por brindar el bienestar, amor y cuidado que tus mascotas merecen.</p>
        </section>

        <!-- Historia / Quiénes Somos -->
        <section class="about-grid">
            <div class="about-text">
                <h2>¿Quiénes Somos?</h2>
                <p>
                    En <strong>PetCenter</strong> entendemos que las mascotas son un miembro indispensable de la familia. Desde nuestros inicios, nos hemos dedicado a seleccionar meticulosamente los mejores alimentos, accesorios, ropa y juguetes para perros, gatos, peces y aves.
                </p>
                <p>
                    Nuestro objetivo es facilitar la vida de los dueños de mascotas ofreciendo productos de la más alta calidad a precios accesibles, con la comodidad de envíos rápidos y seguros directamente hasta la puerta de tu hogar.
                </p>
            </div>
            <div class="about-image">
                <img src="../img/img_menuprincipal/sobrenosotros.jpeg" alt="Mascotas felices en PetCenter">
            </div>
        </section>

        <!-- Tarjetas: Misión, Visión y Valores -->
        <section class="cards-section">
            <div class="card">
                <div class="icon">
                    <i class="fas fa-paw"></i>
                </div>
                <h3>Nuestra Misión</h3>
                <p>Ofrecer la mejor variedad de productos y suministros para mascotas, garantizando calidad, excelente atención al cliente y comodidad en cada compra.</p>
            </div>

            <div class="card">
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Nuestra Visión</h3>
                <p>Convertirnos en la tienda de mascotas en línea líder y de mayor confianza, reconocida por nuestro compromiso con el bienestar animal y la satisfacción de nuestra comunidad.</p>
            </div>

            <div class="card">
                <div class="icon">
                    <i class="fas fa-shield-cat"></i>
                </div>
                <h3>Nuestros Valores</h3>
                <p>Amor por los animales, honestidad, rapidez en el servicio y constante innovación en nuestro catálogo para consentir a tus consentidos.</p>
            </div>
        </section>

        <!-- Banner de Compromiso -->
        <section class="commitment-banner">
            <h3>Nuestro Compromiso contigo</h3>
            <p>Trabajamos día a día para que encuentres todo lo necesario para tu perro, gato, ave o pez en un solo lugar. ¡Gracias por confiar en <strong>PetCenter</strong> como tu aliado en el cuidado de tu mascota!</p>
        </section>
    </div>

     <!-- ESTE CODIGO ES DEL PIE DE PAGINA xd -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-col">
                <div class="logo-container">
                    <span class="logo-icon">🐾</span>
                    <span class="site-title">PetCenter</span>
                </div>
                <p>Tu tienda de confianza para el cuidado, estilo y bienestar de tus mascotas.</p>
            </div>
            <div class="footer-col">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="sobrenosotros.php">Sobre Nosotros</a></li>
                    <li><a href="preguntas.php">Preguntas Frecuentes</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Atención al Cliente</h4>
                <ul>
                    <li><a href="contactanos.php">Contacto</a></li>
                    <li><a href="#">Seguimiento de Pedido</a></li>
                    <li><a href="#">Envíos y Entregas</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 PetCenter Store. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
