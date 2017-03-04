<div id="moduleName"><?php echo 'Journal > Famsys Interface'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
<?php echo $this->Form->create('FamsysInterface') ?>
	<div class="fieldfilter">
	<fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Date Filters')?></legend>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	</fieldset>
	<?php echo $this->Form->end() ?>
</div>
</div>
<div class="Famsys Interfaces index">
	<h2><?php __('Famsys Interfaces');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('RC');?></th>
			<th><?php echo $this->Paginator->sort('posting');?></th>
			<th><?php echo $this->Paginator->sort('posting_date');?></th>
			<th><?php echo $this->Paginator->sort('source Id');?></th>
			<th><?php echo $this->Paginator->sort('source_dt');?></th>
			<th><?php echo $this->Paginator->sort('source_no');?></th>
			<th><?php echo $this->Paginator->sort('source_tm');?></th>
			<th><?php echo $this->Paginator->sort('kdtran');?></th>
			<th><?php echo $this->Paginator->sort('noref');?></th>
			<th><?php echo $this->Paginator->sort('norek1');?></th>
			<th><?php echo $this->Paginator->sort('kdcab1');?></th>
			<th><?php echo $this->Paginator->sort('ccy1');?></th>
			<th><?php echo $this->Paginator->sort('nilai1');?></th>
			<th><?php echo $this->Paginator->sort('norek2');?></th>
			<th><?php echo $this->Paginator->sort('kdcab2');?></th>
			<th><?php echo $this->Paginator->sort('ccy2');?></th>
			<th><?php echo $this->Paginator->sort('nilai2');?></th>
			<th><?php echo $this->Paginator->sort('costc1');?></th>
			<th><?php echo $this->Paginator->sort('costc2');?></th>
			<th><?php echo $this->Paginator->sort('costdept1');?></th>
			<th><?php echo $this->Paginator->sort('costdept2');?></th>
			<th><?php echo $this->Paginator->sort('kurs');?></th>
			<th><?php echo $this->Paginator->sort('ket1');?></th>
			<th><?php echo $this->Paginator->sort('ket2');?></th>
			<th><?php echo $this->Paginator->sort('ket3');?></th>
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
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['rc']==='000'?'Yes':'No'; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['rc']; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['posting']==1?'Yes':'No'; ?>&nbsp;</td>
		<td class="left"><?php echo $famsysInterface['FamsysInterface']['posting_date']; ?>&nbsp;</td>
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
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>