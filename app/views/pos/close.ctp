<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>
<div class="pos form">
<?php echo $this->Form->create('Po');?>
	<fieldset>
 		<legend><?php __('Close Order'); ?></legend>
		<?php echo $this->Form->input('id'); ?>
		<?php echo $this->Form->input('no', array('style'=>'width:40%', 'readonly'=>true, 'type'=>'text')); ?>
		<?php echo $this->Form->input('po_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));?>
		<?php echo $this->Form->input('delivery_date', array('type'=>'text', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('supplier_id', array('empty'=>'select supplier', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('Supplier.name', array('label'=>'Supplier', 'style'=>'width:75%', 'readonly'=>true)); ?>
		<div id="supplier_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('SupplierName', 'supplier_choices', '<?php echo BASE_URL ?>/suppliers/auto_complete', {afterUpdateElement : setSupplierValues});
			//]]>
		</script>
		<?php echo $this->Form->input('department_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('department_sub_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('department_unit_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('cost_center_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('business_type_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('status', array('type'=>'text','readonly'=>true, 'value'=>$poStatuses[status_po_draft_id])); ?>
		<?php echo $this->Form->input('po_status_id', array('type'=>'hidden', 'value'=>'10')); ?>
		<?php echo $this->Form->input('description', array('style'=>'width:98%', 'maxlength'=>'255', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('billing_address', array('style'=>'width:98%', 'maxlength'=>'255', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('shipping_address', array('style'=>'width:98%', 'maxlength'=>'255', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('sub_total', array('type'=>'hidden','value'=>$this->data['Po']['vsubtotal'])); ?>
		<?php echo $this->Form->input('discount', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('vat_rate', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('vat_base', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('vat_total', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('total', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('down_payment', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('payment_term', array('readonly'=>true)); ?>
		<?php echo $this->Form->input('daily_penalty', array('readonly'=>true)); ?>
		<?php echo $this->Form->input('currency_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('signer_1', array('style'=>'width:50%', 'maxlength'=>'100', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('signer_2', array('style'=>'width:50%', 'maxlength'=>'100', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('po_address', array('type'=>'hidden', 'style'=>'width:98%', 'maxlength'=>'255')); ?>
		<?php echo $this->Form->input('created', array('value'=>date("Y-m-d"), 'type'=>'hidden') );?>
		<?php //echo $this->Form->input('select_details_from_nbp', array('type'=>'checkbox')); ?>
		<?php echo $this->Form->input('approval_note_1', array('style'=>'width:98%', 'maxlength'=>'255')); ?>
		<?php echo $this->Form->input('approval_note_2', array('style'=>'width:98%', 'maxlength'=>'255')); ?>
	</fieldset>
<?php echo $this->Form->end(__('Close Order', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Pos', true), array('action' => 'index'));?></li>
	</ul>
</div>