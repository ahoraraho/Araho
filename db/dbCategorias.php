<?php

/*****************************************************************************
 *                     CANTIDAD DE CATEGORIAS POR FILTRO
 *****************************************************************************/
function countCategoria($filtro)
{
    global $conexion;

    switch ($filtro) {
        case 'all';
            $consulta = "SELECT COUNT(*) AS total FROM categorias";
            break;
        default:
            $consulta = "SELECT COUNT(*) AS total FROM categorias
            WHERE Nombre LIKE '%$filtro%' ";
            break;
    }

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $total = mysqli_fetch_assoc($resultado);
        return $total['total'];
    } else {
        return 0;
    }
}

/*****************************************************************************
 *                      SELECCIONA UNA CATEGORIA POR EL ID
 *****************************************************************************/
function selectCategoria($id)
{
    global $conexion;

    $consulta = "SELECT C.idCategoria, C.Nombre, C.Hijo_de FROM categorias AS C
                WHERE idCategoria=$id";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                      SELECCIONA TODAS LAS CATEGORIAS
 *****************************************************************************/
/*function selectCategoriasAll()
{
    global $conexion;

    $consulta = "SELECT C.idCategoria, C.Nombre, C.Hijo_de FROM categorias AS C";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}*/
function selectCategoriasConPaginas($filtro = "all", $pagina = 1, $limite = 10)
{
    global $conexion;

    $posicion = ($pagina - 1) * $limite;


    switch ($filtro) {
        case 'all':
            $consulta = "SELECT C.idCategoria, C.Nombre, C.Hijo_de 
                        FROM categorias AS C
                        LIMIT $posicion, $limite";
            break;
        default:
            $consulta = "SELECT C.idCategoria, C.Nombre, C.Hijo_de 
                        FROM categorias AS C
                        WHERE C.Nombre LIKE '%$filtro%' 
                        LIMIT $posicion, $limite";
            break;
    }

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                      AGREGA UNA NUEVA CATEGORIA
 *****************************************************************************/
function InsertCategoria($nombre, $hijo_de)
{
    global $conexion;

    $consulta = "INSERT INTO categorias (Nombre, Hijo_de) 
                    VALUES ('$nombre', $hijo_de)";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                      ACTUALIZA UNA CATEGORIA POR EL ID
 *****************************************************************************/
function UpdateCategoria($id, $nombre, $hijo_de)
{
    global $conexion;

    $consulta = "UPDATE categorias
                SET Nombre = '$nombre', Hijo_de = $hijo_de 
                WHERE idCategoria = $id";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                      ELIMINA UNA CATEGORIA POR EL ID
 *****************************************************************************/
function DeleteCategoria($id)
{
    global $conexion;

    $consulta = "DELETE FROM categorias WHERE idCategoria = $id";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                      OBTIENE EL MAS RECIENTE ID DE CATEGORIA
 *****************************************************************************/
function MayorIdCategoira()
{
    global $conexion;

    $consulta = "SELECT MAX(idCategoria) as maxId FROM categorias";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}
