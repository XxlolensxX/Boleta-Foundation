<?php

$direccion="localhost";
$usuario="rayitas";
$clave="rayitas123";
$nombre_bd="Rayitas";

$conexion = new mysqli($direccion, $usuario, $clave, $nombre_bd);

mysqli_set_charset($conexion, 'utf-8');

/*
 * This is the "official" OO way to do it,
 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.

if ($conexion->connect_error) {
    die('Connect Error (' . $conexion->connect_errno . ') '
            . $conexion->connect_error);
} else {
	echo "Conección Exitosa " . $conexion->host_info;
}
 */

function fechita($fecha,$t=1){
	$meses=array(enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre);
	list($fecha,$hora)=explode(" ",$fecha);
	list($ano,$mes,$dia)=explode("-",$fecha);
	if ($t==1) {
		return "$dia/" . $meses[$mes-1]."/$ano";
	} else {
		return "$dia/$mes/$ano";
	}
}