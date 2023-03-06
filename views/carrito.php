<?php
// Compruebo si no se inicio sesió, si es que la sesion es nula
if (!isset($_SESSION["Usuario"])) { ?>
    <div class="conten">
        <div class="center-small">
            <h3>Debes iniciar sesión para poder ver el carrito!</h3>
            <a style="width: 100%;" class="form_login" href="./?m=ingreso">Iniciar sesión</a>
        </div>
    </div>
<?php } else { ?>
    <?php
    // Si es administrador no va a comprar
    if ($_SESSION["Usuario"]["Administrador"] == 1) {
        header('location: ?m=panel&mod=ventas');
        die();
    }
    $usuario = $_SESSION["Usuario"];
    $idCliente = $usuario["Id"];
    // Valido que se invoca una peticion POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['clearCart'])) {
            DeleteCarrito($idCliente);
            alertaResponDialog("msj-warning", "Carrito vacío", "bi-exclamation-circle");
        }
        if (isset($_POST['comprar'])) {
            if ($_POST["isValidBuy"]) {
                header('location: ?m=checkOut');
            } else {
                alertaResponDialog("msj-error", "No se puede comprar porque no hay stock", "bi-wrench-adjustable-circle");
            }
        }
    }
    // Valido que haya una accion por GET
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        $idProducto = $_GET["idProduct"];
        DeleteCarritoProduct($idCliente, $idProducto);
        alertaResponDialog("msj-warning", "Producto quitado", "bi-exclamation-circle");
        //header('location: ?m=carrito');
    }

    $productosCarrito = SelectCarrito($idCliente);
    if (!empty($productosCarrito)) {
    ?>
        <div class="container">
            <h2>Carrito </h2>
            <div class="contenido-tabla">
                <form action="" method="POST">
                    <table class="responsive-carrito">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th>Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $precioTotal = 0.0;
                            $sinStock = false;
                            $isValidBuy = true;

                            foreach ($productosCarrito as $producto) {
                                $idCarrito = $producto["id"];
                                $idProducto = $producto["idProducto"];
                                $imagen = $producto["Imagen"];
                                $nombre = $producto["Nombre"];
                                $cantidad = $producto["cantidad"];
                                $precio = $producto["Precio"];
                                $precioParcial = $producto["PrecioParcial"];
                                $stock = $producto["Stock"];
                                $precioTotal += $precioParcial;

                                if ($cantidad > $stock) {
                                    $sinStock = true;
                                    $isValidBuy = false;
                                } else {
                                    $sinStock = false;
                                }
                            ?>
                                <tr>
                                    <?php if (!empty($imagen)) : ?>
                                        <td><img style="max-width:100px" src="img/productos/<?= $imagen ?>" alt="<?= $nombre ?>"></td>
                                    <?php else : ?>
                                        <td><img style="max-width:100px" src=""></td>
                                    <?php endif; ?>
                                    <td><?= $nombre ?></td>
                                    <td><?= $cantidad ?></td>
                                    <td>S/. <?= $precio ?></td>
                                    <td>S/. <?= $precioParcial ?></td>
                                    <td>
                                        <a href="?m=carrito&action=quitar&idProduct=<?= $idProducto ?>" title="Eliminar"><i class="bi bi-trash3" style="color:crimson; font-size: 30px;"></i></a>
                                    </td>
                                    <?php
                                    if ($sinStock) :
                                        alertaResponDialog("msj-error", "Sin Stock", "bi-wrench-adjustable-circle");
                                    endif; ?>
                                </tr>
                            <?php   } ?>
                        </tbody>
                    </table>

                    <div class="displayFlex">
                        <h3>El total del carrito es de <strong>S/. <?= $precioTotal ?></strong></h3>
                        <input type="hidden" name="isValidBuy" value="<?= $isValidBuy ?>">
                        <div class="displayGrid">
                            <input class="btnVaciarCarrito" type="submit" name="clearCart" value="Vaciar carrito">
                            <input class="btnComprar" type="submit" value="Comprar" name="comprar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="conten">
            <div class="center-small">
                <h3 style="margin: 20px auto; text-align:center;">Tu carito está vacío</h3>
                <a style="width: 100%;" class="form_singup" href="./">Busquemos algo</a>
            </div>
        </div>
<?php
    }
}
?>