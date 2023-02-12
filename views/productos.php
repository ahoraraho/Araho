<?php
// Si es administrador no va a comprar
if (isset($_SESSION["Usuario"]) && $_SESSION["Usuario"]["Administrador"] == 1) {
    header('location: ?menu=panel&modulo=ventas');
}

list($filtro, $pagina, $orden, $categoria, $marca, $limite) = getFiltroPaginaOrdenCategoriaLimite();

$cantidad_productos = countProductos($filtro);

$paginas_total = ceil($cantidad_productos / $limite);

$urlProductosFiltrado = "?menu=productos&limite=" . $limite . "&pag=" . $pagina . "&buscar=" . $filtro;


switch ($filtro) {
    case 'all':
        $filtroRuta = "Ultimos productos";
        break;
    case 'destacados':
        $filtroRuta = "Productos destacados";
        break;
    case 'tendencia':
        $filtroRuta = "Productos en tendencia";
        break;
    default:
        $text_lowercase = strtolower($filtro);
        $filtroRuta = ucwords($text_lowercase);
        break;
}

switch ($orden) {
    case '':
        $ordenFiltro = "Mas recientes";
        break;
    case 'z-a':
        $ordenFiltro = "Z ⇌ A";
        break;
    case 'a-z':
        $ordenFiltro = "A ⇌ Z";
        break;
    default:
        $ordenFiltro = ucwords($orden);
        break;
}

//$text_lowercase = strtolower($orden);


?>
<div class="contenRutaOut">
    <div class="enrutador">
        <a href="./" title="Ir a inicio">Inicio<i class="iconoNext"></i></a>
        <a title="Estas justo aqui"> <?= $filtroRuta ?><i class="iconoNext"></i></a>
        <a title="Filtro"> <?= $ordenFiltro ?></a>
    </div>
</div>

<!-- nav productos -->
<div class="filtros">
    <h4><?= $filtroRuta ?> = <span><?= $cantidad_productos ?> Articulos encontrados</span></h4>
    <?php if ($cantidad_productos > 1) { ?>
        <h5>Ordenar por: </h5>
        <ul class="order-nav">
            <li><a class="<?= ($orden == 'a-z') ? 'active' : ''; ?>" href="<?= $urlProductosFiltrado ?>&orden=a-z">A ⇌ Z</a></li>
            <li><a class="<?= ($orden == 'z-a') ? 'active' : ''; ?>" href="<?= $urlProductosFiltrado ?>&orden=z-a">Z ⇋ A</a></li>
            <li><a class="<?= ($orden == '') ? 'active' : ''; ?>" href="<?= $urlProductosFiltrado ?>"> Más recientes</a></li>
            <li><a class="<?= ($orden == 'tendencia') ? 'active' : ''; ?>" href="<?= $urlProductosFiltrado ?>&orden=tendencia">Tendencias</a></li>
            <li><a class="<?= ($orden == 'menor-precio') ? 'active' : ''; ?>" href="<?= $urlProductosFiltrado ?>&orden=menor-precio">Menor precio</a></li>
            <li><a class="<?= ($orden == 'mayor-precio') ? 'active' : ''; ?>" href="<?= $urlProductosFiltrado ?>&orden=mayor-precio">Mayor precio</a></li>
        </ul>
    <?php } ?>
</div>
<div class="cccc">
    <!-- productos -->
    <div class="grid-productos ">
        <!-- Producto -->
        <?php
        $productos = selectProductos($filtro, $orden, $categoria, $marca, $pagina, $limite);
        //$productos = selectProductos('productos-destacados', '', 1, 8);
        foreach ($productos as $producto) {
            $id = $producto['idProducto'];
            $nombre = $producto['Nombre'];
            $precio = $producto['Precio'];
            $imagen = $producto['Imagen'];
            $presentacion = $producto['Presentacion'];
            $stock = $producto['Stock'];
        ?>
            <div class="item-grid-productos">
                <a href="?menu=producto&m=<?= $filtroRuta ?>&f=<?= $ordenFiltro ?>&item=<?= $id ?>">
                    <h3 class="nombre-producto"><?= $nombre ?></h3>
                    <div class="imas">
                        <img class="img-grid-productos" src="img/productos/<?= $imagen ?>" alt="<?= $nombre ?>" />
                    </div>
                    <div class="detalle-grid-productos">
                        <span>S/. <?= $precio ?></span><br>
                        <p><?= $presentacion ?></p>
                        <p style="text-align: end;">Stock <?= $stock ?></p>
                    </div>
                    <!--<input class="btn-a-anadir" type="submit" value="Ver detalles" style="width: 94%; " name="addCart">-->
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<div class="piePagina">
    <div class="derecha">
        <form class="num_paginas--filtro" action="" method="GET">
            <input type="hidden" name="menu" value="productos">
            <!-- <input type="hidden" name="modulo" value="productos"> -->
            <input type="hidden" name="buscar" value="<?= $filtro ?>">
            <input type="hidden" name="orden" value="<?= $orden ?>">
            <select class="form-select" name="limite">
                <option <?= ($limite == '10') ? 'selected' : ''; ?> value="10">10</option>
                <option <?= ($limite == '8') ? 'selected' : ''; ?> value="8">8</option>
                <option <?= ($limite == '6') ? 'selected' : ''; ?> value="6">6</option>
                <option <?= ($limite == '4') ? 'selected' : ''; ?> value="4">4</option>
            </select>
            <button onclick="filtrardorAlfabeto()" title="Numero de productos" class="btn-filtro-num" type="submit">
                <i class="bi bi-sliders"></i>
            </button>
        </form>
    </div>
    <div class="izquierda">
        <?php
        createPagination($paginas_total, $pagina, $filtro, $orden, $limite);
        ?>
    </div>
</div>