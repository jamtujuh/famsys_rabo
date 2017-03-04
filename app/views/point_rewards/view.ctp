<div class="poDetails view">
<h2><?php  __('Po Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($poDetail['Po']['id'], array('controller' => 'pos', 'action' => 'view', $poDetail['Po']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($poDetail['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $poDetail['AssetCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Color'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['color']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Brand'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['brand']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price Cur'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['price_cur']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($poDetail['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $poDetail['Currency']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rp Rate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poDetail['PoDetail']['rp_rate']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Po Detail', true), array('action' => 'edit', $poDetail['PoDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Po Detail', true), array('action' => 'delete', $poDetail['PoDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poDetail['PoDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Po Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
