<div id="moduleName"><?php echo 'Journal > Procces Posting'?></div>
<div class="Famsys Interfaces index">
	<?php echo $this->Form->create('FamsysInterface', array('action'=>'add_into_interface')) ?> 
	<?php echo $this->Form->input('csb',array('type'=>'hidden','name'=>'data[FamsysInterface][csb]','value'=>1))?>
	<h2><?php __('Famsys Interfaces');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th bgcolor="#CCCCCC"><?php echo __('No', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Source Id', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Source Dt', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Source No', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Source Tm', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Kdtran', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Noref', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Norek1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Kdcab1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Ccy1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Nilai1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Norek2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Kdcab2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Ccy2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Nilai2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Costc1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Costc2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Costdept1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Costdept2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Kurs', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Ket1', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Ket2', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Ket3', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Posting', true) ;?></th>
			<th bgcolor="#CCCCCC"><?php echo __('Posting Date', true) ;?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($famsysInterfaces as $famsysInterface):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_id']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_dt']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['source_tm']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['kdtran']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['noref']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['norek1']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['kdcab1']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['ccy1']; ?>&nbsp;</td>
		<td class="number"><?php echo $famsysInterface['FamsysInterface']['nilai1']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['norek2']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['kdcab2']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ccy2']; ?>&nbsp;</td>
		<td class="number"><?php echo $famsysInterface['FamsysInterface']['nilai2']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['costc1']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['costc2']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['costdept1']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['costdept2']; ?>&nbsp;</td>
		<td class="center"><?php echo $famsysInterface['FamsysInterface']['kurs']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ket1']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ket2']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['ket3']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['posting']==1?'Yes':'No'; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['posting_date']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>

	</table>
		<?php echo $this->Form->end('Confirm Journal Interface') ?>
