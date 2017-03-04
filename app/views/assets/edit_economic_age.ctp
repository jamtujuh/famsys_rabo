<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div class="assets form">
<?php echo $this->Form->create('Asset');?>
	<fieldset>
 		<legend><?php __('Edit Masa Manfaat Asset'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code', array('readonly'=>true,'type'=>'text', 'label'=>'No Inventaris'));
		echo $this->Form->input('umurek', array('style'=>'width:40px', 'label'=>'Masa Manfaat'));	
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