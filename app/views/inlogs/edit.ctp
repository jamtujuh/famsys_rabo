<div class="inlogs form">
<?php echo $this->Form->create('Inlog');?>
	<fieldset>
 		<legend><?php __('Edit Inlog'); ?></legend>
	<?php
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('date', array('value'=>date("Y-m-d"), 'type'=>'date'));
		echo $this->Form->input('supplier_id', array('options'=>$suppliers));
		echo $this->Form->input('po_id', array('options'=>$pos));
		echo $this->Form->input('created_at', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Inlog.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Inlog.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inlog Details', true), array('controller' => 'inlog_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog Detail', true), array('controller' => 'inlog_details', 'action' => 'add')); ?> </li>
	</ul>
</div>