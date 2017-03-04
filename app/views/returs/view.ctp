<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
$can_process					=$this->Session->read('Retur.can_process');
$can_edit						=$this->Session->read('Retur.can_edit');
$can_send_to_branch_head		=$this->Session->read('Retur.can_send_to_branch_head');
$can_send_to_stock_management	=$this->Session->read('Retur.can_send_to_stock_management');
$can_generate_journal			=$this->Session->read('Retur.can_generate_journal');
$total=0;
?>
<div class="returs view">
	<h2><?php  __('Retur');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $retur['Retur']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['CostCenter']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Retur Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['ReturStatus']['name']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['created_by']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($retur['Retur']['approved_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['approved_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($retur['Retur']['cancel_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($retur['Retur']['reject_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $retur['Retur']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
	</dl>
	<div class="doc_actions">
		<ul>
			<?php if($can_send_to_branch_head) : ?>
			<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'returs','action'=>'update_status/'.$this->Session->read('Retur.id').'/'.status_retur_sent_to_branch_head_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_send_to_stock_management) : ?>
			<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'returs','action'=>'update_status/'.$this->Session->read('Retur.id').'/'.status_retur_approved_by_branch_head_id)); ?> </li>
			<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'returs','action'=>'update_status/'.$this->Session->read('Retur.id').'/'.status_retur_draft_id)); ?> </li>
			<li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'returs','action'=>'update_status/'.$this->Session->read('Retur.id').'/'.status_retur_reject_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($retur['Retur']['retur_status_id'] == status_retur_reject_id) : ?>
			<li><?php echo $this->Html->link(__('Archive', true), array('controller'=>'returs','action'=>'update_status/'.$this->Session->read('Retur.id').'/'.status_retur_archive_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($can_process) : ?>
			<li><?php echo $this->Html->link(__('Process Stock Return', true), array('controller'=>'inventory_ledgers','action'=>'process_inv', 'retur', $retur['Retur']['id'])); ?> </li>
			<?php endif; ?>

			<?php if($can_generate_journal) : ?>
			<li><?php echo $this->Html->link(__('Generate Retur Journal', true), array('controller'=>'journal_transactions','action'=>'prepare_posting', 'retur', journal_group_retur_id, $this->Session->read('Retur.id'))); ?> </li>
			<?php endif; ?>

			<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'returs','action'=>'index')); ?> </li>
		</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) :?>
			<li><?php echo $this->Html->link(__('Edit Retur', true), array('action' => 'edit', $retur['Retur']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Retur', true), array('action' => 'delete', $retur['Retur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $retur['Retur']['id'])); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('List Returs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Retur Details');?></h3>
	<?php echo $this->Form->create('ReturDetail', array('action'=>'ajax_add'));?>	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Category'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Descr'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th><?php __('Unit Price'); ?></th>
		<th><?php __('Amount'); ?></th>
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php if (!empty($retur['ReturDetail'])):?>
	<?php
		$i = 0;

		foreach ($retur['ReturDetail'] as $returDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			
			$rEx = explode("|", $returDetail['item_detail']);
			$assetCategoryId = $rEx[0];
			$unitID = $rEx[2];
			
		?>
		<tr<?php echo $class;?>>			
			<td><?php echo $i;?></td>
			<td><?php echo $assetCategories["$assetCategoryId"];?></td>
			<td>
			<?php echo $rEx[1];?> -
			<?php echo $returDetail['item_name'];?>
			</td>
			<td><?php echo $this->Number->format($returDetail['qty']);?></td>
			<td><?php echo $returDetail['descr'];?></td>
			<td><?php echo $units["$unitID"];?></td>
			<td class="number"><?php echo $this->Number->format($returDetail['price'],2);?></td>
			<td class="number"><?php echo $this->Number->format($returDetail['amount'],2);?></td>
			<td class="actions">
			<?php if($can_edit) :?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'retur_details', 'action' => 'delete', $returDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $returDetail['id'])); ?>
			<?php endif;?>	
			</td>
		</tr>
		<?php $total	+=$returDetail['amount'] ?>
		<?php endforeach; ?>

	<?php endif;?>	

		
	<?php if($this->Session->read('Retur.can_edit')) :?>
	<tr id="newRecord">
		<td></td>
		<td></td>
		<td>
		<?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('Item.name'); ?>
		<div id="item_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo request_type_stock_id?>', {afterUpdateElement : setReturItemValues});
			//]]>
		</script>
		</td>
		<td><?php echo $this->Form->input('qty', array('style'=>'width:50px')); ?></td>
		<td><?php echo $this->Form->input('descr'); ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="actions">
			<?php echo $this->Form->input('retur_id', array('value'=>$this->Session->read('Retur.id'),'type'=>'hidden')); ?>
			<?php echo $this->Form->input('price', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $this->Form->input('price_cur', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $ajax->submit('Add', 
			array('url'=> array('controller'=>'retur_details', 'action'=>'ajax_add'), 
			'indicator'	=> 'LoadingDiv',
			'complete' => 'appendReturDetail(request)')); ?>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="7" class="number"><?php __("Total") ?></td>
		<td class="number" style="border-top:1px solid black">
			<?php 
				echo $this->Number->format($total,2);
			?>
		</td>
		<td style="border-top:1px solid black" colspan="1">&nbsp;</td>
	</tr>	
	</table>
	<?php echo $this->Form->end(); ?>
</div>
