<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>
<div class="disposals form">
<?php echo $this->Form->create('Disposal');?>
	<fieldset>
 		<legend><?php __('Edit Disposal '.  ucwords($types[$type])); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden', 'readonly'=>true));
		echo $this->Form->input('doc_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		//echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('department_id', array('options'=>$departments, 'disabled'=>true));
		echo $this->Form->input('business_type_id', array('options'=>$businessTypes, 'empty'=>'select business type', 'disabled'=>true));
		//echo $this->Form->input('cost_center_id', array('options'=>$costCenters, 'empty'=>'select cost center'));
		echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden'));
		echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:50%', 'disabled'=>true));
	?>
		<div id="cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setDisposalCostCenterValues});
			//]]>
		</script>
	<?php
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
		echo $this->Form->input('disposal_status', array('type'=>'text','readonly'=>true, 'value'=>$statuses[status_disposal_new_id]));
		echo $this->Form->input('disposal_status_id', array('type'=>'hidden', 'value'=>status_disposal_new_id));
		//echo $this->Form->input('disposal_status_id', array('options'=>$statuses));
		//echo $this->Form->input('disposal_type_id', array('options'=>$types));
		echo $this->Form->input('disposal_type', array('type'=>'text','readonly'=>true, 'value'=>$types[$type]));
		echo $this->Form->input('disposal_type_id', array('type'=>'hidden','readonly'=>true, 'value'=>$type));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Disposal.y')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Disposal.y'))); ?></li>
		<li><?php echo $this->Html->link(__('List Disposals', true), array('action' => 'index'));?></li>
	</ul>
</div>