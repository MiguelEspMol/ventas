<?php  
 session_start(); 
 require_once "../../clases/Conexion.php"; 
 
 $c= new conectar(); 
 $conexion=$c->conexion(); 
 
 $idcliente=$_POST['clienteVenta']; 
 $idproducto=$_POST['productoVenta']; 
 $descripcion=$_POST['descripcionV']; 
 $cantidad=$_POST['cantidadV']; 
 $precio=$_POST['precioV']; 
 
 $sql="SELECT nombre,apellido  
   from clientes  
   where id_cliente='$idcliente'"; 
 $result=mysqli_query($conexion,$sql); 
 
 $c=mysqli_fetch_row($result); 
 
 $ncliente=$c[1]." ".$c[0]; 
 
 $sql = "SELECT nombre, id_categoria  
 FROM articulos  
 WHERE id_producto='$idproducto'"; 
 $result = mysqli_query($conexion, $sql); 
 
 
$row = mysqli_fetch_row($result);
$nombreproducto = $row[0];
$categoriaproducto = $row[1];
 
 
if ($categoriaproducto == 1) { 
    $sql = "UPDATE articulos AS a 
    JOIN categorias AS c ON a.id_categoria = c.id_categoria 
    SET a.cantidad = a.cantidad - $cantidad 
    WHERE (c.id_categoria = 2 OR c.id_categoria = 3) 
    AND a.id_usuario = 1"; 
} elseif ($categoriaproducto == 2) { 
    $sql = "UPDATE articulos AS a 
    JOIN categorias AS c ON a.id_categoria = c.id_categoria 
    SET a.cantidad = a.cantidad - $cantidad 
    WHERE (c.id_categoria = 1) 
    AND a.id_usuario = 1"; 
} elseif ($categoriaproducto == 3) { 
    $sql = "UPDATE articulos AS a 
    JOIN categorias AS c ON a.id_categoria = c.id_categoria 
    SET a.cantidad = a.cantidad - $cantidad 
    WHERE (c.id_categoria = 1) 
    AND a.id_usuario = 1"; 
}

  
 $result = mysqli_query($conexion, $sql); 
 
 $articulo=$idproducto."||". 
    $nombreproducto."||". 
    $descripcion."||". 
    $precio."||". 
    $ncliente."||". 
    $idcliente."||". 
    $cantidad; 
 
 $_SESSION['tablaComprasTemp'][]=$articulo; 
 
 ?>