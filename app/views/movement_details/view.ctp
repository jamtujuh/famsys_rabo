<div class="movementDetails view">
<h2><?php  __('Movement Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movementDetail['MovementDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Movement'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($movementDetail['Movement']['no'], array('controller' => 'movements', 'action' => 'view', $movementDetail['Movement']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($movementDetail['AssetDetail']['name'], array('controller' => 'assets', 'action' => 'view', $movementDetail['AssetDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movementDetail['MovementDetail']['notes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Movement Detail', true), array('action' => 'edit', $movementDetail['MovementDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Movement Detail', true), array('action' => 'delete', $movementDetail['MovementDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $movementDetail['MovementDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Movement Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movement Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Movements', true), array('controller' => 'movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movement', true), array('controller' => 'movements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
