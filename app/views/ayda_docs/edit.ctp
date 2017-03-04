<div class="aydaDocs form">
<?php echo $this->Form->create('AydaDoc');?>
	<fieldset>
 		<legend><?php __('Edit Ayda Doc'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nama');
		echo $this->Form->input('heading');
		echo $this->Form->input('kode');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('AydaDoc.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('AydaDoc.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ayda Docs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Aydas', true), array('controller' => 'aydas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda', true), array('controller' => 'aydas', 'action' => 'add')); ?> </li>
	</ul>
</div>