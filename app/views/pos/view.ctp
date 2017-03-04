<?php
$group_id = $this->Session->read('Security.permissions');
$can_edit = $this->Session->read('Po.can_edit');
$request_type_id=$po['Po']['request_type_id'];
$places = $myApp->getPlaces($po['Currency']['is_desimal']);
$npbs = $po['Npb'] ;
$tmp=array();
foreach($npbs as $npb){
	$tmp[$npb['id']] = $npb['no'];
}
$npbs=$tmp;
?>
<?php
// echo $javascript->link('prototype',false);
// echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
echo $javascript->link('my_detail_add',false);

$recalcFunction = $ajax->remoteFunction( 
    array(
        'url' => array( 'controller' => 'pos', 'action' => 'ajax_view', $this->Session->read('Po.id') ),
		'indicator'=>'LoadingDiv',
		'complete'=>'recalcPo(request)'
    ) 
);
$id_group=$this->Session->read('Security.permissions');
?>

<div class="pos view">
<h2><?php  __('Po');?></h2>
	<dl><?php $i = 0; $j = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['no']; ?>
			<?php
				for($j=1; $j<$po['Po']['printed']; $j++)
				{
					echo '*';
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Delivery Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Supplier']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Request Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['RequestType']['name']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['PoStatus']['name']; ?><br>
			<?php if($po['DeliveryOrder'] == null){
				echo 'Delivery Order has not set';
			}else{
				echo 'Delivery Order: '.$this->Html->link(__($po['DeliveryOrder'][0]['no'], true), array('controller'=>'delivery_orders', 'action' => 'view', $po['DeliveryOrder'][0]['id']));
			}
			echo '<br>';
			if($po['Invoice'] == null){
				echo 'PO Need Invoice';
			}else{
				echo 'Invoice: '.$this->Html->link(__($po['Invoice'][0]['no'], true), array('controller'=>'invoices', 'action' => 'view', $po['Invoice'][0]['id']));
			}?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('V Is Done'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($po['Po']['v_is_done'] . ".gif"); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Currency']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total (Cur)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="PoTotalDiv">
			<?php echo $this->Number->format($po['Po']['total_cur'], $places); ?>
			</div>
		</dd>

		<?php if($po['Po']['down_payment']>0) :?>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Down Payment (Cur)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($po['Po']['down_payment'], $places); ?>
			&nbsp;
		</dd>
		<!--dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Down Payment Journal Generated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($po['Po']['is_down_payment_journal_generated'] . '.gif'); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Journal Generated Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['down_payment_journal_generated_date'] ; ?>
			&nbsp;
		</dd-->
		<?php endif;?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Term'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['payment_term']; ?>
			&nbsp;
		</dd>	
            
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Daily Penalty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['daily_penalty']; ?>
			&nbsp;
		</dd>	

		<?php if($po['Po']['po_status_id'] == '10') :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approval Note 1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['approval_note_1']; ?>
			&nbsp;
		</dd>	
            
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approval Note 2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['approval_note_2']; ?>
			&nbsp;
		</dd>	
		<?php endif;?>
		
		<?php if($po['Po']['reject_notes']) :?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Notes'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<pre><?php echo $po['Po']['reject_notes']; ?></pre>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $po['Po']['reject_by']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $po['Po']['reject_date']; ?>
				&nbsp;
			</dd>
		<?php endif;?>
		
		<?php if($po['Po']['cancel_notes']) :?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Notes'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<pre><?php echo $po['Po']['cancel_notes']; ?></pre>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $po['Po']['cancel_by']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $po['Po']['cancel_date']; ?>
				&nbsp;
			</dd>
		<?php endif;?>
		
		<?php if($po['Po']['approved_by']) :?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $po['Po']['approved_by']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $po['Po']['approved_date']; ?>
				&nbsp;
			</dd>
		<?php endif;?>

	</dl>

	<div class="doc_actions">
	<ul>

		<?php if($this->Session->read('Po.can_down_payment_journal')) :?>
		<li><?php echo $this->Html->link(__('Down Payment Journal', true), array('controller'=>'journal_transactions', 'action' => 'prepare_posting', 'po',journal_group_down_payment_id, $po['Po']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Po.can_print')) :?>
		<li><?php echo $this->Html->link(__('Print PO', true), array('action' => 'view_pdf', $po['Po']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Po.can_reject')) :?>
		<li><?php echo $this->Html->link(__('Reject', true), array('action' => 'reject', $po['Po']['id'])); ?> </li>
		<?php endif;?>

		<?php if($this->Session->read('Po.can_receive')) :?>
		<li><?php echo $this->Html->link(__('View/Add Receive DO', true), array('controller'=>'delivery_orders','action' => 'index', $po['Po']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Po.can_invoice')) :?>
		<li><?php echo $this->Html->link(__('Input Invoice', true), array('controller'=>'invoices','action' => 'add', $po['Po']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Po.can_archive')) :?>
		<li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $po['Po']['id'])); ?> </li>
		<?php endif;?>		
		
		<?php if($group_id == housekeeper_group_id){?>
			<?php if($this->Session->read('HKConf.table_name') == 'npbs'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_npbs');
				}else if($this->Session->read('HKConf.table_name') == 'pos'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_pos');
				}else if($this->Session->read('HKConf.table_name') == 'delivery_orders'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_delivery_orders');
				}else if($this->Session->read('HKConf.table_name') == 'inlogs'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_inlogs');
				}else if($this->Session->read('HKConf.table_name') == 'outlogs'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_outlogs');
				}
			?>
			<li><?php echo $this->Html->link(__('Back', true), $options); ?> </li>
		<?php }else{?>
			<?php if($po['Po']['po_status_id'] == status_po_draft_id || $po['Po']['po_status_id'] == status_po_request_for_approval_id || $po['Po']['po_status_id'] == status_po_finish_id || $po['Po']['po_status_id'] == status_po_approved_1_id || $po['Po']['po_status_id'] == status_po_approved_2_id){?>
				<li><?php echo $this->Html->link($approveLink['label'],$approveLink['options']) ?></li>
			<? };?>
			<?php if($po['Po']['po_status_id'] == status_po_draft_id || $po['Po']['po_status_id'] == status_po_request_for_approval_id || $po['Po']['po_status_id'] == status_po_finish_id || $po['Po']['po_status_id'] == status_po_request_cancel_id || $po['Po']['po_status_id'] == status_po_cancel_level_1_id || $po['Po']['po_status_id'] == status_po_cancel_level_2_id){?>
				<li><?php echo $this->Html->link($cancelLink['label'],$cancelLink['options']) ?></li>			
			<? };?>
		<?php };?>	
		
			
	</ul>
	
</div>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('Edit Po', true), array('action' => 'edit', $po['Po']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Po', true), array('action' => 'delete', $po['Po']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $po['Po']['id'])); ?> </li>
		<?php endif;?>

		<li><?php echo $this->Html->link(__('List Pos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
	</ul>
</div>

<div class="related">
	<?php
		$sub_total	=0;
		$discount	=0;
		$after_disc	=0;
		$vat_base	=0;
		$vat_total	=0;
		$wht_base	=0;
		$wht_total	=0;
		$total		=0;
		$poId = $po['Po']['id'];
	?>
	
	<?php if($po['Po']['request_type_id'] != request_type_stock_id) :?>
		<h3><?php __('FA Item Details');?></h3>
		<?php if ($can_edit):?>
		<p style="text-align:right;width:98%">
			<?php 
				echo $ajax->link(__('Re-Calculate', true), 
				array('controller'=>'pos', 'action'=>'ajax_view', $po['Po']['id']),
				array(
					'indicator'=>'LoadingDiv',
					'complete'=>'recalcPo(request)'
				)); ?> 
		</p>	
		<?php echo $this->Form->create('PoDetail', array('action'=>'ajax_add')); ?>
		<?php endif;?>
		
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('No'); ?></th>
			<th><?php __('Department'); ?></th>
			<th><?php __('Asset Category'); ?></th>
			<th><?php __('Code'); ?></th>
			<th><?php __('Name'); ?></th>
			<th><?php __('Brand'); ?></th>
			<th><?php __('Type'); ?></th>
			<th><?php __('Color'); ?></th>
			<th><?php __('Qty'); ?></th>
			<th><?php __('Qty<br>Received'); ?></th>
			<th><?php __('Price'); ?></th>
			<th><?php __('Amount'); ?></th>
			<th><?php __('Discount'); ?></th>
			<th><?php __('After Disc'); ?></th>
			<th><?php __('Is VAT'); ?></th>
			<th><?php __('Is WHT'); ?></th>
			<th><?php __('Ref. NPB'); ?></th>
			<?php if($id_group==gs_group_id && $po['Po']['po_status_id'] == status_po_draft_id):?>
			<th class="actions"><?php __('Actions');?></th>
			<?php endif;?>
		</tr>
		<?php if (!empty($po['PoDetail'])):?>
		<?php
			$i = 0;
			foreach ($po['PoDetail'] as $poDetail):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				$id=$poDetail['id'];
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $i;?></td>
				<td class="left"><?php echo $departments[$poDetail['department_id']];?></td>
				<td class="left">
					<?php if($po['RequestType']['id'] != 5){?>
						<?php echo $assetCategories[$poDetail['asset_category_id']];?>
					<?php }else{ ?>
						<?php echo $stockAssetCategories[$poDetail['asset_category_id']];?>
					<?php } ?>
					
				</td>
				<td class="left"><?php echo $poDetail['item_code'];?></td>
				<td class="left"><?php echo $poDetail['name'];?></td>
				<td class="left">
					<div id="brand.<?php echo $id ?>"><?php echo $poDetail['brand'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('brand.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="left">
					<div id="type.<?php echo $id ?>"><?php echo $poDetail['type'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('type.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="left">
					<div id="color.<?php echo $id ?>"><?php echo $poDetail['color'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('color.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="center">
					<div id="qty.<?php echo $id?>"><?php echo $poDetail['qty'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('qty.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('indicator'=>'LoadingDiv','loaded'=>$recalcFunction)
						) 
					?>
					<?php endif;?>
				</td>
				<td class="center"><?php echo $poDetail['qty_received'];?></td>
				<td class="number">
					<div id="price_cur.<?php echo $id ?>">
						<?php 
							if($poDetail['price_cur'] > 0){
								echo $this->Number->format($poDetail['price'], $places);								
							}else{
								foreach($po['Item'] as $item){
									if($item['id'] == $poDetail['item_id']){
										if($item['price'] != 0){
											echo $this->Number->format($item['price'], $places);
										}else{
											echo $this->Number->format($item['avg_price'], $places);
										}
									}								
								};
							}
						?>
						
					</div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('price_cur.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="number">
					<div id="amount_cur.<?php echo $id?>"><?php echo $this->Number->format($poDetail['amount'], $places);?></div>
				</td>
				<td class="number">
					<div id="discount_cur.<?php echo $id?>"><?php echo $this->Number->format($poDetail['discount_cur'], $places);?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('discount_cur.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="number">
					<div id="amount_after_disc_cur.<?php echo $id?>">
					<?php echo $this->Number->format($poDetail['amount_after_disc_cur'], $places);?>
					</div>
				</td>
						
				<td>
					<?php echo $this->Html->image($poDetail['is_vat'] . ".gif", 
						$can_edit?
						array('url'=>array('controller' => 'po_details', 'action' => 'set_vat', $poDetail['id'], $poDetail['is_vat']==1?0:1)):
						array()
					);?>
				</td>
				
				<td>
					<?php echo $this->Html->image($poDetail['is_wht'] . ".gif", 
						$can_edit?
						array('url'=>array('controller' => 'po_details', 'action' => 'set_wht', $poDetail['id'], $poDetail['is_wht']==1?0:1)):
						array()
					);?>
				</td>

				<td class="left">
					<?php echo $poDetail['npb_id']?
						$this->Html->link($poDetail['npb_no'], 
						array('controller'=>'npbs', 'action'=>'view', $poDetail['npb_id'])):
					"";?>
				</td>
	
				<td class="actions">
				<?php if($id_group==gs_group_id && $po['Po']['po_status_id'] == status_po_draft_id):?>
					<?php echo $this->Html->link(__('Delete', true), array('controller' => 'po_details', 'action' => 'delete', $poDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poDetail['id'])); ?>
				<?php endif;?>
				</td>
			</tr>
			<?php $sub_total	+= $poDetail['amount_cur'] ?>
			<?php $discount		+= $poDetail['discount_cur'] ?>
			<?php $after_disc	+= $poDetail['amount_after_disc_cur'] ?>
			<?php $vat_base 	+= $poDetail['is_vat']==1?$poDetail['amount_after_disc_cur']:0 ?>
			<?php $vat_total 	+= $poDetail['vat_cur']   ?>
			<?php $total	 	+= $poDetail['amount_nett_cur'] ?>

		<?php endforeach; ?>
		<?php endif;?>
		<?php if($can_edit  && empty($po['Npb']) ) : ?>
		<tr id="newRecord">
			<td colspan="2" class="newField"><?php echo $this->Form->input('department_id', array('style'=>'width:120px')); ?></td>
			<td class="newField"><?php echo $this->Form->input('asset_category_id', array('style'=>'width:120px','empty'=>'')); ?></td>
			<td class="newField"><?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
				<?php echo $this->Form->input('Item.name', array('label'=>'Select Code - Name') ); ?>
				<div id="item_choices" class="auto_complete"></div> 
				<script type="text/javascript"> 
					//<![CDATA[
					new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo $request_type_id?>', {afterUpdateElement : setPoItemValues});
					//]]>
				</script>
			</td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('brand', array('maxlength'=>'20')); ?></td>
			<td class="newField"><?php echo $this->Form->input('type', array('maxlength'=>'20')); ?></td>
			<td class="newField"><?php echo $this->Form->input('color', array('maxlength'=>'10')); ?></td>
			<td class="newField"><?php echo $this->Form->input('qty', array('size'=>'6'));?></td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('price_cur', array('size'=>'10', 'value'=>0)); ?></td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('discount_cur', array('size'=>'6', 'value'=>0));?></td>
			<td></td>
			<td class="newField"><?php echo $this->Form->checkbox('is_vat', array('label'=>false, 'value'=>true));?></td>
			<td></td>
			<td>
				<?php echo $this->Form->input('po_id', array('value'=>$this->Session->read('Po.id'),'type'=>'hidden')); ?>
				<?php echo $this->Form->input('umurek', array('type'=>'hidden') );?>
				<?php echo $ajax->submit('Add', 
				array(
				'url'=> array('controller'=>'po_details', 'action'=>'ajax_add'), 
				'indicator'	=> 'LoadingDiv',
				'complete' => 'appendPoDetail(request)')); ?>		
			</td>
		</tr>	
		<?php endif;?>
		
		
	<?php else: //request type == stock ?>
		
		
		<h3><?php __('Stock Inventory Item Details');?></h3>
		<?php if ($can_edit):?>
		<p style="text-align:right;width:98%">
			<?php 
				echo $ajax->link(__('Re-Calculate', true), 
				array('controller'=>'pos', 'action'=>'ajax_view', $po['Po']['id']),
				array(
					'indicator'=>'LoadingDiv',
					'complete'=>'recalcPo(request)'
				)); ?> 
		</p>	
		<?php echo $this->Form->create('PoDetail', array('action'=>'ajax_add')); ?>
		<?php endif;?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('No'); ?></th>
			<th><?php __('Department'); ?></th>
			<th><?php __('Item Category'); ?></th>
			<th><?php __('Code'); ?></th>
			<th><?php __('Name'); ?></th>
			<th><?php __('Brand'); ?></th>
			<th><?php __('Type'); ?></th>
			<th><?php __('Color'); ?></th>
			<th><?php __('Qty'); ?></th>
			<th><?php __('Qty Received'); ?></th>
			<th><?php __('Price'); ?></th>
			<th><?php __('Amount'); ?></th>
			<th><?php __('Discount'); ?></th>
			<th><?php __('After Disc'); ?></th>
			<th><?php __('Is VAT'); ?></th>
			<th><?php __('Is WHT'); ?></th>
			<th><?php __('Ref. NPB'); ?></th>
			<?php if($id_group==gs_group_id && $po['Po']['po_status_id'] == status_po_draft_id):?>
			<th class="actions"><?php __('Actions');?></th>
			<?php endif ;?>
		</tr>	
		<?php if (!empty($po['PoDetail'])):?>
		<?php
			$i = 0;
			foreach ($po['PoDetail'] as $poDetail):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				$id=$poDetail['id'];
				$poId = $poDetail['po_id'];
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $i;?></td>
				<td class="left"><?php echo $departments[$poDetail['department_id']];?></td>
				<td class="left"><?php echo $stockAssetCategories[$poDetail['asset_category_id']];?></td>
				<td class="left"><?php echo $poDetail['item_code'];?></td>
				<td class="left"><?php echo $poDetail['name'];?></td>
				<td class="left">
					<div id="brand.<?php echo $id ?>"><?php echo $poDetail['brand'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('brand.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="left">
					<div id="type.<?php echo $id ?>"><?php echo $poDetail['type'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('type.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="left">
					<div id="color.<?php echo $id ?>"><?php echo $poDetail['color'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('color.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="number">
					<div id="qty.<?php echo $id?>"><?php echo $poDetail['qty'];?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('qty.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td><?php echo $poDetail['qty_received'];?></td>
				<td class="number">
					<div id="price_cur.<?php echo $id ?>">
					<?php if($poDetail['price_cur'] > 0){
						echo $this->Number->format($poDetail['price'], $places);								
					}else{
						foreach($po['Item'] as $item){
							if($item['id'] == $poDetail['item_id']){
								if($item['price'] != 0){
									echo $this->Number->format($item['price'], $places);
								}else{
									echo $this->Number->format($item['avg_price'], $places);
								}
							}								
						};
					}?>
					</div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('price_cur.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="number">
					<div id="amount_cur.<?php echo $id?>"><?php echo $this->Number->format($poDetail['amount'], $places);?></div>
				</td>
				<td class="number">
					<div id="discount_cur.<?php echo $id?>"><?php echo $this->Number->format($poDetail['discount_cur'], $places);?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('discount_cur.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="number">
					<div id="amount_after_disc_cur.<?php echo $id?>">
					<?php echo $this->Number->format($poDetail['amount_after_disc_cur'], $places);?>
					</div>
				</td>
				<td>
					<?php echo $this->Html->image($poDetail['is_vat'] . ".gif", 
						$can_edit?
						array('url'=>array('controller' => 'po_details', 'action' => 'set_vat', $poDetail['id'], $poDetail['is_vat']==1?0:1)):
						array()
					);?>
				</td>
				
				<td>
					<?php echo $this->Html->image($poDetail['is_wht'] . ".gif", 
						$can_edit?
						array('url'=>array('controller' => 'po_details', 'action' => 'set_wht', $poDetail['id'], $poDetail['is_wht']==1?0:1)):
						array()
					);?>
				</td>
				<td class="left">
					<?php echo $poDetail['npb_id']?
					$this->Html->link($poDetail['npb_no'], 
					array('controller'=>'npbs', 'action'=>'view', $poDetail['npb_id'])):
					"";?>
				</td>
				<td class="actions">
				<?php if($id_group==gs_group_id && $po['Po']['po_status_id'] == status_po_draft_id):?>
					<?php echo $this->Html->link(__('Delete', true), array('controller' => 'po_details', 'action' => 'delete', $poDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poDetail['id'])); ?>
				<?php endif;?>
				</td>
			</tr>
			<?php $sub_total	+= $poDetail['amount_cur']; ?>
			<?php $discount		+= $poDetail['discount_cur']; ?>
			<?php $after_disc	+= $poDetail['amount_after_disc_cur']; ?>
			<?php $vat_base 	+= $poDetail['is_vat']==1?$poDetail['amount_after_disc_cur']:0 ;?>
			<?php $vat_total 	+= $poDetail['vat_cur'];   ?>
			<?php $wht_base 	+= $poDetail['is_wht']==1?$poDetail['amount_after_disc_cur']:0 ;?>
			<?php $wht_total 	+= $po['Po']['wht_total'];   ?>
			<?php $total	 	+= $poDetail['amount_nett_cur']; ?>

		<?php endforeach; ?>
		<?php endif;?>
		
		<?php if($can_edit  && empty($po['Npb']) ) : ?>
		<tr id="newRecord">
			<td colspan="2" class="newField"><?php echo $this->Form->input('department_id', array('style'=>'width:120px')); ?></td>
			<td class="newField"><?php echo $this->Form->input('asset_category_id', array('options'=>$stockAssetCategories,'style'=>'width:120px','empty'=>'')); ?></td>
			<td class="newField">
				<?php echo $this->Form->input('Item.name'); ?>
				<?php echo $this->Form->input('item_id', array('type'=>'hidden')); ?>
				<div id="item_choices" class="auto_complete"></div> 
				<script type="text/javascript"> 
					//<![CDATA[
					new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo $request_type_id?>', {afterUpdateElement:setPoItemValues});
					//]]>
				</script>			
			</td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('brand', array('maxlength'=>'20'));?></td>
			<td class="newField"><?php echo $this->Form->input('type', array('maxlength'=>'20'));?></td>
			<td class="newField"><?php echo $this->Form->input('color', array('maxlength'=>'10'));?></td>
			<td class="newField"><?php echo $this->Form->input('qty', array('size'=>'6'));?></td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('price_cur', array('size'=>'10', 'value'=>0)); ?></td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('discount_cur', array('size'=>'6', 'value'=>0));?></td>
			<td></td>
			<td class="newField"><?php echo $this->Form->input('is_vat', array('label'=>false, 'value'=>true));?></td>
			<td></td>
			<td>
				<?php echo $this->Form->input('po_id', array('value'=>$this->Session->read('Po.id'),'type'=>'hidden')); ?>
				<?php echo $this->Form->input('umurek', array('type'=>'hidden') );?>
				<?php echo $ajax->submit('Add', 
				array(
				'url'=> array('controller'=>'po_details', 'action'=>'ajax_add'), 
				'indicator'	=> 'LoadingDiv',
				'complete' => 'appendPoDetail(request)')); ?>		
			</td>
		</tr>	
		<?php endif;?>	
	<?php endif; // request type if ?>
	
	
	<!-- total lines -->
	<tr>
		<td style="border-top:1px solid black" colspan="11" class="number"><?php __("Sub Total") ?></td>
		<td  style="border-top:1px solid black" class="number">
			<div id="sub_total"><?php echo $this->Number->format($sub_total, $places);?></div>
		</td>
		<td style="border-top:1px solid black" class="number">
			<div id="discount"><?php echo $this->Number->format($discount, $places)?></div>
		</td>
		<td style="border-top:1px solid black" class="number">
			<div id="after_disc"><?php echo $this->Number->format($after_disc, $places)?></div>
		</td>

		<td style="border-top:1px solid black" colspan="4">&nbsp;</td>
	</tr>
		
	<tr>
		<td colspan="11" class="number"><?php __("VAT") ?></td>
		<td class="number">
			<?php echo $po['Po']['vat_rate'];?>% x
		</td>
		<td class="number">
			<div id="vat_base"><?php echo $this->Number->format($vat_base, $places);?></div>
		</td>		
		<td class="number">
			<div id="vat_total"><?php echo $this->Number->format($vat_total, $places);?></div>
		</td>		

		<td colspan="4">&nbsp;</td>
	</tr>
		
	<tr>
		<td colspan="11" class="number"><?php __("PPH") ?></td>
		<td class="number">
			<div id="wht_rate.<?php echo $id ?>"><?php echo $po['Po']['wht_rate'];?></div>% x
				<?php if($can_edit) :?>
				<?php echo $ajax->editor('wht_rate.'.$id,
					array('controller'=>'pos', 'action'=>'ajax_edit', $id ),
					array('loaded'=>$recalcFunction)				
					) 
				?>
				<?php endif;?>			
		</td>
		<td class="number">
			<div id="wht_base.<?php echo $id ?>"><?php echo $this->Number->format($wht_base, $places);?></div>
			<?php if($can_edit) :?>
			<?php echo $ajax->editor('wht_base.'.$id,
				array('controller'=>'pos', 'action'=>'ajax_edit', $id ),
				array('loaded'=>$recalcFunction)				
				) 
			?>
			<?php endif;?>
		</td>		
		<td class="number">
			<div id="wht_total.<?php echo $id ?>"><?php echo $this->Number->format($wht_total, $places);?></div>
			<?php if($can_edit) :?>
			<?php echo $ajax->editor('wht_total.'.$id,
				array('controller'=>'pos', 'action'=>'ajax_edit', $id ),
				array('loaded'=>$recalcFunction)				
				) 
			?>
			<?php endif;?>
		</td>		

		<td colspan="4">&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="13" class="number"><?php __("Grand Total") ?></td>
		<td class="number">
			<div id="total"><?php echo $this->Number->format($total, $places)?></div>
		</td>
		<td colspan="4">&nbsp;</td>
	</tr>	
	
	</table>
	
	<?php if($can_edit) :?>
	<?php echo $this->Form->end()?>
	<div id="PoUpdateDiv"></div>
	<?php endif;?>

</div>

<div class="related">
	<h3><?php __('Payment Term');?></h3>
	<?php if ($can_edit):?>
	<p style="text-align:right;width:98%">
		<?php 
			echo $ajax->link(__('Re-Calculate', true), 
			array('controller'=>'pos', 'action'=>'ajax_view', $po['Po']['id']),
			array(
				'indicator'=>'LoadingDiv',
				'complete'=>'recalcPo(request)'
			)); ?> 
	</p>	
	<?php endif;?>
	<?php 
	if (!empty($po['PoPayment'])):?>
	<?php
		$total_term_percent = $po['Po']['v_total_term_percent'];
		$total_amount_due = $po['Po']['v_total_amount_due'];
		$total_amount_paid = $po['Po']['v_total_amount_paid'];
	?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Term No'); ?></th>
		<th><?php __('Term Percent (%)'); ?></th>
		<th><?php __('Date Due'); ?></th>
		<th><?php __('Date Paid'); ?></th>
		<th><?php __('Amount Due'); ?></th>
		<th><?php __('Amount Paid'); ?></th>
		<th><?php __('Description'); ?></th>
	</tr>
	<?php

		$i = 0;
		foreach ($po['PoPayment'] as $poPayment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$id=$poPayment['id'];
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $poPayment['term_no'];?></td>
			<td>
				<div id="term_percent.<?php echo $id?>"><?php echo $poPayment['term_percent'];?></div>
				<?php if($can_edit) :?>
				<?php echo $ajax->editor('term_percent.'.$id,
						array('controller'=>'po_payments', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
					)
				?>
				<?php endif;?>				
			</td>
			<td>
				<div id="date_due.<?php echo $id?>"><?php echo $poPayment['date_due']?$this->Time->format(DATE_FORMAT, $poPayment['date_due']):'0000-00-00';?></div>
				<?php if($can_edit) :?>
				<?php echo $ajax->editor('date_due.'.$id,
						array('controller'=>'po_payments', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
					)
				?>
				<?php endif;?>						
			</td>
			<td>
				<div id="date_paid.<?php echo $id?>"><?php echo $poPayment['date_paid']?$poPayment['date_paid']:'0000-00-00';?></div>
			</td>
			<td class="number">
				<div id="amount_due.<?php echo $id?>"><?php echo $this->Number->format($poPayment['amount_due'], $places);?>				
			</td>
			<td class="number">
				<div id="amount_paid.<?php echo $id?>"><?php echo $this->Number->format($poPayment['amount_paid'], $places);?></div>
			</td>
			<td>
				<div id="description.<?php echo $id?>"><?php echo $poPayment['description'];?></div>
				<?php if($can_edit) :?>
				<?php echo $ajax->editor('description.'.$id,
					array('controller'=>'po_payments', 'action'=>'ajax_edit', $id )
					)
				?>
				<?php endif;?>					
			</td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td></td>
		<td>
			<div id="total_term_percent"><?php echo $total_term_percent; ?>%</div>
		</td>
		<td></td>
		<td></td>
		<td class="number">
			<div id="total_amount_due"><?php echo $this->Number->format($total_amount_due, $places);?><div>
		</td>
		<td class="number">
			<div id="total_amount_paid"><?php echo $this->Number->format($total_amount_paid, $places);?><div>
		</td>
		<td></td>
	</tr>
	</table>
<?php endif; ?>

</div>

<div>
	<h3><?php __('Description'); ?></h3>
	<pre><?php echo $po['Po']['description']; ?></pre>
	<p>&nbsp;</p>
</div>

<div>
	<h3><?php __('Shipping Address'); ?></h3>
	<pre><?php echo $po['Po']['shipping_address']; ?></pre>
	<p>&nbsp;</p>
</div>

<div>
	<h3><?php __('Billing Address'); ?></h3>
	<pre><?php echo $po['Po']['billing_address']; ?></pre>
	<p>&nbsp;</p>
</div>

<div>
	<h3><?php __('Purchase Order Address'); ?></h3>
	<pre><?php echo $po['Po']['po_address']; ?></pre>
	<p>&nbsp;</p>
</div>

<div class="related">
	<h3><?php __('Related NPB');?></h3>
	<?php 
	if (!empty($po['Npb'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('No NPB'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Req. Date'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Is Done'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php

		$i = 0;
		foreach ($po['Npb'] as $npb):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $npb['no'];?></td>
			<td><?php echo $departments[$npb['department_id']];?></td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $npb['req_date']); ?></td>
			<td><?php echo $npbStatuses[$npb['npb_status_id']];?></td>
			<td><?php echo $npb['created_by'];?></td>
			<td><?php echo $this->Html->image($npb['v_is_done'].".gif");?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'npbs', 'action' => 'view', $npb['id'], 'no_procces')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<h3><?php __('Related Invoice');?></h3>
	<?php 
	if (!empty($po['Invoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('No Invoice'); ?></th>
		<th><?php __('Supplier'); ?></th>
		<th><?php __('Inv. Date'); ?></th>
		<th><?php __('Total (Rp)'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php

		$i = 0;
		foreach ($po['Invoice'] as $invoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $invoice['no'];?></td>
			<td><?php echo $suppliers[$invoice['supplier_id']];?></td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $invoice['inv_date']); ?></td>
			<td class="number"><?php echo $this->Number->format($invoice['total'], $places);?></td>
			<td><?php echo $invoice_statuses[$invoice['status_invoice_id']];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'invoices', 'action' => 'view', $invoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>


<?php
echo $ajax->observeField( 'PoDetailAssetCategoryId', 
    array(
		'url'		=> array('controller'=>'assets','action' => 'get_depr_year'),
		'complete'	=> 'updateField("PoDetailUmurek","depr_year_com",request)',
		'indicator' 	=> 'LoadingDiv', 
	)
); 
?>