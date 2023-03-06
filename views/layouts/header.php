<?php ob_start(); /*Esta función activará el búfer de salida. Mientras que el búfer de salida es activo no se envía 
ninguna salida desde el script ( que no sean encabezados ), en su lugar el la salida se almacena en un búfer interno.*/ ?>
<?php session_start(); ?>
<div class="detras"></div>
<nav>
	<div class="nav-bar">
		<i class='bi bi-list sidebarOpen'></i>
		<div class="logo">
			<a href="./" title="Araho">
				<i class="logo-img logo-light"></i>
				<b>RAHO</b>
			</a>
		</div>
		<div class="botones">
			<div class="menu">
				<div class="logo-toggle">
					<div class="logo">
						<a href="./" title="Araho">
							<i class="logg logo-img logo-light"></i>
							<b>RAHO</b>
						</a>
					</div>
					<i class='bi bi-x-lg siderbarClose'></i>
				</div>
				<ul class="nav-links">
					<?php
					if (isset($_SESSION["Usuario"])) {
						if ($_SESSION["Usuario"]["Administrador"]) { ?>
							<li><a id="nonne" href="?m=panel&modulo=ventas"><i class="bi-calendar2-event"></i><span>Ventas</span></a></li>
							<li><a id="nonne" href="?m=panel&modulo=productos"><i class="bi-box-seam"></i><span>Productos</span></a></li>
							<li><a id="nonne" href="?m=panel&modulo=categorias"><i class="bi-tags"></i><span>Categorias</span></a></li>
							<li><a id="nonne" href="?m=panel&modulo=marcas"><i class="bi-view-list"></i><span>Marcas</span></a></li>
							<li><a id="nonne" href="?m=panel&modulo=usuarios"><i class="bi bi-people"></i><span>Usuarios</span></a></li>
						<?php } else { ?>
							<li class="nav-main"> <a href="?m=ubicacion"><i class="bi bi-pin-map-fill"></i><span>Ubicacion</span></a> </li>
							<li class="nav-main"> <a href="?m=contacto"><i class="bi bi-chat-left-text"></i><span>Contacto</span></a> </li>
							<li class="nav-main"> <a href="?m=nosotros"><i class="bi bi-text-indent-left"></i><span>Nosotros</span></a> </li>
							<li><a id="nonne" href="?m=panel&modulo=compras"><i class="bi bi-handbag"></i><span>Compras</span></a></li>
							<li class="nav-main"><a href="#"><i class="bi bi-tags"></i><span>Categorias</span></a>
								<ul class="nav-lista Show">
									<?php
									$categorias = selectCategorias();
									foreach ($categorias as $categoria) {
										$nombre = $categoria["Nombre"]; ?>
										<li> <a href="?m=productos&buscar=categorias&categoria=<?= $nombre ?>"><span><?= $nombre ?></span></a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
						<li><a id="nonne" href="?m=panel&modulo=cuenta"><i class="bi-gear"></i><span>Configuracion</span></a></li>
						<div class="separado"></div>
						<li><a id="nonne" href="?m=panel&sesion=cerrar"><i class="bi-power"></i><span>Cerrar sesión</span></a></li>
					<?php } else { ?>
						<li class="nav-main"> <a href="?m=ubicacion"><i class="bi bi-pin-map-fill"></i><span>Ubicacion</span></a> </li>
						<li class="nav-main"> <a href="?m=contacto"><i class="bi bi-chat-left-text"></i><span>Contacto</span></a> </li>
						<li class="nav-main"> <a href="?m=nosotros"><i class="bi bi-text-indent-left"></i><span>Nosotros</span></a></li>
						<li class="nav-main"><a href="#"><i class="bi bi-tags"></i><span>Categorias</span></a>
							<ul class="nav-lista Show">
								<?php
								$categorias = selectCategorias();
								foreach ($categorias as $categoria) {
									$nombre = $categoria["Nombre"]; ?>
									<li> <a href="?m=productos&buscar=categorias&categoria=<?= $nombre ?>"><span><?= $nombre ?></span></a></li>
								<?php } ?>
							</ul>
						</li>
						<div class="inicios">
							<li> <a id="nonne" href="?m=ingreso"><button class="btn-ingreso">Sing In</button></a> </li>
							<li> <a id="nonne" href="?m=registro"><button class="btn-registro">Sign Up</button> </a> </li>
						</div>
					<?php } ?>
				</ul>
			</div>

			<?php if (!isset($_SESSION["Usuario"]) || $_SESSION["Usuario"]["Administrador"] == 0) { ?>
				<div class="carrito">
					<li>
						<a href="?m=carrito" title="Carrito">
							<div class="icone">
								<i class="bi-cart2" id="card"></i>
							</div>
							<?php // Compruebo si se inicio sesión
							if (isset($_SESSION["Usuario"])) {
								$usuario = $_SESSION["Usuario"];
								$idCliente = $usuario["Id"];
								$productosCarrito = SelectCarrito($idCliente);
								// compruebo si el usuario tiene productos en carrito
								if (!empty($productosCarrito)) { ?>
									<i class="bi bi-bell-fill campana"></i>
									<span><?= count($productosCarrito) ?></span>
							<?php }
							}
							?>
							</i>
						</a>
					</li>
				</div><?php } ?>
			<div class="dark-light">
				<i id="iconoTheme" class='bi-brightness-high-fill'></i>
			</div>
			<?php if (!isset($_SESSION["Usuario"]) || $_SESSION["Usuario"]["Administrador"] == 0) { ?>
				<div class="searchToggle">
					<i class='bi bi-x-lg cancel'></i>
					<i class='bi bi-search search'></i>
				</div>
				<div class="search-field">
					<form class="busqueda" action="" method="GET">
						<!-- para agregar la vista de ?m=productos en la url -->
						<input type="hidden" name="m" value="productos">
						<!-- concatenando el valor a buscar -->
						<input type="text" id="inputBusqueda" list="categorias-list" name="buscar" placeholder="Buscar..." required>
						<i onclick="limpiarBusqueda()" id="clearIcon" class="bi-x"></i>
						<datalist id="categorias-list">
							<?php
							$categorias = selectCategorias();
							foreach ($categorias as $categoria) {
								$nombre = $categoria["Nombre"]; ?>
								<option class="optionList" value="<?= $nombre ?>">
								<?php } ?>
						</datalist>
						<button class="btn-busca" type="submit"><i class="bi-search"></i></button>
					</form>
				</div>
			<?php } ?>
			<div class="person">
				<?php if (!isset($_SESSION["Usuario"])) { ?>
					<div class="btn-user">
						<a href="?m=ingreso">
							<i class="bi bi-person"></i>
						</a>
					</div>
				<?php } else { ?>
					<div class="btn-user">
						<a href="?m=panel<?= ($_SESSION["Usuario"]["Administrador"]) ? '&modulo=ventas' : '&modulo=compras'; ?>">
							<i class="bi bi-person-gear"></i>
							<span><?= $_SESSION["Usuario"]["Nombre"]; ?></span>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</nav>

<script>
	function limpiarBusqueda() {
		//document.getElementById("clearIcon").onclick = limpiaCampo;
		var campoBusqueda = document.getElementById("inputBusqueda");
		campoBusqueda.value = "";
	}
</script>