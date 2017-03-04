<div class="outlogDetails form">
<?php echo $this->Form->create('OutlogDetail');?>
	<fieldset>
 		<legend><?php __('Add Outlog Detail'); ?></legend>
	<?php
		echo $this->Form->input('outlog_id', array('type'=>'hidden','value'=>$this->Session->read('Outlog.id')));
		echo $this->Form->input('Outlog.no', array('value'=>$out_no, 'readonly'=>true));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'select inventory category'));
		echo $this->Form->input('item_id', array('empty'=>'select item'));
		echo $this->Form->input('unit_id');
		echo $this->Form->input('qty', array('value'=>1));
		echo $this->Form->input('price', array('value'=>0));
		echo $this->Form->input('amount', array('readonly'=>true, 'value'=>0));
		
		$options = array('url' => 'getitems', 'update' => 'OutlogDetailItemId',
			'loading' 	=> 'Element.show(\'LoadingDiv\')',
			'complete'	=> 'Element.hide(\'LoadingDiv\')');
		echo $ajax->observeField('OutlogDetailAssetCategoryId', $options);
		
		$options = array('url' => 'getunits', 'update' => 'OutlogDetailUnitId');
		echo $ajax->observeField('OutlogDetailItemId', $options);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Outlog Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
	
	echo $javascript->event('OutlogDetailQty','change','calcAmount(\'OutlogDetail\')');
	echo $javascript->event('OutlogDetailPrice','change','calcAmount(\'OutlogDetail\')');
	echo $javascript->event('OutlogDetailAmount','change','calcAmount(\'OutlogDetail\')');
	
?>