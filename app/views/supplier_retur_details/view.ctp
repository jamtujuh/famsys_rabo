<div class="returDetails view">
<h2><?php  __('Retur Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returDetail['ReturDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Retur'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($returDetail['Retur']['id'], array('controller' => 'returs', 'action' => 'view', $returDetail['Retur']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($returDetail['Item']['name'], array('controller' => 'items', 'action' => 'view', $returDetail['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returDetail['ReturDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returDetail['ReturDetail']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returDetail['ReturDetail']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posting'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returDetail['ReturDetail']['posting']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Retur Detail', true), array('action' => 'edit', $returDetail['ReturDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Retur Detail', true), array('action' => 'delete', $returDetail['ReturDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $returDetail['ReturDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Retur Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Returs', true), array('controller' => 'returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
