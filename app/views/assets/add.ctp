?>
<div class="assets form">
<?php echo $this->Form->create('Asset');?>
	<fieldset>
 		<legend><?php __('Add Asset'); ?></legend>
	<?php
		echo $this->Form->input('purchase_id',array('type'=>'hidden','value'=>$this->Session->read('Purchase.id')));
		echo $this->Form->input('date_of_purchase', array('readonly'=>true,'type'=>'text','value'=>$purchases['Purchase']['date_of_purchase']));
		echo $this->Form->input('asset_category_type_id', array( 'options'=>$assetCategoryTypes, 'empty'=>'select one'));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'select one'));		
		echo $this->Form->input('umurek', array('style'=>'width:40px'));
		echo $this->Form->input('golongan', array('style'=>'maxlength:255'));
		echo $this->Form->input('name');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('color');
		echo $this->Form->input('currency_id', array('options'=>$currencies));
		echo $this->Form->input('price_cur');
		echo $this->Form->input('rp_rate', array('default'=>1) );
		echo $this->Form->input('price', array('readonly'=>true) );
		echo $this->Form->input('qty', array('default'=>1));
		echo $this->Form->input('year', array('value'=>substr($purchases['Purchase']['date_of_purchase'], 0,4)));
		echo $this->Form->input('department_id', array('readonly'=>true,'type'=>'hidden','value'=>$purchases['Purchase']['department_id']));
		echo $this->Form->input('warranty_id', array('readonly'=>true,'type'=>'hidden','value'=>$purchases['Purchase']['warranty_id']));
		echo $this->Form->input('voucher_no', array('readonly'=>true,'type'=>'hidden','value'=>$purchases['Purchase']['voucher_no']));
		echo $this->Form->input('po_no', array('readonly'=>true,'type'=>'hidden','value'=>$purchases['Purchase']['po_no']));
		echo $this->Form->input('invoice_no', array('readonly'=>true,'type'=>'hidden','value'=>$purchases['Purchase']['invoice_no']));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Build Asset Details', true));?>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Assets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase', true), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Detail', true), array('controller' => 'asset_details', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->event('AssetPriceCur','change','calcRp(\'Asset\');calcAmount(\'Asset\')');
echo $javascript->event('AssetQty','change','calcRp(\'Asset\');calcAmount(\'Asset\')');
echo $javascript->event('AssetRpRate','change','calcRp(\'Asset\')');

echo $ajax->observeField( 'AssetCurrencyId', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_currency'),
		'complete'	=> 'getRate(request,\'Asset\');Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 

echo $ajax->observeField( 'AssetAssetCategoryId', 
    array(
		'url'		=> array('controller','assets','action' => 'get_depr_year'),
		'complete'	=> 'updateField("AssetUmurek","depr_year_com",request);Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 


?>



