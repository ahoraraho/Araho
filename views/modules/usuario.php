<?php
// Valido que el usuario sea administrador
if (!$_SESSION["Usuario"]["Administrador"]) {
    header('location: ./');
}

// Valido que haya una accion a realizar, sino se irá a crear un nuevo producto
if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "add";
}

// Valido que tipo de peticion invoca al modulo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aca se deben procesar los datos del formulario ejecutado
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    switch ($action) {
        case 'add':

            $msj = "0x1000";
            $affectedRows = InsertClientesUsuario($nombre, $apellido, $direccion, $telefono);
            if ($affectedRows > 0) {
                $msj = "0x10";
            }
            break;

        case 'update':

            $msj = "0x20";
            $affectedRows = UpdateClientesUsuario($id, $nombre, $apellido, $direccion, $telefono);
            if ($affectedRows == 0) {
                $msj = "0x1000";
            }
            break;

        case 'delete':
            $msj = "0x1000";
            if (DeleteClientesUsuario($id) > 0) {
                //unlink("img/productos/" . $imagenActual);
                $msj = "0x30";
            }
            break;
    }
    header('location: ?menu=panel&modulo=usuarios&msj=' . $msj);
} else {
    // Preparar el formulario para: Agregar - Modificar - Eliminar
    switch ($action) {
        case 'add':
            //optiene el id mayor de la tabla categorias
            $maxid = MayorIdClientesUsuario();
            foreach ($maxid as $iddd) {
                $id = $iddd["maxId"];
            }
            $id = ($id + 1);
            $btn = "Agregar";
            $status = null;
            $cliente_usuario = array(
                "id" => $id,
                "nombre" => "",
                "apellido" => "",
                "direccion" => "",
                "telefono" => ""

            );
            break;

        case 'update':
            $id = $_GET["id"];
            $btn = "Actualizar";
            $status = "readonly";
            $cliente_usuario = selectClientesUsuario($id);
            break;

        case 'delete':
            $id = $_GET["id"];
            $btn = "Eliminar";
            $status = "disabled";
            $cliente_usuario = selectClientesUsuario($id);
            break;
    }
}
?>
<?php
switch ($btn) {
    case 'Eliminar':
        $style = "background-color:crimson";
        $styleImage = "display: none !importans; ";
        $hacer = "Eliminar Usuario";
        $icono = "bi bi-trash";
        break;
    case 'Agregar':
        $style = "background-color:rgb(0, 176, 26)";
        $hacer = "Agregar Usuario";
        $icono = "bi bi-plus-square";
        break;
    case 'Actualizar':
        $style = "background-color:rgb(9, 109, 149)";
        $hacer = "Ver Usuario";
        $icono = "bi bi-binoculars";
        break;
    default:
        # code...
        break;
}
?>
<div class="ruta">
    <a href="./" title="Home"><i class="bi bi-house"></i> Home</a>
    <a href="?menu=panel&modulo=usuarios" title="Ir a Usuarios"><i class="bi bi-people"></i> Usuarios</a>
    <a href="#" title="Estas justo aqui" class="active"><i class="<?= $icono ?>"></i> <?= $hacer ?></a>
</div>

<div class="formularios">
    <div class="entradas">
        <h3>Usuario</h3>
        <div class="main">
            <div class="formm">
                <form action="?menu=panel&modulo=usuario&action=<?= $action ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $cliente_usuario["id"]; ?>">
                    <i class="bi bi-qr-code"></i><span>Id Usuario</span>
                    <input class="noEdid" title="Edicion no permitida" required type="text" name="Nombre" value="<?= $cliente_usuario["id"]; ?>" <?= $status ?>>
                    <i class="bi bi-person-lines-fill"></i></i><span>Nombre </span>
                    <input class="noEdid" title="Edicion no permitida" required type="text" name="nombre" value="<?= $cliente_usuario["nombre"]; ?>" <?= $status ?>>
                    <i class="bi bi-credit-card-2-front"></i><span>Apellido </span>
                    <input class="noEdid" title="Edicion no permitida" required type="text" name="apellido" value="<?= $cliente_usuario["apellido"]; ?>" <?= $status ?>>
                    <i class="bi bi-pin-map"></i><span>Dirección </span>
                    <input class="noEdid" title="Edicion no permitida" required type="text" name="direccion" value="<?= $cliente_usuario["direccion"]; ?>" <?= $status ?>>
                    <i class="bi bi-phone"></i><span>Teléfono </span>
                    <input class="noEdid" title="Edicion no permitida" required type="number" name="telefono" value="<?= $cliente_usuario["telefono"]; ?>" <?= $status ?>>
                    <i class="bi bi-envelope"></i><span>Email </span>
                    <input class="noEdid" title="Edicion no permitida" required type="email" name="email" value="<?= $cliente_usuario["Email"]; ?>" <?= $status ?>>

                </form>
            </div>
        </div>
    </div>
</div>