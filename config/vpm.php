<?php
/*****************************************************************************
 * Archivo que redirecciona al contenido que se va incrustar dentro del main
 ******************************************************************************/
if (isset($_GET['menu'])) {
    $pagina = 'views/' . $_GET['menu'] . '.php'; //variable de pagina, redireccionadas
    if (file_exists($pagina)) {
        require_once($pagina);
    } else {
        require_once("views/404.php");
    }
} else {
    require_once('views/home.php');
}
