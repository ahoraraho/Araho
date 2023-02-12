<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">

    <link rel="icon" type="image/x-icon" href="../icons/signa.png" />
</head>
<?php
//DATOS
$perfil = 'https://avatars.githubusercontent.com/u/88399484?v=4';
$name = 'Alan Atilio';
$frase = 'El futuro es emocionante';
//redes
$lk = 'aatilio';
$gh = 'aatilio';
//convencionales
$fb = 'aalanatilio';
$ig = 'aalanatilio';
$tr = 'aalanatilio';
$tk = 'alanatilio';
//CONTACTO
$tg = 'alanatilio';
$wp = '936660120';
$cel = "936660120";
$dr = "aalan#9781";
//UBICACION
$province = 'Arequipa';
$country = 'Peru';
$web = 'www.sorian.ml/';



//DATOS
if (isset($_GET['perfil'])) {
    $perfil = $_GET['perfil'];
}
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_GET['frase'])) {
    $frase = $_GET['frase'];
}
//REDES 
if (isset($_GET['lk'])) {
    $lk = $_GET['lk'];
}
if (isset($_GET['gh'])) {
    $gh = $_GET['gh'];
}
if (isset($_GET['tg'])) {
    $tg = $_GET['tg'];
}
//DETALLES
if (isset($_GET['cel'])) {
    $cel = $_GET['cel'];
}
if (isset($_GET['province'])) {
    $province = $_GET['province'];
}
if (isset($_GET['country'])) {
    $country = $_GET['country'];
}
if (isset($_GET['web'])) {
    $web = $_GET['web'];
}
?>

<body>
    <main>
        <!--<div class="conten">
            <h1>¡Firma electrónica personalizada!</h1>
        </div>-->
        <div class="conten">
            <div class="center-small">
                <table class="my-signature">
                    <tbody>
                        <tr style="border: none;">
                            <td class="avatar">
                                <a href="https://www.<?= $web ?>/">
                                    <img class="img-logo" src="<?= $perfil ?>">
                                </a>
                            </td>
                            <td class="information">
                                <b class="nombre"><?= $name ?> </b>
                                <p>
                                    <span class="descripcion">
                                        <?= $frase ?>
                                    </span>
                                </p>
                                <div class="sociales">
                                    <a href="https://www.linkedin.com/in/<?= $lk ?>" target="_blank" class="btn b-linke">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="https://github.com/<?= $gh ?>" target="_blank" class="btn b-git">
                                        <i class="bi bi-github"></i>
                                    </a> <!--
                                    <a href="https://web.facebook.com/<?= $fb ?>" target="_blank" class="btn b-fac">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/<?= $tr ?>" target="_blank" class="btn b-twi">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                    <a href="https://www.tiktok.com/@<?= $tk ?>" target="_blank" class="btn b-twi">
                                        <i class="bi bi-tiktok"></i>
                                    </a>
                                    <a href="https://wa.me/<?= $cel ?>" target="_blank" class="btn b-wha">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <a href="https://discord.gg/<?= $dr ?>" target="_blank" class="btn b-wha">
                                        <i class="bi bi-discord"></i>
                                    </a>
                                    <a href="https://www.instagram.com/<?= $ig ?>" target="_blank" class="btn b-wha">
                                        <i class="bi bi-instagram"></i>
                                    </a>-->
                                    <a href="https://t.me/<?= $tg ?>" target="_blank" class="btn b-tel">
                                        <i class="bi bi-telegram"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="color-signature"></div>
                            </td>
                            <td class="datos">
                                <span class="dd d-tel">
                                    <i class="bi bi-telephone-inbound"></i>
                                    <a href="tel:<?= $cel ?>" target="_blank" class="d-tel">+51 <?= $cel ?></a>
                                </span>
                                <span class="dd d-loc">
                                    <i class="bi bi-geo-fill"></i>
                                    <a href="https://www.google.com/maps/place/Arequipa/" target="_blank" class="d-loc"><?= $province . ", " . $country ?></a>
                                </span>
                                <span class="dd d-web">
                                    <i class="bi bi-globe"></i>
                                    <a href="https://www.<?= $web ?>/" target="_blank" class="d-web">www.<?= $web ?></a>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>