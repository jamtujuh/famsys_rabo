<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>

<div class="supplier_returs form">
<?php echo $this->Form->create('SupplierRetur');?>
	<fieldset>
 		<legend><?php __('Add Supplier Retur'); ?></legend>
	<?php
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('date', array('type'=>'text', 'value'=>date("Y-m-d"), 'readonly'=>true));

		echo $this->Form->input('supplier_id', array('options'=>$suppliers, 'empty'=>'select supplier', 'type'=>'hidden')); 
		echo $this->Form->input('Supplier.name', array('label'=>'Supplier', 'style'=>'width:60%')); 
	?>
		<div id="supplier_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('SupplierName', 'supplier_choices', '<?php echo BASE_URL ?>/suppliers/auto_complete', {afterUpdateElement : setSupplierReturValues});
			//]]>
		</script>
	<?php echo $this->Form->input('retur_id', array('type'=>'hidden') ); ?>
	<?php echo $this->Form->input('Retur.name', array('label'=>'Select Retur No')); ?>
		<div id="retur_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ReturName', 'retur_choices', '<?php echo BASE_URL ?>/returs/auto_complete_supplier', {afterUpdateElement : setSupplierReturReturValues});
			//]]>
		</script>
	<?php	
		echo $this->Form->input('department_id', array('value'=>$department_id,'type'=>'hidden')); 
		echo $this->Form->input('department_name', array('value'=>$departments[$department_id],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 

		echo $this->Form->input('business_type_id', array('value'=>$business_type_id,'type'=>'hidden')); 
		echo $this->Form->input('business_type_name', array('value'=>$businessTypes[$business_type_id],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 

		echo $this->Form->input('cost_center_id', array('value'=>$cost_center_id,'type'=>'hidden')); 
		echo $this->Form->input('cost_center_name', array('value'=>$costCenters[$cost_center_id],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 

		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"),'type'=>'hidden'));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List SupplierReturs', true), array('action' => 'index'));?></li>
	</ul>
</div>