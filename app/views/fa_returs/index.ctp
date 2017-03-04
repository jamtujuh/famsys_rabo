<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('FaRetur') ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Fa Retur Filters') ?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Branch Filter')?></legend>
	<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
		<?php echo $this->Form->input('department_name',array('style'=>'width:100%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
	<?php else : ?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'All', 'value'=>$department_id)) ?>		
	<?php endif  ;?>
		<?php echo $this->Form->input('business_type_id',array('options'=>$businessTypes,'empty'=>'All', 'value'=>$business_type_id)) ?>		
		<?php echo $this->Form->input('cost_center_id', array('type'=>'hidden', 'empty'=>'All')); ?>
		<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
		<div id="cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setFaReturCostCenterValues});
			//]]>
		</script>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Fa Retur Info') ?></legend>
	<?php echo $this->Form->input('fa_retur_status_id', array('options'=>$faReturStatuses, 'empty'=>'Select Retur Status', 'value'=>$fa_retur_status_id)); ?>
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
		<li><?php echo $this->Html->link(__('List Asset Detail', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
	</ul>
</div>
</div>
<div class="related">

	<h2><?php __('Fa Returs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('doc_date');?></th>
			<th><?php echo $this->Paginator->sort('no_retur');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('fa_retur_status_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$group_id=$this->Session->read('Security.permissions');
	foreach ($faReturs as $faRetur):
		$class = null;
		$can_edit 		= $faRetur['FaRetur']['fa_retur_status_id']==status_fa_retur_draft_id && $group_id==normal_user_group_id;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $faRetur['FaRetur']['doc_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $faRetur['FaRetur']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $faRetur['Department']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $faRetur['BusinessType']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $faRetur['CostCenter']['cost_centers']; ?>-<?php echo $faRetur['CostCenter']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $faRetur['FaRetur']['created_by']; ?>&nbsp;</td>
		<td class="left"><?php echo $faRetur['FaReturStatus']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $faRetur['FaRetur']['id'])); ?>
			<?php if($can_edit) :?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $faRetur['FaRetur']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $faRetur['FaRetur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faRetur['FaRetur']['id'])); ?>
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