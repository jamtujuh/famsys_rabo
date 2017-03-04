<div class="aydaDocs index">
	<h2><?php __('Ayda Docs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nama');?></th>
			<th><?php echo $this->Paginator->sort('heading');?></th>
			<th><?php echo $this->Paginator->sort('kode');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($aydaDocs as $aydaDoc):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $aydaDoc['AydaDoc']['id']; ?>&nbsp;</td>
		<td><?php echo $aydaDoc['AydaDoc']['nama']; ?>&nbsp;</td>
		<td><?php echo $aydaDoc['AydaDoc']['heading']; ?>&nbsp;</td>
		<td><?php echo $aydaDoc['AydaDoc']['kode']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $aydaDoc['AydaDoc']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $aydaDoc['AydaDoc']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $aydaDoc['AydaDoc']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $aydaDoc['AydaDoc']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ayda Doc', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Aydas', true), array('controller' => 'aydas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda', true), array('controller' => 'aydas', 'action' => 'add')); ?> </li>
	</ul>
</div>