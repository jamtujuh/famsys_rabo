<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div class="faSupplierReturs form">
<?php echo $this->Form->create('FaSupplierRetur');?>
	<fieldset>
 		<legend><?php __('Edit Fa Supplier Retur'); ?></legend>
	<?php
		echo $this->Form->input('id');
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
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('department_id');
		echo $this->Form->input('created_by', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('notes', array('type'=>'textarea', 'style'=>'width:100%'));
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