<?php 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div class="movements form">
<?php echo $this->Form->create('Movement');?>
	<fieldset>
 		<legend><?php __('Add Movement'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden', 'readonly'=>true));
		echo $this->Form->input('doc_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		//debug($this->Session->read('Npb.department_id'));
	?>
	<table width="100">
	<tr>
	
	<?php if ($this->Session->read('Npb.department_id') !=0) { ?>
	<td>
	<?php
		echo $this->Form->input('dest_branch', array('label'=>'Dest Branch', 'style'=>'width:80%','type'=>'text','readonly'=>true, 'value'=>$departments[$this->Session->read('Npb.department_id')]));
		echo $this->Form->input('dest_department_id', array('label'=>'Dest Branch', 'type'=>'hidden', 'value'=>$this->Session->read('Npb.department_id')));
	?>
	</td>
	<?php }else if($this->Session->read('Npb.department_id') ==0) {?>
	<td>
	<?php
		echo $this->Form->input('dest_department_id', array('label'=>'Dest Branch', 'options'=>$departments, 'empty'=>'select Dest branch'));
	?>
	</td>
	<?php }?>
	
	<?php //if ($this->Session->read('Npb.department_sub_id') !=0) { ?>
	<!--<td>-->
	<?php
		//echo $this->Form->input('origin_department', array('label'=>'Origin Department', 'style'=>'width:80%','type'=>'text','readonly'=>true, 'value'=>$departmentSubs[$this->Session->read('Npb.department_sub_id')]));
		//echo $this->Form->input('source_department_sub_id', array('label'=>'Origin Department', 'type'=>'hidden', 'value'=>$this->Session->read('Npb.department_sub_id')));
	?>
	<!--</td>-->
	<?php //}else if($this->Session->read('Npb.department_sub_id') ==0) {?>
	<!--<td>-->
	<?php
		//echo $this->Form->input('source_department_sub_id', array('label'=>'Origin Department', 'empty'=>''));
	?>
	<!--</td>-->
	<?php //}?>
	
	<?php //if ($this->Session->read('Npb.department_unit_id') !=0) { ?>
	<!--<td>-->
	<?php
		///echo $this->Form->input('origin_unit', array('label'=>'Origin Unit', 'style'=>'width:80%','type'=>'text','readonly'=>true, 'value'=>$departmentUnits[$this->Session->read('Npb.department_unit_id')]));
		//echo $this->Form->input('source_department_unit_id', array('label'=>'Origin Unit', 'type'=>'hidden', 'value'=>$this->Session->read('Npb.department_unit_id')));
	?>
	<!--</td>-->
	<?php //}else if($this->Session->read('Npb.department_unit_id') ==0) {?>
	<!--<td>-->
	<?php
		//echo $this->Form->input('source_department_unit_id', array('label'=>'Origin Unit', 'empty'=>''));
	?>
	<!--</td>-->
	<?php //}?>
	
	<!--</tr>-->
	
	<!--<tr>-->
	<?php if ($this->Session->read('Npb.business_type_id') !=0) { ?>
	<td>
	<?php
		echo $this->Form->input('dest_business_type', array('label'=>'Dest Business Type', 'style'=>'width:80%', 'type'=>'text','readonly'=>true, 'value'=>$businessTypes[$this->Session->read('Npb.business_type_id')]));
		echo $this->Form->input('dest_business_type_id', array('label'=>'Dest Business Type', 'type'=>'hidden', 'value'=>$this->Session->read('Npb.business_type_id')));
	?>
	</td>
	<?php }else if($this->Session->read('Npb.business_type_id') ==0) {?>
	<td>
	<?php
		echo $this->Form->input('dest_business_type_id', array('label'=>'Dest Business Type', 'options'=>$businessTypes, 'empty'=>'select Dest business type'));
	?>
	</td>
	<?php }?>
	<!--</tr>-->
	
	<!--<tr>-->
	<?php if ($this->Session->read('Npb.cost_center_id') !=0) { ?>
	<td>
	<?php
		echo $this->Form->input('dest_cost_center', array('label'=>'Dest Cost Center', 'style'=>'width:80%', 'type'=>'text','readonly'=>true, 'value'=>$costCenters[$this->Session->read('Npb.cost_center_id')]));
		echo $this->Form->input('dest_cost_center_id', array('label'=>'Dest Cost Center', 'type'=>'hidden', 'value'=>$this->Session->read('Npb.cost_center_id')));
	?>
	</td>
	<?php }else if($this->Session->read('Npb.cost_center_id') ==0) {?>
	<td>
	<?php
		//echo $this->Form->input('source_cost_center_id', array('label'=>'Origin Cost Center', 'options'=>$costCenters, 'empty'=>'select source Cost Center'));
	?>
		<?php echo $this->Form->input('dest_cost_center_id', array('empty'=>'select Dest cost center', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('DestCostCenter.name', array('label'=>'Dest Cost Center', 'style'=>'width:100%')); ?>
		<div id="dest_cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('DestCostCenterName', 'dest_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_destination', {afterUpdateElement : setDestCostCenterMovementValues});
			//]]>
		</script>
	</td>
	<?php }?>
	</tr>
	
	<tr>
	<td>
	<?php
		echo $this->Form->input('source_department_id', array('label'=>'Origin Branch', 'options'=>$departments, 'empty'=>'select Origin branch'));
	?>
	</td>
	<!--<td>-->
	<?php
		//echo $this->Form->input('dest_department_sub_id', array('label'=>'Dest Department', 'empty'=>''));
	?>
	<!--</td>-->
	<!--<td>-->
	<?php
		//echo $this->Form->input('dest_department_unit_id', array('label'=>'Dest Unit', 'empty'=>''));
	?>
	<!--</td>-->
	<!--</tr>-->
	<!--<tr>-->
	<td>
	<?php
		echo $this->Form->input('source_business_type_id', array('label'=>'Origin Business Type', 'options'=>$businessTypes, 'empty'=>'select origin business type'));
	?>
	</td>
	<!--</tr>-->
	
	<!--<tr>-->
	<td>
	<?php
		//echo $this->Form->input('dest_cost_center_id', array('label'=>'Dest Cost Center', 'options'=>$costCenters, 'empty'=>'select dest cost center'));
	?>
		<?php echo $this->Form->input('source_cost_center_id', array('empty'=>'select origin cost center', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('SourceCostCenter.name', array('label'=>"Origin Cost Center<font color='red'>*</font>", 'style'=>'width:100%')); ?>
		<div id="source_cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('SourceCostCenterName', 'source_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_source', {afterUpdateElement : setSourceCostCenterMovementValues});
			//]]>
		</script>
	</td>
	</tr>
	</table>
	<?php
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
		echo $this->Form->input('movement_status', array('type'=>'text','readonly'=>true, 'value'=>$statuses[status_movement_new_id]));
		echo $this->Form->input('movement_status_id', array('type'=>'hidden', 'value'=>status_movement_new_id));
		//echo $this->Form->input('request_type', array('type'=>'text','readonly'=>true, 'value'=>$requestTypes[$this->Session->read('Npb.request_type_id')]));
		echo $this->Form->input('request_type_id', array('type'=>'hidden', 'value'=>$this->Session->read('Npb.request_type_id')));
		//echo $this->Form->input('npb', array('type'=>'text','readonly'=>true, 'value'=>$npbs[$this->Session->read('Npb.id')]));
		echo $this->Form->input('npb_id', array('type'=>'hidden', 'value'=>$this->Session->read('Npb.id')));
	?>
	<?php
		/* $options = array('url' => 'getSourceDepartmentSubId', 
		'indicator'=>'LoadingDiv', 'update' => 'MovementSourceDepartmentSubId');
		echo $ajax->observeField('MovementSourceDepartmentId', $options);
		
		$options = array('url' => 'getSourceDepartmentUnitId', 
		'indicator'=>'LoadingDiv', 'update' => 'MovementSourceDepartmentUnitId');
		echo $ajax->observeField('MovementSourceDepartmentSubId', $options);
		
		$options = array('url' => 'getDestDepartmentSubId', 
		'indicator'=>'LoadingDiv', 'update' => 'MovementDestDepartmentSubId');
		echo $ajax->observeField('MovementDestDepartmentId', $options);
		
		$options = array('url' => 'getDestDepartmentUnitId', 
		'indicator'=>'LoadingDiv', 'update' => 'MovementDestDepartmentUnitId');
		echo $ajax->observeField('MovementDestDepartmentSubId', $options); */
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Movements', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Movement Details', true), array('controller' => 'movement_details', 'action' => 'index')); ?> </li>
	</ul>
</div>