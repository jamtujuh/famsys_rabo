<div class="inlogs form">
<?php echo $this->Form->create('Inlog');?>
	<fieldset>
 		<legend><?php __('Add Inlog'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('date', array('type'=>'date', 'value'=>date("Y-m-d")));
		if($invoice_id)
		{
			echo $this->Form->input('invoice_no', array('readonly'=>true, 'value'=>$invoice_no, 'style'=>'width:50%'));
			echo $this->Form->input('invoice_id', array('type'=>'hidden', 'value'=>$invoice_id));
		}
		else
			echo $this->Form->input('invoice_id', array('type'=>'hidden', 'value'=>0));
			
		if($delivery_order_id)
		{
			echo $this->Form->input('delivery_order_no', array('readonly'=>true, 'value'=>$delivery_order_no, 'style'=>'width:50%'));
			echo $this->Form->input('delivery_order_id', array('type'=>'hidden', 'value'=>$delivery_order_id));
		}
		else
			echo $this->Form->input('delivery_order_id', array('type'=>'hidden', 'value'=>0));
			
		if($po_id)
		{
			echo $this->Form->input('po_no', array('readonly'=>true, 'value'=>$po_no, 'style'=>'width:50%'));
			echo $this->Form->input('po_id', array('type'=>'hidden', 'value'=>$po_id));
		}
		else
			echo $this->Form->input('po_id', array('type'=>'hidden', 'value'=>0));			
			
		if($supplier_id)
		{
			echo $this->Form->input('supplier_name', array('readonly'=>true, 'value'=>$supplier_name, 'style'=>'width:50%'));
			echo $this->Form->input('supplier_id', array('type'=>'hidden', 'value'=>$supplier_id));
		}
		else
			echo $this->Form->input('supplier_id', array('options'=>$suppliers, 'empty'=>'select supplier'));

		echo $this->Form->input('department_id', array('value'=>$this->Session->read('Userinfo.department_id'),'type'=>'hidden'));
		echo $this->Form->input('business_type_id', array('value'=>$this->Session->read('Userinfo.business_type_id'),'type'=>'hidden'));
		echo $this->Form->input('cost_center_id', array('value'=>$this->Session->read('Userinfo.cost_center_id'),'type'=>'hidden'));
		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"),'type'=>'hidden'));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Inlogs', true), array('action' => 'index'));?></li>
	</ul>
</div>