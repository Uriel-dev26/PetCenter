<?php 
// 1. Requerir la conexión subiendo un nivel a la carpeta php/
require_once '../conexion.php';

define('KEY_TOKEN', 'tu_token_secreto');
?>

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PetCenter - Paseo y Viajes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Estilos subiendo 2 niveles hasta la raíz -->
    <link rel="stylesheet" href="../../css/estil.css">
</head>
<body>
<!-- Barra Superior -->
    <div class="top-bar">
        <span>🚚 Envío gratis en compras mayores a $500 para consentir a tu minino.</span>
    </div>
<!-- HEADER ADAPTADO -->
<header class="site-header">
    <div class="header-container">
        <!-- Enlace a la página principal (2 niveles atrás) -->
        <a href="../../Lay-Proy.php" class="logo-container">
            <span class="logo-icon">🐾</span>
            <span class="site-title">PetCenter</span>
        </a>

        <!-- Buscador dirigiendo a php/busquedas.php (1 nivel atrás) -->
        <div class="search-container">
            <form action="../busquedas.php" method="GET" class="search-form">
                <input type="text" name="busqueda" id="input-busqueda" placeholder="Buscar juguetes, correas, alimento..." autocomplete="off">
                <button type="button" id="btn-limpiar" class="btn-clear">&times;</button>
                <button type="submit" class="btn-search">🔍</button>
            </form>

            <div id="box-sugerencias" class="sugerencias-box hidden">
                <div class="sugerencias-header">SUGERENCIAS</div>
                <ul id="lista-sugerencias"></ul>
            </div>
        </div>

        <!-- Acciones de usuario (1 nivel atrás) -->
        <div class="header-actions">
            <a href="../Sesion.php" class="action-btn">
                <span class="icon">👤</span>
                <span class="label">Mi Cuenta</span>
            </a>
            <a href="../contacto2.php" class="action-btn">
                <span class="icon">📞</span>
                <span class="label">Ayuda</span>
            </a>
            <a href="../ver_carrito.php" class="action-btn cart-btn">
                    <span class="icon">🛒</span>
                    <span id="num_cart" class="cart-badge"><?php echo array_sum($_SESSION['carrito'] ?? []); ?></span>
                </a>
        </div>
    </div>

    <!-- Navegación Principal -->
    <nav class="main-nav">
        <ul>
            <li><a href="../../Lay-Proy.php">Inicio</a></li>
            <li><a href="../perros.php">Perros</a></li>
            <li><a href="../gatos.php">Gatos</a></li>
            <li><a href="../peces.php">Peces</a></li>
            <li><a href="../aves.php" class="active">Aves</a></li>
            <li><a href="../../Lay-Proy.php#ofertas" class="nav-highlight">Ofertas 🏷️</a></li>
        </ul>
    </nav>
</header>

<!-- CONTENIDO DE PRODUCTOS -->
<main class="py-4">
    <div class="container">
        <!-- Migas de Pan (Breadcrumbs) -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../Lay-Proy.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="../aves.php">Aves</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>Higiene y Cuidado</span></li>
            </ol>
        </nav>
        <h3 class="section-title">Productos para Higiene y Cuidado</h3>
        <div class="products-grid">
            <?php
            $sql = "SELECT * FROM productos WHERE categoria = 'ave' AND subcategoria = 'Higiene'";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    // La ruta de las imágenes en BD inicia con 'img/...', por lo que necesita subir 2 niveles
                    $imagenRuta = !empty($fila['imagen']) ? '../../' . $fila['imagen'] : '../../img/img_menuprincipal/Logo.jpg';
                    ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($imagenRuta); ?>" 
                                 alt="<?php echo htmlspecialchars($fila['nombre']); ?>" 
                                 onerror="this.src='../../img/img_menuprincipal/Logo.jpg'">
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
                echo "<p style='grid-column: 1/-1; text-align: center; color: #64748b; padding: 30px;'>No se encontraron productos para esta categoría.</p>";
            }

            mysqli_close($conexion);
            ?>
        </div>
    </div>
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

<!-- Scripts apuntando 2 niveles atrás a la carpeta js/ -->
<script src="../../js/scriptbuscarsugerencias.js"></script>
<script src="../../js/carrito_global.js"></script>
</body>
</html>