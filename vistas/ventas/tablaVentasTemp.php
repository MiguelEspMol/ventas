<?php 

	session_start();
	//print_r($_SESSION['tablaComprasTemp']);
 ?>

 <h4></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center; border: 2px solid black;">
 	
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
 		<span class="btn btn-success" onclick="crearVenta()"> GENERAR VENTA
		 <span class="glyphicon glyphicon-usd"></span>
 		</span>
		 <br>
		 <br>
 	</caption>

 <script type="text/javascript">
 	$(document).ready(function(){
 		nombre="<?php echo @$cliente ?>";
 		$('#nombreclienteVenta').text("Nombre de cliente: " + nombre);
 	});
 </script>