<?php
// Incluir archivos de conexión y definición de la clase Ventas

require_once "../../clases/Conexion.php";
require_once "../../clases/Ventas.php";

$c = new conectar();
$conexion = $c->conexion();

$obj = new Ventas();

// Obtener las fechas enviadas desde el formulario
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];

// Consulta SQL para obtener las ventas según las fechas seleccionadas
$sql = "SELECT fechaCompra, nombre, total_articulos_vendidos, total_venta_producto
        FROM (
            SELECT v.fechaCompra, a.nombre, SUM(v.cantidad) AS total_articulos_vendidos, SUM(v.precio) AS total_venta_producto
            FROM ventas v
            INNER JOIN articulos a ON v.id_producto = a.id_producto
            WHERE v.fechaCompra BETWEEN '$fechaInicio' AND '$fechaFin'
            GROUP BY v.fechaCompra, a.nombre
            UNION ALL
            SELECT fechaCompra, 'Total del Dia', NULL, SUM(precio)
            FROM ventas
            WHERE fechaCompra BETWEEN '$fechaInicio' AND '$fechaFin'
            GROUP BY fechaCompra
        ) AS v
        ORDER BY fechaCompra, nombre";

$result = mysqli_query($conexion, $sql);


$totalPlatosVendidos = 0;
$totalVentas = 0;
$totalVentaDia = 0;

// Generar la tabla de ventas con los resultados obtenidos
echo '<body style="background-color: #f5f5f5;">';
echo '<div class="d-flex justify-content-center">';
echo '<div class="table-responsive">';
echo '<table id="tablaVentas" class="table table-hover table-condensed table-bordered" style="text-align: center; border: 2px solid black;">';
echo '<caption><label>Ventas por Fecha</label></caption>';
echo '<tr>';
echo '<td style="border: 1px solid black; background-color: #ffbf77;">Fecha</td>';
echo '<td style="border: 1px solid black; background-color: #ffbf77;">Nombre del Plato</td>';
echo '<td style="border: 1px solid black; background-color: #ffbf77;">Total de Platos Vendidos</td>';
echo '<td style="border: 1px solid black; background-color: #ffbf77;">Total de Venta del Dia</td>';
echo '</tr>';

while ($ver = mysqli_fetch_array($result)) {

    $totalPlatosVendidos += $ver['total_articulos_vendidos'];

    if ($ver['nombre'] === 'Total del Dia') {
        $totalVentaDia += $ver['total_venta_producto'];
    }


    echo '<tr>';
    echo '<td style="border: 1px solid black; background-color: #e0e0e0;">' . $ver['fechaCompra'] . '</td>';
    echo '<td style="border: 1px solid black; background-color: #e0e0e0;">' . $ver['nombre'] . '</td>';
    echo '<td style="border: 1px solid black; background-color: #e0e0e0;">' . $ver['total_articulos_vendidos'] . '</td>';
    echo '<td style="border: 1px solid black; background-color: #e0e0e0;">Bs. ' . $ver['total_venta_producto'] . '</td>';
    echo '</tr>';
}

echo '<tr>';
echo '<td style="border: 1px solid black; background-color: #e0e0e0;" colspan="2">Total General</td>';
echo '<td style="border: 1px solid black; background-color: #e0e0e0;">' . $totalPlatosVendidos . '</td>';
echo '<td style="border: 1px solid black; background-color: #e0e0e0;">Bs. ' . $totalVentaDia . '</td>';
echo '<td style="border: 1px solid black; background-color: #e0e0e0;"></td>';
echo '<td style="border: 1px solid black; background-color: #ffbf77;">
            <a href="../../vistas/fpdf/reporteVenta.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i>
                Reporte
            </a>
        </td>';
echo '</tr>';
    

echo '</table>';
echo '</div>';
echo '</div>';
echo '</body>';

?>