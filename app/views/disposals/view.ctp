<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit = $this->Session->read('Disposal.can_edit');
$journal_group_id = $disposal['Disposal']['disposal_type_id']==type_disposal_write_off_id ? journal_group_write_off_id : journal_group_profit_sales_id;
?>
<div class="disposals view">
<h2><?php  __('Disposal '.  ucwords($types[$type]));?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $disposal['Disposal']['doc_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($disposal['Department']['name'], array('controller' => 'departments', 'action' => 'view', $disposal['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['dao_code']; ?> - <?php echo $disposal['CostCenter']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Disposal Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['DisposalStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Disposal Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['DisposalType']['name']; ?>
			&nbsp;
		</dd>
		
		<?php if($this->Session->read('Disposal.can_reject_notes')) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['reject_notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if($this->Session->read('Disposal.can_cancel_notes')) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['cancel_notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if(!empty($disposal['Disposal']['approved_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['approved_by']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if(!empty($disposal['Disposal']['approved_date'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposal['Disposal']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
	</dl>
	
	<div class="doc_actions">
	<ul>
		<?php if($this->Session->read('Disposal.can_posting_disposal_journal')) :?>
		<li><?php echo $this->Html->link(__('Disposal Journal Posting', true), 
			array('controller'=>'journal_transactions','action' => 'prepare_posting','disposal',$journal_group_id, $disposal['Disposal']['id'])); ?> 
		</li>
		<?php endif;?>	
	
		<li><?php echo $this->Html->link($approveLink['label'],$approveLink['options']) ?></li>
		
		<?php if($this->Session->read('Disposal.can_print')) :?>
		<li><?php echo $this->Html->link(__('Print Disposal', true), array('action' => 'view_pdf', $disposal['Disposal']['id'])); ?> </li>
		<?php endif;?>
	
		<?php if($this->Session->read('Disposal.can_cancel')) :?>
		<li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'cancel', $disposal['Disposal']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Disposal.can_reject')) :?>
		<li><?php echo $this->Html->link(__('Reject', true), array('action' => 'reject', $disposal['Disposal']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Disposal.can_archive')) :?>
		<li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $disposal['Disposal']['id'])); ?> </li>
		<?php endif;?>
	</ul>
	</div>
	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('Edit Disposal', true), array('action' => 'edit', $disposal['Disposal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Disposal', true), array('action' => 'delete', $disposal['Disposal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $disposal['Disposal']['id'])); ?> </li>
		<?php endif;?>
						
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Disposal '.  ucwords($types[$type]).' Details');?></h3>
	<?php if (!empty($disposal['DisposalDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('No Inventaris'); ?></th>
		<th><?php __('Asset Name'); ?></th>
		<th><?php __('Sales Amount'); ?></th>
		<th><?php __('Loss Profit Amount'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Book Value'); ?></th>
		<th><?php __('Accum Dep'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
		
		
		<!--th class="actions"><?php __('Actions');?></th-->
	</tr>
	<?php
		$i = 0;
		foreach ($disposal['DisposalDetail'] as $disposalDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
		
		<?php //list($code, $name) = explode ('|', $disposalDetail['asset_name']); ?>
			<td><?php echo $i;?></td>			
			<td class="left"><?php echo $assetCategories[$disposalDetail['asset_category_id']];?></td>
			<td class="left"><?php echo $disposalDetail['code'] ;?></td>
			<td class="left"><?php echo $disposalDetail['name'] ;?></td>
			<td class="number"><?php echo $this->Number->format($disposalDetail['sales_amount']) ;?></td>
			<td class="number"><?php echo $this->Number->format($disposalDetail['loss_profit_amount']) ;?></td>
			<td class="number"><?php echo $this->Number->format($disposalDetail['price']) ;?></td>
			<td class="number"><?php echo $this->Number->format($disposalDetail['book_value']) ;?></td>
			<td class="number"><?php echo $this->Number->format($disposalDetail['accum_dep']) ;?></td>
			<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $disposalDetail['date_of_purchase']) ;?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<?php if($can_edit) : ?>
			<li><?php echo $this->Html->link(__('New Disposal Detail', true), array('controller' => 'disposal_details', 'action' => 'add'));?> </li>
			<?php endif;?>
		</ul>
	</div>
</div>

<div>
	<h3><?php __('Notes'); ?></h3>
	<pre><?php echo $disposal['Disposal']['notes']; ?></pre>
	<p>&nbsp;</p>
</div>
