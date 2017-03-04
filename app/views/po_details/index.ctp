<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
            <?php echo $this->Form->create('PoDetail') ?>
			<legend><?php __('List PO Detail Filters') ?></legend>
			<fieldset class='subfilter'>
			<legend><?php __('PO Info')?></legend>
			<?php echo $form->input('asset_category_type_id', array('options' => $assetCategoryTypes, 'empty' => 'all', 'value' => $this->Session->read('PoDetail.asset_category_type_id'))); ?>
            <?php echo $form->input('asset_category_id', array('empty' => 'all', 'options' => $assetCategories, 'value' => $this->Session->read('PoDetail.asset_category_id'))); ?>
            <?php echo $this->Form->input('department_id', array('empty' => 'all', 'value' => $this->Session->read('PoDetail.department_id'))) ?> 
            <?php echo $this->Form->input('currency_id', array('empty' => 'all', 'options' => $currencies)) ?> 
            <?php echo $this->Form->input('report_type', array('options' => array('All'=>'All', 'Finish'=>'Finish', 'Outstanding'=>'Outstanding'), 'value' => $this->Session->read('PoDetail.report_type'))) ?> 
			</fieldset>
		
			<fieldset class='subfilter' style='width:40%'>
			<legend><?php __('PO Date')?></legend>
			<?php echo $this->Form->input('supplier_id', array('empty' => 'all','options' => $suppliers)) ?> 
			<?php echo $this->Form->input('po_status_id', array('empty' => 'all','options' => $poStatuses)) ?> 
			<?php echo $this->Form->input('date_start', array('type' => 'date', 'value' => $date_start)) ?> 
            <?php echo $this->Form->input('date_end', array('type' => 'date', 'value' => $date_end)) ?>
			</fieldset>
			<?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
      <?php
      $options = array(
          'url' => array('controller' => 'asset_categories', 'action' => 'get_asset_categories', 'PoDetail'),
          'update' => 'PoDetailAssetCategoryId',
          'indicator' => 'LoadingDiv',
      );
      echo $ajax->observeField('PoDetailAssetCategoryTypeId', $options);
      ?>	
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h2><?php __('Po Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('npb_id');?></th>
			<th><?php echo $this->Paginator->sort('MR Date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('request_type_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('created_date');?></th>
			<th><?php echo $this->Paginator->sort('reject_by');?></th>
			<th><?php echo $this->Paginator->sort('reject_date');?></th>
			<th><?php echo $this->Paginator->sort('cancel_by');?></th>
			<th><?php echo $this->Paginator->sort('cancel_date');?></th>
			<th><?php echo $this->Paginator->sort('date_finish');?></th>
			<th><?php echo $this->Paginator->sort('approved_by');?></th>
			<th><?php echo $this->Paginator->sort('approved_date');?></th>
			<th><?php echo $this->Paginator->sort('PO No');?></th>
			<th><?php echo $this->Paginator->sort('PO Date');?></th>
			<th><?php echo $this->Paginator->sort('Delivery Date');?></th>
			<th><?php echo $this->Paginator->sort('Supplier');?></th>
			<th><?php echo $this->Paginator->sort('Po Status');?></th>
			<th><?php echo $this->Paginator->sort('daily_penalty');?></th>
			<th><?php echo $this->Paginator->sort('approval_info');?></th>
			<th><?php echo $this->Paginator->sort('currency_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('Code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('Qty Received');?></th>
			<th><?php echo $this->Paginator->sort('price_cur');?></th>
			<th><?php echo $this->Paginator->sort('amount_cur');?></th>
			<th><?php echo $this->Paginator->sort('discount_cur');?></th>
			<th><?php echo $this->Paginator->sort('amount_after_disc_cur');?></th>
			<th><?php echo $this->Paginator->sort('vat');?></th>
			<th><?php echo $this->Paginator->sort('vat_cur');?></th>
			<th><?php echo $this->Paginator->sort('Payment Term');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('billing_address');?></th>
			<th><?php echo $this->Paginator->sort('shipping_address');?></th>
			<th><?php echo $this->Paginator->sort('reject_by');?></th>
			<th><?php echo $this->Paginator->sort('reject_date');?></th>
			<th><?php echo $this->Paginator->sort('cancel_by');?></th>
			<th><?php echo $this->Paginator->sort('cancel_date');?></th>
			<th><?php echo $this->Paginator->sort('rp_rate');?></th>
			<th><?php echo $this->Paginator->sort('date_finish');?></th>
			<th><?php echo $this->Paginator->sort('signer_1');?></th>
			<th><?php echo $this->Paginator->sort('signer_2');?></th>
			<th><?php echo $this->Paginator->sort('po_address');?></th>
			<th><?php echo $this->Paginator->sort('down_payment');?></th>
			<th><?php echo $this->Paginator->sort('approved_by');?></th>
			<th><?php echo $this->Paginator->sort('is_vat');?></th>
			<th><?php echo $this->Paginator->sort('Invoice');?></th>
	</tr>
	<?php
	$i = 0;
	$amount_after_disc_cur = 0;
	$amount_cur = 0;
	$discount_cur = 0;
	foreach ($poDetails as $poDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$places = $myApp->getPlaces($poDetail['Currency']['is_desimal']);
	?>

	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $npbs[$poDetail['PoDetail']['npb_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$poDetail['Npb']['npb_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$poDetail['Npb']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $businessType[$poDetail['Npb']['business_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['CostCenter']['name'] .'-'. $poDetail['CostCenter']['cost_centers']; ?>&nbsp;</td>
		<td class="left"><?php echo $requestType[$poDetail['Npb']['request_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['created_by']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$poDetail['Npb']['created_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['reject_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['reject_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['reject_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['cancel_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['cancel_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['cancel_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['date_finish'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['date_finish']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['approved_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['approved_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['approved_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($poDetail['Po']['no'], array('controller' => 'pos', 'action' => 'view', $poDetail['Po']['id'])); ?>		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $poDetail['Po']['po_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $poDetail['Po']['delivery_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $suppliers[$poDetail['Po']['supplier_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poStatuses[$poDetail['Po']['po_status_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['daily_penalty']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['approval_info']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Currency']['name']; ?></td>
		<td class="left"><?php echo $poDetail['AssetCategory']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['type']; ?>&nbsp;</td>
		<td class="center"><?php echo $poDetail['PoDetail']['qty']; ?>&nbsp;</td>
		<td class="center"><?php echo $poDetail['PoDetail']['qty_received']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['price_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['amount_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['discount_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['amount_after_disc_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['vat'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['vat_cur'], $places); ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['payment_term']. ' Term'; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['description']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['billing_address']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['shipping_address']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['reject_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Po']['reject_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Po']['reject_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['cancel_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Po']['cancel_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Po']['cancel_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Number->format($poDetail['Po']['rp_rate']); ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Po']['date_finish'])?$this->Time->format(DATE_FORMAT,$poDetail['Po']['date_finish']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['signer_1']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['signer_2']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['po_address']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Number->format($poDetail['Po']['down_payment']); ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['approved_by']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['is_vat']==1?'Yes':'No'; ?>&nbsp;</td>
		<td class="left">
			<?php if(!empty($poDetail['Po']['Invoice'])): ?>
				<?php foreach($poDetail['Po']['Invoice'] as $invoice):?>
					<?php echo $invoice['no'] ; ?>&nbsp;
				<?php endforeach; ?>
			<?php endif; ?>		
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
