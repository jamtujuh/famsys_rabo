<div id="moduleName"><?php echo 'STOCK > Stock List'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('Stock', array('action'=>'index')) ?>
<fieldset>
	<legend><?php __('Stock Filters')?></legend>
	<fieldset class="subfilter" style="width:50%">
	<legend><?php __('Stock Filter') ?></legend>
	
	<?php if($this->Session->read('Security.permissions')!=stock_management_group_id) :?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$this->Session->read('Stock.department_id') )) ?>
		<?php echo $this->Form->input('department_name',array('type'=>'text','readonly'=>true,'value'=>$departments[$this->Session->read('Stock.department_id') ])) ?>
	<?php else : ?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'value'=>$this->Session->read('Stock.department_id') )) ?>	
	<?php endif; ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF', 'xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
</fieldset>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks', true), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
	</ul>
</div>
</div>
<div class="related">
	<h2><?php __('Stocks');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$qty = 0;
	$amount = 0;
	foreach ($stocks as $stock):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $stock['Stock']['date']); ?>&nbsp;</td>
		<td class="left"><?php echo $stock['Item']['name']; ?></td>
		<td class="center"><?php echo $stock['Stock']['qty']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($stock['Stock']['price']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($stock['Stock']['amount']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'history', $stock['Stock']['item_id'], $stock['Stock']['department_id'] )); ?>
		</td>
	</tr>
	<?php $qty += $stock['Stock']['qty']?>
	<?php $amount += $stock['Stock']['amount']?>
<?php endforeach; ?>
	<tr>
		<td class="number" colspan='3'>Total</td>
		<td class="center"><?php echo $this->Number->format($qty) ;?></td>
		<td></td>
		<td class="number"><?php echo $this->Number->format($amount) ;?></td>
	</tr>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
