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
    $id = $_POST["id"];
    $nombre = $_POST["Nombre"];

    switch ($action) {
        case 'add':

            $msj = "0x1000";
            $affectedRows = InsertMarca($nombre);
            if ($affectedRows > 0) {
                $msj = "0x10";
            }
            break;

        case 'update':

            $msj = "0x20";
            $affectedRows = UpdateMarca($id, $nombre);
            if ($affectedRows == 0) {
                $msj = "0x1000";
            }
            break;

        case 'delete':
            $msj = "0x1000";
            if (DeleteMarca($id) > 0) {
                //unlink("img/productos/" . $imagenActual);
                $msj = "0x30";
            }
            break;
    }
    header('location: ?menu=panel&modulo=marcas&msj=' . $msj);
} else {
    // Preparar el formulario para: Agregar - Modificar - Eliminar
    switch ($action) {
        case 'add':
            //optiene el id mayor de la tabla categorias
            $maxid = MayorIdMarca();
            foreach ($maxid as $iddd) {
                $id = $iddd["maxId"];
            }
            $id = ($id + 1);
            $btn = "Agregar";
            $status = null;
            $marca = array(
                "idMarca" => $id,
                "Nombre" => ""
            );
            break;

        case 'update':
            $id = $_GET["id"];
            $btn = "Actualizar";
            $status = null;
            $marca = selectMarca($id);
            break;

        case 'delete':
            $id = $_GET["id"];
            $btn = "Eliminar";
            $status = "disabled";
            $marca = selectMarca($id);
            break;
    }
}
?>
<?php
switch ($btn) {
    case 'Eliminar':
        $style = "background-color:crimson";
        $styleImage = "display: none !importans; ";
        $hacer = "Eliminar Marca";
        $icono = "bi bi-trash";
        break;
    case 'Agregar':
        $style = "background-color:rgb(0, 176, 26)";
        $hacer = "Agregar Marca";
        $icono = "bi bi-plus-square";
        break;
    case 'Actualizar':
        $style = "background-color:rgb(9, 109, 149)";
        $hacer = "Actualizar Marca";
        $icono = "bi bi-pencil-square";
        break;
    default:
        # code...
        break;
}
?>
<div class="ruta">
    <a href="./" title="Home"><i class="bi bi-house"></i> Home</a>
    <a href="?menu=panel&modulo=marcas" title="Ir a Marcas"><i class="bi bi-view-list"></i> Marcas</a>
    <a href="#" title="Estas justo aqui" class="active"><i class="<?= $icono ?>"></i> <?= $hacer ?></a>
</div>
<div class="formularios">
    <div class="entradas">
        <h3>Marca</h3>
        <div class="main">
            <div class="formm">
                <form action="?menu=panel&modulo=marca&action=<?= $action ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $marca["idMarca"]; ?>">
                    <i class="bi bi-qr-code-scan"></i><span>Id Marca</span>
                    <input id="noEdid" title="No se puede modificar" disabled required type="text" name="Nombre" value="<?= $marca["idMarca"] ?>" <?= $status ?>>
                    <i class="bi bi-menu-button-fill"></i><span>Nombre</span>
                    <input required type="text" name="Nombre" value="<?= $marca["Nombre"] ?>" <?= $status ?>>

                    <br><br>
                    <button type="submit" name="action" id="ac" style="<?= $style ?>" class="form_login"><?= $btn; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>