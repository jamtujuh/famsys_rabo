<div class="pos form">
<?php echo $this->Form->create('Po');?>
	<fieldset>
		<legend><?php __('Add PO From NPB'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text', 'value'=>$newId));
		echo $this->Form->input('po_date');
		echo $this->Form->input('supplier_id',array('options'=>$suppliers));
		echo $this->Form->input('department_id',array('options'=>$departments));
		echo $this->Form->input('description', array('style'=>'width:98%'));
	?>
	</fieldset>


	<div class="npbs index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo 	__('id');?></th>
				<th><?php echo __('department_id');?></th>
				<th><?php echo __('req_date');?></th>
				<th><?php echo __('status_id');?></th>
				<th><?php echo __('total');?></th>
				<th><?php echo __('total_cur');?></th>
				<th><?php echo __('created_by');?></th>
				<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($npbs as $npb):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $npb['Npb']['id']; ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($npb['Department']['name'], array('controller' => 'departments', 'action' => 'view', $npb['Department']['id'])); ?>
			</td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['req_date']); ?>&nbsp;</td>
			<td><?php echo $npb['Npb']['status_id']; ?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($npb['Npb']['total']); ?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($npb['Npb']['total_cur']); ?>&nbsp;</td>
			<td><?php echo $npb['Npb']['created_by']; ?>&nbsp;</td>
			
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller'=>'npbs','action' => 'view', $npb['Npb']['id'])); ?>
				<?php echo $this->Form->input('Npb.id', 
					array('type'=>'checkbox', 'name'=>'data[Po][Npb][id][]','value'=>$npb['Npb']['id'] )
				)?>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>
	</div>
<?php echo $this->Form->end('Convert to PO')?>
</div>
	
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Po Details', true), array('controller' => 'po_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po Detail', true), array('controller' => 'po_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
