<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit = $this->Session->read('Po.can_edit');
$places = $myApp->getPlaces($po['Currency']['is_desimal']);

?>
<h2><div class="error-message">
<?php echo 'WARNING : if you reject this PO,  then all the items in request will be rejected even though MR is in the process of purchase or transfer. with these conditions, you sure?' ;?>            
</div></h2>
<div class="pos view">
<h2><?php  __('Po');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Po']['no']; ?>
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
			<?php echo $this->Html->link($po['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $po['Supplier']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['PoStatus']['name']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['Currency']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total (Cur)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="PoTotalDiv"><?php echo $this->Number->format($po['Po']['total_cur'], $places); ?></div>
		</dd>

	</dl>

	<div>
		<?php echo $this->Form->create('Po');?>
			<?php
				echo $this->Form->input('id', array('type'=>'hidden'));
				echo $this->Form->input('no', array('type'=>'hidden'));
				echo $this->Form->input('cancel_notes', array('style'=>'width:98%'));
				echo $this->Form->input('cancel_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
				echo $this->Form->input('cancel_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
			?>
		<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	
	<div class="doc_button">
        <ul>
			<li><?php echo $this->Html->link('Back', array('action'=>'view', $po['Po']['id'])) ;?></li>
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
	</ul>
</div>


<div class="related">
	<?php
		$sub_total	=0;
		$discount	=0;
		$after_disc	=0;
		$vat_base	=0;
		$vat_total	=0;
		$total		=0;
	?>
	
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
			<th><?php __('Ref. NPB'); ?></th>
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
				<td class="left"><?php echo $assetCategories[$poDetail['asset_category_id']];?></td>
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
					<?php //if($can_edit) :?>
					<?php //echo $ajax->editor('qty.'.$id,
						//array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						//array('indicator'=>'LoadingDiv','loaded'=>$recalcFunction)
						//) 
					?>
					<?php //endif;?>
				</td>
				<td class="center"><?php echo $poDetail['qty_received'];?></td>
				<td class="number">
					<div id="price_cur.<?php echo $id ?>"><?php echo $this->Number->format($poDetail['price_cur'], $places);?></div>
					<?php if($can_edit) :?>
					<?php echo $ajax->editor('price_cur.'.$id,
						array('controller'=>'po_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
				</td>
				<td class="number">
					<div id="amount_cur.<?php echo $id?>"><?php echo $this->Number->format($poDetail['amount_cur'], $places);?></div>
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

				<td class="left">
					<?php echo $poDetail['npb_id']?
					$this->Html->link($npbs[$poDetail['npb_id']], 
					array('controller'=>'npbs', 'action'=>'view', $poDetail['npb_id'])):
					"";?>
				</td>
	
			</tr>
			<?php $sub_total	+=$poDetail['amount_cur'] ?>
			<?php $discount		+=$poDetail['discount_cur'] ?>
			<?php $after_disc	+=$poDetail['amount_after_disc_cur'] ?>
			<?php $vat_base 	+=$poDetail['is_vat']==1?$poDetail['amount_after_disc_cur']:0 ?>
			<?php $vat_total 	+=$poDetail['vat_cur']   ?>
			<?php $total	 	+=$poDetail['amount_nett_cur'] ?>

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
		
	</table>
<?php endif; // empty ?>
</div>

<?php if($can_edit) :?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New PO Item Detail', true), array('controller' => 'po_details', 'action' => 'add'));?> </li>
		</ul>
	</div>	
<?php endif;?>
	


<div class="related">
	<h3><?php __('Description'); ?></h3>
	<div><?php echo $po['Po']['description']; ?></div>
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
		<th><?php __('Total (Rp)'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Notes'); ?></th>
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
			<td class="number"><?php echo $this->Number->format($npb['v_total']);?></td>
			<td><?php echo $npbStatuses[$npb['npb_status_id']];?></td>
			<td><?php echo $npb['notes'];?></td>
			<td><?php echo $npb['created_by'];?></td>
			<td><?php echo $this->Html->image($npb['v_is_done'].".gif");?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'npbs', 'action' => 'view', $npb['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
