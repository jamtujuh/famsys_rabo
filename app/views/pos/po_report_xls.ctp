<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Purchase Order Report '. ucwords($type), true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$supplier_id = '';

if ($this->data['Po']['supplier_id'] == null) {
	$supplier_id = 'All';
}else  {
		$supplier_id = $suppliers[$this->data['Po']['supplier_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Purchase Order Report '. ucwords($type), true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Supplier', true);?></td>
		<td>: <?php echo $supplier_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start', true);?></td>
		<td>: <?php echo  $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Po', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Po Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Delivery Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Is Done', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Name', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty Received', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Balance', true);?></div></td>
		<?php 
			if($type=='finish') :
		    echo '<td bgcolor="#CCCCCC">' ;
			echo __('Finish Date',true);
			echo '</td>' ;
			endif;
			?>
	</tr>
	<?php
	$i = 0;
	
	foreach ($pos as $po):
		if($po['PoDetail'] == null)
		continue;
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	     <td><?php echo $i ?></td>
		<td class="left"><?php echo $po['Po']['no']; ?></td>
		
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?></td>
		<td><?php echo $po['Supplier']['name']; ?></td>
		<?php
		if($po['Po']['v_is_done'] == 1){
			$image = 'Yes';
		}else{
			$image = 'No';
		}
		?>
		<td class="center"><?php echo $image; ?></td>
		
		<?php foreach ($po['PoDetail'] as $j=>$d) : ?>
			<?php if($j==0) :?>
			<td>
				<?php echo $d['name']?>
			</td>
			<td class="center">
				<?php echo $d['qty']?>
			</td>
			<td class="center">
				<?php echo $d['qty_received']?>
			</td>
			<td class="center">
				<?php echo $d['qty']-$d['qty_received'];?>
			</td>
			
			<?php 
			if($type=='finish')
			{
				echo '<td>' ;
				echo $this->Time->format(DATE_FORMAT,$po['Po']['date_finish']);
				echo '</td>' ;
			}
			?>
						
			<?php else :?>
			<tr>
				<td colspan="6"></td>
				<td>
				<?php echo $d['name']?>
				</td>
				<td class="center">
				<?php echo $d['qty']?>
				</td>
				<td class="center">
				<?php echo $d['qty_received']?>
				</td>
				<td class="center">
				<?php echo $d['qty']-$d['qty_received'];?>
				</td>
				<?php 
				if($type=='finish')
				{
					echo '<td>' ;
					echo $this->Time->format(DATE_FORMAT,$po['Po']['date_finish']);
					echo '</td>' ;
				}
				?>
			</tr>
			<?php endif ?>
			<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
	</table>