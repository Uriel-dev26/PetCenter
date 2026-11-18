<?php
session_start();
header('Content-Type: application/json');
require_once '../conexion.php';

$res = ['ok' => false, 'numero' => 0, 'subtotal' => 0, 'total' => 0, 'msg' => ''];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$action = $_POST['action'] ?? '';
$id_producto = isset($_POST['id']) ? intval($_POST['id']) : 0;
$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
$id_usuario = $_SESSION['id_usuario'] ?? null;

if ($id_producto > 0) {
    
    // Verificar stock del producto en la base de datos
    $stmt = mysqli_prepare($conexion, "SELECT precio, stock, nombre FROM productos WHERE id_producto = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_producto);
    mysqli_stmt_execute($stmt);
    $prodResult = mysqli_stmt_get_result($stmt);
    $productoBD = mysqli_fetch_assoc($prodResult);
    mysqli_stmt_close($stmt);

    if (!$productoBD) {
        $res['msg'] = 'El producto no existe.';
        echo json_encode($res);
        exit();
    }

    switch ($action) {
        case 'agregar':
            $cantActual = $_SESSION['carrito'][$id_producto] ?? 0;
            $nuevaCant = $cantActual + $cantidad;
            
            if ($nuevaCant > $productoBD['stock']) {
                $res['msg'] = 'Stock insuficiente.';
                $nuevaCant = $productoBD['stock'];
            }
            
            $_SESSION['carrito'][$id_producto] = $nuevaCant;

            // Sincronizar con BD si el usuario está autenticado
            if ($id_usuario) {
                $stmtDB = mysqli_prepare($conexion, "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE cantidad = ?");
                mysqli_stmt_bind_param($stmtDB, "iiii", $id_usuario, $id_producto, $nuevaCant, $nuevaCant);
                mysqli_stmt_execute($stmtDB);
                mysqli_stmt_close($stmtDB);
            }
            $res['ok'] = true;
            break;

        case 'actualizar':
            if ($cantidad <= 0) {
                unset($_SESSION['carrito'][$id_producto]);
                if ($id_usuario) {
                    $stmtDel = mysqli_prepare($conexion, "DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
                    mysqli_stmt_bind_param($stmtDel, "ii", $id_usuario, $id_producto);
                    mysqli_stmt_execute($stmtDel);
                    mysqli_stmt_close($stmtDel);
                }
            } else {
                if ($cantidad > $productoBD['stock']) {
                    $cantidad = $productoBD['stock'];
                    $res['msg'] = 'Se ajustó al límite de stock disponible.';
                }
                $_SESSION['carrito'][$id_producto] = $cantidad;
                if ($id_usuario) {
                    $stmtUpd = mysqli_prepare($conexion, "UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
                    mysqli_stmt_bind_param($stmtUpd, "iii", $cantidad, $id_usuario, $id_producto);
                    mysqli_stmt_execute($stmtUpd);
                    mysqli_stmt_close($stmtUpd);
                }
            }
            $res['ok'] = true;
            $res['subtotal'] = number_format($productoBD['precio'] * ($_SESSION['carrito'][$id_producto] ?? 0), 2, '.', '');
            break;

        case 'eliminar':
            unset($_SESSION['carrito'][$id_producto]);
            if ($id_usuario) {
                $stmtDel = mysqli_prepare($conexion, "DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
                mysqli_stmt_bind_param($stmtDel, "ii", $id_usuario, $id_producto);
                mysqli_stmt_execute($stmtDel);
                mysqli_stmt_close($stmtDel);
            }
            $res['ok'] = true;
            break;
    }
}

// Recalcular total acumulado de artículos en el carrito
$res['numero'] = array_sum($_SESSION['carrito']);

// Recalcular total a pagar
$totalAcumulado = 0;
if (!empty($_SESSION['carrito'])) {
    $ids = implode(',', array_map('intval', array_keys($_SESSION['carrito'])));
    $queryTot = mysqli_query($conexion, "SELECT id_producto, precio FROM productos WHERE id_producto IN ($ids)");
    while ($row = mysqli_fetch_assoc($queryTot)) {
        $cant = $_SESSION['carrito'][$row['id_producto']] ?? 0;
        $totalAcumulado += ($row['precio'] * $cant);
    }
}
$res['total'] = number_format($totalAcumulado, 2, '.', '');

echo json_encode($res);
mysqli_close($conexion);
exit();
?>