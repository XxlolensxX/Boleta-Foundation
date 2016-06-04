<?php require_once('conexion.php');?>
<?php if (isset($_GET[idElm]) && $_GET[idElm] <> "") {
  echo $q="DELETE FROM `compras` WHERE `id` = '$_GET[idElm]'";
  $conexion->query($q);
} ?>

<?php 
$query = "SELECT * FROM `compras` WHERE `nombre_cliente` = '1'";
$resource = $conexion->query($query);
 ?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Boleta de compra</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/app.css">
<script src="https://use.fontawesome.com/67a2690474.js"></script>

</head>

<body>
<?php include("nav.php"); ?>

<div class="row">
<table>

  <tbody>
    <tr>
      <td class="accent-color text-primary-color menu-text">Productos</td>
      <td class="accent-color text-primary-color menu-text">Precio</td>
      <td class="accent-color text-primary-color menu-text">Cantidad</td>
      <td class="accent-color text-primary-color menu-text">Total</td>
      <td class="accent-color text-primary-color menu-text"></td>
      <td class="accent-color text-primary-color menu-text"></td>
    </tr>


<?php while ($row = $resource ->fetch_assoc()){ ?>
    <tr>
    
      <td><?=$row[nombre]?></td>
      <td>$<?php echo $precio=$row[precio];?></td>
      <td><?php echo  $cantidad=$row[cantidad];?></td>
      <td>$<?php echo number_format($sub = $cantidad * $precio);($subtotal += $sub)?></td>
      <td><a href="modificar.php?id=<?php echo $row[id]?>&codigo=<?php echo $row[codigo]?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
      <td><a href="boleta.php?idElm=<?php echo $row[id] ?>" onClick="return confirm('Está seguro que desea eliminar de forma permanente?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
      </tr>

  
   
<?php }?>



    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="accent-color text-primary-color menu-text">Costo de Envío</td>
      <td><?php
	  if ( $subtotal >= 50000) {
	  echo "$ ". $envio = 0;
	  }

	  else if ( $subtotal > 25000){
		  echo '$ '. number_format($envio = 2000);
		  }

	else {
		echo '$ '. number_format($envio = 5000);}

	  ?></td>
    <td></td>
      <td></td>
    </tr>


    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>Subtotal</td>
      <td><?php echo '$ '. number_format(($subtotal = $subtotal + $envio)); ?></td>
      <td></td>
      <td></td>
    </tr>

  <?php if ($subtotal > 50000) { ?>

    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td class="accent-color text-primary-color menu-text">Descuento 10%</td>
      <td>-<?php echo '$ ' . number_format($descuento = $subtotal * .1); ?></td>
      <td></td>
      <td></td>
    </tr>

   <?php }?>

    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>IVA 19%</td>
      <td><?php echo '$ '. number_format($iva = ($subtotal - $descuento)* .19); ?></td>
      <td></td>
      <td></td>
    </tr>


    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Total</td>
      <td><?php echo '$ '. number_format($total = ($subtotal - $descuento) + $iva );?></td>
      <td></td>
      <td></td>
    </tr>



  </tbody>
</table>


</div>
<?php require("footer.php") ?>
<!-- Foundation Files -->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
