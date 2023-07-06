<?php 

	session_start();
	//print_r($_SESSION['tablaComprasTemp']);
 ?>

 <h4></h4>
 <style>
	@media (max-width: 767px) {
		.table-ventas {
			margin-left: auto;
			margin-right: auto;
		}
	}

	/* Estilos para dispositivos de escritorio */
	@media (min-width: 768px) {
		.table-ventas {
			margin-left: 200px;
		}
	}

	@media (max-width: 767px) {
	.btn-generar-venta {
		margin-left: 0;
		margin-right: auto;
		display: block;
	}
}

/* Estilos para dispositivos de escritorio */
@media (min-width: 768px) {
	.btn-generar-venta {
		margin-left: 200px;
	}
}
</style>
 <table class="table table-bordered table-hover table-condensed table-ventas" style="text-align: center; border: 2px solid black;">
 <br>
 	<tr>
 		<td style="border: 2px solid black; background-color: #ffbf77;">Nombre</td>
 		<td style="border: 2px solid black; background-color: #ffbf77;">Precio</td>
 		<td style="border: 2px solid black; background-color: #ffbf77;">Cantidad</td>
 		<td style="border: 2px solid black; background-color: #ffbf77;">Quitar</td>
		<td style="border: 2px solid black; background-color: #ffbf77;">Ticket</td>
 	</tr>
 	<?php 
 	$total= 0;//esta variable tendra el total de la compra en dinero
 	$cliente=""; //en esta se guarda el nombre del cliente
 		if(isset($_SESSION['tablaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaComprasTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td style="border: 2px solid black;"><?php echo $d[1] ?></td>
 		<td style="border: 2px solid black;"><?php echo $d[3] ?></td>
 		<td style="border: 2px solid black;"><?php echo $d[6]; ?></td>
 		<td style="border: 2px solid black;">
 			<span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>

 	</tr>

 <?php 
 		$total = $total + ($d[3] * $d[6]);
 		$i++;
 		$cliente=$d[4];
 	}
 	endif; 
 ?>

 	<tr>
 		<td> Total de venta: <?php echo "Bs.".$total; ?></td>
		 <td>
		 <td>
		 <td>
		 <td style="border: 2px solid black;">
            <a href="fpdf/ticketVenta.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i>
                Ticket
            </a>
        </td>
		</td>
		</td>
		</td>
 	</tr>
	

 </table>
 <caption>
 		<span class="btn btn-success btn-generar-venta" onclick="crearVenta()"> GENERAR VENTA
		 <span class="glyphicon glyphicon-usd"></span>
 		</span>
		 <br>
 	</caption>

 <script type="text/javascript">
 	$(document).ready(function(){
 		nombre="<?php echo @$cliente ?>";
 		$('#nombreclienteVenta').text("Nombre de cliente: " + nombre);
 	});
 </script>