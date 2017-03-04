<div class="poDetails form">
<?php echo $this->Form->create('PoDetail');?>
	<fieldset>
 		<legend><?php __('Edit Po Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('po_id', array('type'=>'hidden'));
//		echo $this->Form->input('Po.no', array('value'=>$po['Po']['no'], 'readonly'=>true));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories));
		echo $this->Form->input('name', array('style'=>'width:98%'));
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('color');
		echo $this->Form->input('qty');
//		echo $this->Form->input('currency_id', array('options'=>$currencies));
//		echo $this->Form->input('rp_rate', array('type'=>'hidden'));
		echo $this->Form->input('price_cur');
		echo $this->Form->input('discount_cur');
//		echo $this->Form->input('amount_nett_cur', array('readonly'=>true));
		echo $this->Form->input('is_vat');
//		echo $this->Form->input('is_wht');
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