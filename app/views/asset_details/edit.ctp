<div class="assetDetails form">
<?php echo $this->Form->create('AssetDetail');?>
	<fieldset>
 		<legend><?php __('Edit Asset Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('asset_id', array('type'=>'hidden'));
		echo $this->Form->input('department_id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('date_of_purchase');
		echo $this->Form->input('date_start');
		echo $this->Form->input('date_end');
		echo $this->Form->input('name');
		echo $this->Form->input('color');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('serial_no');
		echo $this->Form->input('umurek');
		echo $this->Form->input('maksi');
		echo $this->Form->input('price');
		echo $this->Form->input('depbln');
		echo $this->Form->input('hpthnlalu');
		echo $this->Form->input('hpthnini');
		echo $this->Form->input('depthnini');
		echo $this->Form->input('book_value');
		echo $this->Form->input('ada');
		echo $this->Form->input('condition_id');
		echo $this->Form->input('konfigurasi');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('AssetDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('AssetDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('controller' => 'assets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conditions', true), array('controller' => 'conditions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Condition', true), array('controller' => 'conditions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>