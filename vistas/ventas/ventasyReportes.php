<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql = "SELECT v.fechaCompra, a.nombre, v.cantidad AS total_articulos_vendidos, v.precio AS total_venta_producto
            FROM ventas v
            INNER JOIN articulos a ON v.id_producto = a.id_producto
            GROUP BY v.fechaCompra, a.nombre";
	
	$result=mysqli_query($conexion,$sql); 
	?>

<h4>Reportes y ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
	<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                <caption><label>Ventas por Fecha</label></caption>
                <tr>
                    <td>Fecha</td>
                    <td>Nombre del Plato</td>
                    <td>Total de Platos Vendidos</td>
          			<td>Total de Venta del Dia</td>
                </tr>
                <?php while($ver = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td><?php echo $ver['fechaCompra']; ?></td>
                        <td><?php echo $ver['nombre']; ?></td>
                        <td><?php echo $ver['total_articulos_vendidos']; ?></td>
            			<td><?php echo "Bs. " . $ver['total_venta_producto']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
	</div>

	</div>
	</div>
	<div class="col-sm-1"></div>
	

</div>

<script>
$(document).ready(function() {
	$('#btnVaciarVentasHechas').click(function() {
		$.ajax({
			url: "../procesos/ventas/vaciarTempHechas.php",
			success: function(r){
				$('#ventasyReportesLoad').load("ventas/ventasyReportes.php");
			}
		 });
	 });
 });

</script>
