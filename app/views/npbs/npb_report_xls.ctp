<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Memo Request Report '. ucwords($type), true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$department_id = '';

if ($this->data['Npb']['department_id'] == null) {
	$department_id = 'All';
}else  {
		$department_id = $departments[$this->data['Npb']['department_id']];
}
if ($this->data['Npb']['business_type_id'] == null) {
	$business_type_id = 'All';
}else  {
		$business_type_id = $businessType[$this->data['Npb']['business_type_id']];
}
if ($this->data['Npb']['cost_center_id'] == null) {
	$cost_center_id = 'All';
}else  {
		$cost_center_id = $costCenter[$this->data['Npb']['cost_center_id']];
}
if ($this->data['Npb']['cost_center_id'] == null) {
	$cost_center_ids = '';
}else  {
		$cost_center_ids = $costCenters[$this->data['Npb']['cost_center_id']];
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Memo Request Report '. ucwords($type), true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Branch', true);?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		
		<td colspan="2"><?php echo __('Date Start', true);?></td>
		<td colspan="2">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Busines Type', true);?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
		
		<td colspan="2"><?php echo __('Date End', true);?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Cost Center', true);?></td>
		<td colspan="2">: <?php echo $cost_center_id;?>&nbsp;<?php echo $cost_center_ids;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Mr', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Is Done ?', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Name', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty Full Fill', true);?></div></td>
		<?php if($type=='outstanding') { ?>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Balance', true);?></div></td>
		<?php } ?>
		<?php 
			if($type=='finish') :
		    echo '<td bgcolor="#CCCCCC">' ;
			echo __('Finish Date', true);
			echo '</td>' ;
			endif;
			?>
	</tr>
	<?php
	$i = 0;
	foreach ($npbs as $npb):
		if($npb['NpbDetail'] == null)
		continue;
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	    
		<td class="left"><?php echo $i ?></td>
		
		<td class="left"><?php echo $npb['Npb']['no']; ?></td>
		
		<td>
			<?php echo $npb['Department']['name']; ?>			
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['npb_date']); ?></td>
		<?php if($npb['Npb']['v_is_done'] == 1){
		$done = 'Yes';
		}else{
		$done = 'No';
		}
		?>
		<td class="center"><?php echo $done; ?></td>
     
		<?php foreach ($npb['NpbDetail'] as $j=>$d) : ?>
			<?php if($j==0) :?>
				<td>
					<?php echo $d['item_name']?>
				</td>
				<td align="right">
					<?php echo $d['qty']?>
				</td>	
				<td align="right">
					<?php echo $d['qty_filled']?>
				</td>	
				<?php if($type=='outstanding') { ?>
				<td align="right">
					<?php echo $d['qty']-$d['qty_filled']?>
				</td>	
				<?php } ?>
				<?php 
					if($type=='finish') {
					echo '<td align="right">' ;
					echo $this->Time->format(DATE_FORMAT,$npb['Npb']['date_finish']);
					echo '</td>' ;
					}
				?>
									
			
			<?php else :?>
			<tr>
				<td colspan="5"></td>
				<td>
				<?php echo $d['item_name']?>
				</td>
				<td align="right">
				<?php echo $d['qty']?>
				</td>				 
				<td align="right">
					<?php echo $d['qty_filled']?>
				</td>						
				<?php if($type=='outstanding') { ?>
				<td align="right">
					<?php echo $d['qty']-$d['qty_filled']?>
				</td>
				<?php } ?>
				<?php 
					if($type=='finish') {
					echo '<td align="right">' ;
					echo $this->Time->format(DATE_FORMAT,$npb['Npb']['date_finish']);
					echo '</td>' ;
					}
				?>
									
			</tr>
			<?php endif ?>
			


		<?php endforeach;?>
		
	</tr>
<?php endforeach; ?>

	</table>