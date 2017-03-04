<div class="importAssetDetails form">
<?php echo $this->Form->create('ImportAssetDetail');?>
	<fieldset>
 		<legend><?php __('Edit Import Asset Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fa_import_id');
		echo $this->Form->input('code');
		echo $this->Form->input('condition_id');
		echo $this->Form->input('asset_id');
		echo $this->Form->input('asset_category_id');
		echo $this->Form->input('purchase_id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('department_sub_id');
		echo $this->Form->input('department_unit_id');
		echo $this->Form->input('business_type_id');
		echo $this->Form->input('cost_center_id');
		echo $this->Form->input('warranty_id');
		echo $this->Form->input('warranty_name');
		echo $this->Form->input('warranty_year');
		echo $this->Form->input('status');
		echo $this->Form->input('name');
		echo $this->Form->input('item_code');
		echo $this->Form->input('color');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('date_of_purchase');
		echo $this->Form->input('umurek');
		echo $this->Form->input('price');
		echo $this->Form->input('depbln');
		echo $this->Form->input('hpthnlalu');
		echo $this->Form->input('hpthnini');
		echo $this->Form->input('depthnlalu');
		echo $this->Form->input('depthnini');
		echo $this->Form->input('book_value');
		echo $this->Form->input('date_start');
		echo $this->Form->input('date_end');
		echo $this->Form->input('serial_no');
		echo $this->Form->input('notes');
		echo $this->Form->input('CAB');
		echo $this->Form->input('LT');
		echo $this->Form->input('UNIT_KERJA');
		echo $this->Form->input('LOKASI');
		echo $this->Form->input('GOL');
		echo $this->Form->input('HARI');
		echo $this->Form->input('TOTAL_PENYUSUTAN_DAYS');
		echo $this->Form->input('TOTAL_PENYUSUTAN_MONTH');
		echo $this->Form->input('KETERANGAN');
		echo $this->Form->input('NILAI_BUKU_THN_LALU');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Import Asset Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fa Imports', true), array('controller' => 'fa_imports', 'action' => 'index')); ?> </li>
	</ul>
</div>