<div id="moduleName"><?php echo 'Stock > List Inlog'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('Inlog', array('action'=>'index')) ?>
	<fieldset>
 	<fieldset class="subfilter" style="width:30%">
	<legend><?php __('Inlog Filters')?></legend>
	<?php echo $this->Form->input('inlog_status_id',array('empty'=>'all','value'=>$inlog_status_id)) ?>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$inlog_supplier_id)) ?>
	</fieldset>
 	<fieldset class="subfilter" style="width:37%">
	<legend><?php __('Date Filters')?></legend>
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
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inlog Details', true), array('controller' => 'inlog_details', 'action' => 'index')); ?> </li>
	</ul>
</div>
</div>

<div class="Inlog related">
	<h2><?php __('Inlogs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('no_inlog');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('inlog_status_id');?></th>
			<th><?php echo $this->Paginator->sort('po_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($inlogs as $inlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = $inlog['Inlog']['inlog_status_id']==status_inlog_draft_id&&$inlog['Inlog']['created_by']==$this->Session->read('Userinfo.name') ;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $inlog['Inlog']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $inlog['Inlog']['date']); ?>&nbsp;</td>
		<td class="left">
			<?php echo $inlog['Supplier']['name']; ?>
		</td>
		<td class="left"><?php echo $inlog['InlogStatus']['name']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($inlog['Po']['no'], array('controller' => 'pos', 'action' => 'view', $inlog['Po']['id'])); ?>
		</td>
		<td class="left"><?php echo $inlog['Inlog']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $inlog['Inlog']['id'])); ?>
			<?php if($can_edit) :?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $inlog['Inlog']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $inlog['Inlog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inlog['Inlog']['id'])); ?>
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