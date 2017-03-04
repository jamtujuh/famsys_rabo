<div class="inlogDetails view">
<h2><?php  __('Inlog Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogDetail['InlogDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inlog'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inlogDetail['Inlog']['id'], array('controller' => 'inlogs', 'action' => 'view', $inlogDetail['Inlog']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inlogDetail['Item']['name'], array('controller' => 'items', 'action' => 'view', $inlogDetail['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogDetail['InlogDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogDetail['InlogDetail']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogDetail['InlogDetail']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posting'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogDetail['InlogDetail']['posting']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inlog Detail', true), array('action' => 'edit', $inlogDetail['InlogDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Inlog Detail', true), array('action' => 'delete', $inlogDetail['InlogDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inlogDetail['InlogDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inlog Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('controller' => 'inlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
