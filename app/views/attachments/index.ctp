<div class="attachments index">
	<h2><?php __('Attachments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('attachment_file_path');?></th>
			<th><?php echo $this->Paginator->sort('attachment_file_name');?></th>
			<th><?php echo $this->Paginator->sort('attachment_file_size');?></th>
			<th><?php echo $this->Paginator->sort('attachment_content_type');?></th>
			<th><?php echo $this->Paginator->sort('npb_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attachments as $attachment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attachment['Attachment']['id']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['name']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['attachment_file_path']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['attachment_file_name']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['attachment_file_size']; ?>&nbsp;</td>
		<td><?php echo $attachment['Attachment']['attachment_content_type']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attachment['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $attachment['Npb']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $attachment['Attachment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['Attachment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Attachment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
	</ul>
</div>