<div class="poDetails form">
<?php echo $this->Form->create('PoDetail');?>
	<fieldset>
 		<legend><?php __('Edit Po Received'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('po_id', array('type'=>'hidden'));
		//echo $this->Form->input('asset_category_id', array('options'=>$assetCategories));
		echo $this->Form->input('name', array('style'=>'width:98%', 'readonly'=>true));
		echo $this->Form->input('brand', array('type'=>'hidden'));
		echo $this->Form->input('type', array('type'=>'hidden'));
		echo $this->Form->input('color', array('type'=>'hidden'));
		echo $this->Form->input('qty', array('readonly'=>true));
		echo $this->Form->input('qty_received');
		echo $this->Form->input('department_id');
		echo $this->Form->input('rp_rate', array('type'=>'hidden'));
		echo $this->Form->input('price_cur', array('type'=>'hidden'));
		echo $this->Form->input('price', array('type'=>'hidden'));
		echo $this->Form->input('discount_cur', array('type'=>'hidden'));
		echo $this->Form->input('amount_nett_cur', array('readonly'=>true, 'type'=>'hidden'));
		echo $this->Form->input('is_vat', array('type'=>'hidden'));
		echo $this->Form->input('is_wht', array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PoDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PoDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Po Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->event('PoDetailPriceCur','change','calcRp(\'PoDetail\')');
echo $javascript->event('PoDetailQty','change','calcRp(\'PoDetail\')');
echo $javascript->event('PoDetailRpRate','change','calcRp(\'PoDetail\')');

echo $javascript->event('PoDetailPriceCur','change','nettCur(\'PoDetail\')');
echo $javascript->event('PoDetailDiscountCur','change','nettCur(\'PoDetail\')');
echo $javascript->event('PoDetailAmountNettCur','change','nettCur(\'PoDetail\')');
?>