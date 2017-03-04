<div class="warranties form">
<?php echo $this->Form->create('Warranty');?>
	<fieldset>
 		<legend><?php __('Edit Warranty'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('telephone');
		echo $this->Form->input('email');
		echo $this->Form->input('fax');
		echo $this->Form->input('hp');
		echo $this->Form->input('business_type');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('province');
		echo $this->Form->input('website');
		echo $this->Form->input('tanggal', array('value'=>date("Y-m-d"), 'type'=>'date'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Warranty.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Warranty.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Warranties', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
	</ul>
</div>