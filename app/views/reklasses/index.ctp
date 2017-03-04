<div id="moduleName"><?php echo 'Asset > List Reklass'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('Reklass', array('action'=>'index')) ?>
<fieldset>
 	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Outlog Filters')?></legend>
	<?php echo $this->Form->input('reklas_status_id',array('empty'=>'all','options'=>$reklasStatus)) ?>
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
		<?php if($this->Session->read('Security.permissions')==fincon_group_id) :?>
		<li><?php echo $this->Html->link(__('New Reklass', true), array('action' => 'add')); ?></li>
		<?php endif;?>
	</ul>
</div>
</div>
<div class="reklasses index">
	<h2><?php __('Reklasses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('doc_no');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('asset_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('Amortisasi');?></th>
			<th><?php echo $this->Paginator->sort('reklass_status_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($reklasses as $reklas):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $reklas['Reklass']['doc_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $reklas['Reklass']['date']); ?>&nbsp;</td>
		<td class="left"><?php echo $reklas['Asset']['code']; ?> - <?php echo $reklas['Asset']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $reklas['AssetCategory']['name']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($reklas['Reklass']['amount']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($reklas['Reklass']['depthnini']); ?>&nbsp;</td>
		<td class="left"><?php echo $reklas['ReklasStatus']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $reklas['Reklass']['id'])); ?>
			<?php if($this->Session->read('Security.permissions')==fincon_group_id && $reklas['Reklass']['reklas_status_id'] == status_reklass_draft_id):?>			
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $reklas['Reklass']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $reklas['Reklass']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $reklas['Reklass']['id'])); ?>
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
