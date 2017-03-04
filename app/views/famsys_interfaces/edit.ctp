<div class="famsysInterfaces form">
<?php echo $this->Form->create('FamsysInterface');?>
	<fieldset>
 		<legend><?php __('Edit Famsys Interface'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('source_id');
		echo $this->Form->input('source_dt');
		echo $this->Form->input('source_no');
		echo $this->Form->input('source_tm');
		echo $this->Form->input('kdtran');
		echo $this->Form->input('noref');
		echo $this->Form->input('norek1');
		echo $this->Form->input('kdcab1');
		echo $this->Form->input('ccy1');
		echo $this->Form->input('nilai1');
		echo $this->Form->input('norek2');
		echo $this->Form->input('kdcab2');
		echo $this->Form->input('ccy2');
		echo $this->Form->input('nilai2');
		echo $this->Form->input('costc1');
		echo $this->Form->input('costc2');
		echo $this->Form->input('costdept1');
		echo $this->Form->input('costdept2');
		echo $this->Form->input('kurs');
		echo $this->Form->input('ket1');
		echo $this->Form->input('ket2');
		echo $this->Form->input('ket3');
		echo $this->Form->input('rc');
		echo $this->Form->input('st');
		echo $this->Form->input('trs_dt');
		echo $this->Form->input('trs_tm');
		echo $this->Form->input('posting');
		echo $this->Form->input('posting_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FamsysInterface.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FamsysInterface.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Famsys Interfaces', true), array('action' => 'index'));?></li>
	</ul>
</div>