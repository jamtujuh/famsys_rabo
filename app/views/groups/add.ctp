<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
 		<legend><?php __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('auth_amount');
		echo $this->Form->checkbox('is_admin');
		echo 'Is Admin?';
		echo $this->Form->input('descr');
		echo $this->Form->input('Menu');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index'));?></li>
	</ul>
</div>