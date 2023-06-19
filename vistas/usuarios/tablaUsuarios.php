<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_usuario,
					nombre,
					apellido,
					email
			from usuarios";
	$result=mysqli_query($conexion,$sql);

 ?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center; border: 2px solid black;">
	<caption><label>Usuarios</label></caption>
	<tr>
		<td style="border: 2px solid black; background-color: #ffbf77;">Nombre</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Apellido</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Usuario</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Editar</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td style="border: 2px solid black;"><?php echo $ver[1]; ?></td>
		<td style="border: 2px solid black;"><?php echo $ver[2]; ?></td>
		<td style="border: 2px solid black;"><?php echo $ver[3]; ?></td>
		<td style="border: 2px solid black;">
			<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td style="border: 2px solid black;">
			<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>