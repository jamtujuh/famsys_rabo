<div class="assetCategoryTypes view">
<h2><?php  __('Asset Category Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $assetCategoryType['AssetCategoryType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Asset Category Type', true), array('action' => 'edit', $assetCategoryType['AssetCategoryType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Asset Category Type', true), array('action' => 'delete', $assetCategoryType['AssetCategoryType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assetCategoryType['AssetCategoryType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Category Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category Type', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
