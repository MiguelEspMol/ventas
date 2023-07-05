<?php
session_start();
$iduser = $_SESSION['iduser'];
require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj = new articulos();

$datos = array();

$datos[0] = $_POST['categoriaSelect'];
$datos[1] = $iduser;
$datos[2] = $_POST['nombre'];
$datos[3] = $_POST['descripcion'];
$datos[4] = $_POST['cantidad'];
$datos[5] = $_POST['precio'];

echo $obj->insertaArticulo($datos);
?>