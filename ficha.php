<?php require_once('conexion.php'); 
if (!$_GET[id]) {
	header('Location: index.php');
}

if (isset($_POST[comprar]) && $_POST[comprar] =="comprar") // el primero es para el name el segundo para el value
	{
	$q="INSERT INTO `Rayitas`.`compras` (`id`, `nombre_cliente`, `codigo`, `nombre`, `precio`, `cantidad`, `fecha_compra`) VALUES (NULL, '$_POST[nombre_cliente]', '$_POST[codigo]', '$_POST[nombre]', '$_POST[precio]','$_POST[cantidad]', NOW())";

	 $conexion->query($q);
	 $ID = $conexion-> insert_id;
	 if($ID) header("Location: boleta.php");// no puede haber OUTPUT antes
	 	
	 
	 
}


$query = "SELECT * FROM `Rayitas` WHERE id ='$_GET[id]' ";
$resource = $conexion ->query($query);
$filas = $resource->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ficha</title>
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">
<body>
<?php include('nav.php'); ?>



<div class="row" id="ficha">
	
		<div class="medium-6 columns">
			
			<img src="images/<?php echo $filas[codigo];?>.jpg" class="box-shadow">
		</div>


		<div class="medium-6 columns">

			<h5><?php echo $filas[nombre];?></h5>
			<p><b><?php echo $filas[frase_promocional];?></b></p>

		<div id="info">
			<p>Código : <?php echo $filas[codigo];?></p>
			<p>Fecha : <?php echo fechita($filas[fecha],1);?></p>
			<p>Categoría : <?php echo $filas[categoria];?></p>
		</div>

			<div class="colores clearfix">
				<a href="#"><div class="blue"></div></a>
				<a href="#"><div class="red"></div></a>
				<a href="#"><div class="green"></div></a>
			</div>

			<div class="descripcion to-up">
				<p><?php echo $filas[descripcion];?></p>
			</div>
	
		<form id="form-cantidad" method="post">
	
			
				<input type="hidden" name="nombre" id="nombre" value="<?php echo $filas[nombre]?>">
				<input type="hidden" name="codigo" id="codigo" value="<?php echo $filas[codigo]?>">
				<input type="hidden" name="precio" id="precio" value="<?php echo $filas[precio]?>">
				<input type="hidden" name="nombre_cliente" id="cliente" value="1">
				

			<div class="row">
				<div class="medium-3 columns">
				<label for="cantidad">Cantidad</label>
				</div>

				<div class="medium-9 columns">
				<input id="cantidad" name="cantidad" type="number" value="0">
				</div>
			</div>	
		
		<input class="button large expanded accent-color" type="submit" name="comprar" value="comprar">
		
	
		</form>
		</div>

</div>
<?php require('footer.php'); ?>
	
<!-- Foundation Files -->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>