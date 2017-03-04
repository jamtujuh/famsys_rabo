<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"". __('Famsys Interface', true) .' '.gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Famsys Interface', true) ;?></h2></td>
	</tr>	
	<tr>
		<td><?php echo __('Date Start', true) ;?></td>
		<td colspan="2">: <?php echo  $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
		<td><?php echo __('Date End', true) ;?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
			<td bgcolor="#CCCCCC"><?php echo __('No', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Status', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('RC', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Posting', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Posting Date', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Source Id', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Source Dt', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Source No', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Source Tm', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Kdtran', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Noref', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Norek1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Kdcab1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Ccy1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Nilai1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Norek2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Kdcab2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Ccy2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Nilai2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Costc1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Costc2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Costdept1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Costdept2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Kurs', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Ket1', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Ket2', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Ket3', true) ;?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($famsysInterfaces as $famsysInterface):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['rc']==='000'?'Yes':'No'; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['rc']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['posting']==1?'Yes':'No'; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['posting_date']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_id']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_dt']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_tm']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['kdtran']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['noref']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['norek1']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['kdcab1']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['ccy1']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->precision($famsysInterface['FamsysInterface']['nilai1'],0); ?></td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['norek2']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['kdcab2']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ccy2']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->precision($famsysInterface['FamsysInterface']['nilai2'],0); ?></td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['costc1']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['costc2']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['costdept1']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['costdept2']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['kurs']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ket1']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ket2']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ket3']; ?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
	</table>

