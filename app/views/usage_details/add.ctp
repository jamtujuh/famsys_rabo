<div class="returDetails form">
<?php echo $this->Form->create('ReturDetail');?>
	<fieldset>
 		<legend><?php __('Add Retur Detail'); ?></legend>
	<?php
		echo $this->Form->input('retur_id', array('type'=>'hidden','value'=>$this->Session->read('Retur.id')));
		echo $this->Form->input('Retur.no', array('value'=>$out_no, 'readonly'=>true));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'select inventory category'));
		echo $this->Form->input('item_id', array('empty'=>'select item'));
		echo $this->Form->input('unit_id');
		echo $this->Form->input('qty', array('value'=>1));
		echo $this->Form->input('price', array('value'=>0));
		echo $this->Form->input('amount', array('readonly'=>true, 'value'=>0));
		
		$options = array('url' => 'getitems', 'update' => 'ReturDetailItemId',
			'loading' 	=> 'Element.show(\'LoadingDiv\')',
			'complete'	=> 'Element.hide(\'LoadingDiv\')');
		echo $ajax->observeField('ReturDetailAssetCategoryId', $options);
		
		$options = array('url' => 'getunits', 'update' => 'ReturDetailUnitId');
		echo $ajax->observeField('ReturDetailItemId', $options);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Retur Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Returs', true), array('controller' => 'returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
	echo $javascript->link('prototype',false);
	echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
	
	echo $javascript->event('ReturDetailQty','change','calcAmount(\'ReturDetail\')');
	echo $javascript->event('ReturDetailPrice','change','calcAmount(\'ReturDetail\')');
	echo $javascript->event('ReturDetailAmount','change','calcAmount(\'ReturDetail\')');
	
?>