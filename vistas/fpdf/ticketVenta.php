<?php

session_start();
require('./fpdf.php');


class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../../clases/Conexion.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('../../img/LOGO3.png', 5, 5, 12); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 10); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(5); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(50, 20, utf8_decode('Ticket de Venta'), 0, 1, 'L', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(1); // Salto de línea
      $this->SetTextColor(103); //color

     

      /* CAMPOS DE LA TABLA */
      //color
      $this->Ln(5); // Salto de línea
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 7);
      $this->Cell(0.1); // Movernos a la derecha
      $this->Cell(12, 7, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(12, 7, utf8_decode('Precio'), 1, 0, 'C', 1);
      $this->Cell(14, 7, utf8_decode('Cantidad'), 1, 1, 'C', 1);
      $this->Cell(0.1); // Movernos a la derecha
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 10); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(40, 5, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../clases/Conexion.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
//$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AddPage('P', array(60, 105)); // Tamaño personalizado para un ticket vertical
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 7);
$pdf->SetDrawColor(163, 163, 163); //colorBorde



$i = $i + 1;
/* TABLA */
if (isset($_SESSION['tablaComprasTemp']) && is_array($_SESSION['tablaComprasTemp'])) {
   foreach ($_SESSION['tablaComprasTemp'] as $key) {
       $d = explode("||", $key);

       // Obtener los datos
       $nombre = $d[1];
       $precio = $d[3];
       $cantidad = $d[6];

       // Agregar los datos al PDF
       $pdf->Cell(12, 7, utf8_decode($nombre), 1, 0, 'C', 0);
       $pdf->Cell(12, 7, utf8_decode($precio), 1, 0, 'C', 0);
       $pdf->Cell(14, 7, utf8_decode($cantidad), 1, 1, 'C', 0);
   }
}


$pdf->Output('reporte.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
