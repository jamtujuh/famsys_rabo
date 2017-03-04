<?php 
App::import('Vendor','xtcpdf');  
$pdf = new XTCPDF(); 
$textfont = 'freesans';
$pdf->SetAuthor("Rabobank Indonesia"); 
$pdf->SetAutoPageBreak( false ); 
$pdf->setHeaderFont(array($textfont,'',25)); 
$pdf->xheadercolor = array(255,255,255); 
$pdf->xheadertext = 'Surat Retur FA'; 
$pdf->xfootertext = $copyright_id;
$pdf->SetMargins(10, 15, 10);
$pdf->AddPage('L');
$pdf->Ln(4);
$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

$tbl = '<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td><IMG SRC="img/cake.icon.png" WIDTH=32 HEIGHT=34 ALT=""></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td WIDTH="100">Doc Date</td>
		<td>: '.$this->Time->format(DATE_FORMAT, $faRetur['FaRetur']['doc_date']) .'</td>
	</tr>
	<tr>
		<td WIDTH="100">No</td>
		<td>: '.$faRetur['FaRetur']['no'] .'</td>
	</tr>
	<tr>
		<td WIDTH="100">Branch</td>
		<td>: '.$departments[$faRetur['FaRetur']['department_id']] .'</td>
	</tr>
	<tr>
		<td WIDTH="100">Business Type</td>
		<td>: '.$faRetur['BusinessType']['name'] .'</td>
	</tr>
	<tr>
		<td WIDTH="100">Cost Center</td>
		<td>: '.$faRetur['CostCenter']['cost_centers'] .' - '.$faRetur['CostCenter']['name'] .'</td>
	</tr>
	<tr>
		<td WIDTH="100">Created By</td>
		<td>: '.$faRetur['FaRetur']['created_by'] .'</td>
	</tr>
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = '<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">No</div></td>
		<td width="110" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Asset Category</div></td>
		<td width="110" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">No Inventaris</div></td>
		<td width="80" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Code</div></td>
		<td width="80" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Name</div></td>
		<td width="90" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Brand</div></td>
		<td width="80" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Type</div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Color</div></td>
		<td width="80" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Serial No</div></td>
		<td width="65" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center">Date Of Purchase</div></td>
	</tr>';
	
	if (!empty($faRetur['FaReturDetail'])):
	$i = 0;
	foreach ($faRetur['FaReturDetail'] as $faReturDetail):
	$class = null;
	if ($i!=0 && $i%15== 0) {
				$tbl.='</table>';
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->AddPage();
				$pdf->Ln(5);
				}
	if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	
	
	$tbl .= '<tr>
		<td align="center">'.$i.'</td>
		<td align="left">'.$assetCategory[$faReturDetail['asset_category_id']].'</td>
		<td align="left">'.$faReturDetail['code'].'</td>
		<td align="left">'.$faReturDetail['item_code'].'</td>
		<td align="left">'.$faReturDetail['name'].'</td>
		<td align="left">'.$faReturDetail['brand'].'</td>
		<td align="left">'.$faReturDetail['type'].'</td>
		<td align="left">'.$faReturDetail['color'].'</td>
		<td align="left">'.$faReturDetail['serial_no'].'</td>
		<td align="left">'.$this->Time->format(DATE_FORMAT, $faReturDetail['date_of_purchase']).'</td>
	</tr>';
	endforeach;
	endif;
	$tbl .= '
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = '<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td height="60" align="left">Notes : <br>'.str_replace("\n","<br>",$faRetur['FaRetur']['notes']) .'</td>
	</tr>
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = '<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">Yang Menyerahkan,</td>
		<td align="center">Yang Menerima,</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center">(....................................................................)</td>
		<td align="center">(....................................................................)</td>
	</tr>
	<tr>
		<td align="center">Nama Lengkap & Tanda Tangan</td>
		<td align="center">Nama Lengkap & Tanda Tangan</td>
	</tr>
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// reset pointer to the last page
//$pdf->lastPage();

echo $pdf->Output('Print-'.$faReturDetail['id'].'.pdf', 'D'); 

?>