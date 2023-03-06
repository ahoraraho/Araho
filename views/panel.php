<?php
// Chequeo si se abrió sesión
// session_start();
if (!isset($_SESSION["Usuario"])) {
    //echo 'hahahahahahahahhahahaha';
    header('location: ./');
}
// chequeo si se está cerrando la sesión
if (isset($_GET['sesion']) && $_GET['sesion'] == 'cerrar') {
    unset($_SESSION);
    session_destroy();
    header('location: ./');
}

?>
<section class="panel-users">
    <nav class="nav-panel">
        <?php // Si es administrador se da acceso a los modulos de administrador 
        ?>
        <?php if ($_SESSION["Usuario"]["Administrador"]) { ?>
            <a href="?m=panel&mod=ventas" class="<?= ($_GET['mod'] == 'ventas') ? 'nav-active' : ''; ?>"><i class="bi bi-calendar2-event"></i><span>Ventas</span></a>
            <a href="?m=panel&mod=productos" class="<?= ($_GET['mod'] == 'productos') ? 'nav-active' : ''; ?>"><i class="bi bi-box-seam"></i><span>Productos</span></a>
            <a href="?m=panel&mod=categorias" class="<?= ($_GET['mod'] == 'categorias') ? 'nav-active' : ''; ?>"><i class="bi bi-tags"></i><span>Categorias</span></a>
            <a href="?m=panel&mod=marcas" class="<?= ($_GET['mod'] == 'marcas') ? 'nav-active' : ''; ?>"><i class="bi bi-view-list"></i><span>Marcas</span></a>
            <a href="?m=panel&mod=usuarios" class="<?= ($_GET['mod'] == 'usuarios') ? 'nav-active' : ''; ?>"><i class="bi bi-people"></i><span>Usuarios</span></a>
        <?php } else { ?>
            <?php // Acceso a compras solo si no es administrador 
            ?>
            <a href="?m=panel&mod=compras" class="<?= ($_GET['mod'] == 'compras') ? 'nav-active' : ''; ?>"><i class="bi bi-handbag"></i><span>Compras</span></a>
        <?php } ?>
        <?php // Acceso al resto de los modulos para todos los tipos de usuario 
        ?>
        <a href="?m=panel&mod=cuenta" class="<?= ($_GET['mod'] == 'cuenta') ? 'nav-active' : ''; ?>"><i class="bi bi-gear"></i><span>Configuracion</span></a>
        <span class="separador"></span>
        <a href="?m=panel&sesion=cerrar"><i class="bi bi-power"></i><span>Cerrar sesión</span></a>
    </nav>

    <section class="container-panel">
        <?php
        // recibo el mod al que se accedió, escogio segun el tipo de usuario
        if (isset($_GET['mod'])) {
            $mod = 'views/modules/' . $_GET['mod'] . '.php';
            if (file_exists($mod)) {
                require_once($mod);
            } else {
                require_once("views/404.php");
            }
        }
        ?>
    </section>
</section>