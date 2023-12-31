<?php

session_start();
require('./fpdf.php');


class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {

      $this->Image('../../img/LOGO3.png', 5, 5, 12); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 10); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(10); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(50, 20, utf8_decode('Ticket de Venta'), 0, 1, 'L', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(1); // Salto de línea
      $this->SetTextColor(103); //color

     

      /* CAMPOS DE LA TABLA */
      //color
      $this->Ln(2); // Salto de línea
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 7);
      $this->Cell(0.1); // Movernos a la derecha
      $this->Cell(23, 7, utf8_decode('Nombre del Plato'), 1, 0, 'L', 1);
      $this->Cell(12, 7, utf8_decode('Precio'), 1, 0, 'C', 1);
      $this->Cell(14, 7, utf8_decode('Cantidad'), 1, 1, 'C', 1);
      $this->Cell(0.1); // Movernos a la derecha
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'B', 10); //tipo fuente, cursiva, tamañoTexto
      $this->Cell(3);
      $hoy = date('d/m/Y');
      $this->Cell(40, 5, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}


$pdf = new PDF();
//$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AddPage('P', array(68, 105)); // Tamaño personalizado para un ticket vertical
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 7);
$pdf->SetDrawColor(163, 163, 163); //colorBorde


$total= 0;
$i = $i + 1;
/* TABLA */
if (isset($_SESSION['tablaComprasTemp']) && is_array($_SESSION['tablaComprasTemp'])) {
   foreach ($_SESSION['tablaComprasTemp'] as $key) {
       $d = explode("||", $key);

       // Obtener los datos
       $nombre = $d[1];
       $precio = $d[3];
       $cantidad = $d[6];
      
       $total = $total + ($d[3] * $d[6]);
       // Agregar los datos al PDF
       $pdf->Cell(23, 7, utf8_decode($nombre), 1, 0, 'C', 0);
       $pdf->Cell(12, 7, utf8_decode($precio), 1, 0, 'C', 0);
       $pdf->Cell(14, 7, utf8_decode($cantidad), 1, 1, 'C', 0);
 	}
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(49, 7, utf8_decode("Total de venta: " . "Bs. ". $total), 1, 1, 'C', 0);
}


$pdf->Output('reporte.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
