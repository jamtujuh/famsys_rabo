<div class="inlogDetails form">
<?php echo $this->Form->create('InlogDetail');?>
	<fieldset>
 		<legend><?php __('Add Inlog Detail'); ?></legend>
	<?php
		echo $this->Form->input('inlog_id', array('type'=>'hidden','value'=>$this->Session->read('Inlog.id')));
		echo $this->Form->input('Inlog.no', array('value'=>$in_no, 'readonly'=>true));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'select inventory category'));
		echo $this->Form->input('item_id', array('empty'=>'select item'));
		echo $this->Form->input('unit_id');
		echo $this->Form->input('qty', array('value'=>1));
		echo $this->Form->input('price', array('value'=>0));
		echo $this->Form->input('amount', array('readonly'=>true, 'value'=>0));
		
		$options = array('url' => 'getitems', 'update' => 'InlogDetailItemId',
			'loading' 	=> 'Element.show(\'LoadingDiv\')',
			'complete'	=> 'Element.hide(\'LoadingDiv\')');
		echo $ajax->observeField('InlogDetailAssetCategoryId', $options);
		
		$options = array('url' => 'getunits', 'update' => 'InlogDetailUnitId');
		echo $ajax->observeField('InlogDetailItemId', $options);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Inlog Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('controller' => 'inlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
	
	echo $javascript->event('InlogDetailQty','change','calcAmount(\'InlogDetail\')');
	echo $javascript->event('InlogDetailPrice','change','calcAmount(\'InlogDetail\')');
	echo $javascript->event('InlogDetailAmount','change','calcAmount(\'InlogDetail\')');
	
?>