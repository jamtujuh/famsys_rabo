<div class="outlogDetails view">
<h2><?php  __('Outlog Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogDetail['OutlogDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Outlog'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($outlogDetail['Outlog']['id'], array('controller' => 'outlogs', 'action' => 'view', $outlogDetail['Outlog']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($outlogDetail['Item']['name'], array('controller' => 'items', 'action' => 'view', $outlogDetail['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogDetail['OutlogDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogDetail['OutlogDetail']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogDetail['OutlogDetail']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posting'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogDetail['OutlogDetail']['posting']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Outlog Detail', true), array('action' => 'edit', $outlogDetail['OutlogDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Outlog Detail', true), array('action' => 'delete', $outlogDetail['OutlogDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $outlogDetail['OutlogDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlog Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
