<?php 
	require_once "../../clases/Conexion.php";
	$c = new conectar();
	$conexion = $c->conexion();
	$sql = "SELECT art.nombre,
			art.descripcion,
			art.cantidad,
			art.precio,
			cat.nombreCategoria,
			DATE_FORMAT(art.fechaCaptura, '%d-%m-%Y') as fechaCaptura,
			art.id_producto
		FROM articulos AS art 
		INNER JOIN categorias AS cat ON art.id_categoria = cat.id_categoria";
	$result = mysqli_query($conexion, $sql);
?>

<style>
    /* Estilos para dispositivos móviles */
    @media (max-width: 767px) {
        .table-responsive {
            width: auto;
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
        }

        table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
</style>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center; border: 2px solid black;">
        <br>
        <tr>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Nombre</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Descripcion</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Cantidad</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Precio</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Categoria</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Fecha</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Editar</strong></td>
            <td style="border: 2px solid black; background-color: #ffbf77;"><strong>Eliminar</strong></td>
        </tr>

        <?php while($ver = mysqli_fetch_row($result)): ?>

        <tr>
            <td style="border: 2px solid black;"><?php echo $ver[0]; ?></td>
            <td style="border: 2px solid black;"><?php echo $ver[1]; ?></td>
            <td style="border: 2px solid black;"><?php echo $ver[2]; ?></td>
            <td style="border: 2px solid black;"><?php echo $ver[3]; ?></td>
            <td style="border: 2px solid black;"><?php echo $ver[4]; ?></td>
            <td style="border: 2px solid black;"><?php echo $ver[5]; ?></td>
            <td style="border: 2px solid black;">
                <span data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $ver[6]; ?>')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
            </td>
            <td style="border: 2px solid black;">
                <span class="btn btn-danger btn-xs" onclick="eliminaArticulo('<?php echo $ver[6]; ?>')">
                    <span class="glyphicon glyphicon-remove"></span>
                </span>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
