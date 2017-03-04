<div class="invoices form">
<?php echo $this->Form->create('Invoice');?>
	<fieldset>
 		<legend><?php __('Edit Invoice'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//if($can_edit_no)
			//echo $this->Form->input('no');
		if($can_edit_no)
			echo $this->Form->input('no');
		else
			echo $this->Form->input('no', array('readonly'=>true));
		
		echo $this->Form->input('inv_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		if($is_from_po)
		{
			echo $this->Form->input('supplier_id', array('type'=>'hidden'));
			echo $this->Form->input('supplier_name', array('readonly'=>true, 'type'=>'text','value'=>$supplier_name, 'style'=>'width:35%'));
		}
		else
		{
			echo $this->Form->input('supplier_id', array('options'=>$suppliers));
		}
		
		if($can_edit_wht)
		{
			echo $this->Form->input('wht_rate');
		}
		else
		{
			echo $this->Form->input('wht_rate', array('type'=>'hidden'));
		}
		
		echo $this->Form->input('vat_rate', array('readonly'=>true));
		//echo $this->Form->input('department_id', array('options'=>$departments));
		echo $this->Form->input('description', array('style'=>'width:98%'));
		echo $this->Form->input('sub_total', array('readonly'=>true, 'value'=>round($this->data['Invoice']['vsubtotal'])));
		if($is_from_po){
			if($this->data['Invoice']['currency_id'] == 1){
				echo $this->Form->input('currency_id',array('options'=>$currencies,'empty'=>'-', 'disabled'=>'disabled')) ;
			}else{
				echo $this->Form->input('currency_id',array('options'=>$currencies,'empty'=>'-')) ;
			}			 
		}else{
			echo $this->Form->input('currency_id',array('options'=>$currencies,'empty'=>'-')) ;
		}
		
		echo $this->Form->input('rp_rate', array('value'=>abs($this->data['Invoice']['rp_rate'])));
		
		if($this->Session->read('Security.premissions')==admin_group_id)
		{
			echo $this->Form->input('discount');
			echo $this->Form->input('vat_rate');
			echo $this->Form->input('wht_rate');
			echo $this->Form->input('vat_base');
			echo $this->Form->input('wht_base');		
			echo $this->Form->input('vat_total');
			echo $this->Form->input('wht_total');
			echo $this->Form->input('total');
		}
		
		//   echo $this->Form->input('paid_date', array('emtpy'=>'enter date'));
		echo $this->Form->input('select_details_from_po', array('type'=>'hidden','value'=>0));		
	?>
	      
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($this->Session->read('Security.permissions') == gs_group_id) :?>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Invoice.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Invoice.id'))); ?></li>
		<?php endif;?>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'view', $this->Form->value('Invoice.id'))); ?></li>
	</ul>
</div>