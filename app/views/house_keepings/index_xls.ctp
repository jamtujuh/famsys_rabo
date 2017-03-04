<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('List Point Reward', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($this->Session->read('pointReward.department_id',$this->data['pointReward']['department_id']) == null) {
	$department_id = 'All';
}else  {
	$department_id =  $departments[$this->Session->read('pointReward.department_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('List Point Reward', true) ;?></h2></td>
	</tr>
	<tr>	
		<td colspan="2"><?php echo __('Branch/Department', true) ;?></td>
		<td>: <?php echo $department_id ;?></td>
	</tr>
	<tr>	
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td>: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>	
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('MR', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('MR Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Department', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($pointRewards as $pointReward):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $pointReward['pointReward']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$pointReward['pointReward']['created_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$pointReward['pointReward']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $pointReward['pointReward']['created_by']; ?>&nbsp;</td>
	</tr>
	
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left" colspan="4"><?php echo $pointReward['pointReward']['notes']; ?>&nbsp;</td>
	</tr>
	
<?php endforeach; ?>
	</table>