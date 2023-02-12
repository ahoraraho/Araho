<?php

/*****************************************************************************
 *                     SELECCIONAR TODOS LOS USUARIOS CLIENTE
 *****************************************************************************/
function SelectClientesUsuarioPaginado($pagina = 1, $limite = 10)
{
    global $conexion;

    $posicion = ($pagina - 1) * $limite;

    $consulta = "SELECT U.id, U.nombre, U.apellido, U.direccion, U.telefono, L.Email
    FROM clientes_usuario AS U 
    INNER JOIN login AS L ON U.id = L.idClienteUsuario
    LIMIT $posicion, $limite";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                               CANTIDAD DE MARCAS
 *****************************************************************************/
function countClienteUsuario()
{
    global $conexion;

    $consulta = "SELECT COUNT(*) AS total FROM clientes_usuario";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $total = mysqli_fetch_assoc($resultado);
        return $total['total'];
    } else {
        return 0;
    }
}

/*****************************************************************************
 *                      SELECCIONA UN USUARIO POR EL ID
 *****************************************************************************/
function selectClientesUsuario($id)
{
    global $conexion;

    $consulta = "SELECT U.id, U.nombre, U.apellido, U.direccion, U.telefono, L.Email, L.Pass
    FROM clientes_usuario AS U 
    INNER JOIN login AS L
    ON U.id = L.idClienteUsuario
    WHERE U.id=$id";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                      AGREGA UN USUARIO A LA BASE DE DATOS
 *****************************************************************************/
function InsertClientesUsuario($nombre, $apellido, $direccion, $telefono)
{
    global $conexion;

    $consulta = "INSERT INTO clientes_usuario (nombre, apellido, direccion, telefono) 
                    VALUES ('$nombre','$apellido','$direccion','$telefono')";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                      ACTUALIZA UN USUARIO POR EL ID
 *****************************************************************************/
function UpdateClientesUsuario($id, $nombre, $apellido, $direccion, $telefono)
{
    global $conexion;

    $consulta = "UPDATE clientes_usuario
                SET nombre = '$nombre',
                SET apellido = '$apellido',
                SET direccion = '$direccion',
                SET telefono = '$telefono',
                WHERE id = $id";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}



/*****************************************************************************
 *                      ELIMINA UNA MARCA POR EL ID
 *****************************************************************************/
function DeleteClientesUsuario($id)
{
    global $conexion;

    $consulta = "DELETE FROM clientes_usuario WHERE id = $id";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                 OBTIENE EL MAS RECIENTE ID DE LOS USUARIOS
 *****************************************************************************/
function MayorIdClientesUsuario()
{
    global $conexion;

    $consulta = "SELECT MAX(id) as maxId FROM clientes_usuario";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}
