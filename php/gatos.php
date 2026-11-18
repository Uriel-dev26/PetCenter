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
    <title>PetCenter - Sección de Gatos</title>
    <link rel="stylesheet" href="../css/estil.css">
    <link rel="stylesheet" href="../css/estilosgato.css">
</head>
<body>

    <!-- Barra Superior -->
    <div class="top-bar">
        <span>🚚 Envío gratis en compras mayores a $500 para consentir a tu minino.</span>
    </div>

    <!-- Encabezado Principal -->
    <header class="site-header">
        <div class="header-container">
            <a href="../Lay-Proy.php" class="logo-container">
                <span class="logo-icon">🐾</span>
                <span class="site-title">PetCenter</span>
            </a>

            <!-- Buscador Integrado -->
            <div class="search-container">
                <form action="busquedas.php" method="GET" class="search-form">
                    <input type="text" name="busqueda" id="input-busqueda" placeholder="Buscar juguetes, rascadores, alimento..." autocomplete="off" required>
                    <button type="button" id="btn-limpiar" class="btn-clear">&times;</button>
                    <button type="submit" class="btn-search">🔍</button>
                </form>
                
                <div id="box-sugerencias" class="sugerencias-box hidden">
                    <div class="sugerencias-header">SUGERENCIAS</div>
                    <ul id="lista-sugerencias"></ul>
                </div>
            </div>

            <!-- Acciones de Usuario -->
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

        <!-- Menú de opciones ajustado -->
        <nav class="main-nav">
            <ul>
                <li><a href="../Lay-Proy.php">Inicio</a></li>
                <li><a href="perros.php">Perros</a></li>
                <li><a href="gatos.php" class="active">Gatos</a></li>
                <li><a href="peces.php">Peces</a></li>
                <li><a href="aves.php">Aves</a></li>
                <li><a href="../Lay-Proy.php#ofertas" class="nav-highlight">Ofertas 🏷️</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido Principal -->
    <main class="site-main">
        <!-- Migas de pan para Sección Gatos -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../Lay-Proy.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Gatos</span></li>
        </ol>
    </nav>
        
        <!-- Banner Grande con Foto Ilustrativa del Gato -->
        <section class="hero-banner-cat">
            <div class="hero-content">
                <span class="badge">Especial felino</span>
                <h1>Todo para el rey de la casa</h1>
                <p>Encuentra rascadores, juguetes con catnip, camas ultra cómodas y alimentos premium diseñados para su bienestar.</p>
            </div>
            <div class="hero-cat-image">
                <img src="../img/img_menuprincipal/SeccionGatos.jpg" alt="Sección Gatos" onerror="this.src='../img/img_menuprincipal/Logo.jpg'">
            </div>
        </section>

        <!-- Secciones / Subcategorías de Gatos -->
        <section class="section-container">
            <h3 class="section-title">Explora por Categoría</h3>
            <div class="categories-grid">
                <a href="GatosCategorias/GatosCategoriaJuguetes.php" class="category-link">
                <div class="category-card">
                    <span class="cat-icon">🧶</span>
                    <h4>Juguetes y Rascadores</h4>
                </div>
                </a>
                <a href="GatosCategorias/GatosCategoriaAlimentos.php" class="category-link">
                <div class="category-card">
                    <span class="cat-icon">🥣</span>
                    <h4>Alimentos y Premios</h4>
                </div>
                </a>
                <a href="GatosCategorias/GatosCategoriaCama.php" class="category-link">
                <div class="category-card">
                    <span class="cat-icon">🛌</span>
                    <h4>Camas y Descanso</h4>
                </div>
                </a> 
                <a href="GatosCategorias/GatosCategoriaHigiene.php" class="category-link">
                <div class="category-card">
                    <span class="cat-icon">🧴</span>
                    <h4>Higiene y Arena</h4>
                </div>
                </a>
            </div>
        </section>

        <!-- Productos de Gatos (Cargados desde la Base de Datos) -->
        <section class="section-container" id="productos-gatos">
            <h3 class="section-title">Productos Destacados para Gatos</h3>
            <div class="products-grid">
                <?php
                require_once 'conexion.php';

                // Buscamos productos que contengan la palabra 'gato' o 'felino' en su nombre o descripción
                $sql = "SELECT * FROM productos WHERE categoria = 'gato' LIMIT 4";
                $resultado = mysqli_query($conexion, $sql);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $imagenRuta = !empty($fila['imagen']) ? '../' . $fila['imagen'] : '../img/img_menuprincipal/Logo.jpg';
                        ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?php echo htmlspecialchars($imagenRuta); ?>" alt="<?php echo htmlspecialchars($fila['nombre']); ?>" onerror="this.src='../img/img_menuprincipal/Logo.jpg'"> <!-- es la foto que va a mostrar si el articulo no tiene foto -->
                            </div>
                            <div class="product-info">
                                <span class="product-category">Stock: <?php echo htmlspecialchars($fila['stock']); ?></span>
                                <h4 class="product-title"><?php echo htmlspecialchars($fila['nombre']); ?></h4>
                                <p style="font-size: 0.85rem; color: #666; margin-bottom: 10px;"><?php echo htmlspecialchars($fila['descripcion']); ?></p>
                                <div class="product-price">
                                    <span class="price-current">$<?php echo htmlspecialchars($fila['precio']); ?></span>
                                </div>
                                <button class="btn-add-cart" data-id="<?php echo $fila['id_producto']; ?>">Añadir al carrito</button>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p style='grid-column: 1/-1; text-align: center; color: #64748b; padding: 30px;'>Pronto agregaremos más productos exclusivos para gatos.</p>";
                }

                mysqli_close($conexion);
                ?>
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

    <script src="../js/scriptbuscarsugerencias.js"></script>
    <script src="../js/carrito_global.js"></script>
</body>
</html>