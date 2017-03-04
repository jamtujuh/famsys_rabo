<div class="process view">
	<h2><?php __('Inventory ledger process complete') ?></h2>
	<p><?php __('You can see the inventory ledger list now.') ?></p>
	<div class="doc_actions">
		<ul>
			<li><?php echo $this->Html->link(__('List Stock Ledger', true), array('action' => 'index'));?></li>
			<?php if($this->Session->check('Outlog.id')) :?>
			<li><?php echo $this->Html->link(__('View Outlog', true), array('controller'=>'outlogs','action' => 'view',$this->Session->read('Outlog.id')));?></li>
			<?php endif; ?>
			
			<?php if($this->Session->check('Inlog.id')) :?>
			<li><?php echo $this->Html->link(__('View Inlog', true), array('controller'=>'inlogs','action' => 'view',$this->Session->read('Inlog.id')));?></li>
			<?php endif; ?>

			<?php if($this->Session->check('SupplierRetur.id')) :?>
			<li><?php echo $this->Html->link(__('View Supplier Retur', true), array('controller'=>'supplier_returs','action' => 'view',$this->Session->read('SupplierRetur.id')));?></li>
			<?php endif; ?>

			<?php if($this->Session->check('Retur.id')) :?>
			<li><?php echo $this->Html->link(__('View Retur', true), array('controller'=>'returs','action' => 'view',$this->Session->read('Retur.id')));?></li>
			<?php endif; ?>			
		</u>
	</div>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><? echo $this->Html->link(__('Home', true), '/pages/home' ); ?></li>
		<li><?php echo $this->Html->link(__('List Stock Ledgers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Outlog', true), array('controller'=>'outlogs','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inlog', true), array('controller'=>'inlogs','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List MR Outstanding', true), array('controller'=>'npbs','action' => 'npb_report/outstanding'));?></li>
	</ul>
</div>