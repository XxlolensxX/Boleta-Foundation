<?php require_once('../conexion.php'); ?>
<?php if (isset($_GET[idElm]) && $_GET[idElm] <> "") {
  echo $q="DELETE FROM `registro` WHERE `id` = '$_GET[idElm]'";
  $conexion->query($q);
} ?>
<?php  
$max = 5;
$page = 0;

$self = $_SERVER['PHP_SELF'];

if (isset($_GET[page]) && $_GET[page]<>"") {
  $page = $_GET[page];
}

$inicio = $page * $max;

$query= "SELECT * FROM `registro` WHERE 1 ";

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
	<title>Lista Usuarios</title>
<link rel="stylesheet" type="text/css" href="../css/foundation.css">
<link rel="stylesheet" type="text/css" href="../css/app.css">
<link rel="stylesheet" href="../css/placeholder/style_placeholder.css">

<script src="https://use.fontawesome.com/67a2690474.js"></script>
</head>
<body>
<?php include('../nav.php'); ?>
  
<div class="row">
<h3>Usuarios</h3>
    <div class="medium-offset-10 medium-2">
   <a href="agregar.php"><input class="button" type="button" name="agregar_usuario" value="Agregar Usuario"></a>
  </div>


  <form class="medium-12" action="" method="post">


<div class="row">

    <div class="medium-offset-7 medium-3">
      
       <input type="text" name="buscador" placeholder="Búsqueda">
       <label for="buscador" placeholder="Búsqueda" alt="Búsqueda"> 
    </div>

    <div class="medium-2 columns">

       <input class="button" type="submit" name="enviar_busqueda" value="Búscar">

</div>
</div>
    </form>


<?php if ($total){ ?>



<table>
  <tbody>

    <tr>
      <td><b>Nombre</b></td>
      <td><b>Email</b></td>
      <td><b>País</b></td>
      <td><b>Opciones</b></td>
    </tr>



<?php while ($row = $resource ->fetch_assoc()) { ?> <!-- inicio WHILE -->
    <tr>
      <td>

          <div class="medium-11">
             <p><b><?php echo $row[nombre];?></b><p>
          </div>

       
	   </td>

      <td> <?php echo $row[correo] ?></td>
      <td> <?php echo $row[pais] ?></td>
      <td> <div class="row">
        <div class="medium-4"><a href="ficha_usuario.php?id=<?php echo $row[id]?>"><i class="fa fa-search" aria-hidden="true"></i></a></div>
        <div class="medium-4"><a href="modificar.php?id=<?php echo $row[id]?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
        <div class="medium-4"><a href="usuario.php?idElm=<?php echo $row[id] ?>" onClick="return confirm('Está seguro que desea eliminar de forma permanente?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
      </div>
      </td>
    </tr>
 <? } ?> <!-- cierre WHILE -->
     
   </tbody>
</table>


<?php } else { ?> 
  <div class="medium-12 alert text-center accent-color ">
  <p>No hay resultados que mostrar</p>
  </div>
<?php } ?>

<div class="medium-offset-3 medium-5">
 <ul class="pagination text-center" role="navigation" arial-label="pagination">

  <?php if($page - 1 >= 0) { ?>
    <li class="pagination-previous"><a href="<?php echo $self?>?page=<?php echo $page - 1 ?>">anterior</a></li>
  <?php } ?>

<?php echo $inicio + 1?> a <?php echo min($inicio + $max, $total)?> de <?php echo $total ?>

  <?php if ($page + 1 <= $totalPages) { ?>
   <li class="pagination-next"><a href="<?php echo $self?>?page=<?php echo $page + 1 ?>">Siguiente</a></li>
  <?php } ?>
</ul> 

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