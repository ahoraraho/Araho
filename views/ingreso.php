<?php
$stylee = null;
$stylee2 = null;
$email = "";
$focus = "autofocus";
$focus2 = null;
if (isset($_GET["mesage"])) {
	$mesage = $_GET["mesage"];
	switch ($mesage) {
		case 'ok':
			alertaResponDialog("msj-ok", "Gracias por registrarte, Bienvenido!", "bi-check-lg");
			break;
		case 'nok';
			alertaResponDialog("msj-warning", "Ya existe una cuenta con ese email", "bi-exclamation-diamond");
			break;
		case 'resetOk';
			alertaResponDialog("msj-ok", "Cuenta restaurada correctamente", " bi-check2-all");
			break;
		default:
			alertaResponDialog("msj-warning", "Algo salio mal", "bi-dash-circle");
			break;
	}
}
//isset — Determinar si una variable está declarada y es diferente denull
if (isset($_POST['login'])) {
	if (isset($_POST['email']) || isset($_POST['pass'])) {
		$email = $_POST['email'];
		$pass = $_POST["pass"];
		$usuario = loginUsuario($email); //USAMOS LA FUNCION
		$verifiPass = verificarPass($email, $pass);
		if (!$usuario) {
			alertaResponDialog("msj-error", "Email no encontrado", "bi-exclamation-octagon");
			$email = "";
			$stylee = "box-shadow: red 0px 0px 1px 2px;";
			$stylee2 = null;
			$focus = "autofocus";
			$focus2 = null;
		} elseif (!$verifiPass) {
			alertaResponDialog("msj-error", "Contraseña incorrecta", "bi-exclamation-triangle");
			$stylee2 = "box-shadow: red 0px 0px 1px 2px;";
			$stylee = null;
			$email = $_POST['email'];
			$focus = null;
			$focus2 = "autofocus";
		}

		if ($usuario and $verifiPass) {
			// acceso correcto
			session_start();
			$_SESSION["Usuario"] = array(
				"Id" => $usuario["idUsuario"],
				"Nombre" => ($usuario["Nombre"]) ? $usuario["Nombre"] : $usuario["RazonSocial"],
				"Apellido" => $usuario["Apellido"],
				"Email" => $usuario["Email"],
				"Administrador" => $usuario['Rol']
			);
			if ($usuario['Rol']) {
				header("location: ?menu=panel&modulo=productos");
			} else {
				header("location: ./");
			}
		}
	} else {
		alertaResponDialog("msj-warning", "No puede estar vacio ningun campo", "bi-info-circle");
	}
}
?>

<div class="conten">
	<div class="center-small">
		<h1 class="form_title">Sing In</h1>
		<form action="" method="POST" class="form">
			<div class="form_group">
				<input style="<?= $stylee ?>" type="email" id="email" name="email" class="form_input" placeholder=" " value="<?= $email ?>" required <?= $focus ?>>
				<label for="email" class="form_label"><i class="bi bi-envelope-paper"></i><span>Email</span><sup>*</sup></label>
			</div>
			<div class="form_group">
				<input style="<?= $stylee2 ?>" type="password" id="txtPassword" name="pass" class="form_input" placeholder=" " required <?= $focus2 ?>>
				<label for="password" class="form_label form_label-pass"><i class="bi bi-shield-lock"></i><span>Password</span><sup>*</sup></label>
				<div class="eyePass">
					<i id="iconoEye" class="bi bi-eye"></i>
				</div>
			</div>
			<div class="form_guardar-cuenta">
				<label class="control control-checkbox"> Remember me
					<input type="checkbox" name="recordar" onclick="" />
					<div class="control_indicator"></div>
				</label>
			</div>
			<button name="login" class="form_login">Sing In</button>
		</form><br>
		<a class="crear-cuenta" href="?menu=reset">¿Olvidaste tu contraseña?</a>
		<p class="nuevo-usuario">¿No tiene una cuenta?</p>
		<a href="?menu=registro"><button class="form_singup">New Sign Up</button></a>
	</div>
</div>