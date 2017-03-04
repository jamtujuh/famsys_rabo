<div class="pos index">
	<fieldset>
	<legend><?php __('Report Order' ) ?></legend>
	<?php echo $this->Form->create('Po', array('action'=>'report_order')) ?>
	<?php echo $form->input('year', array( 'label' => 'Acquisition Year', 'value'=>$this->Session->read('ReportOrder.year'), 'style'=>'width:50px')); ?>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
	<?php echo $this->Form->end('Refresh') ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New PO', true), array('action' => 'po_type')); ?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List PO Details', true), array('controller' => 'po_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New PO Detail', true), array('controller' => 'po_details', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h2><?php __('Report Order');?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('Supplier');?></th>
			<th><?php echo $this->Paginator->sort('Jenis Barang');?></th>
			<th><?php echo $this->Paginator->sort('Mata Uang');?></th>
			<th><?php echo $this->Paginator->sort('Jan');?></th>
			<th><?php echo $this->Paginator->sort('Feb');?></th>
			<th><?php echo $this->Paginator->sort('Mar');?></th>
			<th><?php echo $this->Paginator->sort('Apr');?></th>
			<th><?php echo $this->Paginator->sort('May');?></th>
			<th><?php echo $this->Paginator->sort('Jun');?></th>
			<th><?php echo $this->Paginator->sort('Jul');?></th>
			<th><?php echo $this->Paginator->sort('Aug');?></th>
			<th><?php echo $this->Paginator->sort('Sep');?></th>
			<th><?php echo $this->Paginator->sort('Okt');?></th>
			<th><?php echo $this->Paginator->sort('Nov');?></th>
			<th><?php echo $this->Paginator->sort('Dec');?></th>
			<th><?php echo $this->Paginator->sort('Total');?></th>
			
	</tr>
	<?php
	$i = 0;
	$id_group=$this->Session->read('Security.permissions');
	
	foreach ($pos as $po):
		$class = null;
		$can_edit 		= $po['Po']['po_status_id']==status_po_draft_id && $id_group==gs_group_id;
		$can_receive 	= $po['Po']['po_status_id']==status_po_sent_id && $id_group==gs_group_id;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr <?php echo $class;?>
	    <td> <?php echo $i ?>&nbsp;</td>
		<td>
		<?php echo $this->Html->link($po['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $po['Supplier']['id'])); ?>
		</td>
	
		
		<?php foreach ($po['PoDetail'] as $j=>$d) : ?>
			<?php if($j==0) :?>
				<td>
					<?php echo $d['name']?>
				</td>
					<?php else :?>
				<tr>
				<td colspan="2"></td>
				<td>
					<?php echo $d['name']?>
				</td>
				</tr> 
			<?php endif ?>
			
			<?php if($j==0) :?>
			   <td>
					<?php echo $po['Currency']['name'] ?>
			  </td>
			<?php else :?>
			  <tr>
			  <td colspan="3"></td>
			  <td>
			<?php echo $po['Currency']['name'] ?>
			 </td>
			 </tr>
			<?php endif ?>
		 
		 <?php if($i==0) :?>
			<td>
				<?php echo $po['v_month']?>
			</td>
				<?php else :?>
			<tr>
			<td colspan="4"></td>
			<td>
				<?php echo $po['v_month']?>
			</td>
			</tr>
				 
		<?php endif ?>
		
	    <?php if($j==0) :?>
		    <td>
				<?php echo $d['qty']?>
			</td>
				<?php else :?>
			<tr>
			<td colspan="5"></td>
			<td>
				<?php echo $d['qty']?>
			</td>
			</tr>
				 

		<?php endif ?>
				
		<?php if($j==0) :?>
			<td>
				<?php echo $d['qty']?>
			</td>
				<?php else :?>
			<tr>
			<td colspan="6"></td>
			<td>
				<?php echo $d['qty']?>
			</td>
			</tr>
				 
		<?php endif ?>
				
			
	  <?php endforeach; ?>
	 
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