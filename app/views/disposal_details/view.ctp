<div class="disposalDetails view">
<h2><?php  __('Disposal Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalDetail['DisposalDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Disposal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($disposalDetail['Disposal']['id'], array('controller' => 'disposals', 'action' => 'view', $disposalDetail['DisposalDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($disposalDetail['AssetDetail']['name'], array('controller' => 'asset_details', 'action' => 'view', $disposalDetail['AssetDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sales Mount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalDetail['DisposalDetail']['sales_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Loss Profit Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalDetail['DisposalDetail']['loss_profit_amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalDetail['DisposalDetail']['notes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Disposal Detail', true), array('action' => 'edit', $disposalDetail['DisposalDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Disposal Detail', true), array('action' => 'delete', $disposalDetail['DisposalDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $disposalDetail['DisposalDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Disposal Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Disposals', true), array('controller' => 'disposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal', true), array('controller' => 'disposals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
