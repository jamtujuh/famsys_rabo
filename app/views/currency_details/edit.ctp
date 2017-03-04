<div class="currencyDetails form">
<?php echo $this->Form->create('CurrencyDetail');?>
	<fieldset>
 		<legend><?php __('Edit Currency Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('currency_id');
		echo $this->Form->input('tanggal');
		echo $this->Form->input('rp_rate');
		echo $this->Form->input('rp_BI_rate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CurrencyDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CurrencyDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Currency Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>