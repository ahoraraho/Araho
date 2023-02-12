<div class="filtros">
    <h4><?= $filtro ?> = <span><?= $cantidad_productos ?> productos encontrados</span></h4>
    <?php if ($cantidad_productos > 1) { ?>
        <ul class="order-nav">
            <li><a class="<?= ($orden == '' && $filtro == '') ? 'active' : ''; ?>" href="?menu=panel&modulo=productos">Todos los productos</a></li>
            <li><a class="<?= ($filtro == "Samsung") ? 'active' : ''; ?>" href="?menu=panel&modulo=productos&buscar=Samsung">Samsung</a></li>
            <li><a class="<?= ($orden == 'menor-precio') ? 'active' : ''; ?>" href="?menu=panel&modulo=productos&buscar=todos-los-productos&order=menor-precio">Menor precio</a></li>
            <li><a class="<?= ($orden == 'mayor-precio') ? 'active' : ''; ?>" href="?menu=panel&modulo=productos&buscar=todos-los-productos&order=mayor-precio">Mayor precio</a></li>
        </ul>
    <?php } ?>
</div>



<div class="contenedor_buscador">
    <div class="buscador">
        <div class="from_busqueda">
            <form class="from_input" action="" method="GET">
                <!-- para agregar la vista de ?menu=productos en la url -->
                <input type="hidden" name="menu" value="panel">
                <input type="hidden" name="modulo" value="productos">
                <!-- concatenando el valor a buscar -->
                <input type="text" name="buscar" placeholder="Buscar..." required>
                <!-- <input type="submit" value="BUSCAR"> -->
                <button class="btn-buscador" type="submit"><i class="bi-search"></i></button>
            </form>
        </div>
        <div class="filtrador">
            <div class="filtrador_boton">
                <button onclick="myFunction()" class="dropbtn">Todos los productos</button>
                <div id="myDropdown" class="filtrador-content">
                    <a href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#contact">Contact</a>
                </div>
            </div>
        </div>
    </div>
</div>


<select class="form-select" aria-label="Default select example">
    <option selected>Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>

<div class="input-group">
    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
        <option selected>Choose...</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>
    <button class="btn btn-outline-secondary" type="button">Button</button>
</div>}










