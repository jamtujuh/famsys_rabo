<div class="faReturDetails form">
<?php echo $this->Form->create('FaReturDetail');?>
	<fieldset>
 		<legend><?php __('Edit Fa Retur Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fa_retur_id');
		echo $this->Form->input('asset_detail_id');
		echo $this->Form->input('asset_category_id');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('color');
		echo $this->Form->input('serial_no');
		echo $this->Form->input('date_of_purchase');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FaReturDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FaReturDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fa Retur Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fa Returs', true), array('controller' => 'fa_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Retur', true), array('controller' => 'fa_returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Detail', true), array('controller' => 'asset_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>