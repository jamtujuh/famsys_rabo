<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit = $this->Session->read('Po.can_edit');
?>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($po['Department']['name'], array('controller' => 'departments', 'action' => 'view', $po['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $po['PoStatus']['name']; ?>
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
			<div id="PoTotalDiv"><?php echo $this->Number->format($po['Po']['total']); ?></div>
		</dd>

	</dl>

	<div class="doc_actions">
		<ul>
			
			<?php if($this->Session->read('Po.can_print')) :?>
				<li><?php echo $this->Html->link(__('Print PO', true), array('action' => 'view_pdf', $po['Po']['id'])); ?> </li>
			<?php endif;?>
			<?php if($this->Session->read('Po.can_invoice')) :?>
				<li><?php echo $this->Html->link(__('Input Invoice', true), array('controller'=>'invoices','action' => 'add', $po['Po']['id'])); ?> </li>
			<?php endif;?>
			<li><?php echo $this->Html->link(__('Back', true), array('action' => 'view', $po['Po']['id'])); ?> </li>
			
		</ul>
	</div>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
	</ul>
</div>


<div class="related">
	<h3><?php __('PO Item Received');?></h3>
	<?php if (!empty($po['PoDetail'])):?>	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Qty Received'); ?></th>
		<th><?php __('Out Standing'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($po['PoDetail'] as $poDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
		
		<?php $out_standing=$poDetail['qty']-$poDetail['qty_received'];?>
		
			<td><?php echo $i;?></td>
			<td><?php echo $assetCategories[ $poDetail['asset_category_id'] ];?></td>
			<td class="left"><?php echo $poDetail['name'];?></td>
			<td><?php echo $poDetail['qty'];?></td>
			<td><?php echo $poDetail['qty_received'];?></td>
			<td><?php echo $out_standing;?></td>
			
			<td class="actions">
			<?php if($can_edit) : ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'po_details', 'action' => 'edit', $poDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'po_details', 'action' => 'delete', $poDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poDetail['id'])); ?>
			<?php endif;?>
			<?php echo $this->Html->link(__('Edit', true), array('controller' => 'po_details', 'action' => 'edit_received', $poDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
	</table>

<?php endif; // empty ?>

</div>


<div class="related">
	<h3><?php __('Description'); ?></h3>
	<div><?php echo $po['Po']['description']; ?></div>
	<p>&nbsp;</p>
</div>
