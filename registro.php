<?php require_once('conexion.php');
if ($_POST[registrar]) {
	header('Location: index.php');
};
if (isset($_POST[registrar]) && $_POST[registrar] =="registrar") // el primero es para el name el segundo para el value
	{
	$q="INSERT INTO `registro` (`id`, `nombre`, `correo`, `telefono`, `pais`, `direccion`, `usuario`, `contrasena`) 
	VALUES (
	NULL, 
	'$_POST[nombre]', 
	'$_POST[correo]', 
	'$_POST[telefono]', 
	'$_POST[pais]',
	'$_POST[direccion]',
	'$_POST[usuario]', 
	'$_POST[contrasena]'
	)";

	 $conexion->query($q);
	 $ID = $conexion->insert_id;
	 if($ID) header("Location: index.php");// no puede haber OUTPUT antes	 
}

echo $q;
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" href="css/placeholder/style_placeholder.css">
	<script src="https://use.fontawesome.com/67a2690474.js"></script>
</head>
<body>
<?php include('nav.php') ?>

<div class="row">


<div class="medium-offset-4 medium-5 columns">

<h3>Registro Usuario</h3>

<form id ="formulario_registro" action="" method="post" data-parsley-validate="">
	
	<input id="nombre" name="nombre" type="text" required="">
	<label for="nombre" alt="Nombre" placeholder="Nombre"></label>
	

	<input id="email" name="correo" type="email" required="">
	<label for="email" placeholder="Email" alt="Email"></label>
		
	
	<input id="telefono" name="telefono" type="tel" required="">
	<label for="tel" placeholder="Telefóno" alt="Telefóno"></label>
	

	
	<label for="pais" placeholder="País" alt="País"></label>
	<select name="pais" required="">
		<option>Chile</option>
		<option>Argentina</option>
		<option>Perú</option>
	</select>
	

	
	<textarea name="direccion" required="" placeholder="Dirección"></textarea>
	<label for="dir" placeholder="Dirección" alt="Dirección"></label>
	
	

	<input name="usuario" type="text" required="">
	<label for="usuario" placeholder="Usuario" alt="Usuario"></label>


	
	<input name="contrasena" type="password"  required="">
	<label for="contrasena" placeholder="*********" alt="Contraseña"></label>		

	<input id="enviar" class="large expanded button" type="submit" name="registrar" value="registrar" required="">

</form>	
</div>

<div class="medium-6 columns"></div>

</div>
<?php include('footer.php') ?>

<!-- Foundation Files -->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="js/validador/jquery.validate.min.js"></script>
    <script>
$(document).ready(function(){
 
	$("#enviar").on("click", function(){
 
		$("#formulario_registro").validate({
		rules:
		{
			correo: { required:true, email:true},
			nombre: { required:true,  minlength:3, maxlength:8},
			telefono: { required:true},
			direccion: { required:true, minlength:4},
			usuario: { required:true, minlength:4, maxlength:10},
			contrasena: { required:true, minlength:4}

		},
		messages: {
			correo: { 
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido </div>'), 
				email: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El formato de Email es incorrecto</div>'), 
				},

			nombre: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'), 
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres minimos son 3</div>'), 
				maxlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres maximo son 8</div>') },

			telefono: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>')
				},

			direccion: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'),
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Ingresa una dirección válida</div>')
				},

			usuario: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'),
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres minimos son 4</div>'),
				maxlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres maximo son 10</div>')
				},

			contrasena: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'),
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres minimos son 4</div>')
				},
			}
		});
 
 
	});
});
</script>

</body>
</html>