<?php 
App::import('Vendor','xtcpdf');  
$pdf = new XTCPDF(); 
$textfont = 'freesans';
$pdf->SetAuthor("Rabobank Indonesia"); 
$pdf->SetAutoPageBreak( true ); 
$pdf->setHeaderFont(array($textfont,'',25)); 
$pdf->xheadercolor = array(255,255,255); 
$pdf->xheadertext = ''; 
$pdf->xfootertext = '';
$pdf->SetFont('helvetica', '', 6);

//set margins
$pdf->SetMargins(10,10,10,10);
$pdf->AddPage();
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setBarcode(date('Y-m-d H:i:s'));
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 6,
	'stretchtext' => 4
);

//barcode propoerties
$w 		= 70;
$h 		= 20;
$xres 	= 0.5;
$type 	= 'C39';
$align 	= 'N';

//start
$x = $start_x = 3;
$y = $start_y = 8;
$space_x = 15;
$space_y = 25;
$row=0;

foreach ($assetDetails as $i=>$assetDetail):
	if ($i!=0 && $i%10 == 0) {
		$pdf->AddPage();
		$pdf->Ln(5);
		$x = $start_x ;
		$y = $start_y ;
		$row = 0;
	}
	
	//kelipatan 2?
	if ($i % 2 == 0 ) 
	{
		$x = $start_x;
		$y = $start_y + $row*($h + $space_y);
		$row++;
	}
	else
	{
		$x = $start_x + $w + $space_x;
	}
	
	$pdf->write1DBarcode( $assetDetail['AssetDetail']['code'], $type, $x, $y, $w, $h, $xres, $style, $align);
	
	$pdf->Text($x,$y+$h, $assetDetail['AssetDetail']['name']);
	$pdf->Text($x+40,  $y+$h,   $this->Time->format(DATE_FORMAT, $assetDetail['AssetDetail']['date_of_purchase'] ));
	$pdf->Text($x,     $y+$h+3, $assetDetail['Department']['name'] );
	$pdf->Text($x+40,  $y+$h+3, $assetDetail['Purchase']['no'] );
	
	
endforeach;

echo $pdf->Output('Barcode-'.date('Y-m-d').'.pdf', 'D'); 

?>