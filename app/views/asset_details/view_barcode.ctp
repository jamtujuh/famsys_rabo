<?php 
App::import('Vendor','xtcpdf');  
$pdf = new XTCPDF(); 
$textfont = 'freesans';
$pdf->SetAuthor("Rabobank Indonesia"); 
$pdf->SetAutoPageBreak( true ); 
$pdf->setHeaderFont(array($textfont,'',25)); 
$pdf->xheadercolor = array(255,255,255); 
$pdf->xheadertext = 'Barcode List Asset'; 
$pdf->xfootertext = 'Copyright © %d Rabobank. All rights reserved.';

//set margins
$pdf->SetMargins(10, 15, 10);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// add a page (required with recent versions of tcpdf) 
$pdf->AddPage();
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//$pdf->setLanguageArray($l);
$pdf->setBarcode(date('Y-m-d H:i:s'));
// define barcode style
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
	'fontsize' => 8,
	'stretchtext' => 4
);
$i = 0;
foreach ($assetDetails as $assetDetail):
	if ($i!=0 && $i%8 == 0) {
		$pdf->AddPage();
		$pdf->Ln(5);
	}
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$pdf->Cell(0, 0, $assetDetail['Department']['code'].'-'.$assetDetail['AssetDetail']['item_code'].'-'.$assetDetail['AssetDetail']['name'].'-'.$assetDetail['Purchase']['no'], 0, 1);
	$pdf->write1DBarcode( $assetDetail['AssetDetail']['code'], 'C39', '', '', '', 25, 0.3, $style, 'N');
endforeach;

echo $pdf->Output('Barcode-'.date('Y-m-d').'.pdf', 'D'); 

?>