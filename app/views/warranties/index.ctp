<div id="moduleName"><?php echo $moduleName?></div>
<div class="warranties index">
	<h2><?php __('Warranties');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('warranty_info');?></th>
			<th><?php echo $this->Paginator->sort('business_type');?></th>
			<th><?php echo $this->Paginator->sort('website');?></th>
			<th><?php echo $this->Paginator->sort('tanggal');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($warranties as $warranty):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $warranty['Warranty']['warranty_info']; ?>&nbsp;</td>
		<td><?php echo $warranty['Warranty']['business_type']; ?>&nbsp;</td>
		<td><?php echo $warranty['Warranty']['website']; ?>&nbsp;</td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $warranty['Warranty']['tanggal']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $warranty['Warranty']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $warranty['Warranty']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $warranty['Warranty']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $warranty['Warranty']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Warranty', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
	</ul>
</div>