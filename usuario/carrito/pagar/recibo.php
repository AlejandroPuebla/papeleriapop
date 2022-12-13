<?php

include("../../../conexion.php");
require('../../../../../fpdf.php');

class PDF_nueva extends FPDF
{
   //Cabecera de página
   function Header()
   {

       $this->Image('../../../imagenes/logo/logo.jpg',10,5,40,40);

     	$this->SetFont('Arial','B',18);
	
	
		$this->Ln();
       

     	$this->Cell(140,10,'Papeleria Pop',0,0,'C'  );
		$this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(144,10,'www.papeleriapop.com.mx',0,0,'C'  );
		$this->Ln();
        $this->SetFont('Arial','B',5);
        $this->Cell(128,4,'Este no es un documento tributario',0,0,'C'  );
		$this->Ln();
        $this->Cell(120,4,'Tamaño del ticket 58mm',0,0,'C'  );
        $this->Ln();
		$this->Ln();
        $this->Ln();
		$this->Ln();
        $this->Ln();
    
        include("../../../conexion.php");
        $query = mysqli_query($conexion, "SELECT folio_venta,fecha,hora
                                          FROM ventas v
                                          ORDER BY id_venta DESC
                                          LIMIT 1");
                                
        while ($inv = mysqli_fetch_array($query)) {
            $folio=$inv['0'];
            $fecha=$inv['1'];
            $hora=$inv['2'];
        }

        $this->SetFont('Arial','B',10);
        $this->Cell(144,8,'Fecha: '.$fecha,0,0,'L'  );
        $this->Ln();
        $this->Cell(144,8,'Hora: '.$hora,0,0,'L'  );
        $this->Ln();
        $this->Cell(144,8,'#Venta: '.$folio,0,0,'L'  );
        $this->Ln();
        $this->Cell(144,8,'Estado: Pagado',0,0,'L'  );
        $this->Ln();
        $this->Cell(144,8,'Direccion: Las misiones #25 colonia aztecas',0,0,'L'  );
        $this->Ln();
        $this->Cell(144,8,'Vendedor: Valeria Katherin Acuña Bermudez',0,0,'L'  );
        $this->Ln();
        $this->Ln();



   }
    
   
//Pie de página
    function Footer()
    {

        //$this->Image('logo_computol.png',10,260,40,40);
        $this->SetY(-20);

        $this->SetFont('Arial','B',18);

       // $this->Cell(0,10,'     Ventas por factura',0,0,'C'  );
        //$this->Cell(0,10,'P'.$this->PageNo(),0,0,'R');
        //$this->Cell(0,10,'P'.$this->PageNo(),0,0,'R');
   }
}


$pdf = new PDF_nueva();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);

$pdf->Cell(14, 12, "Folio", 1, 0, 'C');	
$pdf->Cell(30, 12, "Producto", 1, 0, 'C');
$pdf->Cell(30, 12, "Marca", 1, 0, 'C');
$pdf->Cell(35, 12, "Descripcion", 1, 0, 'C');
$pdf->Cell(22, 12, "Cantidad", 1, 0, 'C');
$pdf->Cell(14, 12, "P/U", 1, 0, 'C');
$pdf->Cell(20, 12, "Img", 1, 0, 'C');
$pdf->Cell(25, 12, "Total", 1, 0, 'C');


$pdf->Ln();

$query = mysqli_query($conexion, "SELECT folio_venta,fecha,hora
                                          FROM ventas v
                                          ORDER BY id_venta DESC
                                          LIMIT 1");
                                
        while ($inv = mysqli_fetch_array($query)) {
            $folio=$inv['0'];
        }

$final = 0;

$query = mysqli_query($conexion, "SELECT i.id_producto,i.nombre_producto,i.marca_producto,i.descripcion_producto,v.cantidad,i.precio_unitario,i.imagen, SUM(v.cantidad*i.precio_unitario) as total
                                                        FROM ventas v, inventario i 
                                                        WHERE i.id_producto=v.id_producto
                                                        AND v.folio_venta='$folio'
                                                        GROUP BY v.id_venta
                                                        ");

while ($inv = mysqli_fetch_array($query)) {
    $total=$inv['7'];
    $pdf->Cell(14,12, $inv['0'], 1,0,'C');
    $pdf->Cell(30,12, $inv['1'], 1,0,'C');
    $pdf->Cell(30,12, $inv['2'], 1,0,'C');
    $pdf->Cell(35,12, $inv['3'], 1,0,'C');
    $pdf->Cell(22,12, $inv['4'], 1,0,'C');
    $pdf->Cell(14,12, "$".$inv['5'], 1,0,'C');
    $pdf->Cell(20,12, $pdf->Image('../../../imagenes/productos/'.$inv['6'], $pdf->GetX()+4, $pdf->GetY()+1,11),1,0,'C');
    $pdf->Cell(25,12, "$".$inv['7'], 1,0,'C');
    $pdf->Ln();

    $final=$final+$total;
}

    $pdf->Cell(14,12, "", 1,0,'C');
    $pdf->Cell(30,12, "", 1,0,'C');
    $pdf->Cell(30,12, "", 1,0,'C');
    $pdf->Cell(35,12, "", 1,0,'C');
    $pdf->Cell(22,12, "", 1,0,'C');
    $pdf->Cell(34,12, "Total",1,0,'C');
    $pdf->Cell(25,12, "$".$final, 1,0,'C');
    if($final>499 && $final<1000){
        $pdf->Ln();
        $pdf->Cell(14,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(35,12, "", 1,0,'C');
        $pdf->Cell(22,12, "", 1,0,'C');
        $pdf->Cell(34,12, "Descuento",1,0,'C');
        $descuento=($final/100)*4;
        $pdf->Cell(25,12, "$".$descuento, 1,0,'C');
        $pdf->Ln();
        $pdf->Cell(14,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(35,12, "", 1,0,'C');
        $pdf->Cell(22,12, "", 1,0,'C');
        $pdf->Cell(34,12, "Precio final",1,0,'C');
        $final=$final-$descuento;
        $pdf->Cell(25,12, "$".$final, 1,0,'C');
    }elseif($final>999){
        $pdf->Ln();
        $pdf->Cell(14,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(35,12, "", 1,0,'C');
        $pdf->Cell(22,12, "", 1,0,'C');
        $pdf->Cell(34,12, "Descuento",1,0,'C');
        $descuento=($final/100)*8;
        $pdf->Cell(25,12, "$".$descuento, 1,0,'C');
        $pdf->Ln();
        $pdf->Cell(14,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(30,12, "", 1,0,'C');
        $pdf->Cell(35,12, "", 1,0,'C');
        $pdf->Cell(22,12, "", 1,0,'C');
        $pdf->Cell(34,12, "Precio final",1,0,'C');
        $final=$final-$descuento;
        $pdf->Cell(25,12, "$".$final, 1,0,'C');
    }else{

    }

    

$pdf->Output('');