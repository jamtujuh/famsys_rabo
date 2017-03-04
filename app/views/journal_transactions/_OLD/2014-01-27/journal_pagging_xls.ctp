<div id="flashMessage" class="ok">
INFO
<br/>
<EM>If file(s) not yet downloaded. 
<br/>
1. Please turn off POPUP BLOCKER. 
<br/>
2. And do click on button Download CSV #XXX again.</EM>
</div>
This Journal has generated <?php echo count($arrayPagging); ?> CSV File(s).
<br/>
Click to download CSV.
<br/>
<?php
$ctr = 0;
foreach ($arrayPagging as $rows) {
?>
<br/>
<?php echo $this->Form->create('JournalTransaction', array('action'=>'create_csv_pagging', 'target'=>'_blank')) ?>
	<input type='hidden' value='<?php echo $rows; ?>' name='csv_files'/>
	<input type='hidden' value='<?php echo $ctr; ?>' name='ctr'/>
	<input type='hidden' value='<?php echo count($arrayPagging); ?>' name='total'/>
	<input type='submit' value='Download CSV #<?php echo ($ctr+1); ?>' name='submit' onclick='/*this.disabled=true; this.value=this.value+" generated - Button disabled -"*/'/>
<?php echo $this->Form->end() ?>
<br/>
<?php
$ctr++;
}
?>
Total Generated CSV: <?php echo $ctr; ?> Files.
<br/>
<br/>
<?php echo $this->Html->link('Back to Journal List', array('action'=>'index')); ?>
