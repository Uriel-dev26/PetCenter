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
    <title>Resultados de Búsqueda - PetCenter</title>
    <link rel="stylesheet" href="../css/estil.css">
    <style>
        .search-results-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .search-header { margin-bottom: 30px; text-align: center; }
        .search-term { color: var(--primary-color); }
        .no-results { text-align: center; padding: 50px; background: #fff; border-radius: 12px; }
    </style>
</head>
<body>
    <div class="top-bar">
        <span>🚚 Envío gratis en compras mayores a $500 | 10% de descuento en tu primera compra con el código: <strong>PETNEW</strong></span>
    </div>

    <!-- Encabezado Principal -->
    <header class="site-header">
        <div class="header-container">
            <a href="../Lay-Proy.php" class="logo-container">
                <span class="logo-icon">🐾</span>
                <span class="site-title">PetCenter</span>
            </a>

            <!-- Formulario de búsqueda (action corregido) -->
            <div class="search-container">
                <form action="busquedas.php" method="GET" class="search-form">
                    <input type="text" name="busqueda" id="input-busqueda" placeholder="Buscar alimentos, ropa, juguetes..." autocomplete="off" required value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                    <button type="button" id="btn-limpiar" class="btn-clear">&times;</button>
                    <button type="submit" class="btn-search">🔍</button>
                </form>
                
                <div id="box-sugerencias" class="sugerencias-box hidden">
                    <div class="sugerencias-header">SUGERENCIAS</div>
                    <ul id="lista-sugerencias"></ul>
                </div>
            </div>

            <!-- Acciones de usuario con rutas ajustadas -->
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

        <!-- Menú de navegación principal -->
        <nav class="main-nav">
            <ul>
                <li><a href="../Lay-Proy.php">Inicio</a></li>
                <li><a href="perros.php">Perros</a></li>
                <li><a href="gatos.php">Gatos</a></li>
                <li><a href="peces.php">Peces</a></li>
                <li><a href="aves.php">Aves</a></li>
                <li><a href="../Lay-Proy.php#ofertas" class="nav-highlight">Ofertas 🏷️</a></li>
            </ul>
        </nav>
    </header>

    <!-- Resultados de Búsqueda -->
    <main class="search-results-container">
        <?php
        require_once 'conexion.php';

        if (isset($_GET['busqueda']) && !empty(trim($_GET['busqueda']))) {
            $busqueda = trim($_GET['busqueda']);
            echo "<div class='search-header'><h2>Resultados para: <span class='search-term'>'" . htmlspecialchars($busqueda) . "'</span></h2></div>";

            $sql = "SELECT * FROM productos WHERE nombre LIKE ? OR descripcion LIKE ?";
            $stmt = mysqli_prepare($conexion, $sql);
            
            $param = "%" . $busqueda . "%";
            mysqli_stmt_bind_param($stmt, "ss", $param, $param);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                echo "<div class='products-grid'>";
                
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $imagenRuta = !empty($fila['imagen']) ? '../' . $fila['imagen'] : '../img/img_menuprincipal/Logo.jpg';
                    ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($imagenRuta); ?>" 
                                 alt="<?php echo htmlspecialchars($fila['nombre']); ?>" 
                                 onerror="this.src='../img/img_menuprincipal/Logo.jpg'">
                        </div>
                        <div class="product-info">
                            <span class="product-category">Stock: <?php echo htmlspecialchars($fila['stock']); ?></span>
                            <h4 class="product-title"><?php echo htmlspecialchars($fila['nombre']); ?></h4>
                            <p style="font-size: 0.85rem; color: #666; margin-bottom: 10px;"><?php echo htmlspecialchars($fila['descripcion']); ?></p>
                            <div class="product-price">
                                <span class="price-current">$<?php echo htmlspecialchars($fila['precio']); ?></span>
                            </div>
                            <button class="btn-add-cart">Añadir al carrito</button>
                        </div>
                    </div>
                    <?php
                }
                echo "</div>";
            } else {
                echo "<div class='no-results'><h3>No encontramos productos que coincidan con tu búsqueda.</h3><p>Intenta con otros términos como 'perro', 'gato' o 'ropa'.</p></div>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<div class='no-results'><h3>Por favor ingresa un término de búsqueda.</h3></div>";
        }
        ?>
    </main>

    <!-- PIE DE PÁGINA -->
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
                <li><a href="../sobrenosotros.php">Sobre Nosotros</a></li>
                <li><a href="../preguntas.php">Preguntas Frecuentes</a></li>
                <li><a href="#">Términos y Condiciones</a></li>
                <li><a href="#">Política de Privacidad</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Atención al Cliente</h4>
            <ul>
                <li><a href="../contacto2.php">Contacto</a></li>
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
</body>
</html>