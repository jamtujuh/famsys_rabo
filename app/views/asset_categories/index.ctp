<?php
	$asset_category_type_id=$this->Session->read('AssetCategory.asset_category_type_id');
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('AssetCategory', array('action'=>'index')) ?>
	<fieldset class="subfilter">
	<legend><?php __('Categories Filters')?></legend>
	<?php echo $this->Form->input('asset_category_type_id',array('value'=>$asset_category_type_id)) ?>
	<?php echo $this->Form->end('Refresh') ?>
	</fieldset>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
</div>
<div class="related">
	<h2><?php __('Asset Categories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_type_id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('id_parent');?></th>
			<th><?php echo $this->Paginator->sort('depr_year_com');?></th>
			<th><?php echo $this->Paginator->sort('depr_rate_com');?></th>
			<th><?php echo $this->Paginator->sort('depr_year_fis');?></th>
			<th><?php echo $this->Paginator->sort('depr_rate_fis');?></th>
			<th><?php echo $this->Paginator->sort('account_id');?></th>
			<th><?php echo $this->Paginator->sort('account_depr_accumulated_id');?></th>
			<th><?php echo $this->Paginator->sort('account_depr_cost_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assetCategories as $assetCategory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
			
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategoryType']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['id_parent']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['depr_year_com']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['depr_rate_com']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['depr_year_fis']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategory['AssetCategory']['depr_rate_fis']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($assetCategory['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $assetCategory['Account']['id'])); ?>
		</td>
		<td class="left">
			<?php echo $this->Html->link($assetCategory['AccountDeprAccumulated']['name'], array('controller' => 'accounts', 'action' => 'view', $assetCategory['AccountDeprAccumulated']['id'])); ?>
		</td>		
		<td class="left">
			<?php echo $this->Html->link($assetCategory['AccountDeprCost']['name'], array('controller' => 'accounts', 'action' => 'view', $assetCategory['AccountDeprCost']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $assetCategory['AssetCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $assetCategory['AssetCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $assetCategory['AssetCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $assetCategory['AssetCategory']['id'])); ?>
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
