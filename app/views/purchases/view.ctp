<?php
$can_edit						=$this->Session->read('Purchase.can_edit');
$can_send_to_supervisor			=$this->Session->read('Purchase.can_send_to_supervisor');
$can_approve					=$this->Session->read('Purchase.can_approve');
$can_cancel						=$this->Session->read('Purchase.can_cancel');
$can_reject						=$this->Session->read('Purchase.can_reject');
$can_archive					=$this->Session->read('Purchase.can_archive');
$group 							=$this->Session->read('Security.permissions');
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);

?>
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
		<?php if (!empty($purchase['Purchase']['invoice_no'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchase['Purchase']['invoice_no']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if (!empty($purchase['Purchase']['po_id'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($purchase['Purchase']['po_no'], array('controller'=>'pos', 'action'=>'view', $purchase['Purchase']['po_id']) ); ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if (!empty($purchase['Supplier']['name'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($purchase['Supplier']['name'], '#', array('onclick' => "Element.toggle('supplier_info');")); ?><br>
			<div id="supplier_info" style="display:none"><?php echo $purchase['Supplier']['supplier_info'] ?></div>
		</dd>
		<?php endif;?>
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
			<?php echo $this->Number->format($purchase['Purchase']['warranty_year']); ?> Year <?php echo $this->Number->format($purchase['Purchase']['warranty_month']); ?> Month 
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Register Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $status[$purchase['Purchase']['purchase_status_id']]; ?> 
			&nbsp;
		</dd>
		
		<?php if (!empty($purchase['Purchase']['reject_by'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Reject By'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $purchase['Purchase']['reject_by']; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Reject Notes'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <pre><?php echo $purchase['Purchase']['reject_notes']; ?></pre>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Reject Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $purchase['Purchase']['reject_date']; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>

            <?php if (!empty($purchase['Purchase']['cancel_by'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Cancel By'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $purchase['Purchase']['cancel_by']; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Cancel Notes'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <pre><?php echo $purchase['Purchase']['cancel_notes']; ?></pre>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Cancel Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $purchase['Purchase']['cancel_date']; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>

	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
			<?php if($can_add_detail && $purchase['Purchase']['purchase_status_id']==status_purchase_draft_id) : ?>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $purchase['Purchase']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $purchase['Purchase']['no'])); ?></li>
			<?php endif; ?>
	</ul>
</div>
	<div class="doc_actions">
		<ul>
			<?php if($can_send_to_supervisor) : ?>
			<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'purchases','action'=>'update_status/' . $this->Session->read('Purchase.id') . '/' . status_purchase_sent_to_supervisor_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_approve) : ?>
			<li><?php echo $this->Html->link(__('Approve', true), 
			array('controller'=>'purchases','action'=>'update_status/' .  $this->Session->read('Purchase.id'). '/' . status_purchase_approved_id),
			null, __('This process will register asset data. Are you sure?',true)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_add_detail && $purchase['Purchase']['purchase_status_id']==status_purchase_sent_to_supervisor_id && $group ==fa_supervisor_group_id) : ?>
			<li><?php echo $this->Html->link(__('Approve', true), 
			array('controller'=>'purchases','action'=>'update_status/' .  $this->Session->read('Purchase.id'). '/' . status_purchase_approved_id),
			null, __('This process will register asset data. Are you sure?',true)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_add_detail && $purchase['Purchase']['purchase_status_id']==status_purchase_sent_to_supervisor_id && $group ==it_supervisor_group_id) : ?>
			<li><?php echo $this->Html->link(__('Approve', true), 
			array('controller'=>'purchases','action'=>'update_status/' .  $this->Session->read('Purchase.id'). '/' . status_purchase_approved_id),
			null, __('This process will register asset data. Are you sure?',true)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_add_detail && $purchase['Purchase']['purchase_status_id']==status_purchase_draft_id) : ?>
			<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'purchases','action'=>'update_status/' . $this->Session->read('Purchase.id') . '/' . status_purchase_sent_to_supervisor_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_add_detail && $purchase['Purchase']['purchase_status_id']==status_purchase_sent_to_supervisor_id && $group ==fa_supervisor_group_id) : ?>
			<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'purchases','action'=>'cancel', $purchase['Purchase']['id'])); ?> </li>
			<?php endif; ?>
			
			<?php //if($can_reject) : ?>
			<li><?php //echo $this->Html->link(__('Reject', true), array('controller'=>'purchases','action'=>'reject', $purchase['Purchase']['id'])); ?> </li>
			<?php //endif; ?>
			
			<?php if($can_archive) : ?>
			<li><?php echo $this->Html->link(__('Archive', true), array('controller'=>'purchases','action'=>'archive/' .  $this->Session->read('Purchase.id'). '/' . status_purchase_archive_id)); ?> </li>
			<?php endif; ?>
			
			<li><?php //echo $this->Html->link(__('Back to List Register', true), array('action' => 'index')); ?> </li>			
			<li><?php echo $this->Html->link(__('Print To PDF', true), array('controller' => 'purchases', 'action' => 'print_pdf', $purchase['Purchase']['id'])); ?> </li>
		</ul>
	</div>	


<div class="related">
	<h3><?php __('Assets Details');?></h3>
	<?php echo $this->Form->create('Asset', array('action' => 'ajax_add2')); ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Business Type'); ?></th>
		<th><?php __('Cost Center'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('No Inventaris'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>		
		<!--th width="300" size="300"><?php __('Konfigurasi'); ?></th-->
		<th><?php __('Brand'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Cur'); ?></th>
		<th class="number"><?php __('Price (Rp)'); ?></th>
		<th class="number"><?php __('Amount (Rp)'); ?></th>
		<th><?php __('Economic Age<br>(Month)'); ?></th>
		<th><?php __('Monthly<br>Depreciation'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
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
				<?php echo $departments[$asset['department_id']];?>&nbsp;
			</td>
			<td class="left"><?php echo $businessTypes[$asset['business_type_id']];?></td>
			<td class="left"><?php echo $costCenter[$asset['cost_center_id']];?></td>
			<td class="left"><?php echo $assetCategories[$asset['asset_category_id']];?>&nbsp;</td>
			<td class="left"><?php echo $asset['code'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['item_code'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['name'];?>&nbsp;</td>
			<!--td class="left"><?php echo $asset['konfigurasi'];?>&nbsp;</td-->	
			<td class="left"><?php echo $asset['brand'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['type'];?></td>
			<td class="left"><?php echo $asset['color'];?>&nbsp;</td>
			<td class="left"><?php echo $asset['qty'];?>&nbsp;</td>
			<td class="left"><?php echo $currencies[$asset['currency_id']];?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($asset['price']);?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($asset['amount']);?>&nbsp;</td>
			
			<td class="center"><?php echo $asset['maksi'];?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($asset['depbln']);?>&nbsp;</td>
			<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $asset['date_of_purchase']);?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'assets', 'action' => 'view', $asset['id'])); ?>
				<?php if($can_add_detail  && $purchase['Purchase']['purchase_status_id']==status_purchase_draft_id) : ?>
					<?php echo $this->Html->link(__('Delete', true), array('controller' => 'assets', 'action' => 'delete', $asset['id'])); ?>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if($can_add_detail  && $purchase['Purchase']['purchase_status_id']==status_purchase_draft_id) : ?>
	<tr id="newRecord">
		<td  colspan="2">
			<?php echo $this->Form->input('department_id', array('style'=>'width:100px'));?>
		</td>
		<td>
			<?php echo $this->Form->input('business_type_id', array('style'=>'width:100px'));?>
		</td>
		<td>
			<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
			<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:160px')); ?>
			<div id="cost_center_choices" class="auto_complete"></div> 
			<script type="text/javascript"> 
				//<![CDATA[
				new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetCostCenterPurchaseValues});
				//]]>
			</script>
		</td>
		<td>
			<?php echo $this->Form->input('asset_category_id', 
				array('style'=>'width:150px'));?>
		</td>
		<td>
			<?php echo $this->Form->input('umurek', array('style'=>'width:30px', 'value'=>5)); ?>
		</td>
	    <td colspan="2">
			<?php if($this->Session->read('Security.permissions') == it_management_group_id){
					$reguest = request_type_fa_it_id;
				}else if($this->Session->read('Security.permissions') == fa_management_group_id){
					$reguest = request_type_fa_general_id;
				}
			?>
			<?php echo $this->Form->input('item_id', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('Item.name', array('label' => 'Select Code - Name')); ?>
			<div id="item_choices" class="auto_complete"></div> 
			<script type="text/javascript"> 
				  //<![CDATA[
				  new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo $reguest ?>', {afterUpdateElement : setAssetValues});
				  //]]>
			</script>
	    </td>
		<!--td>
			<?php echo $this->Form->input('konfigurasi');?>
		</td-->
		<td><?php echo $this->Form->input('brand', array('style'=>'width:50px'));?></td>
		<td><?php echo $this->Form->input('type',  array('style'=>'width:40px', 'maxlength'=>'100'));?></td>
		<td><?php echo $this->Form->input('color', array('style'=>'width:40px'));?></td>
		<td><?php echo $this->Form->input('qty', array('style'=>'width:30px','value'=>1));?></td>
		
		<td>
			<?php echo $this->Form->input('currency_id', array('style'=>'width:40px','value'=>'1'));?>
		</td>
		<td>
			<?php echo $this->Form->input('price_cur', array('style'=>'width:50px'));?>
		</td>
		<td>
			<?php echo $this->Form->input('amount_cur', array('style'=>'width:50px', 'readonly'=>true));?>
		</td>
		<td>
			<?php echo $this->Form->input('price', array('type'=>'hidden'));?>
		</td>
		<td>
			<?php echo $this->Form->input('amount', array('type'=>'hidden'));?>		
		</td>
		<td nowrap>
			<?php echo $this->Form->input('date_of_purchase', array('type'=>'date'));?>		
		</td>

		<td class="actions">
			<?php echo $this->Form->input('purchase_id', array('value'=>$this->Session->read('Purchase.id'),'type'=>'hidden')); ?>
			<?php echo $this->Form->input('rp_rate', array('type'=>'hidden', 'value'=>1)); ?>
			<?php
				echo $ajax->submit('Add', array('url' => array('controller' => 'assets', 'action' => 'ajax_add2'),
					'indicator' => 'LoadingDiv',
					'complete' => 'appendAsset(request)'));
			?>
		</td>
	</tr>
	<?php endif;?>
	</table>
	<?php echo $this->Form->end() ?>
</div>


<?php
// echo $javascript->link('prototype',false);
// echo $javascript->link('scriptaculous',false); 

echo $javascript->event('AssetPriceCur','change','calcRp(\'Asset\');calcAmount(\'Asset\')');
echo $javascript->event('AssetQty','change','calcRp(\'Asset\');calcAmount(\'Asset\')');
echo $javascript->event('AssetRpRate','change','calcRp(\'Asset\')');

echo $ajax->observeField( 'AssetCurrencyId', 
    array(
		'url'		=> array('controller'=>'assets', 'action' =>'get_currency'),
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
