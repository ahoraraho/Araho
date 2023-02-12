<?php

if (!$_SESSION["Usuario"]["Administrador"]) {
    header('location: ./');
}

if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}

$filtro = "";
$orden = "";

if (isset($_GET['buscar'])) {
    $filtro = $_GET['buscar'];
    if ($filtro == '') {
        $filtro = 'todos-los-productos';
    }
}
if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}
if (isset($_GET['order'])) {
    $orden = $_GET['order'];
} else {
    $orden = '';
}
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $filtro = $categoria;
} else {
    $categoria = '';
}

$cantidad_usuarios = countClienteUsuario();

$limite = 10; // CANTIDAD DE MARCAS POR PÁGINA

$paginas_total = ceil($cantidad_usuarios / $limite);

?>
<!-- ruta de acceso guia -->
<div class="ruta">
    <a href="./" title="Home" class="tip-bottom"><i class="bi bi-house"></i> Home</a>
    <a href="#" title="Estas justo aqui" class="active"><i class="bi bi-people"></i> Usuarios</a>
</div>
<?php
if (isset($_GET['msj'])) {
    $msj = $_GET['msj'];
    $typeMsj = "";
    switch ($msj) {
        case '0x10':
            $msj = "Usuario agregado!";
            $typeMsj = "cajaMsj msj-ok";
            break;
        case '0x20':
            $msj = "Usuario actualizado!";
            $typeMsj = "cajaMsj msj-ok";
            break;
        case '0x30':
            $msj = "Usuario eliminado!";
            $typeMsj = "cajaMsj msj-warning";
            break;
        case '0x1000':
            $msj = "Hubo un error al intentar realizar la operación!";
            $typeMsj = "cajaMsj msj-error";
            break;
    }
?>
    <!-- mensaje -->
    <div class="formularios">
        <div class="entradas">
            <div class="<?= $typeMsj ?>"><?= $msj ?></div>
        </div>
    </div>
<?php
}
?>
<h3>Usuarios</h3>
<div class="numm">
    <div class="f1">
        <span class="f-s"> Total: <?= $cantidad_usuarios ?> </span>
    </div>
</div>
<!-- tabla usuarios -->
<div class="contenido-tabla">
    <table class="responsive-usuarios">
        <thead>
            <tr>
                <th>Id Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Email</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $clientes_usuarios = SelectClientesUsuarioPaginado($pagina, $limite);
            foreach ($clientes_usuarios as $cliente_usuario) {
                $id = $cliente_usuario['id'];
                $nombre = $cliente_usuario['nombre'];
                $apellido = $cliente_usuario['apellido'];
                $direccion = $cliente_usuario['direccion'];
                $telefono = $cliente_usuario['telefono'];
                $email = $cliente_usuario['Email'];
            ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $nombre ?></td>
                    <td><?= $apellido ?></td>
                    <td><?= $direccion ?></td>
                    <td><?= $telefono ?></td>
                    <td><?= $email ?></td>
                    <td>
                        <a href="?menu=panel&modulo=usuario&action=update&id=<?= $id ?>" title="Ver"><i class="edid bi-binoculars"><b> </i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="piePagina">
    <div class="derecha">
        <form class="num_paginas--filtro" action="" method="GET">
            <input type="hidden" name="menu" value="panel">
            <input type="hidden" name="modulo" value="usuarios">
            <input type="hidden" name="buscar" value="<?= $filtro ?>">
            <input type="hidden" name="orden" value="<?= $orden ?>">
            <select class="form-select" name="limite">
                <option <?= ($limite == '15') ? 'selected' : ''; ?> value="15">15</option>
                <option <?= ($limite == '10') ? 'selected' : ''; ?> value="10">10</option>
                <option <?= ($limite == '5') ? 'selected' : ''; ?> value="5">5</option>
            </select>
            <button onclick="filtrardorAlfabeto()" title="Numero de productos" class="btn-filtro-num" type="submit">
                <i class="bi bi-sliders"></i>
            </button>
        </form>
    </div>
    <div class="izquierda">
        <?php
        createPaginationLogueado($paginas_total, $pagina, $filtro, $orden, $limite, "usuarios");
        ?>
    </div>
</div>