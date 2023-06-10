<?php
require_once "../../clases/Conexion.php";

if(isset($_POST['idProducto']) && isset($_POST['cantidad'])){
  $idProducto = $_POST['idProducto'];
  $cantidadVendida = $_POST['cantidad'];

  // Actualizar la cantidad disponible en la tabla de artículos
  $c = new conectar();
  $conexion = $c->conexion();
  
  $sql = "UPDATE articulos SET cantidad = cantidad - $cantidadVendida WHERE id_producto = $idProducto";
  $result = mysqli_query($conexion, $sql);

  if($result){
    echo "success";
  } else {
    echo "error";
  }
}
?>
