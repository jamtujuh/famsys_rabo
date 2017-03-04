<div class="fa_imports view">
<h2><?php  __('FaImport');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fa_import['Department']['name'], array('controller' => 'departments', 'action' => 'view', $fa_import['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('FaImport Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['ImportStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['created_by']; ?>
			&nbsp;
		</dd>
	</dl>
	<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'fa_imports','action'=>'view', $this->Session->read('FaImport.id'))); ?> </li>
	</ul>
	</div>
</div>

<div class="related">
	<h2><?php __('Import Asset Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('location_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('depbln');?></th>
			<th><?php echo $this->Paginator->sort('book_value');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('date_start');?></th>
			<th><?php echo $this->Paginator->sort('date_end');?></th>
			<th><?php echo $this->Paginator->sort('serial_no');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('umurek');?></th>
			<th><?php echo $this->Paginator->sort('CAB');?></th>
			<th><?php echo $this->Paginator->sort('LT');?></th>
			<th><?php echo $this->Paginator->sort('UNIT_KERJA');?></th>
			<th><?php echo $this->Paginator->sort('LOKASI');?></th>
			<th><?php echo $this->Paginator->sort('GOL');?></th>
			<th><?php echo $this->Paginator->sort('notes');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
	</tr>
	<?php
	$i = 0;
	$total_price=0;
	foreach ($importAssetDetails as $importAssetDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$total_price += $importAssetDetail['ImportAssetDetail']['price'];
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $importAssetDetail['ImportAssetDetail']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $importAssetDetail['Department']['name']; ?></td>
		<td class="left"><?php echo $importAssetDetail['Location']['name']; ?></td>
		<td class="left"><?php echo $importAssetDetail['ImportAssetDetail']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $importAssetDetail['ImportAssetDetail']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $importAssetDetail['ImportAssetDetail']['color']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['brand']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['type']; ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format($importAssetDetail['ImportAssetDetail']['price']); ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format($importAssetDetail['ImportAssetDetail']['depbln']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($importAssetDetail['ImportAssetDetail']['book_value']); ?>&nbsp;</td>
		<td class="center"><?php echo $importAssetDetail['ImportAssetDetail']['date_of_purchase']; ?>&nbsp;</td>
		<td class="center"><?php echo $importAssetDetail['ImportAssetDetail']['date_start']; ?>&nbsp;</td>
		<td class="center"><?php echo $importAssetDetail['ImportAssetDetail']['date_end']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['serial_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $importAssetDetail['AssetCategory']['name']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['umurek']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['CAB']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['LT']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['UNIT_KERJA']; ?>&nbsp;</td>
		<td class="left"><?php echo $importAssetDetail['ImportAssetDetail']['LOKASI']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['GOL']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['notes']; ?>&nbsp;</td>
		<td><?php echo $importAssetDetail['ImportAssetDetail']['status']; ?>&nbsp;</td>
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
