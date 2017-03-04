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
	</tr>

	<?php
	$i = 0;
	foreach ($journalTransactions as $journalTransaction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		list($a, $b, $c) = explode('.', $journalTransaction['JournalTransaction']['account_code']);
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
			<?php if($journalTransaction['JournalTransaction']['source'] == 'invoice') :?>
				<?php echo $myApp->showArrayValue($invoices, $journalTransaction['JournalTransaction']['doc_id'] ) ; ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php $total_db += $this->Number->precision($journalTransaction['JournalTransaction']['amount_db'],0)?>
	<?php $total_cr += $this->Number->precision($journalTransaction['JournalTransaction']['amount_cr'],0)?>	
<?php endforeach; ?>
	
	</table>