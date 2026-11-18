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
    <title>PetCenter - Registro y Contacto</title>
    <!-- CSS Principal de la tienda -->
    <link rel="stylesheet" href="../css/estil.css">
    <!-- CSS Específico para Formularios -->
    <link rel="stylesheet" href="../css/estilocontacto.css">
</head>

<body>
    <!-- Barra Superior -->
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

            <!-- Buscador Integrado (Ruta ajustada a busquedas.php directamente) -->
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

            <!-- Acciones de Usuario (Rutas ajustadas) -->
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

        <!-- Menú de Navegación (Rutas ajustadas para estar dentro de /php/) -->
        <nav class="main-nav">
            <ul>
                <li><a href="../Lay-Proy.php">Inicio</a></li>
                <li><a href="busquedas.php?busqueda=perro">Perros</a></li>
                <li><a href="gatos.php">Gatos</a></li>
                <li><a href="busquedas.php?busqueda=pez">Peces</a></li>
                <li><a href="busquedas.php?busqueda=ave">Aves</a></li>
                <li><a href="../Lay-Proy.php#ofertas" class="nav-highlight">Ofertas 🏷️</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido del Formulario -->
    <main class="site-main" style="flex-direction: column; align-items: center;">
        <h1>Regístrarme</h1>
        <p class="intro">Completa tus datos para crear tu registro.</p>

        <form action="registro.php" method="post">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" autocomplete="name" placeholder="Alvaro Sanchez" required>
            </div>

            <div class="campo">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" autocomplete="email" placeholder="ejemplo@correo.com" required>
            </div>
            
            <div class="campo mitad">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" autocomplete="password" placeholder="********" required>
            </div>

            <div class="campo mitad">
                <label for="numero">Teléfono</label>
                <input type="tel" id="numero" name="numero" autocomplete="tel" placeholder="55********" required>
            </div>

            <div class="campo">
                <label for="domicilio">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" autocomplete="street-address" placeholder="Av. Ejemplo" required>
            </div>

            <div class="campo mitad">
                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" maxlength="18" placeholder="CURP1848EJEMPLO4" required>
            </div>

            <div class="campo mitad">
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" maxlength="13" placeholder="RFC1484E" required>
            </div>

            <input type="submit" value="Registrarme">
        </form>
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
                    <li><a href="../php/contactanos.php">Contacto</a></li>
                    <li><a href="#">Seguimiento de Pedido</a></li>
                    <li><a href="#">Envíos y Entregas</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 PetCenter Store. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Script del Buscador AJAX -->
    <script src="../js/busqueda.js"></script>
</body>

</html>