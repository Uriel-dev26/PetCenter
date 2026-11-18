<?php
require_once 'conexion.php';

header('Content-Type: application/json');

$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($busqueda !== '') {
    // Seleccionamos también imagen y precio
    $sql = "SELECT id_producto, nombre, precio, imagen FROM productos WHERE nombre LIKE ? LIMIT 5";
    $stmt = mysqli_prepare($conexion, $sql);
    
    $param = "%" . $busqueda . "%";
    mysqli_stmt_bind_param($stmt, "s", $param);
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    $productos = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }

    echo json_encode($productos);
    mysqli_stmt_close($stmt);
} else {
    echo json_encode([]);
}
?>