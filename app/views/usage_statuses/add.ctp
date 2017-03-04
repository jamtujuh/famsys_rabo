<div class="importStatuses form">
<?php echo $this->Form->create('ImportStatus');?>
	<fieldset>
 		<legend><?php __('Add Import Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Import Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List FaImports', true), array('controller' => 'fa_imports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List StockImports', true), array('controller' => 'stock_imports', 'action' => 'index')); ?> </li>
	</ul>
</div>