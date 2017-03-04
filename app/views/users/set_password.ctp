<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Change User Password'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('value'=>$user['User']['username'], 'readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('ad_user', array('value'=>$user['User']['ad_user'],'label'=>'Active Directory Username'));
		echo $this->Form->input('password', array('value'=>''));
		echo $this->Form->input('password2', array('value'=>'','type'=>'password', 'label'=>'Re-type'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>