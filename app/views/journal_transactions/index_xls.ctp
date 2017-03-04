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
if($posting_id == '1') {
	$is_inventory = 'Yes';
}else if($posting_id == '0') {
	$is_inventory = 'No';
}else if($posting_id == '') {
	$is_inventory = 'All';
}

if($this->Session->read('JournalTransaction.department_id') == null) {
		$department_id = 'All';
}else {
		$department_id = $departments[$this->Session->read('JournalTransaction.department_id')];
}

if($this->Session->read('JournalTransaction.journal_group_id') == null) {
		$journal_group_id = 'All';
}else {
		$journal_group_id = $journalGroup[$this->Session->read('JournalTransaction.journal_group_id')];
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
		
		<td WIDTH="75"><?php echo __('Posting', true);?></td>
		<td>: <?php echo $is_inventory ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Journal Group', true);?></td>
		<td>: <?php echo $journal_group_id ;?></td>

		<td WIDTH="75"><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Journal Template', true);?></td>
		<td>: <?php echo $journal_template_id ;?></td>

		<td WIDTH="75"><?php echo __('Date Start', true);?></td>
		<td>: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
</table>
	<?php 
	$total_db=0;
	$total_cr=0;

	?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Journal Template',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Account Code', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Account',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Journal Position', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Db', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Cr', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Posting', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Notes', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Source', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Invoice', true);?></div></td>
	</tr>

	<?php
	$i = 0;
	foreach ($journalTransactions as $journalTransaction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if(strpos($journalTransaction['JournalTransaction']['account_code'],".")){
			list($a, $b, $c) = explode('.', $journalTransaction['JournalTransaction']['account_code']);
		}else{			
			$a		= $journalTransaction['Department']['account_code'];
			$b		= substr($journalTransaction['JournalTransaction']['account_code'],0,3);
			$c		= substr($journalTransaction['JournalTransaction']['account_code'],3,5);
			if($b == "IDR"){
				$b	= '360';
			}else if($b == "USD"){
				$b	= '840';
			}else if($b == "AUD"){
				$b	= '036';
			}else if($b == "EUR"){
				$b	= '333';
			}else if($b == "HKD"){
				$b	= '344';
			}else if($b == "NZD"){
				$b	= '554';
			}else if($b == "Yen"){
				$b	= '392';
			}
		}
		
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td nowrap>
			<?php echo $journalTransaction['JournalTemplate']['name'] ?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$journalTransaction['JournalTransaction']['date']); ?></td>
		<td class="left">&nbsp;<?php echo $a; ?></td>
		<td class="left"><?php echo $b; ?></td>
		<td class="left"><?php echo $c; ?></td>
		<td><?php echo $journalTransaction['Account']['name'] ; ?></td>
		<td><?php echo $journalTransaction['JournalPosition']['name'] ; ?></td>
		<td><?php echo $journalTransaction['Department']['name'] ; ?></td>
		<td align="right"><?php echo $this->Number->precision($journalTransaction['JournalTransaction']['amount_db'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($journalTransaction['JournalTransaction']['amount_cr'],0); ?></td>
		<?php 
		if($journalTransaction['JournalTransaction']['posting'] == 1){
			$posting = 'Yes';
		}else{
			$posting = 'No';
		}
		?>
		<td><?php echo $posting; ?></td>
		<td><?php echo $journalTransaction['JournalTransaction']['notes']; ?></td>
		<td class="left">
			<?php echo $journalTransaction['JournalTransaction']['source']; ?> : <?php echo $journalTransaction['JournalTransaction']['doc_id']; ?>
			
		</td>
		<td class="left">
			<?php if($journalTransaction['JournalTransaction']['source'] == 'invoice') :?>
				<?php echo $journalTransaction['JournalTransaction']['source']; ?> : <?php echo $myApp->showArrayValue($invoices, $journalTransaction['JournalTransaction']['doc_id'] )  ; ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php $total_db += $this->Number->precision($journalTransaction['JournalTransaction']['amount_db'],0)?>
	<?php $total_cr += $this->Number->precision($journalTransaction['JournalTransaction']['amount_cr'],0)?>	
<?php endforeach; ?>

	<tr>
		<td colspan="9"></td>
		<td align="right"><?php echo $this->Number->precision($total_db,0)?></td>
		<td align="right"><?php echo $this->Number->precision($total_cr,0)?></td>
		<td colspan="3"></td>
	</tr>
	
	</table>