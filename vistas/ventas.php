<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>ventas</title>
	<?php require_once "menu.php"; ?>
	<style>
		/* Estilos para celulares */
		@media (max-width: 767px) {
			.btn-ventaProducto {
				margin-left: 17px;
				margin-right: auto;
			}
		}

		@media (max-width: 767px) {
			.btn-ventasHechas {
				margin-left: 40px;
				margin-right: auto;
			}
		}

		/* Estilos para dispositivos de escritorio */
		@media (min-width: 768px) {
			.btn-ventaProducto {
				margin-left: 50px;
				font-size: 15px;
			}
		}

		@media (min-width: 768px) {
			.btn-ventasHechas {
				margin-left: 750px;
				font-size: 15px;
			}
		}
	</style>
</head>
<body>

	<div class="container">
		 <h1></h1>
		 <br>
		 <br>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<span class="btn btn-default btn-ventaProducto" id="ventaProductosBtn" style="border: 1px solid black; background-color: #ffbf77;"><b>REALIZAR VENTA</b></span>
		 		<span class="btn btn-default btn-ventasHechas" id="ventasHechasBtn" style="border: 1px solid black; background-color: #ffbf77;"><b>VENTAS HECHAS</b></span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="ventaProductos"></div>
		 		<div id="ventasHechas"></div>
		 	</div>
		 </div>
	</div>
</body>
</html>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#ventaProductosBtn').click(function(){
				esconderSeccionVenta();
				$('#ventaProductos').load('ventas/ventasDeProductos.php');
				$('#ventaProductos').show();
			});
			$('#ventasHechasBtn').click(function(){
				esconderSeccionVenta();
				$('#ventasHechas').load('ventas/ventasyReportes.php');
				$('#ventasHechas').show();
			});
		});

		function esconderSeccionVenta(){
			$('#ventaProductos').hide();
			$('#ventasHechas').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>