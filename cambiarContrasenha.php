<!DOCTYPE html>
<html>
<head>
	<title>Cambiar contraseña</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel-heading">Cambiar contraseña</div>
					<div class="panel-body">
						<form id="frmCambiarContrasena">
							<label>Nueva contraseña</label>
							<input type="password" class="form-control input-sm" name="nueva_contrasena" id="nueva_contrasena">
							<p></p>
							<span class="btn btn-primary" id="cambiarContrasena">Cambiar contraseña</span>
							<a href="index.php" class="btn btn-default">Regresar al login</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cambiarContrasena').click(function(){
			vacios = validarFormVacio('frmCambiarContrasena');

			if (vacios > 0) {
				alert("Debes llenar todos los campos!!");
				return false;
			}

			datos = $('#frmCambiarContrasena').serialize();
			$.ajax({
				type: "POST",
				data: datos,
				url: "procesos/regLogin/cambiarContrasena.php",
				success: function(r){
					alert(r);

					if (r == 1) {
						alert("Contraseña cambiada con éxito");
					} else {
						alert("Fallo al cambiar la contraseña :(");
					}
				}
			});
		});
	});
</script>
