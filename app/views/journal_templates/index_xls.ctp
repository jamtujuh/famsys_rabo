<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"". __('Template journal', true) .' '.gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="1">
		<tr>
			<td bgcolor="#CCCCCC"><?php echo __('no', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Journal Group', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Asset Category', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Name', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Journal Position', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Account Code', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Account', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('For Destination Branch/Department', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Contra Account', true) ;?></td>
		</tr>		
		<?php
		$i = 0;
		foreach ($journalTemplates as $journalTemplates):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		foreach ($journalTemplates['JournalTemplateDetail'] as $JournalTemplateDetail):
		?>
		<td><?php echo $i; ?></td>
		<td align="left"><?php echo $journalTemplates['JournalGroup']['name']; ?></td>
		<td align="left"><?php echo $journalTemplates['AssetCategory']['name']; ?></td>
		<td align="left"><?php echo $journalTemplates['JournalTemplate']['name']; ?></td>
		<td align="left"><?php echo $journal_positions[$JournalTemplateDetail['journal_position_id']]; ?></td>
		<td align="left"><?php echo isset($JournalTemplateDetail['account_id'])?$accountCodes[$JournalTemplateDetail['account_id']]:''; ?></td>
		<td align="left"><?php echo isset($JournalTemplateDetail['account_id'])?$accounts[$JournalTemplateDetail['account_id']]:''; ?></td>
		<td align="left"><?php echo $JournalTemplateDetail['for_destination_branch']==1?'YES':'NO'; ?></td>
		<td align="left"><?php echo $JournalTemplateDetail['contra_account']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php endforeach; ?>
	</table>

