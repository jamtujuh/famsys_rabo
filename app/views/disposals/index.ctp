<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('Disposal', array('action'=>'index/'.$type)) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Disposal Filters : '.  ucwords($disposalTypes[$type]))?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Disposal Info')?></legend>
	<?php echo $this->Form->input('disposal_status_id',array('options'=>$disposal_statuses,'empty'=>'all','value'=>$disposal_status_id)) ?>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$disposal_department_id)) ?>
	<?php echo $this->Form->input('disposal_type_id',array('type'=>'text', 'readonly'=>true, 'value'=>$disposalTypes[$this->Session->read('Disposal.disposal_type')])) ?>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Disposal Info')?></legend>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Disposal', true), array('action' => 'add')); ?></li>
	</ul>
</div>
</div>

<div class="disposal related">
	<h2><?php __('Disposals '.  ucwords($disposalTypes[$type]));?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('doc_date');?></th>
			<th><?php echo $this->Paginator->sort('Doc No');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('disposal_status_id');?></th>
			<th><?php echo $this->Paginator->sort('disposal_type_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$group_id=$this->Session->read('Security.permissions');
	foreach ($disposals as $disposal):
		$class = null;
		$can_edit 		= $disposal['Disposal']['disposal_status_id']==status_disposal_new_id && $group_id==fa_management_group_id;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $disposal['Disposal']['doc_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $disposal['Disposal']['no']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($disposal['Department']['name'], array('controller' => 'departments', 'action' => 'view', $disposal['Department']['id'])); ?>
		</td>
		<td class="left"><?php echo $disposal['Disposal']['created_by']; ?>&nbsp;</td>
		<td class="left"><?php echo $disposal['DisposalStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $disposal['DisposalType']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $disposal['Disposal']['id'])); ?>
			
			<?php if($can_edit) :?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $disposal['Disposal']['id'])); ?>
			<?php endif; ?>
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
