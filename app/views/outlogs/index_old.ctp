<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<div id="moduleName"><?php echo 'Stock > List Delivery'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('Outlog', array('action'=>'index')) ?>
<fieldset>
 	<fieldset class="subfilter">
	<legend><?php __('Delivery Filters')?></legend>
	<?php echo $this->Form->input('outlog_status_id',array('empty'=>'all','value'=>$this->Session->read('Outlog.outlog_status_id'))) ?>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$outlog_department_id)) ?>
	<?php echo $this->Form->input('business_type_id',array('options'=>$businessTypes,'empty'=>'all')) ?>
	  <?php echo $this->Form->input('cost_center_id', array('empty' => 'select cost center' , 'type' => 'hidden' )); ?>
	  <?php echo $this->Form->input('CostCenter.name', array('label' => 'Cost Center', 'style' => 'width:100%')); ?>
	  <div id="cost_center_choices" class="auto_complete"></div> 
	  <script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setOutlogCostCenterValues});
			//]]>
	  </script>
	  <?php //echo $this->Form->input('journal_groups_id',array('options'=>$journal_groups,'empty'=>'all','value'=>$journal_groups_id)) ?>
	</fieldset>
 	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Date Filters')?></legend>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

</div>

<div class="Outlog related">
	<h2><?php __('Deliveries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<?php
				$id_group = $this->Session->read('Security.permissions');
				if ($this->Session->read('Outlog.outlog_status_id') == status_outlog_sent_to_supervisor_id && $id_group == stock_supervisor_group_id){
			?>	
				<th><?php echo 'Approve';?></th>
			<?php
				}else{
			?>
				<th><?php echo $this->Paginator->sort('No');?></th>
			<?php
				}
			?>
			<th><?php echo $this->Paginator->sort('no_outlog');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('outlog_status_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php echo $this->Form->create('Outlog');?>
	<?php echo $this->Form->input('outlog_status_id', array('value'=>$this->Session->read('Outlog.outlog_status_id'), 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('layout', array('value'=>'screen', 'type'=>'hidden')); ?>
	<?php
	$i = 0;	
	foreach ($outlogs as $outlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = $outlog['Outlog']['outlog_status_id']==status_outlog_draft_id&&$outlog['Outlog']['created_by']==$Userinfo['username'];
	?>
	<tr<?php echo $class;?>>
		<td class="number">
		<?php
			if ($this->Session->read('Outlog.outlog_status_id') == status_outlog_sent_to_supervisor_id && $id_group == stock_supervisor_group_id){
			
		
			echo $this->Form->input('select_detail', 
				array(
					'hiddenField'=>false,
					'label'=>'',
					'checked'=>false,
					'type'=>'checkbox', 
					'value'=>$outlog['Outlog']['id'],
					'name'=>'data[Outlog][outlog_id][]')) ;
			}else{
		?>
			<?php echo $i; ?>&nbsp;
		<?php
			}
		?>			
		</td>	
		<td class="left"><?php echo $outlog['Outlog']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $outlog['Outlog']['date']); ?>&nbsp;</td>
		<td class="left"><?php echo $outlog['Department']['name']; ?></td>
		<td class="left"><?php echo $outlog['BusinessType']['name']; ?></td>
		<td class="left"><?php echo $outlog['CostCenter']['name']; ?></td>
		<td class="left"><?php echo $outlog['OutlogStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $outlog['Outlog']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $outlog['Outlog']['id'])); ?>
			<?php if($can_edit): ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $outlog['Outlog']['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $outlog['Outlog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $outlog['Outlog']['id'])); ?>
			<?php endif;?>
		</td>
	</tr>
<?php endforeach; ?>
	<?php
		if ($this->Session->read('Outlog.outlog_status_id') == status_outlog_sent_to_supervisor_id && $id_group == stock_supervisor_group_id){
	?>
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