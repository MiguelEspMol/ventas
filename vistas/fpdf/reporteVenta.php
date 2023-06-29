<?php


require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../clases/Conexion.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('../../img/LOGO3.png', 10, 5, 27); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(43); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('INFORME DE VENTAS'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

     

      /* CAMPOS DE LA TABLA */
      //color
      $this->Ln(20); // Salto de línea
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10); // Movernos a la derecha
      $this->Cell(20, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Nombre del Plato'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('Total de Platos Vendidos'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Total Venta del Dia'), 1, 1, 'C', 1);
      $this->Cell(10); // Movernos a la derecha
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../clases/Conexion.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

//$consultaVentas = $conexion->query($sql);

//while ($datos_reporte = $consultaVentas->fetch_object()) { 
   // $fechaCompra = $datos_reporte->fechaCompra;
    //$nombre = $datos_reporte->nombre;
    //$total_articulos_vendidos = $datos_reporte->total_articulos_vendidos;
    //$total_venta_producto = $datos_reporte->total_venta_producto;     
   //}

$i = $i + 1;
/* TABLA */
$pdf->Cell(20, 10, utf8_decode("fechaCompra"), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode("nombre"), 1, 0, 'C', 0);
$pdf->Cell(60, 10, utf8_decode("total_articulos_vendidos"), 1, 0, 'C', 0);
$pdf->Cell(50, 10, utf8_decode("total_venta_producto"), 1, 1, 'C', 0);


$pdf->Output('reporte.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
