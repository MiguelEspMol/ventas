<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql = "SELECT fechaCompra, nombre, total_articulos_vendidos, total_venta_producto
	FROM (
		SELECT v.fechaCompra, a.nombre, SUM(v.cantidad) AS total_articulos_vendidos, SUM(v.precio) AS total_venta_producto
		FROM ventas v
		INNER JOIN articulos a ON v.id_producto = a.id_producto
		GROUP BY v.fechaCompra, a.nombre
		UNION ALL
		SELECT fechaCompra, 'Total del Dia', NULL, SUM(precio)
		FROM ventas
		GROUP BY fechaCompra
	) AS v
	ORDER BY fechaCompra, nombre;";
	
	$result=mysqli_query($conexion,$sql); 
	?>

<h4>Reportes y ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
	<div class="table-responsive">
	<table id="tablaVentas" class="table table-hover table-condensed table-bordered" style="text-align: center; border: 2px solid black;">
                <caption><label>Ventas por Fecha</label></caption>
                <tr>
					<td style="border: 1px solid black; background-color: #ffbf77;">Fecha</td>
					<td style="border: 1px solid black; background-color: #ffbf77;">Nombre del Plato</td>
					<td style="border: 1px solid black; background-color: #ffbf77;">Total de Platos Vendidos</td>
					<td style="border: 1px solid black; background-color: #ffbf77;">Total de Venta del Dia</td>
                </tr>
                <?php while($ver = mysqli_fetch_array($result)): ?>
                    <tr class="fila-venta" >
                        <td style="border: 1px solid black; background-color: #e0e0e0;"><?php echo $ver['fechaCompra']; ?></td>
                        <td style="border: 1px solid black; background-color: #e0e0e0;"><?php echo $ver['nombre']; ?></td>
                        <td style="border: 1px solid black; background-color: #e0e0e0;"><?php echo $ver['total_articulos_vendidos']; ?></td>
            			<td style="border: 1px solid black; background-color: #e0e0e0;"><?php echo "Bs. " . $ver['total_venta_producto']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
	</div>

	<form id="formFechas" action="fpdf/reporteVenta.php" method="GET">
  		<div class="form-group">
    		<label for="fechaInicio">Fecha de inicio:</label>
    		<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" style="border: 1px solid black; background-color: #ffbf77;">
  		</div>
  		<div class="form-group">
    		<label for="fechaFin">Fecha de fin:</label>
    		<input type="date" class="form-control" id="fechaFin" name="fechaFin" style="border: 1px solid black; background-color: #ffbf77;">
  		</div>
  		<button type="submit" class="btn btn-primary" id="buscarFechas">Buscar Ventas</button>
  		<button type="button" class="btn btn-danger" id="btnVaciarVentas">Vaciar Ventas</button>
	</form>

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

$('#buscarFechas').on('click', '#formFechas button[type="submit"]', function() {
        var fechas = [];

        $('.fila-venta').each(function() {
            var fecha = $(this).find('td:first').text();
            fechas.push(fecha);
        });

        $('#formFechas').data('fechas', fechas);
    });

$('#btnVaciarVentas').click(function() {
      // Vaciar los datos de la tabla
      $('#tablaVentas').empty();

	  $('#tablaVentas').attr('hidden', true);
    });

      // Mostrar la tabla eliminando el atributo "hidden"
$('#tablaVentas').removeAttr('hidden');

</script>
