<div class="activitylogs form">
<?php echo $this->Form->create('HouseKeeping');?>
	<fieldset>
 		<legend><?php __('Create House Keeping'); ?></legend>
	<?php
		echo $this->Form->input('table_name', array('options'=>$tableOptions, 'empty'=>'-select table-', 'value'=>$this->Session->read('HKConf.table_name')));
		echo $this->Form->input('ds', array('type' => 'date', 'value' => $date_start, 'label'=>'Date Created Start'));
        echo $this->Form->input('de', array('type' => 'date', 'value' => $date_end, 'label'=>'Date Created End'));
		echo $this->Form->input('remark', array('value'=>$this->Session->read('HKConf.remark')));
	?>	

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('House Keeping Log', true), array('action' => 'index'));?></li>
	</ul>
</div>