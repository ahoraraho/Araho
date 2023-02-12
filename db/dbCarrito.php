<?php
/*****************************************************************************
 *                          INSERTAR EN CARRITO
 *****************************************************************************/
function InsertCarrito($idCliente, $idProducto, $cantidad) {
    global $conexion;

    $consulta = "INSERT INTO carrito
                ( idCliente, idProducto, cantidad ) 
                VALUES ( $idCliente, $idProducto, $cantidad );";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
*                    SELECCIONAR EN CARRITO SEGUN CLIENTE
*****************************************************************************/
function SelectCarrito($idCliente) {
    global $conexion;

    $consulta = "SELECT C.id, C.idCliente, C.idProducto, P.Imagen, P.Nombre, C.cantidad, P.Precio, (C.cantidad * P.Precio) AS PrecioParcial, P.Stock 
                FROM carrito AS C
                INNER JOIN productos AS P ON C.idProducto = P.idProducto 
                WHERE C.idCliente = $idCliente";

    $resultado = mysqli_query($conexion, $consulta);
    if (mysqli_num_rows($resultado)>0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

/*****************************************************************************
 *             ACTUALIZAR CANTIDAD EN CARRITO SEGUN idCLiente e IdProducto
 *****************************************************************************/
function UpdateCarrito($idCliente, $idProducto, $cantidad) {
    global $conexion;

    $consulta ="UPDATE carrito 
                SET cantidad = $cantidad 
                WHERE idCliente = $idCliente AND idProducto = $idProducto";
                
    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);//devuelve el número de filas afectadas en la ultima sentencia
}

/*****************************************************************************
 *             ELIMINAR PRODUCTO idProducto EN CARRITO SEGUN idCLiente
 *****************************************************************************/
function DeleteCarritoProduct($idCliente, $idProducto) {
    global $conexion;
    
    $consulta ="DELETE FROM carrito 
                WHERE idCLiente = $idCliente AND idProducto = $idProducto";
    
    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                ELIMINAR TODO EN CARRITO SEGUN idCLiente
 *****************************************************************************/
function DeleteCarrito($idCliente) {
    global $conexion;
    
    $consulta ="DELETE FROM carrito 
                WHERE idCLiente = $idCliente";
    
    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}
