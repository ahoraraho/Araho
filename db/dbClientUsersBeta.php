<?php

/*****************************************************************************
 *                     CANTIDAD DE USUARIOS REGISTRADOS
 *****************************************************************************/
function countUsuariosRol($usuario)
{
    global $conexion;

    //$id = $usuario['Id'];
    $rol = $usuario['Rol'];
    //$idCliente = $usuario['IdCliente'];

    if ($rol == 1) {
        $consulta1 = "SELECT COUNT(*) AS total FROM clientes_empresa";
    } else if ($rol == 0) {
        $consulta2 = "SELECT COUNT(*) AS total FROM clientes_usuario";
    }

    $consulta1 = mysqli_query($conexion, $consulta1);
    $consulta2 = mysqli_query($conexion, $consulta2);

    if (mysqli_num_rows($consulta1) > 0) {
        $total = mysqli_fetch_assoc($consulta1);
        return $total['total'];
    } else if (mysqli_num_rows($consulta2) > 0) {
        $total = mysqli_fetch_assoc($consulta2);
        return $total['total'];
    } else {
        return 0;
    }
}


/*****************************************************************************
 *                CANTIDAD  TOTAL DE USUARIOS REGISTRADOS
 *****************************************************************************/
function countUsuariosAll()
{
    global $conexion;

    $consulta1 = "SELECT COUNT(*) AS total1 FROM clientes_empresa";
    $consulta2 = "SELECT COUNT(*) AS total2 FROM clientes_usuario";

    $consulta1 = mysqli_query($conexion, $consulta1);
    $consulta2 = mysqli_query($conexion, $consulta2);

    if (mysqli_num_rows($consulta1) > 0 and mysqli_num_rows($consulta2) > 0) {
        $t1 = mysqli_fetch_assoc($consulta1);
        $t2 = mysqli_fetch_assoc($consulta2);
        $total = $t1['total1'] + $t2['total2'];
        return $total;
    } else {
        return 0;
    }
}
/*****************************************************************************
 *               SELECCIONO DATOS COMPLETOS DE USUARIO POR ID
 *****************************************************************************/
function SelectUsuario($id)
{
    global $conexion;
    /*$consulta = "SELECT L.Rol, U.Nombre, U.Apellido, E.RazonSocial, L.Email, L.Pass, 
                    CASE WHEN L.Rol = 0 
                        THEN U.id
                        ELSE E.id
                    END AS IdCliente,
                    CASE WHEN L.Rol = 0 
                        THEN U.direccion
                        ELSE E.direccion
                    END AS Direccion,
                    CASE WHEN L.Rol = 0 
                        THEN U.telefono
                        ELSE E.telefono
                    END AS Telefono
                FROM login AS L
                LEFT JOIN clientes_usuario AS U ON L.idClienteUsuario = U.id
                LEFT JOIN clientes_empresa AS E ON L.idClienteEmpresa = E.id
                WHERE L.idUsuario = $id";*/


    //EL IFNULL debuelve un resulataso si es que uno de ellos es nulo o vacio
    $consulta = "SELECT L.Rol, U.Nombre, U.Apellido, E.RazonSocial, L.Email, L.Pass, 
                    IFNULL (U.id, E.id) AS IdCliente,
                    IFNULL(U.direccion, E.direccion) AS Direccion, 
                    IFNULL(U.telefono, E.telefono) AS Telefono 
                FROM login AS L 
                LEFT JOIN clientes_usuario AS U ON L.idClienteUsuario = U.id 
                LEFT JOIN clientes_empresa AS E ON L.idClienteEmpresa = E.id 
                WHERE L.idUsuario = $id";

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado); //Recupera una fila de resultados como un array asociativo
    } else {
        return [];
    }
}


/*****************************************************************************
 *                INSERTAR USUARIO EN LA TABLA SEGUN EL ROL
 *****************************************************************************/
function insertUsuario($rol, $usuario)
{

    global $conexion;

    if ($rol == 1) { //TRIM()permite eliminar caracteres o espacios específicos del principio,del final o de ambos extremos de una cadena
        $razonSocial = trim($usuario['RazonSocial']);
        $direccion = trim($usuario['Direccion']);
        $telefono = trim($usuario['Telefono']);
        $email = trim(strtolower($usuario['Email']));
        $pass = trim($usuario['Pass']);

        $consulta = "INSERT INTO clientes_empresa ( RazonSocial, Direccion, Telefono )
        VALUES ( '$razonSocial', '$direccion', '$telefono' );";

        mysqli_query($conexion, $consulta);

        $ultimo_id = mysqli_insert_id($conexion);

        $consulta = "INSERT INTO login (Rol, idClienteEmpresa, Email, Pass, Estado )
            VALUES ( $rol, $ultimo_id, '$email', '$pass', 1 );";

        mysqli_query($conexion, $consulta);
    } else if ($rol == 0) {
        $nombre = trim($usuario['Nombre']);
        $apellido = trim($usuario['Apellido']);
        $direccion = trim($usuario['Direccion']);
        $telefono = trim($usuario['Telefono']);
        $email = trim(strtolower($usuario['Email'])); // strtolower : Poner una cadena en minúsculas
        $pass = trim($usuario['Pass']);

        $consulta = "INSERT INTO clientes_usuario ( Nombre, Apellido, Direccion, Telefono )
        VALUES ( '$nombre', '$apellido', '$direccion', '$telefono' );";

        mysqli_query($conexion, $consulta);

        $ultimo_id = mysqli_insert_id($conexion);

        $consulta = "INSERT INTO login (Rol, idClienteUsuario, Email, Pass, Estado )
            VALUES ( $rol, $ultimo_id, '$email', '$pass', 1 );";

        mysqli_query($conexion, $consulta);
    }

    return mysqli_affected_rows($conexion);
}

/*****************************************************************************
 *                ACTUALIZO EL USUARIO EN LA TABLA SEGUN EL ID
 *****************************************************************************/
function UpdateUsuario($usuario)
{

    global $conexion;
    $id = $usuario['Id'];
    $rol = $usuario['Rol'];
    $idCliente = $usuario['IdCliente'];
    $nombre = trim($usuario['Nombre']);
    $apellido = trim($usuario['Apellido']);
    $razonSocial = trim($usuario['RazonSocial']);
    $direccion = trim($usuario['Direccion']);
    $telefono = trim($usuario['Telefono']);
    $email = trim(strtolower($usuario['Email']));
    $pass = trim($usuario['Pass']);

    $consulta1 = "UPDATE login
                SET Email = '$email', Pass = '$pass' 
                WHERE IdUsuario = $id";

    if ($rol == 1) {
        $consulta2 = "UPDATE clientes_empresa
                    SET  RazonSocial = '$razonSocial', Direccion = '$direccion', Telefono = '$telefono' 
                    WHERE id = $idCliente";
    } else if ($rol == 0) {
        $consulta2 = "UPDATE clientes_usuario 
                    SET Nombre = '$nombre', Apellido = '$apellido', Direccion = '$direccion', Telefono = '$telefono' 
                    WHERE id = $idCliente";
    }

    mysqli_query($conexion, $consulta1);
    //mysql_affected_rows: Obtener el número de filas afectadas en la operación anterior de MySQL
    $affectedRows = mysqli_affected_rows($conexion);
    mysqli_query($conexion, $consulta2);
    $affectedRows += mysqli_affected_rows($conexion);

    return $affectedRows;
}

/*****************************************************************************
 *                ELIMINO EL USUARIO EN LA TABLA SEGUN EL ID
 *****************************************************************************/
function DeleteUsuario($usuario)
{

    global $conexion;

    $id = $usuario['Id'];
    $rol = $usuario['Rol'];
    $idCliente = $usuario['IdCliente'];

    $consulta1 = "DELETE FROM login
                WHERE IdUsuario = $id";

    if ($rol == 1) {
        $consulta2 = "DELETE FROM clientes_empresa
                    WHERE id = $idCliente";
    } else if ($rol == 0) {
        $consulta2 = "DELETE FROM clientes_usuario 
                    WHERE id = $idCliente";
    }

    mysqli_query($conexion, $consulta1);
    $affectedRows = mysqli_affected_rows($conexion);
    mysqli_query($conexion, $consulta2);
    $affectedRows += mysqli_affected_rows($conexion);
    return $affectedRows;
}
