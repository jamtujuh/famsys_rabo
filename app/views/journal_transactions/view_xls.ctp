<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Journal Transactions', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>

<?php 
if($this->Session->read('JournalTransaction.posting_id') == 1) {
	$is_inventory = 'Yes';
}else if($this->Session->read('JournalTransaction.posting_id') == 0) {
	$is_inventory = 'No';
}else if($this->Session->read('JournalTransaction.posting_id') == null) {
	$is_inventory = 'All';
}

if($this->Session->read('JournalTransaction.department_id') == null) {
		$department_id = 'All';
}else {
		$department_id = $departments[$this->Session->read('JournalTransaction.department_id')];
}

if($this->Session->read('JournalTransaction.journal_template_id') == null) {
		$journal_template_id = 'All';
}else {
		$journal_template_id = $journalTemplates[$this->Session->read('JournalTransaction.journal_template_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Journal Transactions', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true);?></td>
		<td>: <?php echo $department_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Journal Template', true);?></td>
		<td>: <?php echo $journal_template_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Posting', true);?></td>
		<td>: <?php echo $journal_template_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true);?></td>
		<td>: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Journal Template',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Account',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Journal Position', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Db', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Cr', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Posting', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Account Code', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Notes', true);?></div></td>
	</tr>
	<?php 
	$total_db=0;
	$total_cr=0;

	?>
	<?php
	$i = 0;
	foreach ($journalTransactions as $journalTransaction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $journalTransaction['JournalTemplate']['name'] ?></td>
		<td class="left"><?php echo $journalTransaction['JournalTransaction']['date']; ?>&nbsp;</td>
		<td><?php echo $journalTransaction['Account']['name'] ; ?></td>
		<td><?php echo $journalTransaction['JournalPosition']['name'] ; ?></td>
		<td><?php echo $journalTransaction['Department']['name'] ; ?></td>
		<td class="number"><?php echo $this->Number->format($journalTransaction['JournalTransaction']['amount_db']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($journalTransaction['JournalTransaction']['amount_cr']); ?>&nbsp;</td>
		<td><?php echo $journalTransaction['JournalTransaction']['posting']; ?>&nbsp;</td>
		<td class="left"><?php echo $journalTransaction['JournalTransaction']['account_code']; ?>&nbsp;</td>
		<td><?php echo $journalTransaction['JournalTransaction']['notes']; ?>&nbsp;</td>
	</tr>
	<tr>
		<?php $total_db += $journalTransaction['JournalTransaction']['amount_db']?>
		<?php $total_cr += $journalTransaction['JournalTransaction']['amount_cr']?>	
		<?php endforeach; ?>
		<td colspan="6"></td>
		<td class="number"><?php echo $this->Number->format($total_db)?></td>
		<td class="number"><?php echo $this->Number->format($total_cr)?></td>
		<td colspan="4"></td>
	</tr>
	
	</table>