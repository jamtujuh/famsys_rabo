<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div class="assets index">
<?php echo $this->Form->create('Asset') ?>
<fieldset>
	<legend><?php __('Asset Filters') ?></legend>
	<?php if ($this->Session->read('Security.permissions') == normal_user_group_id || $this->Session->read('Security.permissions') == branch_head_group_id) : ?>
		  <?php echo $this->Form->input('department_id', array('options' => $departments, 'type' => 'hidden', 'value' => $Userinfo['department_id'])) ?>
		  <?php echo $this->Form->input('department_name', array('style' => 'width:50%', 'type' => 'text', 'readonly' => true, 'value' => $Userinfo['department_name'])) ?>
	<?php else : ?>
		  <? echo $form->input('department_id', array('options' => $departments, 'value' => $this->Session->read('AssetReport.department_id'), 'empty' => 'all')); ?>
	<?php endif; ?>
		  <?php echo $this->Form->input('business_type_id', array('options' => $businessType, 'empty' => 'all', 'value' => $this->Session->read('AssetReport.business_type_id'))) ?>
		  <?php echo $this->Form->input('cost_center_id', array('empty' => 'select cost center', 'type' => 'hidden')); ?>
		  <?php echo $this->Form->input('CostCenter.name', array('label' => 'Cost Center', 'style' => 'width:40%')); ?>
		  <div id="cost_center_choices" class="auto_complete"></div> 
		  <script type="text/javascript"> 
				//<![CDATA[
				new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetCostCenterValues});
				//]]>
		  </script>
	<? //echo $form->input('department_sub_id', array('options'=>$departmentSub, 'value'=>$this->Session->read('Asset.department_sub_id'), 'empty'=>'')); ?>
	<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('Asset.department_unit_id'), 'empty'=>'')); ?>
		<?	/* $options = array('url' => '/departments/getDepartmentSubId/Asset', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDepartmentSubId');
			echo $ajax->observeField('AssetDepartmentId', $options);
			
			$options = array('url' => '/department_subs/getDepartmentUnitId/Asset', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDepartmentUnitId');
			echo $ajax->observeField('AssetDepartmentSubId', $options); */
		?>

	<?php echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'all','value'=>$this->Session->read('Asset.asset_category_id'))) ?>
	<?php echo $this->Form->input('search_keyword', array('style'=>'width:40%', 'value'=>$this->Session->read('Asset.name'))); ?>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Asset', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Purchase', true), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Asset Detail', true), array('controller' => 'asset_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h2><?php __('Assets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('Branch');?></th>
			<th><?php echo $this->Paginator->sort('Business Type');?></th>
			<th><?php echo $this->Paginator->sort('Cost Center');?></th>
			<th><?php echo $this->Paginator->sort('No Inventaris');?></th>
			<th><?php echo $this->Paginator->sort('Code');?></th>
			<th><?php echo $this->Paginator->sort('Name');?></th>
			<th><?php echo $this->Paginator->sort('Brand');?></th>
			<th><?php echo $this->Paginator->sort('Type');?></th>
			<th><?php echo $this->Paginator->sort('Color');?></th>
			<th><?php echo $this->Paginator->sort('Location');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('Unit Cost','price');?></th>
			<th><?php echo $this->Paginator->sort('Total Acquisition Cost','amount');?></th>
			<th><?php echo $this->Paginator->sort('Economic Age','umurek');?></th>
			<th><?php echo $this->Paginator->sort('Monthly Depreciation','depbln');?></th>
			
			<th><?php echo $this->Paginator->sort('Book Value 31/12/' . ($this->Session->read('AssetReport.year')-1));?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr 31/12/'. ($this->Session->read('AssetReport.year')-1));?></th>
			
			<th><?php echo $this->Paginator->sort('Book Value 31/12/'. $this->Session->read('AssetReport.year'));?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr 31/12/'. $this->Session->read('AssetReport.year'));?></th>
			<th><?php echo $this->Paginator->sort('purchase_id');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>

			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$qty = 0;
	$price = 0;
	$amount = 0;
	$maksi = 0;
	$depbln = 0;
	$hpthnlalu = 0;
	$depthnlalu = 0;
	$book_value = 0;
	$depthnini = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$asset['Asset']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['business_type_id']?$businessType[$asset['Asset']['business_type_id']]:''; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['cost_center_id']?($costCenter[$asset['Asset']['cost_center_id']] . '-' . $costCenters[$asset['Asset']['cost_center_id']]):''; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['type']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($asset['Location']['name'], array('controller'=>'location', 'action'=>'view', $asset['Asset']['location_id'])); ?>&nbsp;</td>
		<td class="center"><?php echo $asset['Asset']['qty']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['price'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['amount'] ); ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format( $asset['Asset']['maksi'] ) ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depbln'] ); ?>&nbsp;</td>
		
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['hpthnlalu'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depthnlalu'] ); ?>&nbsp;</td>

		<td class="number"><?php echo $this->Number->format( $asset['Asset']['book_value'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depthnini'] ); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($asset['Purchase']['no'], array('controller'=>'purchases', 'action'=>'view', $asset['Asset']['purchase_id']) ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_of_purchase']) ; ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $asset['Asset']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $asset['Asset']['id'])); ?>
			<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $asset['Asset']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $asset['Asset']['id'])); ?>
		</td>
	</tr>
	<?php $qty += $asset['Asset']['qty'] ;?>
	<?php $price += $asset['Asset']['price'] ;?>
	<?php $amount += $asset['Asset']['amount'] ;?>
	<?php $maksi += $asset['Asset']['maksi'] ;?>
	<?php $depbln += $asset['Asset']['depbln'] ;?>
	<?php $hpthnlalu += $asset['Asset']['hpthnlalu'] ;?>
	<?php $depthnlalu += $asset['Asset']['depthnlalu'] ;?>
	<?php $book_value += $asset['Asset']['book_value'] ;?>
	<?php $depthnini += $asset['Asset']['depthnini'] ;?>
<?php endforeach; ?>
	<tr>
		<td colspan="11"><div align="right">Total</div></td>
		<td class="center"><?php echo $this->Number->format($qty) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($price) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($amount) ;?>&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($hpthnlalu) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($depthnlalu) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($book_value) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($depthnini) ;?>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11"><div align="right">Total General</div></td>
		<td class="center"><?php echo $this->Number->format($assetTotals['qty']) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetTotals['price']) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetTotals['amount']) ;?>&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetTotals['hpthnlalu']) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetTotals['depthnlalu']) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetTotals['book_value']) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetTotals['depthnini']) ;?>&nbsp;</td>
	</tr>
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
