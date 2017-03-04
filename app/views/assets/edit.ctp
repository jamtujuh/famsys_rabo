<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div class="assets form">
<?php echo $this->Form->create('Asset');?>
	<fieldset>
 		<legend><?php __('Edit Asset'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code', array('readonly'=>true,'type'=>'text', 'label'=>'No Inventaris'));
		echo $this->Form->input('purchase_id',array('type'=>'hidden'));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'readonly'=>true,'type'=>'text'));
		echo $this->Form->input('umurek', array('style'=>'width:40px'));	
		echo $this->Form->input('golongan', array('style'=>'maxlength:255'));		
		echo $this->Form->input('name', array('style'=>'width:50%'));
		echo $this->Form->input('business_type_id', array('options'=>$businessType));
		//echo $this->Form->input('cost_center_id', array('options'=>$costCenter));
	?>
	<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:50%')); ?>
	<div id="cost_center_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetCostCenterValues});
		//]]>
	</script>
	<?php
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('color');
		echo $this->Form->input('currency_id', array('options'=>$currencies, 'readonly'=>true,'type'=>'text'));
		echo $this->Form->input('price_cur', array('readonly'=>true,'type'=>'text'));
		echo $this->Form->input('rp_rate', array('readonly'=>true,'type'=>'text'));
		echo $this->Form->input('price' , array('readonly'=>true,'type'=>'text'));
		echo $this->Form->input('qty', array('readonly'=>true,'type'=>'text'));
		echo $this->Form->input('year', array('readonly'=>true,'type'=>'text'));
		echo $this->Form->input('department_id', array('options'=>$departments, 'readonly'=>true,'type'=>'text'));
		echo $this->Form->input('location_id', array('options'=>$locations));
		echo $this->Form->input('ada', array('readonly'=>true,'type'=>'text'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
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
echo $javascript->event('AssetPriceCur','change','calcRp()');
echo $javascript->event('AssetQty','change','calcRp()');

echo $ajax->observeField( 'AssetCurrencyId', 
    array(
		'url'		=> array('action' => 'get_currency'),
		'complete'	=> 'getRate(request);Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 

echo $ajax->observeField( 'AssetAssetCategoryId', 
    array(
		'url'		=> array('action' => 'get_depr_year'),
		'complete'	=> 'updateField("AssetUmurek","depr_year_com",request);Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 

?>