<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('FaImport', array('action'=>'index')) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('FaImport Filters')?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Fa Import Info')?></legend>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$fa_import_department_id)) ?>
	<?php echo $this->Form->input('import_status_id',array('empty'=>'all','value'=>$import_status_id)) ?>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Fa Import Info')?></legend>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF', 'xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($this->Session->read('Security.permissions') == fa_management_group_id):?>
		<li><?php echo $this->Html->link(__('New FaImport', true), array('action' => 'add')); ?></li>
		<?php endif ;?>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
	</ul>
</div>
</div>

<div class="FaImport related">
	<h2><?php __('FaImports');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('no_fa_import');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('import_status_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fa_imports as $fa_import):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = ($fa_import['FaImport']['import_status_id']==status_fa_import_draft_id && $fa_import['FaImport']['created_by']==$this->Session->read('Userinfo.username')) ? true:false ;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $fa_import['FaImport']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $fa_import['FaImport']['date']); ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($fa_import['Department']['name'], array('controller' => 'departments', 'action' => 'view', $fa_import['Department']['id'])); ?>
		</td>
		<td class="left"><?php echo $fa_import['ImportStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $fa_import['FaImport']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fa_import['FaImport']['id'])); ?>
			<?php if($can_edit): ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fa_import['FaImport']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fa_import['FaImport']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fa_import['FaImport']['id'])); ?>
			<?php endif;?>
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