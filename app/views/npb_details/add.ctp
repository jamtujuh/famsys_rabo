<div class="npbDetails form">
<?php echo $this->Form->create('NpbDetail');?>
	<fieldset>
 		<legend><?php __('Add Npb Detail'); ?></legend>
	<?php
		echo $this->Form->input('npb_id', array('type'=>'hidden','readonly'=>true,'value'=>$this->Session->read('Npb.id')));
		echo $this->Form->input('Npb.no', array('readonly'=>true,'value'=>$npb['Npb']['no']) );
		echo $this->Form->input('item_id', array('options'=>$requestTypes, 'empty'=>'select one item') );
		echo $this->Form->input('qty', array('value'=>1));
		echo $this->Form->input('currency_id', array('value'=>1, 'type'=>'hidden'));
		echo $this->Form->input('rp_rate', array('value'=>1, 'type'=>'hidden'));
		echo $this->Form->input('price_cur', array('value'=>0, 'type'=>'hidden'));
		echo $this->Form->input('price', array('value'=>0, 'type'=>'hidden'));
		echo $this->Form->input('descr', array('style'=>'width:98%') );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Npb Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->event('NpbDetailPriceCur','change','calcRp(\'NpbDetail\')');
echo $javascript->event('NpbDetailQty','change','calcRp(\'NpbDetail\')');
echo $javascript->event('NpbDetailRpRate','change','calcRp(\'NpbDetail\')');

echo $ajax->observeField( 'NpbDetailIdCurrency', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_currency'),
		'complete'	=> 'getRate(request,\'NpbDetail\');Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 

echo $ajax->observeField( 'NpbDetailIdItem', 
    array(
		'url'		=> array('controller'=>'items','action' => 'get_info'),
		'complete'	=> 'updateField("NpbDetailPriceCur","price",request);updateField("NpbDetailIdCurrency","currency_id",request);updateField("NpbDetailRpRate","rp_rate",request);calcRp(\'NpbDetail\');Element.hide(\'LoadingDiv\')',
		'loading' 	=> 'Element.show(\'LoadingDiv\')', 
	)
); 

?>