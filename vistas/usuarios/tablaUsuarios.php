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


<h4></h4>
<style>
		/* Estilos para celulares */
		@media (max-width: 767px) {
			.table-usuarios {
				margin-left: auto;
				margin-right: auto;
			}
		}

		/* Estilos para dispositivos de escritorio */
		@media (min-width: 768px) {
			.table-usuarios {
				margin-top: -23px;
				margin-left: 100px;
			}
		}
</style>


<table class="table table-hover table-condensed table-bordered table-usuarios" style="text-align: center; border: 2px solid black;">
	<caption><label></label></caption>
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