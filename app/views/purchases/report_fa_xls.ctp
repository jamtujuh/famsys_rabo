<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Fixed Asset Register Report', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($this->Session->read('AssetReport.department_id') == null) {
	$department_id = 'All';
}else  {
		$department_id =  $departments[$this->Session->read('AssetReport.department_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fixed Asset Register Report', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true);?></td>
		<td>: <?php echo $department_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Code', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Category', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Purchase', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Acquisition Cost', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum. Depr.', true);?></div></td>
	</tr>
	<?php
	$total=0;
	$i = 0;
	foreach ($purchases as $purchase):
		foreach ($purchase['Asset'] as $asset):
			foreach ($asset['AssetDetail'] as $assetDetail):
				//if($department_id && $assetDetail['department_id']!=$department_id) break;
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
	?>
	<tr>
		<td class="number"><?php echo $i; ?></td>
		<td class="number"><?php echo $purchase['Purchase']['no']; ?></td>
		<td class="left"><?php echo $assetDetail['code']; ?></td>
		<td><?php echo $assetDetail['name']; ?></td>
		<td><?php echo $assetCategories[ $assetDetail['asset_category_id']]; ?></td>
		<td><?php if(!empty($assetDetail['date_start'])):
					echo $this->Time->format(DATE_FORMAT, $assetDetail['date_start']);
					endif; ?></td>
		<td><?php echo $departments[ $assetDetail['department_id'] ]; ?></td>
		<td align="right"><?php echo $this->Number->precision($assetDetail['price'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($assetDetail['depthnini'],0); ?></td>
	</tr>
	<?php $total += $this->Number->precision($assetDetail['price'],0);?>
	<?php endforeach; ?>
	<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<td colspan="7"></td>
		<td><div align="right"><?php echo $this->Number->precision($total,0);?></div></td>
		<td></td>
	</tr>
</table>