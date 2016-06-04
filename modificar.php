<?php require_once('conexion.php'); 
if (!$_GET[id]) {
	header('Location: index.php');
}
if (isset($_POST[comprar]) && $_POST[comprar] =="comprar") // el primero es para el name el segundo para el value
	{
	$q="UPDATE compras SET cantidad='$_POST[cantidad]' WHERE id='$_POST[id]'";
	if ($conexion->query($q)) {
	header("Location: boleta.php");// no puede haber OUTPUT antes
	} 	 
}


$query = "SELECT * FROM `Rayitas` WHERE codigo ='$_GET[codigo]' ";
$resource = $conexion ->query($query);
$filas = $resource->fetch_assoc();

$query_compra = "SELECT * FROM `compras` WHERE id ='$_GET[id]' ";
$resource_compra = $conexion ->query($query_compra);
$filas_compra = $resource_compra->fetch_assoc();

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



<div class="row">
	
<div class="medium-8 columns to-down">

	<div class="row">

		<div class="medium-4 columns">
			<h5><?php echo $filas[nombre];?></h5>
			<img src="images/<?php echo $filas[codigo];?>.jpg">
		</div>

		<div class="medium-8 columns">
			<p><b><?php echo $filas[frase_promocional];?></b></p>

			<div class="colores clearfix">
				<a href="#"><div class="blue"></div></a>
				<a href="#"><div class="red"></div></a>
				<a href="#"><div class="green"></div></a>
			</div>

			<div class="descripcion">
				<p><?php echo $filas[descripcion];?></p>
			</div>
	
		</div>
	</div>

</div>

<div class="medium-4 columns text-right">
	<div>
		<p><b><?php echo $filas[codigo];?></b></p>
		<p><?php echo fechita($filas[fecha],1);?></p>
		<p><?php echo $filas[categoria];?></p>
	</div>


<form class="to-up" method="post">
	<div class="row">
		<div class="medium-8 columns">
			<input type="hidden" name="id" id="id" value="<?php echo $filas_compra[id]?>">
			<input name="cantidad" type="number" value="<?php echo $filas_compra[cantidad]?>">
		</div>

		<div class="medium-4 columns">
		<input class="button accent-color" type="submit" name="comprar" value="comprar">
		</div>
	</div>
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