<?php require_once('../conexion.php');
if ($_POST[modificar]) {
	header('Location: index.php');
};
if (isset($_POST[modificar]) && $_POST[modificar] =="modificar")
	{
	$q="UPDATE registro SET 
	nombre='$_POST[nombre]',
	correo='$_POST[correo]',
	tel='$_POST[tel]',
	pais='$_POST[pais]',
	direccion='$_POST[direccion]',
	usuario='$_POST[usuario]',
	contrasena='$_POST[contrasena]'
	
	WHERE id='$_POST[id]'";
	if ($conexion->query($q)) {
	header("Location: index.php");// no puede haber OUTPUT antes
	} 	 
}

$usuario_mod = "SELECT * FROM `registro` WHERE id ='$_GET[id]' ";
$resource_mod = $conexion ->query($usuario_mod);
$filas_mod = $resource_mod->fetch_assoc();

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="../css/foundation.css">
	<link rel="stylesheet" type="text/css" href="../css/app.css">
	<link rel="stylesheet" href="../css/placeholder/style_placeholder.css">
	<script src="https://use.fontawesome.com/67a2690474.js"></script>
</head>
<body>
<?php include('../nav.php') ?>

<div class="row">


<div class="medium-offset-4 medium-5 columns">

<h3>Modificar Usuario</h3>

<form id ="formulario_registro" action="" method="post" data-parsley-validate="">
	
	<input id="nombre" name="nombre" type="text" value="<?php echo $filas_mod[nombre]?>">
	<label for="nombre" alt="Nombre" placeholder="Nombre"></label>
	

	<input id="email" name="correo" type="email" value="<?php echo $filas_mod[correo]?>">
	<label for="email" placeholder="Email" alt="Email"></label>
		
	
	<input id="telefono" name="telefono" type="tel" value="<?php echo $filas_mod[telefono]?>">
	<label for="tel" placeholder="Telefóno" alt="Telefóno"></label>
	

	
	<label for="pais" placeholder="País" alt="País" ></label>
	<select name="pais" value="<?php echo $filas_mod[pais]?>">
		<option>Chile</option>
		<option>Argentina</option>
		<option>Perú</option>
	</select>
	

	
	<textarea name="direccion" placeholder=""><?php echo $filas_mod[direccion]?></textarea>
	<label for="dir" placeholder="Dirección" alt="Dirección"></label>
	
	

	<input name="usuario" type="text" value="<?php echo $filas_mod[usuario]?>" >
	<label for="usuario" placeholder="Usuario" alt="Usuario"></label>


	
	<input name="contrasena" type="password" value="<?php echo $filas_mod[contrasena]?>">
	<label for="contrasena" placeholder="*********" alt="Contraseña"></label>	

	<input type="hidden" name="id" id="id" value="<?php echo $filas_mod[id]?>">


	<input id="modificar" class="large expanded button" type="submit" name="modificar" value="modificar" required="">


</form>	
<a href="index.php"><input id="cancelar" class="large expanded button" type="submit" name="cancelar" value="Cancelar"> </a>
</div>

<div class="medium-6 columns"></div>

</div>
<?php include('../footer.php') ?>

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
			nombre: { required:true,  minlength:3},
			telefono: { required:true},
			direccion: { required:true, minlength:4},
			usuario: { required:true, minlength:4},
			contrasena: { required:true, minlength:4}

		},
		messages: {
			correo: { 
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido </div>'), 
				email: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El formato de Email es incorrecto</div>'), 
				},

			nombre: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'), 
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres minimos son 3</div>')
				 },

			telefono: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>')
				},

			direccion: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'),
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Ingresa una dirección válida</div>')
				},

			usuario: {
				required: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>El campo es requerido</div>'),
				minlength: jQuery.validator.format('<div class="error-box arrow-left"><i class="fa fa-warning"></i>Los caracteres minimos son 4</div>')
				
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