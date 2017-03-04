<div class="assetDetails form">
<?php echo $this->Form->create('AssetDetail');?>
	<fieldset>
 		<legend><?php __('Add Asset Detail'); ?></legend>
	<?php
		echo $this->Form->input('condition_id');
		echo $this->Form->input('asset_id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('setatus');
		echo $this->Form->input('kd_gab');
		echo $this->Form->input('name');
		echo $this->Form->input('color');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('ada');
		echo $this->Form->input('date_out');
		echo $this->Form->input('kelfa');
		echo $this->Form->input('umur');
		echo $this->Form->input('maksi');
		echo $this->Form->input('tanggal');
		echo $this->Form->input('price');
		echo $this->Form->input('residu');
		echo $this->Form->input('akdasar');
		echo $this->Form->input('depbln');
		echo $this->Form->input('thnlalu');
		echo $this->Form->input('blnlalu');
		echo $this->Form->input('blnini');
		echo $this->Form->input('jan');
		echo $this->Form->input('feb');
		echo $this->Form->input('mar');
		echo $this->Form->input('apr');
		echo $this->Form->input('jun');
		echo $this->Form->input('jul');
		echo $this->Form->input('aug');
		echo $this->Form->input('sep');
		echo $this->Form->input('oct');
		echo $this->Form->input('nov');
		echo $this->Form->input('des');
		echo $this->Form->input('hrgjual');
		echo $this->Form->input('jthnlalu');
		echo $this->Form->input('jblnlalu');
		echo $this->Form->input('jblnini');
		echo $this->Form->input('may');
		echo $this->Form->input('hpthnlalu');
		echo $this->Form->input('hpblnlalumasuk');
		echo $this->Form->input('hpblninimasuk');
		echo $this->Form->input('hpblnlalukeluar');
		echo $this->Form->input('hpblninikeluar');
		echo $this->Form->input('hpthnini');
		echo $this->Form->input('depthnlalu');
		echo $this->Form->input('depblnlalumasuk');
		echo $this->Form->input('depblninimasuk');
		echo $this->Form->input('depblnlalukeluar');
		echo $this->Form->input('depblninikeluar');
		echo $this->Form->input('depthnini');
		echo $this->Form->input('book_value');
		echo $this->Form->input('sedang_diluar');
		echo $this->Form->input('service_tanggal');
		echo $this->Form->input('service_selesai_tanggal');
		echo $this->Form->input('date_begin');
		echo $this->Form->input('date_end');
		echo $this->Form->input('no_urut_prefix');
		echo $this->Form->input('no_urut');
		echo $this->Form->input('serial_no');
		echo $this->Form->input('voucher_no');
		echo $this->Form->input('pos_ting');
		echo $this->Form->input('doc_total');
		echo $this->Form->input('date_of_purchase');
		echo $this->Form->input('kd_luar_tanggal');
		echo $this->Form->input('service_total');
		echo $this->Form->input('service_ket');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

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