<?php 

class ventas{
	public function obtenDatosProducto($idproducto){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql = "SELECT 
				    art.nombre,
				    art.descripcion,
				    art.cantidad,
				    art.precio
				FROM
				    articulos AS art
				WHERE
				    art.id_producto = '$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$data=array(
			'nombre' => $ver[0],
			'descripcion' => $ver[1],
			'cantidad' => $ver[2],
			'precio' => $ver[3]
		);		
		return $data;
	}

	public function crearVenta(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
		$idventa=self::creaFolio();
		$datos=$_SESSION['tablaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);

			$precio_de_ventas = $d[3] * $d[6];

			$sql="INSERT into ventas (id_venta,
										id_cliente,
										id_producto,
										id_usuario,
										precio,
										cantidad,
										fechaCompra)
							values ('$idventa',
									'$d[5]',
									'$d[0]',
									'$idusuario',
									'$precio_de_ventas',
									'$d[6]',
									'$fecha')";
			$r=$r + $result=mysqli_query($conexion,$sql);

			$cantidad_actual = (self::obtenDatosProducto($d[0]))['cantidad'];

			$nueva_cantidad = $cantidad_actual - $d[6];

			$sql="UPDATE articulos SET cantidad = '$nueva_cantidad' WHERE id_producto = '$d[0]'";
			$result=mysqli_query($conexion,$sql);
		}

		return $r;
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_venta from ventas group by id_venta desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT apellido,nombre
			from clientes 
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT precio 
				from ventas 
				where id_venta='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}

	public function obtenCantidadDisponible($idproducto){
		$c = new conectar();
		$conexion = $c->conexion();
	
		$sql = "SELECT cantidad 
					FROM articulos 
					WHERE id_producto = '$idproducto'";
		$result = mysqli_query($conexion, $sql);
	
		$ver = mysqli_fetch_row($result);
	
		return $ver[0];
	}
	
}

?>
