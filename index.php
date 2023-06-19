<?php 
	
	require_once "clases/Conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";
	$result=mysqli_query($conexion,$sql);
	$validar=0;
	if(mysqli_num_rows($result) > 0){
		$validar=1;
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login de usuario</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
</head>
<body style="background-color: orange">
<div class="col-md-12" style="background: linear-gradient(to bottom, #ffbf77 50%, #ff9c2d 50%);">
    <div class="escudo pull-left">
        <img src="img/ministeridesalud.png" width="100px">
    </div>
    <div class="logo pull-right">
        <img src="img/LOGO3.png" width="100px">
    </div>
</div>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">
					<h3 class=¨panel-title¨>Sistema de Ventas de Comida</h3>
					</div>
					<div class="panel panel-body">
					<p>
    					<img src="img/LOGO2.png" height="330" width="330" style="max-width: 100%;">
					</p>
						<form id="frmLogin">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Contraseña</label>
							<input type="password" name="password" id="password" class="form-control input-sm">
							<p></p>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
							<?php  if(!$validar): ?>
							<a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
							<?php endif; ?>
						</form>
						<div class="login-form-forgotpassword form-group text-center">
     						<a href="cambiarContrasenha.php">¿Ha olvidado su contraseña?</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
	<footer style="position: fixed; bottom: 0; left: 0; width: 100%; margin: 0; padding: 10px; background-color: #ffbf77; text-align: center;">
    <div style="background-color: #ffbf77; padding: 0px;">
        <p><b><small>Desarrollado por Miguel Espinoza Mollinedo</small></b> | <b><small>Email: miguelespmol@gmail.com</small></b></p>
    </div>
</footer>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

		vacios=validarFormVacio('frmLogin');

			if(vacios > 0){
				alert("Debes llenar todos los campos!!");
				return false;
			}

		datos=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"procesos/regLogin/login.php",
			success:function(r){

				if(r==1){
					window.location="vistas/inicio.php";
				}else{
					alert("No se pudo acceder :(");
				}
			}
		});
	});
	});
</script>