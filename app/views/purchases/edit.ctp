<?
echo $html->script('prototype');
echo $html->script('scriptaculous'); 
?>	
<div class="purchases form">
<?php echo $this->Form->create('Purchase');?>
	<fieldset>
 		<legend><?php __('Edit Purchase'); ?></legend>
	<fieldset >
		<legend>Document Information</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
			//echo $this->Form->input('voucher_no');
			echo $this->Form->input('date_of_purchase', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		?>
	</fieldset>
	
	<fieldset >
	<legend>Order Information</legend>
		<?
			echo $this->Form->input('po_no', array('readonly'=>true, 'type'=>'text'));
			//echo $this->Form->input('invoice_no');
			//echo $this->Form->input('department_id', array('options'=>$departments));
			//echo $this->Form->input('requester_id', array('options'=>$requesters));
		?>
	</fieldset>
	<fieldset >
	<legend>Warranty Information</legend>
		<div style="float:right;width:50%" id="warranty_div"><?= $warranty_info ?></div>
		<? echo $this->Form->input('warranty_name', array('style'=>'width:100%'));?>
		<?php echo $this->Form->input('warranty_year_start',array('value'=>$warranty_year_start, 'type'=>'date') ); ?>	
		<?php echo $this->Form->input('warranty_year_end',array('value'=>$warranty_year_end, 'type'=>'date') ); ?>	
	</fieldset>  
	
	<fieldset >
	<legend>status Information</legend>
		<div style="float:right;width:50%" id="warranty_div"></div>
		<?php echo $this->Form->input('status', array('type'=>'text','readonly'=>true, 'value'=>$statuses[status_purchase_draft_id])); ?>
		<?php echo $this->Form->input('purchase_status_id', array('type'=>'hidden', 'value'=>status_purchase_draft_id));	?>
	</fieldset>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>


<?
echo $ajax->observeField('PurchaseSupplierId',
	array(
		'url'		=> array('controller'=>'suppliers', 'action'=>'get_supplier_info'),
		'update'	=> 'supplier_div',
		'loading' 	=> 'Element.show(\'LoadingDiv\');', 
		'complete' 	=> 'Element.hide(\'LoadingDiv\')', 
	)
);
echo $ajax->observeField('PurchaseWarrantyId',
	array(
		'url'		=> array('controller'=>'warranties', 'action'=>'get_warranty_info'),
		'loading' 	=> 'Element.show(\'LoadingDiv\');', 
		'complete' 	=> 'Element.hide(\'LoadingDiv\')', 
		'update'	=> 'warranty_div'
	)
);

?>