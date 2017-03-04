<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<div id="moduleName"><?php echo 'Stock > Item Pending'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('NpbDetail', array('action'=>'item_pending')) ?>
	<div class="fieldfilter">
	<fieldset>
 	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('MR Filters Item Pending')?></legend>	
	<?php echo $this->Form->input('department_id', array('options'=>$departments, 'empty'=>'all')) ;?>
	<?php echo $this->Form->input('business_type_id', array('options'=>$businessTypes, 'empty'=>'all')) ;?>
		<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
		<div id="cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement :setNpbDetailCostCenterValues});
			//]]>
		</script>
	</fieldset>
    <?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>

</fieldset>
</div>
</div>
<div class="npbDetails index">
	<h2><?php __('MR Details Item Pending');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('npb_id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('busines_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('qty_filled');?></th>
			<th><?php echo $this->Paginator->sort('process_type_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($npbDetails as $npbDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($npbDetail['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $npbDetail['Npb']['id'])); ?>
		</td>
		<td class="left"><?php echo $departments[$npbDetail['Npb']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $businessTypes[$npbDetail['Npb']['business_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenters[$npbDetail['Npb']['cost_center_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $npbDetail['Item']['name']; ?></td>
		<td class="center"><?php echo $npbDetail['NpbDetail']['qty']; ?>&nbsp;</td>
		<td class="center"><?php echo $npbDetail['NpbDetail']['qty_filled']; ?>&nbsp;</td>
		<td><?php echo $npbDetail['ProcessType']['name']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View MR', true), array('controller' => 'npbs', 'action' => 'view', $npbDetail['Npb']['id'])); ?>
		</td>
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
