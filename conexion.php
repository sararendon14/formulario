<?php 

$servidor = "localhost";
$usuario = "root";
$contrasena = "";  
$basededatos = "bdfactura";

$conexion = new mysqli( $servidor, $usuario, $contrasena,$basededatos);
if($conexion->connect_errno)
{
    die ("Error: ".$conexion->connect_errno);
}

?>