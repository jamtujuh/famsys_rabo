<div class="faSupplierReturDetails view">
<h2><?php  __('Fa Supplier Retur Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fa Supplier Retur'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($faSupplierReturDetail['FaSupplierRetur']['no'], array('controller' => 'fa_returs', 'action' => 'view', $faSupplierReturDetail['FaSupplierRetur']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset Detail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($faSupplierReturDetail['AssetDetail']['name'], array('controller' => 'asset_details', 'action' => 'view', $faSupplierReturDetail['AssetDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($faSupplierReturDetail['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $faSupplierReturDetail['AssetCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Brand'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['brand']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Color'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['color']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Serial No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['serial_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Of Purchase'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['date_of_purchase']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturDetail['FaSupplierReturDetail']['notes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fa Supplier Retur Detail', true), array('action' => 'edit', $faSupplierReturDetail['FaSupplierReturDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fa Supplier Retur Detail', true), array('action' => 'delete', $faSupplierReturDetail['FaSupplierReturDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faSupplierReturDetail['FaSupplierReturDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fa Supplier Retur Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Supplier Retur Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fa Returs', true), array('controller' => 'fa_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Supplier Retur', true), array('controller' => 'fa_returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Detail', true), array('controller' => 'asset_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
