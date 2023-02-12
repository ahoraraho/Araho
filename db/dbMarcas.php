<?php

/*****************************************************************************
 *                      SELECCIONA TODAS LAS MARCAS
 *****************************************************************************/
/*function selectMarcasAll()
{
    global $conexion;

    $consulta = "SELECT M.idMarca, M.Nombre FROM marcas AS M";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}*/
function selectMarcasConPaginas($filtro, $pagina = 1, $limite = 10)
{
    global $conexion;

    $posicion = ($pagina - 1) * $limite;

    switch ($filtro) {
        case 'all':
            $consulta = "SELECT M.idMarca, M.Nombre FROM marcas AS M 
                        LIMIT $posicion, $limite";
            break;
        default:
            $consulta = "SELECT M.idMarca, M.Nombre FROM marcas AS M 
                        WHERE M.Nombre LIKE '%$filtro%' 
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
 *                               CANTIDAD DE MARCAS
 *****************************************************************************/
function countMarca($filtro)
{
    global $conexion;

    switch ($filtro) {
        case 'all';
            $consulta = "SELECT COUNT(*) AS total FROM marcas";
            break;
        default:
            $consulta = "SELECT COUNT(*) AS total FROM marcas
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
 *                      SELECCIONA UNA MARCA POR EL ID
 *****************************************************************************/
function selectMarca($id)
{
    global $conexion;

    $consulta = "SELECT M.idMarca, M.Nombre FROM marcas AS M
                WHERE idMarca=$id";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        return [];
    }
}

/*****************************************************************************
 *                      AGREGA UNA NUEVA MARCA
 *****************************************************************************/
function InsertMarca($nombre)
{
    global $conexion;

    $consulta = "INSERT INTO marcas (Nombre) 
                    VALUES ('$nombre')";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                      ACTUALIZA UNA MARCA POR EL ID
 *****************************************************************************/
function UpdateMarca($id, $nombre)
{
    global $conexion;

    $consulta = "UPDATE marcas
                SET Nombre = '$nombre'
                WHERE idMarca = $id";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}



/*****************************************************************************
 *                      ELIMINA UNA MARCA POR EL ID
 *****************************************************************************/
function DeleteMarca($id)
{
    global $conexion;

    $consulta = "DELETE FROM marcas WHERE idMarca = $id";

    mysqli_query($conexion, $consulta);

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                      OBTIENE EL MAS RECIENTE ID DE MARCA
 *****************************************************************************/
function MayorIdMarca()
{
    global $conexion;

    $consulta = "SELECT MAX(idMarca) as maxId FROM marcas";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        return [];
    }
}
