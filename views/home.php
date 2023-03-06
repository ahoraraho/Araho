<?php
// Si es administrador no va a comprar
if (isset($_SESSION["Usuario"]) && $_SESSION["Usuario"]["Administrador"] == 1) {
	header('location: ?m=panel&mod=ventas');
}
if (isset($_GET["mesage"])) {
	$mesage = $_GET["mesage"];
	switch ($mesage) {
		case 'ok':
			alertaResponDialog("msj-ok", "Producto añadifo al carrito", "bi-check-circle");
			break;
		case 'nok';
			alertaResponDialog("msj-warning", "Ya existe una cuenta con ese email", "bi-dash-circle");
			break;
		default:
			alertaResponDialog("msj-warning", "Algo salio mal", "bi-dash-circle");
			break;
	}
}
?>
<!-- PRODUCTOS DESTACADOS -->
<div class="cccc">
	<div class="productos">
		<h3>PRODUCTOS DESTACADOS </h3>
		<a class="view-all" href="?m=productos&buscar=destacados"> Ver todos</a>
	</div><br>

	<div class="grid-productos">
		<!-- Productos -->
		<?php
		if (isset($_GET['item'])) {
			$id = $_GET['item'];
		}
		$productos = selectProductos('destacados', '', '', '', 1, 8);
		foreach ($productos as $producto) {
			$id = $producto['idProducto'];
			$nombre = $producto['Nombre'];
			$precio = $producto['Precio'];
			$imagen = $producto['Imagen'];
			$presentacion = $producto['Presentacion'];
			$stock = $producto['Stock'];
		?>
			<div class="item-grid-productos">
				<a href="?m=producto&item=<?= $id ?>">
					<h3 class="nombre-producto"><?= $nombre ?></h3>
					<div class="imas">
						<img loading="lazy" class="img-grid-productos" src="img/productos/<?= $imagen ?>" alt="<?= $nombre ?>" />
					</div>
					<div class="detalle-grid-productos">
						<span>S/. <?= $precio ?></span><br>
						<p><?= $presentacion ?></p><br>
						<p style="text-align: end;">Stock <?= $stock ?></p>
					</div>
					<!--<input class="btn-a-anadir" type="submit" value="Ver detalles" style="width: 94%; " name="addCart">-->
				</a>
			</div>
		<?php } ?>
	</div>
</div>
<!-- ULTIMOS PRODUCTOS -->
<div class="cccc">
	<div class="productos">
		<h3>ULTIMOS PRODUCTOS </h3>
		<a class="view-all" href="?m=productos&buscar=all"> Ver todos</a>
	</div><br>
	<div class="grid-productos">
		<!-- Productos -->
		<?php
		$productos = selectProductos('all', '', '', '', 1, 8);

		foreach ($productos as $producto) {
			$id = $producto['idProducto'];
			$nombre = $producto['Nombre'];
			$precio = $producto['Precio'];
			$imagen = $producto['Imagen'];
			$presentacion = $producto['Presentacion'];
			$stock = $producto['Stock'];
		?>
			<div class="item-grid-productos">
				<a href="?m=producto&item=<?= $id ?>">
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
<!-- PRODUCTOS EN TENDENCIA -->
<div class="cccc">
	<div class="productos">
		<h3>TENDENCIA </h3>
		<a class="view-all" href="?m=productos&buscar=tendencia"> Ver todos</a>
	</div><br>
	<div class="grid-productos">
		<!-- Productos -->
		<?php
		$productos = selectProductos('tendencia', '', '', '', 1, 4);

		foreach ($productos as $producto) {
			$id = $producto['idProducto'];
			$nombre = $producto['Nombre'];
			$precio = $producto['Precio'];
			$imagen = $producto['Imagen'];
			$presentacion = $producto['Presentacion'];
			$stock = $producto['Stock'];
		?>
			<div class="item-grid-productos">
				<a href="?m=producto&item=<?= $id ?>">
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