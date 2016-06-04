<?php require_once('../conexion.php'); ?>
<?php if (isset($_GET[idElm]) && $_GET[idElm] <> "") {
  echo $q="DELETE FROM `registro` WHERE `id` = '$_GET[idElm]'";
  $conexion->query($q);
} ?>
<?php  
$usuario_ficha = "SELECT * FROM `registro` WHERE id ='$_GET[id]' ";
$resource_ficha = $conexion ->query($usuario_ficha);
$filas_ficha = $resource_ficha->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista productos</title>
<link rel="stylesheet" type="text/css" href="../css/foundation.css">
<link rel="stylesheet" type="text/css" href="../css/app.css">
<link rel="stylesheet" href="../css/placeholder/style_placeholder.css">
</head>
<body>
<?php include('../nav.php'); ?>

<div class="row">

<h3>Usuario ><small> Ficha</small></h3>

<table>
  <tbody>

    <tr>
      <td><b>Usuario</b></td>
      <td><b>Datos</b></td>
    </tr>
    <tr>
      <td>            
          <p><b>Nombre</b><p>
          <p><b>Email</b><p>
          <p><b>Teléfono</b><p>
          <p><b>País</b><p>
          <p><b>Dirección</b><p>
          <p><b>Usuario</b><p>
          <p><b>Clave</b><p>
	   </td>

      <td>
      <p><?php echo $filas_ficha[nombre]?></p>
      <p><?php echo $filas_ficha[correo]?></p>
      <p><?php echo $filas_ficha[tel]?></p>
      <p><?php echo $filas_ficha[pais]?></p>
      <p><?php echo $filas_ficha[direccion]?></p>
      <p><?php echo $filas_ficha[usuario]?></p>
      <p><?php echo $filas_ficha[contrasena]?></p>
      </td>
    </tr>

     
   </tbody>
</table>

<div class="medium-3">

<a href="modificar.php?id=<?php echo $filas_ficha[id]?>">
<input class="button" type="button" name="modificar" value="Modificar">
</a>
</div>


<div class="medium-offset-6 medium-3">
<a href="index.php?idElm=<?php echo $filas_ficha[id] ?>" onClick="return confirm('Está seguro que desea eliminar de forma permanente?')"><input class="button" type="button" name="eliminar" value="Eliminar">
</a>
</div>

</div>



<?php require('../footer.php'); ?>
<!-- Foundation Files -->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
	
</body>
</html>