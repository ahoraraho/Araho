<?php

$resultado = "";
$error = "";
$coo = "";

if (isset($_POST["registrar"])) {
	$check = isset($_POST['checkbox']) ? "checked" : "unchecked";

	if ($check == "checked") {

		$usuario = [
			"RazonSocial" => $_POST["razon_social"], // business_name
			"Direccion" => "",
			"Telefono" => $_POST["telefono"],
			"Email" => $_POST["email"],
			"Pass" =>  $_POST["pass"]
		];
		if (!existMailUsuario($_POST["email"])) {
			if (insertUsuario(1, $usuario)) {
				// insertado correctamente
				header('location: ?m=ingreso&mesage=ok');
				//alertaResponDialog("msj-ok", "Gracias por registrarte! Bienvenido!", "bi-check-circle");
			} else {
				// error!!
				alertaResponDialog("msj-error", "Ups! Error de conexión. Por favor reintente en unos instantes", "bi-exclamation-circle");
			}
		} else {
			// mail ya existe
			header('location: ?m=ingreso&mesage=nok');
		}
	} else {
		//$resultado = "Se han aceptado las condiciones correctamente";
		$error = "Tiene que aceptar los terminos y condiciones";
		alertaResponDialog("msj-error", "Deve de aceptar los terminos", "bi-slash-circle");
	}
}


?>
<div class="conten">
	<div class="center-small">
		<h1 class="form_title">Company registration</h1>
		<form action="" method="POST" class="form">
			<div class="form_group">
				<input type="text" id="razon_social" name="razon_social" class="form_input" placeholder=" " autocomplete="off" required autofocus>
				<label for="razon_social" class="form_label"><i class="bi bi-building"></i><span>Razón Social</span><sup>*</sup></label>
			</div>
			<div class="form_group">
				<input type="email" id="email" name="email" class="form_input" placeholder=" " autocomplete="off" required>
				<label for="email" class="form_label"><i class="bi bi-envelope"></i><span>Email</span><sup>*</sup></label>
			</div>
			<div class="form_group">
				<input type="number" id="telefono" name="telefono" class="form_input" placeholder=" " autocomplete="off" required maxlength="9">
				<label for="telefono" class="form_label"><i class="bi bi-phone"></i><span>Telefono</span><sup>*</sup></label>
			</div>
			<div class="form_group">
				<input type="password" id="txtPassword" name="pass" class="form_input" placeholder=" " required>
				<label for="password" class="form_label form_label-pass"><i class="bi bi-shield-lock"></i><span>Password</span><sup>*</sup></label>
				<div class="eyePass">
					<i id="iconoEye" class="bi bi-eye"></i>
				</div>
			</div>
			<div class="form_guardar-cuenta">
				<?php
				//NO SE ESTA USANDO POR QUE EL BOTON DE REGISTRO NO ESTA HABILITADO DESDE UN INICIO
				if ($error) {
					echo "<div class='error'>" . $error . "</div>";
					$coo = "errorAll";
				}
				if ($resultado) {
					$coo = "null";
					echo "<div class='resultado'>" . $resultado . "</div>";
				}
				?>
				<label class="control control-checkbox <?= $coo ?>"> I agree the <a target="_blank" href="?m=terminos">Terms and Conditions </a>
					<input type="checkbox" id="checkbox" name="checkbox">
					<div class="control_indicator "></div>
				</label>
			</div>
			<button type="submit" name="registrar" id="registrar" class="form_singup-disabled">Register company</button>
		</form><br>
		<a class="crear-cuenta" href="?m=ingreso">Iniciar Sesion</a><br>
		<a class="crear-cuenta" href="?m=registro">Crear una cuenta personal</a>
	</div>
</div>