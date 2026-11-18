<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Suma la cantidad total de artículos guardados en la sesión del carrito
$total_carrito = !empty($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCenter - Tienda de Accesorios para Mascotas</title>   
    <link rel="stylesheet" href="css/estil.css">
    <link rel="stylesheet" href="css/estiloscarrusel.css">
</head>
<body>

    <!-- Es lo de hasta arriba donde podemos poner anuncios y asi -->
    <div class="top-bar">
        <span>🚚 Envío gratis en compras mayores a $500 | 10% de descuento en tu primera compra con el código: <strong>PETNEW</strong></span>
    </div>

    <!-- Donde va el logo de la pagina y el nombre -->
    <header class="site-header">
        <div class="header-container">
            <a href="Lay-Proy.php" class="logo-container">
                <span class="logo-icon">🐾</span>
                <span class="site-title">PetCenter</span>
            </a>

            <!-- Codigo del buscador -->
            <div class="search-container">
                <form action="php/busquedas.php" method="GET" class="search-form">
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
                <a href="php/Sesion.php" class="action-btn">
                    <span class="icon">👤</span>
                    <span class="label">Mi Cuenta</span>
                </a>
                <a href="php/contacto2.php" class="action-btn">
                    <span class="icon">📞</span>
                    <span class="label">Ayuda</span>
                </a>
                <a href="php/ver_carrito.php" class="action-btn cart-btn">
                    <span class="icon">🛒</span>
                    <span id="num_cart" class="cart-badge"><?php echo array_sum($_SESSION['carrito'] ?? []); ?></span>
                </a>
            </div>
        </div>

        <!-- El menu de opciones como la anterior pagina de accesorios etc -->
        <nav class="main-nav">
            <ul>
                <li><a href="Lay-Proy.php" class="active">Inicio</a></li>
                <li><a href="php/perros.php">Perros</a></li>
                <li><a href="php/gatos.php">Gatos</a></li>
                <li><a href="php/peces.php">Peces</a></li>
                <li><a href="php/aves.php">Aves</a></li>
                <li><a href="#ofertas" class="nav-highlight">Ofertas 🏷️</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido Principal -->
    <main class="site-main">
        
        <!-- La seccion de como de anuncios xd -->
        <!-- Seccion del Slider de Anuncios -->
<section class="hero-slider">
    <div class="slider-container">
        
        <!-- Diapositiva 1 -->
        <div class="slide active">
            <img src="img/img_menuprincipal/todoperro.jpeg" alt="Anuncio 1">
            <div class="slide-content">
                <span class="badge">Nuevos Productos</span>
                <h2>Lo mejor para tu mejor amigo</h2>
                <p>Descubre nuestra colección exclusiva de accesorios, ropa de alta calidad y nutrición premium.</p>
                <a href="#productos" class="btn-primary">Ver Catálogo</a>
            </div>
        </div>

        <!-- Diapositiva 2 -->
        <div class="slide">
            <img src="img/img_menuprincipal/ropaperro.jpeg" alt="Anuncio 2">
            <div class="slide-content">
                <span class="badge">Oferta Especial</span>
                <h2>20% de Descuento en Ropa</h2>
                <p>Prepara a tu mascota para el frío con nuestras chamarras deportivas térmicas.</p>
                <a href="#productos" class="btn-primary">Ver Ofertas</a>
            </div>
        </div>

        <!-- Diapositiva 3 -->
        <div class="slide">
            <img src="img/img_menuprincipal/ropaperro2.jpeg" alt="Anuncio 3">
            <div class="slide-content">
                <span class="badge">Envío Gratis</span>
                <h2>En compras mayores a $500</h2>
                <p>Aprovecha nuestras promociones exclusivas en accesorios para perro y gato esta semana.</p>
                <a href="php/busquedas.php?busqueda=perro" class="btn-primary">Explorar Tienda</a>
            </div>
        </div>

        <!-- Botones de Navegación -->
        <button class="slider-btn prev-btn" id="prevSlide" aria-label="Anterior">&#10094;</button>
        <button class="slider-btn next-btn" id="nextSlide" aria-label="Siguiente">&#10095;</button>

        <!-- Indicadores (Puntos) -->
        <div class="slider-dots">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
        </div>

    </div>
</section>

        <!-- Aqui van a ir las secciones de las tipos de mascotas -->
        <section class="section-container">
    <h3 class="section-title">Comprar por Categoría</h3>
    <div class="categories-grid">
        
        <!-- Categoría Perros (puedes crear un perros.php o dejarlo hacia busquedas) -->
        <a href="php/perros.php" class="category-link">
            <div class="category-card">
                <span class="cat-icon">🐶</span>
                <h4>Perros</h4>
            </div>
        </a>

        <!-- Categoría Gatos (Conectado a la nueva página que creamos) -->
        <a href="php/gatos.php" class="category-link">
            <div class="category-card">
                <span class="cat-icon">🐱</span>
                <h4>Gatos</h4>
            </div>
        </a>

        <!-- Categoría Peces -->
        <a href="php/peces.php" class="category-link">
            <div class="category-card">
                <span class="cat-icon">🐟</span>
                <h4>Peces</h4>
            </div>
        </a>

        <!-- Categoría Aves -->
        <a href="php/aves.php" class="category-link">
            <div class="category-card">
                <span class="cat-icon">🦜</span>
                <h4>Aves</h4>
            </div>
        </a>

    </div>
</section>

        <!-- Es la seccion de los productos destacados -->
        <section class="section-container" id="productos">
            <h3 class="section-title">Productos Destacados</h3>
            <div class="products-grid">
                
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/img_menuprincipal/ropaperro.jpeg" alt="Ropa para perro">
                        <span class="tag-discount">-20%</span>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Ropa</span>
                        <h4 class="product-title">Chamarra Térmica Deportiva</h4>
                        <div class="product-price">
                            <span class="price-current">$349.00</span>
                            <span class="price-old">$430.00</span>
                        </div>
                        <button class="btn-add-cart">Añadir al carrito</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="img/img_menuprincipal/todoperro.jpeg" alt="Accesorios para mascotas">
                    </div>
                    <div class="product-info">
                        <span class="product-category">Accesorios</span>
                        <h4 class="product-title">Kit Completo de Paseo</h4>
                        <div class="product-price">
                            <span class="price-current">$599.00</span>
                        </div>
                        <button class="btn-add-cart">Añadir al carrito</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="img/img_menuprincipal/ropaperro2.jpeg" alt="Ropa de verano">
                    </div>
                    <div class="product-info">
                        <span class="product-category">Ropa</span>
                        <h4 class="product-title">Suéter Casual Algodón</h4>
                        <div class="product-price">
                            <span class="price-current">$289.00</span>
                        </div>
                        <button class="btn-add-cart">Añadir al carrito</button>
                    </div>
                </div>

            </div>
        </section>

        <!-- Es lo que esta antes del pie de que de envios rapido, compra segura, etc -->
        <section class="features-bar">
            <div class="feature-item">
                <span class="feature-icon">🚀</span>
                <div>
                    <h4>Envío Rápido</h4>
                    <p>Entrega en 24-48 horas</p>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">🛡️</span>
                <div>
                    <h4>Compra Segura</h4>
                    <p>Protección en tus pagos</p>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">🔄</span>
                <div>
                    <h4>Devolución Gratis</h4>
                    <p>Hasta 30 días después</p>
                </div>
            </div>
        </section>

    </main>

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
                    <li><a href="php/sobrenosotros.php">Sobre Nosotros</a></li>
                    <li><a href="php/preguntas.php">Preguntas Frecuentes</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Atención al Cliente</h4>
                <ul>
                    <li><a href="php/contactanos.php">Contacto</a></li>
                    <li><a href="#">Seguimiento de Pedido</a></li>
                    <li><a href="#">Envíos y Entregas</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 PetCenter Store. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="js/scriptbuscarsugerencias.js"></script>
    <script src="js/botonescarrusel.js"></script>
    <script src="../js/carrito_global.js"></script>
</body>
</html>