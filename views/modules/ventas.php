<?php

if (!$_SESSION["Usuario"]["Administrador"]) {
    header('location: ./');
}

$usuario = $_SESSION["Usuario"];
$idUsuario = $usuario["Id"];
// Valido que haya una accion por GET



if (isset($_GET['buscar'])) {
    $filtro = $_GET['buscar'];
    if ($filtro == '') {
        $filtro = 'all';
    }
} else {
    $filtro = 'all';
}

if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}
if (isset($_GET['orden'])) {
    $orden = $_GET['orden'];
} else {
    $orden = '';
}
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $filtro = $categoria;
} else {
    $categoria = '';
}
if (isset($_GET['limite'])) {
    $limite = $_GET['limite'];
} else {
    $limite = 10;
}

$numero_ventas = countVenta();

$paginas_total = ceil($numero_ventas / $limite);




$productosVentas = SelectVentasAll($pagina, $limite);
if (!empty($productosVentas)) {
?>
    <div class="ruta">
        <a href="./" title="Home"><i class="bi bi-house"></i> Home</a>
        <a href="#" title="Estas justo aqui" class="active"><i class="bi bi-calendar2-event"></i> Ventas</a>
    </div>
    <?php if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $idVenta = $_GET["idVenta"];

    switch ($action) {
        case 'porentregar':
            UpdateVentaEstado($idVenta, 'por entregar');
            //header('location: ?menu=panel&modulo=ventas');
            alertaResponDialog("msj-warning", "Estado del producto, por entregar", "bi-exclamation-circle");
            break;

        case 'entregado':
            UpdateVentaEstado($idVenta, 'entregado');
            //header('location: ?menu=panel&modulo=ventas');
            alertaResponDialog("msj-ok", "Estado del producto, entregado", "bi-check-circle");
            break;
    }
} ?>
    <h3>Ventas</h3>
    
    <div class="numm">
        <div class="f1">
            <span class="f-s"> Total: <?= $numero_ventas  ?> </span>
        </div>
    </div>
    <div class="contenido-tabla">
        <table class="responsive-ventas">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sinStock = false;
                $isValidBuy = true;

                foreach ($productosVentas as $producto) {
                    $idVenta = $producto["id"];
                    $fecha = $producto["fecha"];
                    $cliente = $producto["cliente"];
                    $idProducto = $producto["idProducto"];
                    $nombre = $producto["nombre"];
                    $cantidad = $producto["cantidad"];
                    $precio = $producto["precio"];
                    $total = $producto["total"];
                    $estado = $producto["estado"];
                    $stock = $producto["stock"];

                    if ($cantidad > $stock) {
                        $sinStock = true;
                        $isValidBuy = false;
                    } else {
                        $sinStock = false;
                    }
                ?>
                    <tr>
                        <td><?= $idVenta ?></td>
                        <td><?= $fecha ?></td>
                        <td><?= $cliente ?></td>
                        <td><?= $nombre ?></td>
                        <td><?= $cantidad ?></td>
                        <td>S/. <?= $precio ?></td>
                        <td>S/. <?= $total ?></td>
                        <?php
                        if ($estado == "por entregar") {
                            echo "<td style='color:slateblue;'><strong> $estado </strong></td>";
                        } else {
                            echo "<td style='color:limegreen;'><strong> $estado </strong></td>";
                        }
                        ?>
                        <td>
                            <a href="?menu=panel&modulo=ventas&action=entregado&idVenta=<?= $idVenta ?>" title="Entregado"><i class="bi bi-bag-check-fill" style="color:limegreen; padding:5px; font-size: 30px; text-align:center;"></i></a>
                            <a href="?menu=panel&modulo=ventas&action=porentregar&idVenta=<?= $idVenta ?>" title="Por Entregar"><i class="bi bi-hourglass-split" style="color:slateblue; padding:5px; font-size: 30px; text-align:center;"></i></a>
                        </td>
                    </tr>
                <?php   } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="conten">
        <h3 style="margin: 20px">Aún no se realizó ninguna venta</h3>
    </div>
<?php
}
?>

<div class="piePagina">
    <div class="derecha">
        <form class="num_paginas--filtro" action="" method="GET">
            <input type="hidden" name="menu" value="panel">
            <input type="hidden" name="modulo" value="ventas">
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
        createPaginationLogueado($paginas_total, $pagina, $filtro, $orden, $limite, "ventas");
        ?>
    </div>
</div>

