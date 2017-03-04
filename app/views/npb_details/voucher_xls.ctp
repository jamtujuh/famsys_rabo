<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Voucher', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['Npb_detail']['department_id'] == null) {
		$department_id = 'All';
}else {
		$department_id = $departments[$this->data['Npb_detail']['department_id']];
}
if($this->data['Npb_detail']['status'] == null) {
		$npb_status_id = 'All';
}else {
		$npb_status_id = $npbStatuses[$this->data['Npb_detail']['status']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Voucher', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Voucher Status', true);?></td>
		<td colspan="2">: <?php echo $npb_status_id;?></td>
		<td WIDTH="75"><?php echo __('Date Start', true);?></td>
		<td colspan="2">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true);?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td WIDTH="75"><?php echo __('Date End', true);?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>

<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2></h2></td>
	</tr>	
</table>

<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="15" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td width="80" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('MR No', true);?></div></td>
		<td width="50" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Carrefour', true);?></div></td>
		<td width="50" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Giant', true);?></div></td>
		<td width="50" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('MAP', true);?></div></td>
		<td width="50" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Hypermart', true);?></div></td>
		<td width="50" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Other', true);?></div></td>
		<td width="110" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Status', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($npbDetails as $npbDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$npbDetail['Npb']['department_id']]; ?></td>
		<td class="left">
		<?php echo $npbDetail['Npb']['no'];?>
		</td>
		<td class="number">
			<?php foreach($totals as $total){
				if($total['item_id'] == '402'){
					if($total['id'] == $npbDetail['NpbDetail']['id'] && $total['item_id'] == $npbDetail['NpbDetail']['item_id']){
						echo $total['total'];
					}											
				}
			}			
			?>
		</td>
		<td class="number">
			<?php foreach($totals as $total){
				if($total['item_id'] == '404'){
					if($total['id'] == $npbDetail['NpbDetail']['id'] && $total['item_id'] == $npbDetail['NpbDetail']['item_id']){
						echo $total['total'];
					}										
				}
			}			
			?>
		</td>
		<td class="number">
			<?php foreach($totals as $total){
				if($total['item_id'] == '403'){
					if($total['id'] == $npbDetail['NpbDetail']['id'] && $total['item_id'] == $npbDetail['NpbDetail']['item_id']){
						echo $total['total'];
					}						
				}
			}			
			?>
		</td>
		<td class="number">
			<?php foreach($totals as $total){
				if($total['item_id'] == '405'){
					if($total['id'] == $npbDetail['NpbDetail']['id'] && $total['item_id'] == $npbDetail['NpbDetail']['item_id']){
						echo $total['total'];
					}				
				}
			}			
			?>
		</td>	
		<td class="number">
			<?php foreach($totals as $total){
				if($total['item_id'] != '402' && $total['item_id'] != '403' && $total['item_id'] != '404' && $total['item_id'] != '405'){
					if($total['id'] == $npbDetail['NpbDetail']['id'] && $total['item_id'] == $npbDetail['NpbDetail']['item_id']){
						echo $total['total'];
					}
				}
			}			
			?>
		</td>		
		<td class="left"><?php echo $npbStatuses[$npbDetail['Npb']['npb_status_id']]; ?></td>	
	</tr>
<?php endforeach; ?>
	</table>