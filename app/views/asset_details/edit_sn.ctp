<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div class="assetDetails form">
<?php echo $this->Form->create('AssetDetail');?>
	<fieldset>
 		<legend><?php __('Edit Asset Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code', array('readonly'=>true, 'style'=>'width:30%', 'label'=>'No Invetaris'));
		echo $this->Form->input('name', array('readonly'=>true, 'style'=>'width:35%'));
		echo $this->Form->input('department_id', array('option'=>$departments, 'type'=>'hidden'));
		echo $this->Form->input('department_name', array('value'=>$departments[$department_id], 'readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('name', array('readonly'=>true));
		echo $this->Form->input('business_type_id', array('readonly'=>true, 'type'=>'hidden'));
		echo $this->Form->input('business_type', array('value'=>$businessType[$business_type_id], 'readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('cost_center_id', array('type'=>'hidden'));
		echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:50%', 'readonly'=>true));
		echo $this->Form->input('color');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('location_id', array('empty'=>''));
		echo $this->Form->input('serial_no');
		echo $this->Form->input('condition_id');
		echo $this->Form->input('konfigurasi', array('style'=>'width:98%'));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>
	<div id="cost_center_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetDetailCostCenterValues});
		//]]>
	</script>

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Asset Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
	</ul>
</div>