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
// Now you position and print your page content 
//$pdf->SetFont($textfont,'B',12); 

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', 
// $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example
$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

// Multicell test
//$pdf->MultiCell(100, 5, 'Purchase Order', 1, 'L', 1, 0, '', '', true);

$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
$tbl = '<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">No</div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Code</div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Name</div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Date Of Purchase</div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Serial Number</div></td>
		<td width="120" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Barcode</div></td>
	</tr>';
	
	if (!empty($assetDetails)):
	$i = 0;
	foreach ($assetDetails as $assetDetail): 
	$class = null;
	if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$pdf->Cell(0, 0, $assetDetail['AssetDetail']['code'], 0, 1);
	$tbl .= '<tr>
		<td>'.$i.'</td>
		<td>'.$assetDetail['AssetDetail']['code'].'</td>
		<td>'.$assetDetail['AssetDetail']['name'].'</td>
		<td>'.$assetDetail['AssetDetail']['date_of_purchase'].'</td>
		<td>'.$assetDetail['AssetDetail']['serial_no'].'</td>
		<td>'.$pdf->write1DBarcode($assetDetail['AssetDetail']['code'], 'C39E', '', '', '', 15, 0.2, $style, 'N').'</td>
	</tr>';

	endforeach;
	endif;
	$tbl .= '
</table>';

ob_end_clean();


$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

// reset pointer to the last page
//$pdf->lastPage();

echo $pdf->Output('Print-'.date('Y-m-d').'.pdf', 'I'); 

?>