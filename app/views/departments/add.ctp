<div class="departments form">
<?php echo $this->Form->create('Department');?>
	<fieldset>
 		<legend><?php __('Add Department'); ?></legend>
	<?php
		echo $this->Form->input('business_type_id');		
		echo $this->Form->input('name', array('style'=>'width:50%') );
		echo $this->Form->input('account_code');
		echo $this->Form->input('area');
		echo $this->Form->input('code');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($this->Session->read('Security.permissions') == gs_group_id):?>
		<li><?php echo $this->Html->link(__('New Department', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<?php endif;?>
	</ul>
</div>