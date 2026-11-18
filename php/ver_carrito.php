<?php
session_start();
require_once 'conexion.php';

$productosEnCarrito = [];
$totalGeneral = 0;

if (!empty($_SESSION['carrito'])) {
    $ids = array_keys($_SESSION['carrito']);
    $idsCadena = implode(',', array_map('intval', $ids));
    
    $sql = "SELECT * FROM productos WHERE id_producto IN ($idsCadena)";
    $res = mysqli_query($conexion, $sql);
    
    while ($prod = mysqli_fetch_assoc($res)) {
        $cant = $_SESSION['carrito'][$prod['id_producto']];
        $subtotal = $prod['precio'] * $cant;
        $totalGeneral += $subtotal;
        
        $prod['cantidad_carrito'] = $cant;
        $prod['subtotal_carrito'] = $subtotal;
        $productosEnCarrito[] = $prod;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCenter - Carrito de Compras</title>
    <link rel="stylesheet" href="../css/estil.css">
    <link rel="stylesheet" href="../css/estilocarrito.css">
</head>
<body>

    <div class="top-bar">
        <span>🚚 Envío gratis en compras mayores a $500 | 10% de descuento con el código: <strong>PETNEW</strong></span>
    </div>

    <header class="site-header">
        <div class="header-container">
            <a href="../Lay-Proy.php" class="logo-container">
                <span class="logo-icon">🐾</span>
                <span class="site-title">PetCenter</span>
            </a>

            <div class="search-container">
                <form action="busquedas.php" method="GET" class="search-form">
                    <input type="text" name="busqueda" id="input-busqueda" placeholder="Buscar productos..." autocomplete="off">
                    <button type="button" id="btn-limpiar" class="btn-clear">&times;</button>
                    <button type="submit" class="btn-search">🔍</button>
                </form>
                <div id="box-sugerencias" class="sugerencias-box hidden">
                    <div class="sugerencias-header">SUGERENCIAS</div>
                    <ul id="lista-sugerencias"></ul>
                </div>
            </div>

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

    <main class="cart-page-container">
        <!-- Migas de Pan -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../Lay-Proy.php">Inicio</a></li>
                <li class="breadcrumb-item active"><span>Carrito de Compras</span></li>
            </ol>
        </nav>

        <h2 class="cart-title">Tu Carrito de Compras 🛒</h2>

        <?php if (empty($productosEnCarrito)): ?>
            <div class="empty-cart-msg">
                <h3>Tu carrito está vacío 🐾</h3>
                <p>Parece que aún no has agregado productos para tu mascota.</p>
                <a href="../Lay-Proy.php" class="btn-checkout" style="display:inline-block; width:auto; margin-top:20px; padding: 10px 25px;">Explorar Tienda</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <!-- Lista de Productos -->
                <div class="cart-items-wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart-table-body">
                            <?php foreach ($productosEnCarrito as $item): 
                                $imgRuta = !empty($item['imagen']) ? '../' . $item['imagen'] : '../img/img_menuprincipal/Logo.jpg';
                            ?>
                                <tr class="cart-item-row" id="cart-row-<?php echo $item['id_producto']; ?>" data-id="<?php echo $item['id_producto']; ?>">
                                    <td>
                                        <div class="cart-product-detail">
                                            <img src="<?php echo htmlspecialchars($imgRuta); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="cart-product-img" onerror="this.src='../img/img_menuprincipal/Logo.jpg'">
                                            <div>
                                                <a href="#" class="cart-product-name"><?php echo htmlspecialchars($item['nombre']); ?></a>
                                                <div style="font-size:0.75rem; color:#64748b;">Stock: <?php echo $item['stock']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart-price-col">$<?php echo number_format($item['precio'], 2); ?></td>
                                    <td>
                                        <div class="quantity-controls">
                                            <button class="btn-qty btn-qty-minus">-</button>
                                            <input type="text" class="input-qty" value="<?php echo $item['cantidad_carrito']; ?>" readonly>
                                            <button class="btn-qty btn-qty-plus">+</button>
                                        </div>
                                    </td>
                                    <td class="cart-subtotal-col">$<?php echo number_format($item['subtotal_carrito'], 2); ?></td>
                                    <td>
                                        <button class="btn-remove-item" title="Eliminar producto">&times;</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Resumen y Pago -->
                <div class="cart-summary-box">
                    <h3 class="summary-title">Resumen del Pedido</h3>
                    <div class="summary-line">
                        <span>Envío estimado</span>
                        <span style="color:#00a896; font-weight:bold;">¡GRATIS!</span>
                    </div>
                    <div class="summary-total-line">
                        <span>Total</span>
                        <span class="summary-total-amount" id="cart-total-amount">$<?php echo number_format($totalGeneral, 2); ?></span>
                    </div>
                    <button class="btn-checkout" onclick="alert('Redirigiendo a la pasarela de pago...');">Proceder al Pago 💳</button>
                    <a href="../Lay-Proy.php" class="btn-continue-shopping">Seguir comprando</a>
                </div>
            </div>
        <?php endif; ?>
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

    <script src="../js/scriptbuscarsugerencias.js"></script>
    <script src="../js/carrito_global.js"></script>
</body>
</html>