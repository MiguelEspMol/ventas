
<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT art.nombre,
					art.descripcion,
					art.cantidad,
					art.precio,
					img.ruta,
					cat.nombreCategoria,
					art.fechaCaptura,
					art.id_producto
		  FROM articulos AS art 
		  INNER JOIN imagenes AS img ON art.id_imagen=img.id_imagen
		  INNER JOIN categorias AS cat ON art.id_categoria=cat.id_categoria";
	$result=mysqli_query($conexion,$sql);

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center; border: 2px solid black;">
	<caption><label>PLATOS</label></caption>
	<tr>
		<td style="border: 2px solid black; background-color: #ffbf77;">Nombre</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Descripcion</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Cantidad</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Precio</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Imagen</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Categoria</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Fecha</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Editar</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td style="border: 2px solid black;"><?php echo $ver[0]; ?></td>
		<td style="border: 2px solid black;"><?php echo $ver[1]; ?></td>
		<td style="border: 2px solid black;"><?php echo $ver[2]; ?></td>
		<td style="border: 2px solid black;"><?php echo $ver[3]; ?></td>
		<td style="border: 2px solid black;">
			<?php 
			$imgVer=explode("/", $ver[4]) ; 
			$imgruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
			?>
			<img width="80" height="80" src="<?php echo $imgruta ?>">
		</td>
		<td style="border: 2px solid black;"><?php echo $ver[5]; ?></td>
		<td style="border: 2px solid black;"><?php echo $ver[6]; ?></td>
		<td style="border: 2px solid black;">
			<span  data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $ver[7] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td style="border: 2px solid black;">
			<span class="btn btn-danger btn-xs" onclick="eliminaArticulo('<?php echo $ver[7] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>