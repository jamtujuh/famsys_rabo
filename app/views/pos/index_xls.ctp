<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Purchase Order List', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$is_done = '';
$po_status_id = '';
$supplier_id = '';

if ($this->Session->read('Po.is_done',$this->data['Po']['is_done']) == 0) {
	$is_done = $is_done  . 'All';
} else if ($this->Session->read('Po.is_done',$this->data['Po']['is_done']) == 1) {
	$is_done = $is_done  . 'Yes';
} else if ($this->Session->read('Po.is_done',$this->data['Po']['is_done']) == 2) {
	$is_done = $is_done  . 'No';
}

if ($this->Session->read('Po.po_status_id',$this->data['Po']['po_status_id']) == null) {
	$po_status_id = 'All';
}else  {
		$po_status_id =  $po_statuses[$this->Session->read('Po.po_status_id',$this->data['Po']['po_status_id'])];
}
if ($this->Session->read('Po.supplier_id',$this->data['Po']['supplier_id']) == null) {
	$supplier_id = 'All';
}else  {
		$supplier_id = $suppliers[$this->Session->read('Po.supplier_id',$this->data['Po']['supplier_id'])];
}
$no = $this->Session->read('Po.no');
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Purchase Order List', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Is Done', true) ;?></td>
		<td>: <?php echo $is_done ;?></td>
	
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td>: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Po Status', true) ;?></td>
		<td>: <?php echo $po_status_id ;?></td>
		
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Supplier', true) ;?></td>
		<td>: <?php echo $supplier_id ;?></td>
		
		<td colspan="2"><?php echo __('No', true) ;?></td>
		<td>: <?php echo $no ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Po', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Po Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Delivery Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Po Status', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Request Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Outstanding', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Total (Cur)', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Down Payment', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Invoice No', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	$id_group=$this->Session->read('Security.permissions');
	
	foreach ($pos as $po):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td class="left"><?php echo $po['Po']['no']; ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?></td>
		<td><?php echo $po['Supplier']['name']; ?></td>
		<td><?php echo $po['PoStatus']['name']; ?></td>
		<td><?php echo $po['RequestType']['name']; ?></td>
		<?php 
		if($po['Po']['v_is_done'] == 1){
			$image = 'Yes';
		}else{
			$image = 'No';
		}
		?>
		<td class="center"><?php echo $image ; ?></td>

		<td class="center"><?php echo $po['Currency']['name']; ?></td>
		<td align="right"><?php echo $this->Number->format($po['Po']['total_cur'], $po['Po']['currency_id']==1?-1:2); ?></td>
		<td align="right"><?php echo $this->Number->format($po['Po']['down_payment'], $po['Po']['currency_id']==1?-1:2); ?></td>
		<td class="number">
			<?php if(!empty($po['Invoice'])): ?>
				<?php foreach($po['Invoice'] as $invoice):?>
					<?php echo $invoice['no'] ; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</td>		
		</tr>
<?php endforeach; ?>
	</table>