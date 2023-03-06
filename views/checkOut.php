<?php
// Compruebo si no se inicio sesión
if (!isset($_SESSION["Usuario"])) {
    header('location: ./');
} else {

    // Si es administrador no va a comprar
    if ($_SESSION["Usuario"]["Administrador"] == 1) {
        header('location: ?m=panel&mod=ventas');
        die();
    }

    $usuario = $_SESSION["Usuario"];
    $idUsuario = $usuario["Id"];

    $productosCarrito = SelectCarrito($idCliente);
    if (!empty($productosCarrito)) {
        // Valido que se invoca una peticion POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['pagar'])) {
                if ($_POST["isValidBuy"]) {
                    // agregar compra a venta ... si es ok
                    if (InsertVenta($idUsuario, $productosCarrito)) {
                        // resto stock de cada producto
                        UpdateProductoStock($productosCarrito);
                        // vaciar carrito...
                        DeleteCarrito($idUsuario);
                    } else {
                        alertaResponDialog("msj-error", "Hubo un error al intentar comprar. Por favor intente más tarde", "bi-wrench-adjustable-circle");
                    }
                    header('location: ?m=checkOutRta');
                } else {
                    alertaResponDialog("msj-error", "No se puede comprar porque no hay stock", "bi-wrench-adjustable-circle");
                }
            }
        }
?>
        <div class="container">
            <h2>Comprar</h2>
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
                                        <td><img style="max-width:50px" src="img/productos/<?= $imagen ?>" alt="<?= $nombre ?>"></td>
                                    <?php else : ?>
                                        <td><img style="max-width:50px" src=""></td>
                                    <?php endif; ?>
                                    <td><?= $nombre ?></td>
                                    <td><?= $cantidad ?></td>
                                    <td>S/. <?= $precio ?></td>
                                    <td>S/. <?= $precioParcial ?></td>
                                    <?php
                                    if ($sinStock) :
                                    ?>
                                        <td style="color:crimson; border-radius: 15px; padding:20px; text-align:center;"><b>Sin Stock!<b></td>
                                    <?php
                                    endif; ?>
                                </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                    <div class="displayFlex">
                        <h4>El total a pagar es <strong>S/. <?= $precioTotal ?></strong></h4>
                        <h4>Forma de pago</h4>
                        <input type="hidden" name="isValidBuy" value="<?= $isValidBuy ?>">
                        <div class="displayGrid" title="Elige la forma de pago">
                            <div class="seclecOptions">
                                <i class="iconoDonw bi-caret-down"></i>
                                <select name="formaPago" required>
                                    <option value=""> Elija la forma de pago...</option>
                                    <option value=""> Mercado Pago </option>
                                    <option value=""> Tarjeta de crédito/débito </option>
                                    <option value=""> Pay Pal </option>
                                </select>
                            </div>
                            <input class="btnComprar" type="submit" name="pagar" value="Pagar">
                            <!-- <input class="btnComprar" type="submit" value="Comprar" name="comprar"> -->
                        </div>
                    </div>
                </form>
                <div class="displayFlex">
                    <a id="back"><button class="btnBack">Atras</button></a>
                </div>
            </div>
        </div>
<?php
    }
}
?>