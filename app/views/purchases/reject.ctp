<div class="purchases view">
<h2><?php  __('Purchase');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchase['Purchase']['no']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Of Purchase'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $purchase['Purchase']['date_of_purchase']); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchase['Purchase']['invoice_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($purchase['Purchase']['po_no'], array('controller'=>'pos', 'action'=>'view', $purchase['Purchase']['po_id']) ); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($purchase['Supplier']['name'], '#', array('onclick' => "Element.toggle('supplier_info');")); ?><br>
			<div id="supplier_info" style="display:none"><?php echo $purchase['Supplier']['supplier_info'] ?></div>
		</dd>
				
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Total (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($purchase['Purchase']['total']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Warranty Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchase['Purchase']['warranty_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Warranty Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($purchase['Purchase']['warranty_year']); ?> Year
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Register Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $status[$purchase['Purchase']['purchase_status_id']]; ?> 
			&nbsp;
		</dd>

	</dl>
	
	<div>
	<?php echo $this->Form->create('Purchase');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('reject_notes', array('style'=>'width:98%'));
			echo $this->Form->input('reject_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('reject_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
	</ul>
</div>
	<div class="doc_actions">
		<ul>
			<li><?php echo $this->Html->link(__('Back to PO', true), array('controller'=>'pos','action' => 'view', $purchase['Purchase']['po_id'])); ?> </li>			
		</ul>
	</div>	


<div class="related">
	<h3><?php __('Assets Details');?></h3>
	<?php echo $this->Form->create('Asset')?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('No Inventaris'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Brand'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Cur'); ?></th>
		<th class="number"><?php __('Price'); ?></th>
		<th class="number"><?php __('Amount'); ?></th>
		<th><?php __('Economic Age<br>(Month)'); ?></th>
		<th><?php __('Monthly<br>Depreciation'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<?php if (!empty($purchase['Asset'])):?>	
	<?php
		$i = 0;
		foreach ($purchase['Asset'] as $asset):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td class="left"><?php echo $i;?></td>
			<td class="left">
				<?php echo $departments[$asset['department_id']];?>
				<?php if (!empty($asset['department_sub_id'])) {?>
					/<?php echo $departmentsub[$asset['department_sub_id']];?>
				<?php }?>
				<?php if (!empty($asset['department_unit_id'])) {?>
					/<?php echo $departmentunit[$asset['department_unit_id']];?>
				<?php }?>&nbsp;
			</td>
			<td class="left"><?php echo $assetCategories[$asset['asset_category_id']];?>&nbsp;</td>
			<td class="left"><?php echo $asset['code'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['item_code'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['name'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['brand'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['type'];?></td>
			<td class="left"><?php echo $asset['color'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['qty'];?>&nbsp;</td>
			<td class="left"><?php echo $currencies[$asset['currency_id']];?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($asset['price']);?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($asset['amount']);?>&nbsp;</td>
			<td class="center"><?php echo $asset['umurek'] * 12 ;?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($asset['depbln']);?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'assets', 'action' => 'view', $asset['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if($can_add_detail) : ?>
	<tr id="newRecord">
		<td  colspan="2" class="newField">
			<?php echo $this->Form->input('department_id', array('style'=>'width:100px'));?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('asset_category_id', 
				array('empty'=>'select category','style'=>'width:150px'));?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('umurek', array('style'=>'width:30px', 'readonly'=>true)); ?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('item_code', array('style'=>'width:50px')); ?>
		</td>
		<td class="newField"><?php echo $this->Form->input('name');?></td>
		<td class="newField"><?php echo $this->Form->input('brand', array('style'=>'width:50px'));?></td>
		<td class="newField"><?php echo $this->Form->input('type',  array('style'=>'width:40px'));?></td>
		<td class="newField"><?php echo $this->Form->input('color', array('style'=>'width:40px'));?></td>
		<td class="newField">
			<?php echo $this->Form->input('qty', array('style'=>'width:30px','value'=>1));?>
		</td>

		<td class="newField">
			<?php echo $this->Form->input('currency_id', array('style'=>'width:40px'));?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('price_cur', array('style'=>'width:50px'));?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('amount_cur', array('style'=>'width:50px'));?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('price', array('type'=>'hidden'));?>
		</td>
		<td class="newField">
			<?php echo $this->Form->input('amount', array('type'=>'hidden'));?>		
		</td>

		<td class="actions">
			<?php echo $this->Form->input('purchase_id', array('value'=>$this->Session->read('Purchase.id'),'type'=>'hidden')); ?>
			<?php echo $this->Form->input('date', array('value'=>$purchase['Purchase']['date_of_purchase'], 'type'=>'hidden')); ?>
			<?php echo $this->Form->input('rp_rate', array('type'=>'hidden', 'value'=>1)); ?>
			<?php echo $ajax->submit('Add', 
			array(
			'url'=> array('controller'=>'assets', 'action'=>'ajax_add'), 
			'indicator'	=> 'LoadingDiv',
			'complete' => 'appendAsset(request)')); ?>		

		</td>
	</tr>
	<?php endif;?>
	</table>
	<?php echo $this->Form->end() ?>
</div>


<?php
// echo $javascript->link('prototype',false);
// echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
echo $javascript->link('my_detail_add',false);

echo $javascript->event('AssetPriceCur','change','calcRp(\'Asset\');calcAmount(\'Asset\')');
echo $javascript->event('AssetQty','change','calcRp(\'Asset\');calcAmount(\'Asset\')');
echo $javascript->event('AssetRpRate','change','calcRp(\'Asset\')');

echo $ajax->observeField( 'AssetCurrencyId', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_currency'),
		'complete'	=> 'getRate(request,\'Asset\')',
		'indicator' 	=> 'LoadingDiv', 
	)
); 

echo $ajax->observeField( 'AssetAssetCategoryId', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_depr_year'),
		'complete'	=> 'updateField("AssetUmurek","depr_year_com",request)',
		'indicator' 	=> 'LoadingDiv', 
	)
); 
?>
