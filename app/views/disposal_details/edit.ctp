<div class="disposalDetails form">
<?php echo $this->Form->create('DisposalDetail');?>
	<fieldset>
 		<legend><?php __('Edit Disposal Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('disposal_id');
		echo $this->Form->input('asset_detail_id');
		echo $this->Form->input('sales_amount');
		echo $this->Form->input('loss_profit_amount');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DisposalDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DisposalDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Disposal Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Disposals', true), array('controller' => 'disposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal', true), array('controller' => 'disposals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>