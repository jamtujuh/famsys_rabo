<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit = $this->Session->read('Movement.can_edit');
?>
<div class="movements view">
<h2><?php  __('Movement');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $movement['Movement']['doc_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['no']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($movement['Movement']['dest_department_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dest Branch'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departments[$movement['Movement']['dest_department_id']]; ?>
			&nbsp;
		<?php endif;?>
		</dd>
		<?php if(!empty($movement['Movement']['dest_department_sub_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dest Department Sub Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['dest_department_sub_id']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($movement['Movement']['dest_department_unit_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dest Department Unit Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['dest_department_unit_id']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($movement['Movement']['dest_business_type_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dest Business Type Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessTypes[$movement['Movement']['dest_business_type_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($movement['Movement']['dest_cost_center_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dest Cost Center Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $costCenters[$movement['Movement']['dest_cost_center_id']] ;?> - <?php echo $costCenter[$movement['Movement']['dest_cost_center_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Branch'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departments[$movement['Movement']['source_department_id']]; ?>
			&nbsp;
		</dd>
		
		<?php if(!empty($movement['Movement']['source_department_sub_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Department Sub'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departments[$movement['Movement']['source_department_sub_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($movement['Movement']['source_department_unit_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Department Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departments[$movement['Movement']['source_department_unit_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($movement['Movement']['source_business_type_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessTypes[$movement['Movement']['source_business_type_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($movement['Movement']['source_cost_center_id'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $costCenters[$movement['Movement']['source_cost_center_id']]; ?> - <?php echo $costCenter[$movement['Movement']['source_cost_center_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Movement Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['MovementStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ref. NPB'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['npb_id']?
					$this->Html->link($npbs[$movement['Movement']['npb_id']], 
						array('controller'=>'npbs', 'action'=>'view', $movement['Movement']['npb_id'])): "";
			?>
			&nbsp;
		</dd>
		
		<?php if(!empty($movement['Movement']['reject_notes'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $movement['Movement']['reject_notes']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if(!empty($movement['Movement']['cancel_notes'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $movement['Movement']['cancel_notes']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if($movement['Movement']['approved_by']) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['approved_by']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if($movement['Movement']['approved_date']) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
	</dl>
	
	<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link($approveLink['label'],$approveLink['options']) ?></li>
		
		<li><?php echo $this->Html->link(__('Print Movement', true), array('action' => 'view_pdf', $movement['Movement']['id'])); ?> </li>
		
		<?php if($this->Session->read('Movement.can_cancel')) :?>
		<li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'cancel', $movement['Movement']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Movement.can_reject')) :?>
		<li><?php echo $this->Html->link(__('Reject', true), array('action' => 'reject', $movement['Movement']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Movement.can_archive')) :?>
		<li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $movement['Movement']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Movement.can_posting_movement_journal')) :?>
		<li><?php echo $this->Html->link(__('Movement Journal Posting', true), 
			array('controller'=>'journal_transactions','action' => 'prepare_posting', 'movement',journal_group_movement_id, $movement['Movement']['id'])); ?> 
		</li>
		<?php endif;?>	
	</ul>
	</div>
	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('Edit Movement', true), array('action' => 'edit', $movement['Movement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Movement', true), array('action' => 'delete', $movement['Movement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $movement['Movement']['id'])); ?> </li>
		<?php endif;?>
		
		<li><?php echo $this->Html->link(__('List Movements', true), array('action' => 'index')); ?> </li>
		
	</ul>
</div>

<div class="related">
	<h3><?php __('Movement Details');?></h3>
	<?php if (!empty($movement['MovementDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('Asset Code'); ?></th>
		<th><?php __('New Asset Code'); ?></th>
		<th><?php __('Asset Name'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Book Value'); ?></th>
		<th><?php __('Accum Dep'); ?></th>
		<th><?php __('Notes'); ?></th>
		<!--th class="actions"><?php __('Actions');?></th-->
	</tr>
	<?php
		$i = 0;
		foreach ($movement['MovementDetail'] as $movementDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
		
		<?php //list($code, $name, $price, $date_of_purchase, $book_value) = explode ('|', $movementDetail['asset_name'])?>
			<td><?php echo $i;?></td>
			<td class="left"><?php echo $assetCategories[$movementDetail['asset_category_id']];?></td>
			<td class="left"><?php echo $movementDetail['code'] ;?></td>
			<td class="left"><?php echo $movementDetail['new_code'] ;?></td>
			<td class="left"><?php echo $movementDetail['name'] ;?></td>
			<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $movementDetail['date_of_purchase']) ;?></td>
			<td class="number"><?php echo $this->Number->format($movementDetail['price']) ;?></td>
			<td class="number"><?php echo $this->Number->format($movementDetail['book_value']) ;?></td>
			<td class="number"><?php echo $this->Number->format($movementDetail['accum_dep']) ;?></td>
			<td class="left"><?php echo $movementDetail['notes'] ;?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<?php if($can_edit) : ?>
			<li><?php echo $this->Html->link(__('New Movement Detail', true), array('controller' => 'movement_details', 'action' => 'add')); ?> </li>
			<?php endif;?>
		</ul>
	</div>
</div>

<div>
	<h3><?php __('Notes'); ?></h3>
	<pre><?php echo $movement['Movement']['notes']; ?></pre>
	<p>&nbsp;</p>
</div>
