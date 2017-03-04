<div class="attachments view">
<h2><?php  __('Attachment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Npb'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($attachment['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $attachment['Npb']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attachment File Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['attachment_file_path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attachment File Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['attachment_file_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attachment File Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['attachment_file_size']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attachment Content Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['attachment_content_type']; ?>
			&nbsp;
		</dd>

	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete Attachment', true), array('action' => 'delete', $attachment['Attachment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Download Attachment', true), 
			'/'.$attachment['Attachment']['attachment_file_path']. $attachment['Attachment']['attachment_file_name']); ?> </li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
	</ul>
</div>

<iframe style="width:98%;height:600px" 
src="<?php echo BASE_URL ?>/<?php echo $attachment['Attachment']['attachment_file_path'] . $attachment['Attachment']['attachment_file_name'] ?>">
</iframe>
