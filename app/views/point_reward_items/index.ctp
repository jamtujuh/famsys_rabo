<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<!--li><!--?php echo $this->Html->link(__('New Item Prefix', true), array('action' => 'add')); ?--> </li-->
	</ul>
</div>
<div class="PointRewardItems index">
	<h2><?php __('Item Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('item_name');?></th>
			<th><?php echo $this->Paginator->sort('prefix');?></th>
			<th><?php echo $this->Paginator->sort('mark');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($PointRewardItems as $detail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($detail['Item']['code'], array('controller' => 'items', 'action' => 'view', $detail['Item']['id'])); ?>
		</td>
		<td class="left"><?php echo $detail['Item']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $detail['PointRewardItem']['item_prefix']; ?></td>
		<td class="left"><?php echo $detail['PointRewardItem']['mark']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View Item', true), array('controller' => 'items', 'action' => 'view', $detail['Item']['id'])); ?>
			<!--?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $detail['PointRewardItem']['id'])); ?-->
			<!--?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $detail['PointRewardItem']['id'])); ?-->
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
	<div class="paging">
		<?php echo $this->Paginator->first('|< ' . __('first', true), array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >|', array(), null, array('class' => 'disabled'));?>
	</div>
</div>