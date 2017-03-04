<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	//echo $javascript->link('my_script',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
<?php echo $this->Form->create('Item') ?>
	<div class="fieldfilter">
	<fieldset>
		<fieldset class="subfilter">
 		<legend><?php __('Filter Item'); ?></legend>	
		<?php echo $this->Form->input('asset_category_type_id', array('options'=>$assetCategoryTypes, 'value'=>$this->Session->read('Item.asset_category_type_id')));?>
		<?php echo $this->Form->input('asset_category_id', array('empty'=>'All','options'=>$assetCategories,  'value'=>$this->Session->read('Item.asset_category_id')));?>	
	<?php
		$options = array('url' => array('controller'=>'asset_categories','action'=>'get_asset_categories', 'Item'), 
			'update' => 'ItemAssetCategoryId',
			'indicator' 	=> 'LoadingDiv',
		);
		echo $ajax->observeField('ItemAssetCategoryTypeId', $options);
	?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	</fieldset>
	<?php echo $this->Form->end() ?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Item', true), array('action' => 'add')); ?></li>
	</ul>
</div>
</div>

<div class="related">
<?php if ($this->Session->read('Item.asset_category_type_id')) : ?>
	<?php if (!empty($items)) : ?>
	<h2><?php __('Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_type_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('request_type_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('unit');?></th>
			<!--th><//?php echo $this->Paginator->sort('location');?></th-->
			<th><?php echo $this->Paginator->sort('currency_id');?></th>
			<th><?php echo $this->Paginator->sort('avg_price');?></th>
			<th><?php echo $this->Paginator->sort('qty_reorder');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td style="width:50px"><?php echo $assetCategoryTypes[$this->Session->read('Item.asset_category_type_id')]; ?>&nbsp;</td>
		<td class="left"><?php echo $item['AssetCategory']['name']; ?></td>
		<td class="left"><?php echo $item['Item']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $item['RequestType']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $item['Item']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $units[$item['Item']['unit_id']]; ?>&nbsp;</td>
		<!--td class="left"><//?php echo $item['Location']['name']; ?>&nbsp;</td-->
		<td class="left">
			<?php echo $this->Html->link($item['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $item['Currency']['id'])); ?>
		</td>
		<td class="number"><?php echo $this->Number->format($item['Item']['avg_price'], 2); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($item['Item']['qty_reorder']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?>
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
	<?php endif;//not empty?>
<?php endif;//not empty?>
</div>