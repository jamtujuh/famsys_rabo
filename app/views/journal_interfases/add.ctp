<div class="journalInterfases form">
<?php echo $this->Form->create('JournalInterfase');?>
	<fieldset>
 		<legend><?php __('Add Journal Interfase'); ?></legend>
	<?php
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
		echo $this->Form->input('trs_id');
		echo $this->Form->input('trs_dt');
		echo $this->Form->input('trs_tm');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Journal Interfases', true), array('action' => 'index'));?></li>
	</ul>
</div>