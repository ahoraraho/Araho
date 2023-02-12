<?php require_once('config/loader.php') ?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Araho</title>
	<link rel="shortcut icon" href="img/ac_icon.png" type="image/png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="library/bootstrap-icons-1.10.2/bootstrap-icons.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/inside.css">
</head>

<body>
	<header>
		<?php include_once('views/layouts/header.php') ?>
	</header>
	<main>
		<?php include_once('config/vpm.php') ?>
	</main>
	<footer>
		<?php include_once('views/layouts/footer.php') ?>
	</footer>
	<script src="js/nav.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/product.js"></script>
</body>

</html>