<?php

// Si es administrador no va a comprar
if (isset($_SESSION["Usuario"]) && $_SESSION["Usuario"]["Administrador"] == 1) {
	header('location: ?menu=panel&modulo=ventas');
}
// Valido que tipo de petición invoca al módulo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Compruebo si se inició sesión
	if (!isset($_SESSION["Usuario"])) {
		header('location: ?menu=ingreso');
		die();
	}
	$id = $_POST["id"];
	$stock = $_POST["stock"];
	// Aquí se deben procesar los datos del formulario ejecutado
	$usuario = $_SESSION["Usuario"];
	$idCliente = $usuario["Id"];

	if (isset($_POST['addCart'])) {
		if ($stock >= 1) {
			if (procesarAddCarrito($id, $idCliente)) {
				alertaResponDialog("msj-ok", "Producto añadifo al carrito", "bi-check");
			} //funcion para añadir un porducto al carrito de compras
		} else {
			alertaResponDialog("msj-error", "No hay stock del producto elegido!!!", "bi-exclamation-circle");
		}
	}
}

$more = 'Todos';
if (isset($_GET['item'])) {
	$id = $_GET['item'];
}
if (isset($_GET['m'])) {
	$more = $_GET['m'];
	// $text_lowercase = strtolower($more);
	// $more= ucwords($text_lowercase);
}
if (isset($_GET['f'])) {
	$fil = $_GET['f'];
	// $text_lowercase = strtolower($more);
	// $more= ucwords($text_lowercase);
} else {
	$fil = "Ninguno";
}


$producto = selectProducto($id);
if ($producto) {
?>
	<div class="contenRutaOut">
		<div class="enrutador">
			<a href="./" title="Ir a inicio">Inicio<i class="iconoNext"></i></a>
			<a id="back" title="Ir a <?= $more ?>"><?= $more ?><i class="iconoNext"></i></a>
			<a title="Filtro"><?= $fil ?><i class="iconoNext"></i></a>
			<a title="Estas justo aqui"> <?= $producto['Nombre'] ?></a>
		</div>
	</div>

	<div class="conten-producto">
		<!-- <div class="backBuuton">
		<a id="back" title="Back"><i class="bi bi-arrow-left"></i></a>
	</div> -->
		<div class="item-grid-producto">
			<!-- producto -->
			<?php
			//$producto = selectProducto($id);

			$id = $producto['idProducto'];
			$nombre = $producto['Nombre'];
			$precio = $producto['Precio'];
			$marca = $producto['NombreMarca'];
			$categoria = $producto['NombreCategoria'];
			$presentacion = $producto['Presentacion'];
			$descripcion = $producto['Descripcion'];
			$stock = $producto['Stock'];
			$imagen = $producto['Imagen'];

			?>
			<div class="detalle-imagen">
				<img id="myImg" alt="<?= $nombre ?>" class="image" src="img/productos/<?= $imagen ?>" />
			</div>
			<div class="diFlexDescription">
				<div class="detalle-descripcion">
					<h2><?= $nombre ?></h2>
					<h2 class="precio">S/. <?= $precio ?></h2>
					<h4 class="stock"><?= $stock ?> unid. en stock</h4>
					<p><?= "Categoría: $categoria | Marca: $marca | Presentación: $presentacion" ?></p>
					<p><?= $descripcion ?></p>
					<form action="" method="POST">
						<input type="hidden" name="id" value="<?= $id ?>">
						<input type="hidden" name="stock" value="<?= $stock ?>">
						<input class="btn-a-anadir" type="submit" value="Agregar al Carrito" name="addCart">
					</form>
				</div>
			</div>
		<?php }	?>
		</div>
	</div>

	<div id="myModal" class="modal">
		<span class="close"><i class="bi bi-x"></i></span>
		<img class="modal-content" id="img01">
		<div id="caption"></div>
	</div>