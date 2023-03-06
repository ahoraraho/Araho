<?php

function inpuntAdmin()
{
    echo "
    <li><a id='nonne' href='?m=panel&mod=ventas'><i class='bi-calendar2-event'></i><span>Ventas</span></a></li>
	<li><a id='nonne' href='?m=panel&mod=productos'><i class='bi-box-seam'></i><span>Productos</span></a></li>
	<li><a id='nonne' href='?m=panel&mod=categorias'><i class='bi-tags'></i><span>Categorias</span></a></li>
	<li><a id='nonne' href='?m=panel&mod=marcas'><i class='bi-view-list'></i><span>Marcas</span></a></li>
	<li><a id='nonne' href='?m=panel&mod=usuarios'><i class='bi bi-people'></i><span>Usuarios</span></a></li>
	";
}

function inpuntUser()
{
    echo "
    <li class='nav-main'><a href='?m=ubicacion'><i class='bi bi-pin-map-fill'></i><span>Ubicacion</span></a> </li>
	<li class='nav-main'> <a href='?m=contacto'><i class='bi bi-chat-left-text'></i><span>Contacto</span></a> </li>
	<li class='nav-main'> <a href='?m=nosotros'><i class='bi bi-text-indent-left'></i><span>Nosotros</span></a> </li>
	<li><a id='nonne' href='?m=panel&mod=compras'><i class='bi bi-handbag'></i><span>Compras</span></a></li>
	<li class='nav-main'><a href='#'><i class='bi bi-tags'></i><span>Categorias</span></a>
		    <ul class='nav-lista '>";
    $categorias = selectCategorias();
    foreach ($categorias as $categoria) {
        $nombre = $categoria['Nombre'];
        echo "<li> <a href='?m=productos&buscar=categorias&categoria=<?= $nombre ?>'><span><?= $nombre ?></span></a></li>";
    }
    echo "  </ul>
	</li>";
}

function optionsCategoria()
{
    $categorias = selectCategorias();
    foreach ($categorias as $categoria) {
        $nombre = $categoria['Nombre'];
        echo "<li> <a href='?m=productos&buscar=categorias&categoria=<?= $nombre ?>'><span><?= $nombre ?></span></a></li>";
    }
}
