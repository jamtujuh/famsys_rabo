<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
//header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Journal Transactions', true).'-'. gmdate("d M Y") . ".txt" );
//header ("Content-Description: Generated Report" );
?>
Source_idSource_dtSource_tmSource_nokdcabkdtrsnorefNorek1Norek2Ccy1Ccy2Nilai1Nilai2KursCostdept1Costdept2Ket1Ket2Ket3strc
<?php
	$i = 0001;
	foreach ($journalTransactions as $journalTransaction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	list($yyyy,$mm,$dd)=explode('-',$journalTransaction['JournalTransaction']['date']);	
	list($cab,$uang,$code)=explode('.',$journalTransaction['JournalTransaction']['account_code']);	
?>
FIX<?php echo sprintf("%06d",$yyyy) ;?><?php echo $mm ;?><?php echo $dd ;?><?php echo sprintf("%06d",'') ;?><?php echo sprintf("%04d",$i) ;?><?php echo sprintf("%03d",'') ;?><?php echo sprintf("%03d",'') ;?><?php echo sprintf("%015d",$journalTransaction['JournalTransaction']['id']) ;?><?php echo $cab ;?><?php echo $uang ;?><?php echo $code ;?><?php echo $cab ;?><?php echo $uang ;?><?php echo $code ;?><?php echo $uang ;?><?php echo $uang ;?><?php echo sprintf("%017d",$journalTransaction['JournalTransaction']['amount_db']) ;?><?php echo sprintf("%017d",$journalTransaction['JournalTransaction']['amount_cr']) ;?><?php echo sprintf("%013d",'1') ;?><?php echo sprintf("%010d",'') ;?><?php echo sprintf("%010d",'') ;?><?php echo sprintf("%035d",'') ;?><?php echo sprintf("%035d",'') ;?><?php echo sprintf("%035d",'') ;?><?php echo sprintf("%02d",'') ;?><?php echo sprintf("%03d",'') ;?>

<?php endforeach; ?>
