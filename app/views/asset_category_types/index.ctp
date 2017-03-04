<div id="moduleName"><?php echo $moduleName?></div>
<div class="assetCategoryTypes index">
	<h2><?php __('Asset Category Types');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assetCategoryTypes as $assetCategoryType):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $assetCategoryType['AssetCategoryType']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $assetCategoryType['AssetCategoryType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $assetCategoryType['AssetCategoryType']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $assetCategoryType['AssetCategoryType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assetCategoryType['AssetCategoryType']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Asset Category Type', true), array('action' => 'add')); ?></li>
	</ul>
</div>