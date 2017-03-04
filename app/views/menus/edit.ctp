<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
 		<legend><?php __('Edit Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id', array('options'=>$parentMenus, 'empty'=>'root'));
		echo $this->Form->input('title');
		echo $this->Form->input('url');
		echo $this->Form->input('help');
		echo $this->Form->input('urutan');
		echo $this->Form->input('Group');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Menu.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Menu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Menu', true), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>