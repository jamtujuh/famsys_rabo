<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div class="faSupplierReturs form">
<?php echo $this->Form->create('FaSupplierRetur');?>
	<fieldset>
 		<legend><?php __('Add Fa Supplier Retur'); ?></legend>
	<?php
		echo $this->Form->input('doc_date', array('type'=>'text', 'readonly'=>true, 'value'=>date('Y-m-d')));
		echo $this->Form->input('no', array('type'=>'text', 'value'=>$newId, 'style'=>'width:165px', 'readonly'=>true) );
		echo $this->Form->input('po_id', array('type'=>'hidden', 'empty'=>'select po no'));
		echo $this->Form->input('Po.no',array('label'=>'Po No', 'style'=>'width:35%','type'=>'text'));
	?>
	<div id="po_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('PoNo', 'po_choices', '<?php echo BASE_URL ?>/pos/auto_complete', {afterUpdateElement : setFaSupplierReturPoValues});
		//]]>
	</script>
	
	<?php
		echo $this->Form->input('branch', array('style'=>'width:35%','type'=>'text','readonly'=>true, 'value'=>$departments[$Userinfo['department_id']]));
		echo $this->Form->input('department_id');
		echo $this->Form->input('cost_center_id', array('type'=>'hidden', 'value'=>$Userinfo['cost_center_id']));
		echo $this->Form->input('business_type_id', array('type'=>'hidden', 'value'=>$Userinfo['business_type_id']));
		echo $this->Form->input('created_by', array('value'=>$Userinfo['username'], 'readonly'=>true) );
		echo $this->Form->input('status', array('type'=>'text','readonly'=>true, 'value'=>$faSupplierReturStatuses[status_fa_supplier_retur_draft_id]));
		echo $this->Form->input('fa_supplier_retur_status_id', array('type'=>'hidden', 'value'=>status_fa_supplier_retur_draft_id));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fa Supplier Returs', true), array('action' => 'index'));?></li>
	</ul>
</div>