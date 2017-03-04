<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
?>
<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
 		<legend><?php __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('asset_category_type_id', array('empty'=>'select asset category type', 'value'=>$this->Session->read('Item.asset_category_type_id')));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories));
		echo $this->Form->input('request_type_id', array('options'=>$requestTypes));
		echo $this->Form->input('name', array('style'=>'width:98%'));
		echo $this->Form->input('unit_id', array('options'=>$units));
		echo $this->Form->input('prefix', array('maxlength'=>'10'));
		echo $this->Form->input('currency_id', array('type'=>'hidden', 'default' => 1));
		echo $this->Form->input('price');
		echo $this->Form->input('avg_price');
		echo $this->Form->input('qty_reorder');
		echo $this->Form->input('descr', array('style'=>'width:98%', 'maxlength'=>'255'));
		
		$options = array('url' => 'getassetcategoryid','indicator'=>'LoadingDiv', 'update' => 'ItemAssetCategoryId');
		echo $ajax->observeField('ItemAssetCategoryTypeId', $options);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Item.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Item.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('action' => 'index'));?></li>
	</ul>
</div>