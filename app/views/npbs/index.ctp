<?php
//	echo $javascript->link('prototype',false);
//	echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
	<?php echo $this->Form->create('Npb', array('action'=>'index')) ?>
	<legend><?php __('NPB Filters')?></legend>	
	<fieldset class="subfilter">
	<legend><?php __('MR Status Info')?></legend>
	<?php echo $this->Form->input('request_type_id',array('options'=>$requestTypes,'empty'=>'all')) ?>
	<?php echo $this->Form->input('is_done',array('options'=>array('0'=>'All','Yes','No'),'value'=>$this->Session->read('Npb.is_done'))) ?>
	<?php echo $this->Form->input('npb_status_id',array('empty'=>'all', 'value'=>$this->Session->read('Npb.npb_status_id'))) ?>
	<?php echo $this->Form->input('no',array('value'=>$this->Session->read('Npb.no'))) ?>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Branch Filter') ?></legend>
	<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
		<?php echo $this->Form->input('department_name',array('style'=>'width:50%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
	<?php else : ?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all')) ?>	
	<?php endif; ?>
		<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all')) ?>
		<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
		<div id="cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setNpbCostCenterValues});
			//]]>
		</script>
	<? //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('Npb.department_Sub_id'),'empty'=>''  )); ?>
	<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('Npb.department_unit_id'), 'empty'=>''  )); ?>		
		<?	/* $options = array('url' => '/departments/getDepartmentSubId/Npb', 
			'indicator'=>'LoadingDiv', 'update' => 'NpbDepartmentSubId');
			echo $ajax->observeField('NpbDepartmentId', $options);
			
			$options = array('url' => '/department_subs/getDepartmentUnitId/Npb', 
			'indicator'=>'LoadingDiv', 'update' => 'NpbDepartmentUnitId');
			echo $ajax->observeField('NpbDepartmentSubId', $options); */
		?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?>
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Npb', true) . ' IT', array('action' => 'add/1')); ?></li>
		<li><?php //echo $this->Html->link(__('New Npb', true) . ' GS', array('action' => 'add/2')); ?></li>
		<li><?php //echo $this->Html->link(__('New Npb', true) . ' Stock', array('action' => 'add/3')); ?></li>
		<li><?php //echo $this->Html->link(__('New Npb', true) . ' Service', array('action' => 'add/4')); ?></li>
		<li><?php echo $this->Html->link(__('Npb List', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Npb Finish', true), array('action' => 'npb_report/finish')); ?></li>
		<li><?php echo $this->Html->link(__('Npb Outstanding', true), array('action' => 'npb_report/outstanding')); ?></li>
	</ul>
</div>
</div>
<div class="npbs related">
	<h2><?php __('Npbs');?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
		<?php
			if ($this->Session->read('Npb.npb_status_id') == 20){
		?>	
			<th><?php echo 'Approve';?></th>
		<?php
			}else{
		?>
			<th><?php echo $this->Paginator->sort('No');?></th>
		<?php
			}
		?>
			<th><?php echo $this->Paginator->sort('no_mr');?></th>
			<th><?php echo $this->Paginator->sort('npb_date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('req_date');?></th>
			<th><?php echo $this->Paginator->sort('npb_status_id');?></th>
			<th><?php echo $this->Paginator->sort('request_type_id');?></th>
			<!--th><?php echo $this->Paginator->sort('v_total');?> (Rp)</th-->
			<th><?php echo $this->Paginator->sort('is_done');?></th>
			<th><?php echo $this->Paginator->sort('approved_by');?></th>
			<th><?php echo $this->Paginator->sort('approved_date');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php echo $this->Form->create('Npb');?>
	<?php echo $this->Form->input('npb_status_id', array('value'=>$this->Session->read('Npb.npb_status_id'), 'type'=>'hidden' )); ?>
	<?php echo $this->Form->input('status_id_update', array('value'=>30, 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('layout', array('value'=>'screen', 'type'=>'hidden')); ?>
	<?php
	$i = 0;
	//debug($npbs);
	foreach ($npbs as $npb):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$group_id 	= $this->Session->read('Security.permissions');
		$can_edit_npb = ($npb['Npb']['npb_status_id'] == status_npb_draft_id ? true: false) && $group_id == normal_user_group_id;
		$can_delete_npb = false;
		
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php
			if ($this->Session->read('Npb.npb_status_id') == 20){
		?>	
		<?php 
			echo $this->Form->input('select_detail', 
				array(
					'hiddenField'=>false,
					'label'=>'',
					'checked'=>false,
					'type'=>'checkbox', 
					'value'=>$npb['Npb']['id'],
					'name'=>'data[Npb][npb_id][]')) ;
			}else{
		?>
			<?php echo $i; ?>&nbsp;
		<?php
			}
		?>	
		</td>
		<td class="left"><?php echo $npb['Npb']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['npb_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $npb['Department']['name']; ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['req_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $npb['NpbStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $npb['RequestTypes']['name']; ?>&nbsp;</td>
		<!--td class="number"><?php echo $this->Number->format($npb['Npb']['v_total']); ?>&nbsp;</td-->

		<td class="center"><?php echo $this->Html->image($npb['Npb']['v_is_done'] . ".gif"); ?>&nbsp;</td>

		<td class="left"><?php echo ucwords($npb['Npb']['approved_by']); ?>&nbsp;</td>
		<td class="left"><?php echo $npb['Npb']['approved_date']; ?>&nbsp;</td>
		<td class="left"><?php echo $npb['Npb']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $npb['Npb']['id'])); ?>
			
			<?php if ($npb['Npb']['request_type_id'] == request_type_point_reward_id && strpos($npb['Npb']['no'],'MR-RAC-C') == false){
					$found = 0; 
					foreach($can_print_status as $find){
						if($found == 0){
							if($find[0]['source_npb_id'] == $npb['Npb']['id']){
								$found = 1;
								echo $this->Html->link(__('Print PDF', true), array('action' => 'print_to_pdf', $npb['Npb']['id']));
							};
						};
					};
				}; 
			?>			
			<?php if ($can_edit_npb) : ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $npb['Npb']['id'])); ?>
			<?php endif; ?>

			<?php if ($can_delete_npb) : ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $npb['Npb']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npb['Npb']['id'])); ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
	<?php
		if ($this->Session->read('Npb.npb_status_id') == 20){ ?>
			<tr>		
				<td colspan="1"><?php echo $this->Form->end(__('Submit', true));?></td>
			</tr>
		<?php };?>	
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
