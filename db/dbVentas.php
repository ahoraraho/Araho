<?php

/*****************************************************************************
 *                         CANTIDAD DE VENTAS TOTALES
 *****************************************************************************/
function countVenta()
{
    global $conexion;

    $consulta = "SELECT COUNT(*) AS total FROM detalle_venta";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $total = mysqli_fetch_assoc($resultado);
        return $total['total'];
    } else {
        return 0;
    }
}
/*****************************************************************************
 *                   INSERTAR VENTA CON DETALLE DE PRODUCTOS
 *****************************************************************************/
function InsertVenta($idUsuario, $productos)
{
    global $conexion;

    $estado = "por entregar";

    $consulta = "INSERT INTO ventas( idUsuario, estado ) 
    VALUES ( $idUsuario, '$estado' );";

    mysqli_query($conexion, $consulta);
    // mysqli_insert_id — Devuelve el valor generado para una columna AUTO_INCREMENT por la última consulta
    $ultimo_id = mysqli_insert_id($conexion);

    $consulta = "INSERT INTO detalle_venta
                ( idVenta, idProducto, cantidad, precio )   
                VALUES ";

    foreach ($productos as $producto) {
        $idProducto = $producto['idProducto'];
        $cantidad = $producto['cantidad'];
        $precio = $producto['Precio'];

        $consulta .= "( $ultimo_id, $idProducto, $cantidad, $precio ), ";
    }

    $consulta = rtrim($consulta, ', '); // quito la ultima coma

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                     SELECCIONAR TODAS LAS VENTAS
 *****************************************************************************/
function SelectVentasAll($pagina = 1, $limite = 10)
{
    global $conexion;

    $posicion = ($pagina - 1) * $limite;

    $consulta = "SELECT V.id, V.fecha, C.nombre AS cliente, D.idProducto, P.nombre, D.cantidad, D.precio, D.cantidad * D.precio AS total, V.estado, P.stock 
    FROM ventas AS V 
    INNER JOIN detalle_venta AS D ON D.idVenta = V.id 
    INNER JOIN login AS L ON V.idUsuario = L.idUsuario 
    INNER JOIN clientes_usuario AS C ON L.idClienteUsuario = C.id 
    INNER JOIN productos AS P ON D.idProducto = P.idProducto
    LIMIT $posicion, $limite";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                    SELECCIONAR VENTAS SEGUN USUARIO
 *****************************************************************************/
function SelectVentas($idUsuario)
{
    global $conexion;

    $consulta = "SELECT V.id, V.fecha, D.idProducto, P.nombre, D.cantidad, D.precio, D.cantidad * D.precio AS total, V.estado, P.stock 
    FROM ventas AS V
    INNER JOIN detalle_venta AS D ON D.idVenta = V.id 
    INNER JOIN productos AS P ON D.idProducto = P.idProducto 
    WHERE V.idUsuario = $idUsuario";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                    SELECCIONAR VENTA SEGUN idVenta
 *****************************************************************************/
function SelectVenta($idVenta)
{
    global $conexion;

    $consulta = "SELECT V.id, V.fecha, D.idProducto, P.nombre, D.cantidad, D.precio, D.cantidad * D.precio AS total, V.estado, P.stock 
    FROM ventas AS V
    INNER JOIN detalle_venta AS D ON D.idVenta = V.id 
    INNER JOIN productos AS P ON D.idProducto = P.idProducto 
    WHERE V.idUsuario = $idVenta";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        return [];
    }
}

/*****************************************************************************
 *             ACTUALIZAR estado de VENTA SEGUN idVenta
 *****************************************************************************/
function UpdateVentaEstado($idVenta, $estado)
{
    global $conexion;

    $consulta = "UPDATE ventas 
                SET estado = '$estado' 
                WHERE id = $idVenta";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                  ELIMINAR VENTA SEGUN idVenta
 *****************************************************************************/
function DeleteVenta($idVenta)
{
    global $conexion;

    $consulta = "DELETE FROM ventas 
                WHERE id = $idVenta";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}
