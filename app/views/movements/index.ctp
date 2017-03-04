<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);	
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div id="fieldfilter">
		<fieldset>
			<legend><?php __('Movement Filters')?></legend>
			<?php echo $this->Form->create('Movement', array('action'=>'index')) ?>
			<fieldset class="subfilter" style="width:27%">
				<legend><?php __('Document Info')?></legend>
				<?php echo $this->Form->input('movement_status_id',array('options'=>$movement_statuses,'empty'=>'all','value'=>$movement_status_id)) ?>
				<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
				<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
			</fieldset>
			<fieldset class="subfilter" style="width:20%">
				<legend><?php __('Source')?></legend>
				<?php echo $this->Form->input('source_department_id',array('label'=>'Source Branch', 'options'=>$departments,'empty'=>'all','value'=>$movement_department_id)) ?>
				<?php echo $this->Form->input('source_business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$movement_business_id)) ?>
				<?php echo $this->Form->input('source_cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
				<?php echo $this->Form->input('SourceCostCenter.name', array('label'=>'Source Cost Center', 'style'=>'width:100%')); ?>
				<div id="source_cost_center_choices" class="auto_complete"></div> 
				<script type="text/javascript"> 
					//<![CDATA[
					new Ajax.Autocompleter('SourceCostCenterName', 'source_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_source', {afterUpdateElement : setSourceCostCenterValues});
					//]]>
				</script>
			</fieldset>
			<fieldset class="subfilter" style="width:20%">
				<legend><?php __('Destination')?></legend>
				<?php echo $this->Form->input('dest_department_id',array('label'=>'Dest Branch', 'options'=>$departments,'empty'=>'all','value'=>$dest_department_id)) ?>
				<?php echo $this->Form->input('dest_business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$dest_business_type_id)) ?>
				<?php echo $this->Form->input('dest_cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
				<?php echo $this->Form->input('DestCostCenter.name', array('label'=>'Dest Cost Center', 'style'=>'width:100%')); ?>
				<div id="dest_cost_center_choices" class="auto_complete"></div> 
				<script type="text/javascript"> 
					//<![CDATA[
					new Ajax.Autocompleter('DestCostCenterName', 'dest_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_destination', {afterUpdateElement : setDestCostCenterValues});
					//]]>
				</script>
				<? //echo $form->input('source_department_sub_id', array('options'=>$departmentSub, 'empty'=>'','value'=>$movement_department_sub_id)); ?>
				<? //echo $form->input('source_department_unit_id', array( 'options'=>$departmentUnit, 'empty'=>'','value'=>$movement_department_unit_id)); ?>
					<?	/* $options = array('url' => 'getSourceDepartmentSubId', 
						'indicator'=>'LoadingDiv', 'update' => 'MovementSourceDepartmentSubId');
						echo $ajax->observeField('MovementSourceDepartmentId', $options);
						
						$options = array('url' => 'getSourceDepartmentUnitId', 
						'indicator'=>'LoadingDiv', 'update' => 'MovementSourceDepartmentUnitId');
						echo $ajax->observeField('MovementSourceDepartmentSubId', $options); */
					?>
			</fieldset>
			<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
			<?php echo $this->Form->submit('Refresh') ?>
			<?php echo $this->Form->end() ?>
		</fieldset>
	</div>
</div>

<div class="movement related">
	<h2><?php __('Movement');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('doc_date');?></th>
			<th><?php echo $this->Paginator->sort('doc_no');?></th>
			<th><?php echo $this->Paginator->sort('origin_branch');?></th>
			<th><?php echo $this->Paginator->sort('destination_branch');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('movement_status_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$group_id=$this->Session->read('Security.permissions');
	foreach ($movements as $movement):
		$class = null;
		$can_edit 		= $movement['Movement']['movement_status_id']==status_movement_new_id && ($group_id==fa_management_group_id || $group_id==it_management_group_id );
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	$can_delete_movement = false;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $movement['Movement']['doc_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $movement['Movement']['no']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($departments[$movement['Movement']['source_department_id']], array('controller' => 'departments', 'action' => 'view', $movement['Movement']['source_department_id'])); ?>
		</td>
		<td class="left">
			<?php echo $this->Html->link($departments[$movement['Movement']['dest_department_id']], array('controller' => 'departments', 'action' => 'view', $movement['Movement']['dest_department_id'])); ?>
		</td>
		<td class="left"><?php echo $movement['Movement']['created_by']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $movement['MovementStatus']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $movement['Movement']['id'])); ?>
			
			<?php if($can_edit) :?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $movement['Movement']['id'])); ?>
			<?php endif; ?>
		</td>
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
