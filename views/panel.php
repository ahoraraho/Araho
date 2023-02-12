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
            <a href="?menu=panel&modulo=ventas" class="<?= ($_GET['modulo'] == 'ventas') ? 'nav-active' : ''; ?>"><i class="bi bi-calendar2-event"></i><span>Ventas</span></a>
            <a href="?menu=panel&modulo=productos" class="<?= ($_GET['modulo'] == 'productos') ? 'nav-active' : ''; ?>"><i class="bi bi-box-seam"></i><span>Productos</span></a>
            <a href="?menu=panel&modulo=categorias" class="<?= ($_GET['modulo'] == 'categorias') ? 'nav-active' : ''; ?>"><i class="bi bi-tags"></i><span>Categorias</span></a>
            <a href="?menu=panel&modulo=marcas" class="<?= ($_GET['modulo'] == 'marcas') ? 'nav-active' : ''; ?>"><i class="bi bi-view-list"></i><span>Marcas</span></a>
            <a href="?menu=panel&modulo=usuarios" class="<?= ($_GET['modulo'] == 'usuarios') ? 'nav-active' : ''; ?>"><i class="bi bi-people"></i><span>Usuarios</span></a>
        <?php } else { ?>
            <?php // Acceso a compras solo si no es administrador 
            ?>
            <a href="?menu=panel&modulo=compras" class="<?= ($_GET['modulo'] == 'compras') ? 'nav-active' : ''; ?>"><i class="bi bi-handbag"></i><span>Compras</span></a>
        <?php } ?>
        <?php // Acceso al resto de los modulos para todos los tipos de usuario 
        ?>
        <a href="?menu=panel&modulo=cuenta" class="<?= ($_GET['modulo'] == 'cuenta') ? 'nav-active' : ''; ?>"><i class="bi bi-gear"></i><span>Configuracion</span></a>
        <span class="separador"></span>
        <a href="?menu=panel&sesion=cerrar"><i class="bi bi-power"></i><span>Cerrar sesión</span></a>
    </nav>

    <section class="container-panel">
        <?php
        // recibo el modulo al que se accedió, escogio segun el tipo de usuario
        if (isset($_GET['modulo'])) {
            $modulo = 'views/modules/' . $_GET['modulo'] . '.php';
            if (file_exists($modulo)) {
                require_once($modulo);
            } else {
                require_once("views/404.php");
            }
        }
        ?>
    </section>
</section>