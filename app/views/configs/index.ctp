<div class="configs index">
	<h2><?php __('Configs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('key');?></th>
			<th><?php echo $this->Paginator->sort('value');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($configs as $config):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $config['Config']['key']; ?>&nbsp;</td>
		<td><?php echo $config['Config']['value']; ?>&nbsp;</td>
		<td class="actions">
			<?php if($Userinfo['group_is_admin'] == 1): ?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $config['Config']['key'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $config['Config']['key'])); ?>
			<?php endif;?>
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
		<?php if($Userinfo['group_is_admin'] == 1): ?>
		<li><?php echo $this->Html->link(__('New Config', true), array('action' => 'add')); ?></li>
		<?php endif;?>
	</ul>
</div>
<div class="doc_actions">
	<ul>
		<?php if($Userinfo['group_is_admin'] == 1): ?>
		<li><?php echo $this->Html->link(__('Print PDF', true), array('action' => 'index',  'pdf')); ?> </li>
		<li><?php echo $this->Html->link(__('Print XLS', true), array('action' => 'index',  'xls')); ?> </li>
		<?php endif;?>
	</ul>
</div>
