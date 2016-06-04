<?php require_once('conexion.php'); ?>
<?php  
$max = 5;
$page = 0;

$self = $_SERVER['PHP_SELF'];

if (isset($_GET[page]) && $_GET[page]<>"") {
  $page = $_GET[page];
}

$inicio = $page * $max;

$query= "SELECT `id`,`nombre`,`frase_promocional`,`precio`, `codigo` FROM `Rayitas` WHERE 1 ";

$limit = " LIMIT $inicio,$max";

//$query_limit = $query.$limit;

//$resource = $conexion->query($query_limit);


$palabra = $_POST[buscador];
//$cate = $_POST[categoria];

$busqueda = " AND nombre LIKE '%$palabra%'";

$query_busqueda = $query.$busqueda.$limit;

$resource = $conexion->query($query_busqueda);





if (isset($_GET[total]) && $_GET[total] <>"") {
  $total = $_GET[total];
} else {
  $todos = $conexion->query($query);
  $total = $todos->num_rows;
}


$totalPages = ceil($total/$max)-1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista productos</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="stylesheet" href="css/placeholder/style_placeholder.css">
</head>
<body>
<?php include('nav.php'); ?>

<div class="row">

  

     <form action="" method="post">

<div class="row align-right">
<div class="medium-8 columns">
       
       <input type="text" name="buscador" placeholder="Búsqueda">
       <label for="buscador" placeholder="Búsqueda" alt="Búsqueda" > 
</div>

  <div class="medium-4 columns">
       <input  class="button" type="submit" name="enviar_busqueda" value="Búscar">
  </div>
     
</div>     

    </form>
  

<?php if ($total){ ?>



<table>
  <tbody>

    <tr>
      <td><b>Producto</b></td>
      <td><b>Precio</b></td>
    </tr>



<?php while ($row = $resource ->fetch_assoc()) { ?> <!-- inicio WHILE -->
    <tr>
      <td>
       

          <div class="medium-1">
            <img class="thumbnail tamaño" src="images/<?php echo $row[codigo];?>.jpg">
          </div>

          <div class="medium-11">
             <p><a href= "ficha.php?id=<?php echo $row[id];?>"><b><?php echo $row[nombre];?></b></a><p>
             <p><?php echo $row[frase_promocional];?></p>
          </div>

       
	   </td>

      <td>$ <?php echo number_format($row[precio]) ?></td>
    </tr>
 <? } ?> <!-- cierre WHILE -->
     
   </tbody>
</table>


<?php } else { ?> 
  <div class="medium-12 alert text-center accent-color ">
  <p>No hay resultados que mostrar</p>
  </div>
<?php } ?>


 <ul class="pagination text-center" role="navigation" arial-label="pagination">

  <?php if($page - 1 >= 0) { ?>
    <li class="pagination-previous"><a href="<?php echo $self?>?page=<?php echo $page - 1 ?>">anterior</a></li>
  <?php } ?>



  <?php if ($page + 1 <= $totalPages) { ?>
   <li class="pagination-next"><a href="<?php echo $self?>?page=<?php echo $page + 1 ?>">Siguiente</a></li>
  <?php } ?>
</ul> 
<?php echo $inicio + 1?> a <?php echo min($inicio + $max, $total)?> de <?php echo $total ?>
</div>

<?php require('footer.php'); ?>
<!-- Foundation Files -->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
	
</body>
</html>