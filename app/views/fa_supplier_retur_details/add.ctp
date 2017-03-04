<div class="faSupplierReturDetails form">
<fieldset>
	<legend><?php __('Search Asset Detail'); ?></legend>
<?php
	echo $this->Form->create('FaSupplierReturDetail', array('action'=>'add'));
	echo $this->Form->input('search_keyword', array('style'=>'width:40%'));
	echo $this->Form->end('Search');
?>
</fieldset>

<?php echo $this->Form->create('FaSupplierReturDetail');?>
	<fieldset>
 		<legend><?php __('Add Fa Supplier Retur Detail'); ?></legend>
	<?php
		echo $this->Form->input('fa_supplier_retur_id', array('type'=>'hidden','value'=>$this->Session->read('FaSupplierRetur.id')));
		echo $this->Form->input('FaSupplierRetur.no', array('value'=>$fa_supplier_retur_no, 'readonly'=>true));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('select_detail_Asset'); ?></th>
			<th><?php echo $this->Paginator->sort('branch'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_code'); ?></th>
			<th><?php echo $this->Paginator->sort('item_code'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_name_detail'); ?></th>
			<th><?php echo $this->Paginator->sort('brand'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('serial_no'); ?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase'); ?></th>
		</tr>
		<?php
		$i = 0;
		$chk = null;
		foreach($asset_details as $asset):
		
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		?>
			<tr<?php echo $class;?>>
				<td>
				<?php
				foreach($assetDetailSelecteds as $ad)
				{
					if($asset['AssetDetail']['id'] == $ad['asset_detail_id'])
					{
						$chk=true;
						break;
					}
					else
						$chk=false;
						
				}
				?>
				
				<?php echo $this->Form->checkbox('asset_detail_id', 
					array(
						'label'=>'',
						'checked'=>$chk,
						'hiddenField'=>false,
						'type'=>'checkbox', 
						'value'=>$asset['AssetDetail']['id'],
						'name'=>'data[FaSupplierReturDetail][asset_detail_id]['.$i.']'
						) )
				?>
				</td>
				<td class="left"><?php echo $asset['Department']['name']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['code']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['item_code']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['name']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['brand']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['type']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['color']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['serial_no']?></td>
				<td><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase'])?></td>
			</tr>
		<?php endforeach;?>
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
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fa Supplier Returs', true), array('controller' => 'fa_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
	</ul>
</div>