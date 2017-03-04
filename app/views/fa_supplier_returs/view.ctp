<?php
$can_edit	= $this->Session->read('FaSupplierRetur.can_edit');
$can_replacement	= $this->Session->read('FaSupplierRetur.can_replacement');
$can_pdf	= $this->Session->read('FaSupplierRetur.can_pdf');

?>
<div class="faSupplierReturs view">
<h2><?php  __('Fa Supplier Retur');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $faSupplierRetur['FaSupplierRetur']['doc_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['FaSupplierRetur']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PO No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['Po']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['CostCenter']['cost_centers']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['FaSupplierRetur']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fa Supplier Retur Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['FaSupplierReturStatus']['name']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($faSupplierRetur['FaSupplierRetur']['approved_by'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['FaSupplierRetur']['approved_by']; ?>
			&nbsp;
		<?php endif; ?>
		</dd>
		<?php if(!empty($faSupplierRetur['FaSupplierRetur']['approved_date'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierRetur['FaSupplierRetur']['approved_date']; ?>
			&nbsp;
		<?php endif; ?>
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) :?>
		<li><?php echo $this->Html->link(__('Edit Fa Supplier Retur', true), array('action' => 'edit', $faSupplierRetur['FaSupplierRetur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fa Supplier Retur', true), array('action' => 'delete', $faSupplierRetur['FaSupplierRetur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faSupplierRetur['FaSupplierRetur']['id'])); ?> </li>
		<?php endif;?>
	</ul>
</div>

<div class="doc_actions">
	<ul>
		<?php if($approveLink):?>
			<li><?php echo $this->Html->link($approveLink['label'],$approveLink['options']) ?></li>
		<?php endif;?>
		
		<?php if($can_replacement):?>
			<li><?php echo $this->Html->link(__('Process Replacement', true), array('action'=>'replacement', $faSupplierRetur['FaSupplierRetur']['id'])) ?></li>
		<?php endif;?>
		
		<?php if($can_pdf):?>
			<li><?php echo $this->Html->link(__('Print Supplier Retur', true), array('action'=>'view_pdf', $faSupplierRetur['FaSupplierRetur']['id'])) ?></li>
		<?php endif;?>		
		
		<li><?php echo $this->Html->link(__('Back',true),array('action'=>'index')) ?></li>
	</ul>
</div>


<div class="related">
	<h3><?php __('Related Fa Supplier Retur Details');?></h3>
	<?php if (!empty($faSupplierRetur['FaSupplierReturDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('No Inventaris'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('name'); ?></th>
		<th><?php __('Brand'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color'); ?></th>
		<th><?php __('Serial No'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
		<th><?php __('Notes'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($faSupplierRetur['FaSupplierReturDetail'] as $faSupplierReturDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $myApp->showArrayValue($assetCategory,$faSupplierReturDetail['asset_category_id']);?></td>
			<td><?php echo $faSupplierReturDetail['code'];?></td>
			<td><?php echo $faSupplierReturDetail['item_code'];?></td>
			<td><?php echo $faSupplierReturDetail['name'];?></td>
			<td><?php echo $faSupplierReturDetail['brand'];?></td>
			<td><?php echo $faSupplierReturDetail['type'];?></td>
			<td><?php echo $faSupplierReturDetail['color'];?></td>
			<td><?php echo $faSupplierReturDetail['serial_no'];?></td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $faSupplierReturDetail['date_of_purchase']);?></td>
			<td class="left"><?php echo $faSupplierReturDetail['notes'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<?php if($can_edit) :?>	
			<li><?php echo $this->Html->link(__('New Fa Supplier Retur Detail', true), array('controller' => 'fa_supplier_retur_details', 'action' => 'add'));?> </li>
			<?php endif;?>
		</ul>
	</div>
</div>
<div>
      <h3><?php __('Notes'); ?></h3>
      <div id="notes"><pre><?php echo $faSupplierRetur['FaSupplierRetur']['notes']; ?></pre></div>

</div>
