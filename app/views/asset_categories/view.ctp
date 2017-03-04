<div class="assetCategories view">
<h2><?php  __('Asset Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset Category Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategoryType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategory']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategory']['name']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Depr Year Com'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategory']['depr_year_com']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Depr Rate Com'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategory']['depr_rate_com']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Depr Year Fis'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategory']['depr_year_fis']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Depr Rate Fis'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategory['AssetCategory']['depr_rate_fis']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assetCategory['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $assetCategory['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account Depr Accumulated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assetCategory['AccountDeprAccumulated']['name'], array('controller' => 'accounts', 'action' => 'view', $assetCategory['AccountDeprAccumulated']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account Depr Cost'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($assetCategory['AccountDeprCost']['name'], array('controller' => 'accounts', 'action' => 'view', $assetCategory['AccountDeprCost']['id'])); ?>
			&nbsp;
		</dd>		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Asset Category', true), array('action' => 'edit', $assetCategory['AssetCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Asset Category', true), array('action' => 'delete', $assetCategory['AssetCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assetCategory['AssetCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
	</ul>
</div>
