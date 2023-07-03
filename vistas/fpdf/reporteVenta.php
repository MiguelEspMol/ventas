<?php


require('./fpdf.php');
require_once "../../clases/Conexion.php";

$c = new conectar();
$conexion = $c->conexion();

class PDF extends FPDF
{


   private $fechaInicio;
   private $fechaFin;


   function setFechas($fechaInicio, $fechaFin)
   {
      $this->fechaInicio = date('d-m-Y', strtotime($fechaInicio));
      $this->fechaFin = date('d-m-Y', strtotime($fechaFin));
   }


   // Cabecera de página
   function Header()
   {
      //include '../../clases/Conexion.php';//llamamos a la conexion BD

      $this->Image('../../img/LOGO3.png', 10, 5, 27); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(35); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Ln(7);
      $this->Cell(35);
      $this->Cell(110, 15, utf8_decode('INFORME DE VENTAS'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      if ($this->fechaInicio && $this->fechaFin) {
         $this->Ln(2);
         $this->Cell(51);
         $this->SetFont('Arial', 'B', 12);
         $this->Cell(0, 10, utf8_decode("Del: " . $this->fechaInicio . "             Al: " . $this->fechaFin), 0, 1, 'L', 0);
         $this->Ln(2);
      }

      /* CAMPOS DE LA TABLA */
      //color
      $this->Ln(10); // Salto de línea
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      //$this->Cell(5); // Movernos a la derecha
      $this->Cell(30, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Nombre del Plato'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('Total de Platos Vendidos'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Total Venta del Dia'), 1, 1, 'C', 1);
      //$this->Cell(5); // Movernos a la derecha
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 12); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 12); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}


$fechaInicio = $_GET['fechaInicio'];
$fechaFin = $_GET['fechaFin'];

$pdf = new PDF();
$pdf->setFechas($fechaInicio, $fechaFin);
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas


$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde


$totalGeneral = 0;
$totalGeneralPlatos = 0;



$sql = "SELECT fechaCompra, nombre, total_articulos_vendidos, total_venta_producto
        FROM (
            SELECT v.fechaCompra, a.nombre, SUM(v.cantidad) AS total_articulos_vendidos, SUM(v.precio) AS total_venta_producto
            FROM ventas v
            INNER JOIN articulos a ON v.id_producto = a.id_producto
            WHERE v.fechaCompra BETWEEN '$fechaInicio' AND '$fechaFin'
            GROUP BY v.fechaCompra, a.nombre
            UNION ALL
            SELECT fechaCompra, 'TOTAL DEL DIA', SUM(v.cantidad), SUM(v.precio)
            FROM ventas v
            INNER JOIN articulos a ON v.id_producto = a.id_producto
            WHERE fechaCompra BETWEEN '$fechaInicio' AND '$fechaFin'
            GROUP BY fechaCompra
        ) AS v
        ORDER BY fechaCompra, nombre";

$result = mysqli_query($conexion, $sql);

$fechaAnterior = null;


$i = $i + 1;
/* TABLA */
while ($ver = mysqli_fetch_array($result)) {

   $fechaActual = $ver['fechaCompra'];

   if ($fechaActual !== $fechaAnterior) {
      $pdf->Ln(5);
   }

   $pdf->Cell(30, 10, utf8_decode(date('d-m-Y', strtotime($ver['fechaCompra']))), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($ver['nombre']), 1, 0, 'C', 0);
   $pdf->Cell(60, 10, utf8_decode($ver['total_articulos_vendidos']), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode("Bs. " . $ver['total_venta_producto']), 1, 1, 'C', 0);

   if ($ver['nombre'] !== 'TOTAL DEL DIA' && !is_null($ver['total_venta_producto'])) {
      $totalGeneral += $ver['total_venta_producto'];
   }

   if ($ver['total_articulos_vendidos']) {
      $totalGeneralPlatos += $ver['total_articulos_vendidos'];
   }
   $fechaAnterior = $fechaActual;
}


$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, utf8_decode('TOTAL GENERAL'), 1, 0, 'C', 0); // Celda para el título "TOTAL GENERAL"
$pdf->Cell(60, 10, utf8_decode($totalGeneralPlatos), 1, 0, 'C', 0); // Celda para mostrar el Total General de platos vendidos
$pdf->Cell(50, 10, utf8_decode("Bs. " . $totalGeneral), 1, 1, 'C', 0); // Celda para mostrar el Total General de venta


$pdf->Output('reporte.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
