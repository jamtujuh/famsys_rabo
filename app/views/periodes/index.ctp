<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Periode', true), array('action' => 'add')); ?></li>		
	</ul>
</div>

<div class="periode related">
	<h2><?php __('Periodes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('day_start');?></th>
		<th><?php echo $this->Paginator->sort('day_end');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<?php
	$i = 0;
	foreach ($Periodes as $pe):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $pe['Periode']['name']; ?>&nbsp;</td>
		<td><?php echo $pe['Periode']['day_start']; ?>&nbsp;</td>
		<td><?php echo $pe['Periode']['day_end']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pe['Periode']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pe['Periode']['id'])); ?>
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

