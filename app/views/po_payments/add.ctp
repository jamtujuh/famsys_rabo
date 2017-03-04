<div class="poPayments form">
<?php echo $this->Form->create('PoPayment');?>
	<fieldset>
 		<legend><?php __('Add Po Payment'); ?></legend>
	<?php
		echo $this->Form->input('po_id');
		echo $this->Form->input('term');
		echo $this->Form->input('payment_date');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Po Payments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
	</ul>
</div>