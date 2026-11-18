<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Suma la cantidad total de artículos guardados en la sesión del carrito
$total_carrito = !empty($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>

    <link rel="stylesheet" href="../css/Preguntas.css">
    <link rel="stylesheet" href="../css/estil.css">
    
    <!-- GOOGLE FONTS PARA EL TÍTULO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

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
<section class="faq-section">
    <h1 class="faq-title lobster-title">PREGUNTAS FRECUENTES</h1>

    <div class="faq-item">
      <img src="../img/img_menuprincipal/Logo.jpg" alt="icono" class="faq-icon">

        <div>
            <h3>¿Puedo cancelar o modificar mi pedido después de pagarlo?</h3>
            <p>NO. Dado que nuestros productos son elaborados y personalizados la mayoría de las veces para cada cliente, una vez que el pedido ha sido abonado, iniciamos su producción.</p>
        </div>
    </div>

    <div class="faq-item">
        <img src="../img/img_menuprincipal/Logo.jpg" alt="icono" class="faq-icon">
        <div>
            <h3>¿Realizan envíos a todo el país?</h3>
            <p>Por el momento, no ofrecemos servicio de envío a domicilio. Todos los pedidos deben ser retirados personalmente en nuestra ubicación de recogida designada.</p>
        </div>
    </div>

    <div class="faq-item">
        <img src="../img/img_menuprincipal/Logo.jpg" alt="icono" class="faq-icon">
        <div>
            <h3>¿Cuánto tarda en estar listo mi pedido?</h3>
            <p>El tiempo de elaboración de tu pedido es estimado entre 7 y 15 días hábiles a partir de la confirmación del pago. Este plazo puede variar ligeramente dependiendo de la complejidad del producto y del volumen de pedidos activos. Te notificaremos si el tiempo excede este rango.</p>
        </div>
    </div>

</section>

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