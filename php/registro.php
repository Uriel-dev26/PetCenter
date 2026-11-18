<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="../css/estilocontacto.css">
    <link rel="stylesheet" href="../css/estiloregistro.css">
</head>
<body>
    <nav>
        <a href="../Lay-Proy.php">Inicio</a>
        <a href="contacto2.php">Contacto</a>
    </nav>
    
    <?php

    $conexion = mysqli_connect("localhost", "root", "", "dat");

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $domicilio = $_POST['domicilio'];
    $curp = $_POST['curp'];
    $numero = $_POST['numero'];
    $rfc = $_POST['rfc'];

    $sql = "INSERT INTO usuarios (nombre, correo, password, domicilio, curp, numero, rfc) 
            VALUES ('$nombre', '$correo', '$password', '$domicilio', '$curp', '$numero', '$rfc')";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
    ?>
        <main class="contenedor">
            <div class="card">
                <a class="dismiss" href="contacto2.php" aria-label="Cerrar">×</a>
                <div class="header">
                    <div class="image">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M20 7L9.00004 18L3.99994 13"></path>
                        </svg>
                    </div>
                    <div class="content">
                        <span class="title">Usuario registrado con éxito</span>
                        <p class="message">
                            Gracias, <?php echo htmlspecialchars($nombre); ?>. Guardamos tu registro con el correo
                            <?php echo htmlspecialchars($correo); ?>.
                        </p>
                    </div>
                    <div class="actions">
                        <a class="history" href="../Lay-Proy.php">Ir al inicio</a>
                        <a class="track" href="contacto2.php">Registrar otro usuario</a>
                    </div>
                </div>
            </div>
        </main>
    <?php
    } else {
        echo "<h1>Error al registrar usuario</h1>";
        echo "<p>" . mysqli_error($conexion) . "</p>";
    }

    // 4. Cerrar la conexión
    mysqli_close($conexion);
    ?>
</body>
</html>