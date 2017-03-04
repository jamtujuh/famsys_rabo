<?
echo $html->script('prototype');
echo $html->script('scriptaculous'); 
$group = $this->Session->read('Security.permissions');
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div class="purchases form">
<?php echo $this->Form->create('Purchase');?>
	<fieldset>
 		<legend><?php __('Add Purchase'); ?></legend>
 
	<fieldset >
		<legend>Document Information</legend>
		<?php
			echo $this->Form->input('no', array('value'=>$newId, 'readonly'=>true, 'type'=>'text'));
			//echo $this->Form->input('voucher_no');
			echo $this->Form->input('date_of_purchase', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
			echo $this->Form->input('delivery_order_id', array('value'=>$delivery_order_id, 'type'=>'hidden'));
			echo $this->Form->input('invoice_id', array('value'=>$invoice_id, 'type'=>'hidden'));
			
			if($group==fa_management_group_id){
			echo $this->Form->input('request_type_id', array('value'=>request_type_fa_general_id, 'type'=>'hidden'));
			}else if($group==it_management_group_id){
			echo $this->Form->input('request_type_id', array('value'=>request_type_fa_it_id, 'type'=>'hidden'));
			}
			//echo $this->Form->input('invoice_no');
		?>
	</fieldset>
	
	<fieldset >
	<legend>Order Information</legend>
		<?php if ($po_no):?>
			<?php echo $this->Form->input('po_no', array('readonly'=>true,'value'=>$po_no)); ?>
			<?php echo $this->Form->input('po_id', array('value'=>$po_id, 'type'=>'hidden')); ?>
			<?php echo $this->Form->input('currency_id', array('type'=>'hidden','value'=>$currency_id)); ?>
			<?php echo $this->Form->input('currency_name', array('readonly'=>true,'value'=>$currency_name)); ?>
			<?php echo $this->Form->input('rp_rate', array('readonly'=>true,'type'=>'text', 'value'=>$rp_rate)); ?>
		<?php else:?>
			<?php echo $this->Form->input('po_no', array('disabled'=>true)); ?>
			<?php echo $this->Form->input('currency_id', array('disabled'=>true)); ?>
			<?php echo $this->Form->input('rp_rate', array('readonly'=>true,'type'=>'text','value'=>$rp_rate)); ?>
			<?php echo $this->Form->input('group_id', array('value'=>$this->Session->read('Userinfo.group_id'), 'type'=>'hidden'));?>
		<?php endif;?>
	</fieldset>

	<fieldset  >
	<legend>Supplier Information</legend>
		<div style="float:right;width:50%" id="supplier_div"></div>
		<?php if($supplier_id) : ?>
		<?php echo $this->Form->input('supplier_id', array('type'=>'hidden','value'=>$supplier_id));?>
		<?php echo $supplier_name ?>		
		<?php else : ?>
		<?php echo $this->Form->input('supplier_id', array('options'=>$suppliers,'empty'=>'select one'));?>
		<?php endif; ?>
	</fieldset>
	
	<fieldset >
	<legend>Warranty Information/Notes</legend>
		<div style="float:right;width:50%" id="warranty_div"></div>
		<?php echo $this->Form->input('warranty_name',array('style'=>'width:100%', 'value'=>$warranty_name)); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Purchases', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
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