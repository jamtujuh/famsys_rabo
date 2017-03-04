<div class="invoiceDetails form">
<?php echo $this->Form->create('InvoiceDetail');?>
	<fieldset>
 		<legend><?php __('Add Invoice Detail'); ?></legend>
	<?php
		echo $this->Form->input('invoice_id', array('type'=>'hidden', 'value'=>$this->Session->read('Invoice.id')));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories,'empty'=>'select a category'));
		echo $this->Form->input('umurek', array('readonly'=>true) );
		echo $this->Form->input('name', array('style'=>'width:98%'));
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('color');
		echo $this->Form->input('qty', array('value'=>1));
		echo $this->Form->input('currency_id', array('options'=>$currencies));
		echo $this->Form->input('rp_rate', array('value'=>1, 'readonly'=>true));
		echo $this->Form->input('price_cur');
		echo $this->Form->input('price', array('readonly'=>true));
		echo $this->Form->input('is_vat');
		echo $this->Form->input('is_wht');	
		echo $this->Form->input('vat_rate', array('type'=>'hidden', 'value'=>$this->Session->read('Invoice.vat_rate')));
		echo $this->Form->input('wht_rate', array('type'=>'hidden', 'value'=>$this->Session->read('Invoice.wht_rate')));
		echo $this->Form->input('department_id', array('value'=>$this->Session->read('Invoice.department_id')));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Invoice Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>


<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->event('InvoiceDetailPriceCur','change','calcRp(\'InvoiceDetail\')');
echo $javascript->event('InvoiceDetailQty','change','calcRp(\'InvoiceDetail\')');
echo $javascript->event('InvoiceDetailRpRate','change','calcRp(\'InvoiceDetail\')');

echo $ajax->observeField( 'InvoiceDetailCurrencyId', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_currency'),
		'complete'	=> 'getRate(request,\'InvoiceDetail\');Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 

echo $ajax->observeField( 'InvoiceDetailAssetCategoryId', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_depr_year'),
		'complete'	=> 'updateField("InvoiceDetailUmurek","depr_year_com",request);Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 
?>