<?php

if (!$_SESSION["Usuario"]["Administrador"]) {
    header('location: ./');
}

list($filtro, $pagina, $orden, $categoria, $marca, $limite) = getFiltroPaginaOrdenCategoriaLimite();

$cantidad_marcas = countMarca($filtro);

$paginas_total = ceil($cantidad_marcas / $limite);

?>
<!-- ruta de acceso guia -->
<div class="ruta">
    <a href="./" title="Home" class="tip-bottom"><i class="bi bi-house"></i> Home</a>
    <a href="#" title="Estas aqui" class="active"><i class="bi bi-view-list"></i> Marcas</a>
</div>
<?php
if (isset($_GET['msj'])) {
    $msj = $_GET['msj'];
    $typeMsj = "";
    switch ($msj) {
        case '0x10':
            $msj = "Marca agregada!";
            $typeMsj = "msj-ok";
            $iconoAlert = "bi-check-circle";
            break;
        case '0x20':
            $msj = "Marca actualizada!";
            $typeMsj = "msj-ok";
            $iconoAlert = "bi-check2-circle";
            break;
        case '0x30':
            $msj = "Marca eliminada!";
            $typeMsj = "msj-warning";
            $iconoAlert = "bi-info-circle";
            break;
        case '0x1000':
            $msj = "Hubo un error al intentar realizar la operación!";
            $typeMsj = "msj-error";
            $iconoAlert = "bi-bug";
            break;
    }
    alertaResponDialog($typeMsj, $msj, $iconoAlert);
}
?>

<h3>Marcas</h3>

<div class="numm">
    <div class="f1">
        <form class="from_input" action="" method="GET">
            <!-- para agregar la vista de ?menu=productos en la url -->
            <input type="hidden" name="menu" value="panel">
            <input type="hidden" name="modulo" value="marcas">
            <!-- concatenando el valor a buscar -->
            <input type="text" name="buscar" value="" placeholder="Buscar...">
            <!-- <input type="submit" value="BUSCAR"> -->
            <button class="btn-buscador" type="submit"><i class="bi-search"></i></button>
        </form>
        <span class="f-s"><?= $cantidad_marcas ?> </span>
    </div>
    <div class="f2">
        <a href="?menu=panel&modulo=marca&action=add" class="button-link btn-new f-e">
            <i class="abi bi bi-plus-square"></i><span>Nueva Marca</span>
        </a>
    </div>
</div>

<div class="contenido-tabla">
    <table class="responsive-marcas">
        <thead>
            <tr>
                <th>Id Marca</th>
                <th>Nombre Marca</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $marcas = selectMarcasConPaginas($filtro, $pagina, $limite);

            foreach ($marcas as $marca) {
                $id = $marca['idMarca'];
                $nombre = $marca['Nombre'];
            ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $nombre ?></td>
                    <td>
                        <a href="?menu=panel&modulo=marca&action=update&id=<?= $id ?>" title="Modificar"><i class="bi bi-pencil-square" style="color:rgb(32, 55, 96);font-size: 30px; margin-right: 20px;"><b> </i></a>
                        <a href="?menu=panel&modulo=marca&action=delete&id=<?= $id ?>" title="Eliminar"><i class="bi bi-trash" width="30" height="30" style="color: red; font-size: 30px;;"><b></i></a>
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
            <input type="hidden" name="modulo" value="marcas">
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
        createPaginationLogueado($paginas_total, $pagina, $filtro, $orden, $limite, "marcas");
        ?>
    </div>
</div>