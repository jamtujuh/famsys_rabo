<div class="outlogs form">
<?php echo $this->Form->create('Outlog');?>
	<fieldset>
 		<legend><?php __('Add Delivery'); ?></legend>
	<?php
		//echo $this->Form->input('id');
		echo $this->Form->input('outlog_status_id', array('type'=>'hidden','value'=>status_outlog_draft_id));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('date', array('type'=>'date', 'value'=>date("Y-m-d")));
		
		if(!empty($npb) )
		{
			echo $this->Form->input('department_id', array('value'=>$npb['Npb']['department_id'],'type'=>'hidden')); 
			echo $this->Form->input('department_name', array('value'=>$npb['Department']['name'],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
			echo $this->Form->input('business_type_id', array('value'=>$npb['Npb']['business_type_id'],'type'=>'hidden')); 
			echo $this->Form->input('business_type_name', array('value'=>$npb['BusinessType']['name'],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
			echo $this->Form->input('cost_center_id', array('value'=>$npb['Npb']['cost_center_id'],'type'=>'hidden')); 
			echo $this->Form->input('cost_center_name', array('value'=>$npb['CostCenter']['name'],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
			//echo $this->Form->input('stock_qty', array('value'=>$npb['Item']['balance'],'type'=>'text','readonly'=>true, 'style'=>'width:5%')); 
			//echo $this->Form->input('stock_status', array('value'=>$npb['Item']['stock_status'],'type'=>'hidden')); 
			//echo $this->Form->input('qty_request', array('value'=>$npb['NpbDetail'][0]['qty'],'style'=>'width:5%','readonly'=>true)); 
			//echo $this->Form->input('qty_unfilled', array('value'=>$npb['NpbDetail'][0]['qty_unfilled'],'style'=>'width:5%','readonly'=>true)); 
			echo $this->Form->input('asset_category', array('value'=>$npb['Item']['asset_category'],'type'=>'hidden')); 
			//echo $this->Form->input('qty_fill', array('type'=>'text','style'=>'width:5%','maxlength'=>'20','label'=>__('Qty',true).' Fill')); 
			echo $this->Form->input('npb_id', array('value'=>$npb['Npb']['id'],'type'=>'hidden')); 
			echo $this->Form->input('npb_no', array('value'=>$npb['Npb']['no'],'type'=>'text','readonly'=>true,'label'=>__('Npb',true).' No')); 
		}
		else
		{
			echo $this->Form->input('npb_id', array('value'=>0,'type'=>'hidden')); 
			echo $this->Form->input('department_id', array('options'=>$departments, 'empty'=>'select branch'));
		}
		echo $this->Form->input('notes', array('style'=>'width:98%', 'maxlength'=>'255'));
		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"),'type'=>'hidden'));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Outlogs', true), array('action' => 'index'));?></li>
	</ul>
</div>
