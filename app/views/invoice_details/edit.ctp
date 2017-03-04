<div class="invoiceDetails form">
<?php echo $this->Form->create('InvoiceDetail');?>
	<fieldset>
 		<legend><?php __('Edit Invoice Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('invoice_id', array('type'=>'hidden'));
		echo $this->Form->input('asset_category_id', array('options'=>$assetCategories,'empty'=>'select a category'));
		echo $this->Form->input('umurek', array('readonly'=>true) );
		echo $this->Form->input('name', array('style'=>'width:98%'));
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('color');
		echo $this->Form->input('qty' );
		echo $this->Form->input('price_cur');
		echo $this->Form->input('price');	
		echo $this->Form->input('discount_cur');
		echo $this->Form->input('discount');
		echo $this->Form->input('is_vat');
		echo $this->Form->input('is_wht');
		echo $this->Form->input('vat_rate', array('type'=>'hidden', 'value'=>$this->Session->read('Invoice.vat_rate')));
		echo $this->Form->input('wht_rate', array('type'=>'hidden', 'value'=>$this->Session->read('Invoice.wht_rate')));
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('InvoiceDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('InvoiceDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Invoice Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>