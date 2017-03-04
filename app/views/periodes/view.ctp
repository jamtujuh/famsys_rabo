<?php $places = $myApp->getPlaces($asset['Currency']['is_desimal']);?>
<div class="assets view">
<h2><?php  __('Asset');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No Inventaris'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Purchase'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($asset['Purchase']['no'], array('controller' => 'purchases', 'action' => 'view', $asset['Purchase']['id'])); ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['AssetCategory']['name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Golongan'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['golongan']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['CostCenter']['cost_centers']; ?> - <?php echo $asset['CostCenter']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Brand'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['brand']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Color'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['color']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($asset['Asset']['price']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Currency']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price in Currrency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($asset['Asset']['price_cur'], $places); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($asset['Asset']['amount']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Of Purchase'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['date_of_purchase']?$this->Time->format(DATE_FORMAT, $asset['Asset']['date_of_purchase']):''; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Start'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['date_start']?$this->Time->format(DATE_FORMAT, $asset['Asset']['date_start']):''; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date End'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['date_end']?$this->Time->format(DATE_FORMAT, $asset['Asset']['date_end']):''; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Economic Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['umurek']; ?>
			&nbsp;
		</dd>


		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Warranty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['warranty_name']; ?>	
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Warranty Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $asset['Asset']['warranty_year']; ?>	Year
			&nbsp;
		</dd>
	</dl>
	
	<div class="doc_actions">
		<ul>
			<li><?php echo $this->Html->link(__('Asset List', true), array('action' => 'index')); ?> </li>
		</ul>
	</div>
	
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Asset Details');?></h3>
	<?php if (!empty($asset['AssetDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('No Inventaris'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Brand'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color'); ?></th>
		<th><?php __('Serial No'); ?></th>
		<th><?php __('Date of Purchase'); ?></th>
		<th><?php __('Date Start'); ?></th>
		<th><?php __('Date End'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Economic Age'); ?></th>		
		<th><?php __('Monthly Depr'); ?></th>
		<th><?php __('Actions'); ?></th>


	</tr>
	<?php
		$i = 0;
		foreach ($asset['AssetDetail'] as $assetDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			if($assetDetail['price'] >= 5000000){
				$assetDetail['depbln'] = $assetDetail['depbln'];
			}elseif($assetDetail['price'] < 5000000){
				$assetDetail['depbln'] = 0;
			}
		?>
		<tr<?php echo $class;?>>
			<td class="left"><?php echo $i;?></td>
			<td class="left"><?php echo $assetCategories[$assetDetail['asset_category_id']];?></td>
			<td class="left"><?php echo $assetDetail['code'];?></td>
			<td class="left"><?php echo $assetDetail['item_code'];?><br>
			<td class="left"><?php echo $assetDetail['name'];?><br>
			<td class="left"><?php echo $assetDetail['brand'];?><br>
			<td class="left"><?php echo $assetDetail['type'];?><br>
			<td class="left"><?php echo $assetDetail['color'];?><br>
			<td class="left"><?php echo $assetDetail['serial_no'];?></td>
			<td class="center"><?php echo $this->Time->format(DATE_FORMAT, $assetDetail['date_of_purchase']); ?></td>
			<td class="center"><?php if(!empty($assetDetail['date_start'])) : 
								echo $this->Time->format(DATE_FORMAT, $assetDetail['date_start']); 
								endif; ?></td>
			<td class="center"><?php if(!empty($assetDetail['date_start'])) : 
								echo $this->Time->format(DATE_FORMAT, $assetDetail['date_end']); 
								endif; ?></td>
			<td class="number"><?php echo $this->Number->format( $assetDetail['price'] );?></td>
			<td class="center"><?php echo $assetDetail['maksi'] ;?></td>
			<td class="number"><?php echo $this->Number->format( $assetDetail['depbln'] );?></td>
			
			<td class="actions">
				<?php echo $this->Html->link(__('Edit SN', true), array('controller'=>'asset_details', 'action' => 'edit_sn', $assetDetail['id'])); ?>
				<?php echo $this->Html->link(__('History', true), array('controller'=>'asset_details', 'action' => 'history', $assetDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
