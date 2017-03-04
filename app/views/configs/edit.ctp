<div class="configs form">
<?php echo $this->Form->create('Config');?>
	<fieldset>
 		<legend><?php __('Edit Config'); ?></legend>
	<?php
		echo $this->Form->input('key', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Config.key')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Config.key'))); ?></li>
		<li><?php echo $this->Html->link(__('List Configs', true), array('action' => 'index'));?></li>
	</ul>
</div>