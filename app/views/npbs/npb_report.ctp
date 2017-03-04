<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);	
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('Npb', array('action'=>'npb_report/'. $type)) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Memo Request Report '. ucwords($type)) ?></legend>
	<fieldset class="subfilter">
	<legend><?php __('MR Status Info')?></legend>
	<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
		<?php echo $this->Form->input('department_name',array('style'=>'width:100%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
	<?php else : ?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$department_id)) ?>	
	<?php endif; ?>
		<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$business_type_id)) ?>
		<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
		<div id="cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setNpbCostCenterValues});
			//]]>
		</script>
	<?php //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('Npb.department_sub_id'),'empty'=>''  )); ?>
	<?php //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('Npb.department_unit_id'), 'empty'=>''  )); ?>		
	<?php /* $options = array('url' => '/departments/getDepartmentSubId/Npb', 
		'indicator'=>'LoadingDiv', 'update' => 'NpbDepartmentSubId');
		echo $ajax->observeField('NpbDepartmentId', $options);
		
		$options = array('url' => '/department_subs/getDepartmentUnitId/Npb', 
		'indicator'=>'LoadingDiv', 'update' => 'NpbDepartmentUnitId');
		echo $ajax->observeField('NpbDepartmentSubId', $options); */
	?>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Date Filter')?></legend>
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
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('No NPB');?></th>
			<th><?php echo $this->Paginator->sort('Department');?></th>
			<th><?php echo $this->Paginator->sort('Date');?></th>
			<th><?php echo $this->Paginator->sort('Is Done ?');?></th>
			<th><?php echo $this->Paginator->sort('Item name');?></th>
			<th><?php echo $this->Paginator->sort('Qty');?></th>	
			<th><?php echo $this->Paginator->sort('Qty Full Fill');?></th>	
			<?php if($type=='outstanding') { ?>
			<th><?php echo $this->Paginator->sort('Balance');?></th>	
			<?php } ?>
			<?php 
			if($type=='finish') :
		    echo '<th>' ;
			echo $this->Paginator->sort('Finish Date');
			echo '</th>' ;
			endif;
			?>
	</tr>
	<?php
	$i = 0;
	foreach ($npbs as $npb):
		if($npb['NpbDetail'] == null)
		continue;
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	
	?>
	<tr<?php echo $class;?>>
	    
		<td class="left"><?php echo $i ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($npb['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $npb['Npb']['id'])); ?>&nbsp;</td>
		<td class="left">
			<?php echo $npb['Department']['name']; ?>			
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['npb_date']); ?>&nbsp;</td>
		<td class="center"><?php echo $this->Html->image($npb['Npb']['v_is_done'] . ".gif"); ?>&nbsp;</td>
     
		<?php foreach ($npb['NpbDetail'] as $j=>$d) : ?>
			<?php if($j==0) :?>
				<td class="left">&nbsp;
					<?php echo $d['item_name']?>
				</td>
				<td class="center">&nbsp;
					<?php echo $d['qty']?>
				</td>	
				<td class="center">&nbsp;
					<?php echo $d['qty_filled']?>
				</td>	
				<?php if($type=='outstanding') { ?>
				<td class="center">&nbsp;
					<?php echo $d['qty']-$d['qty_filled']?>
				</td>	
				<?php } ?>
				<?php 
					if($type=='finish') {
					echo '<td>&nbsp;' ;
					echo $this->Time->format(DATE_FORMAT, $npb['Npb']['date_finish']);
					echo '</td>' ;
					}
				?>
									
			
			<?php else :?>
			<tr>
				<td colspan="5"></td>
				<td class="left">&nbsp;
				<?php echo $d['item_name']?>
				</td>
				<td class="center">&nbsp;
				<?php echo $d['qty']?>
				</td>				 
				<td class="center">&nbsp;
					<?php echo $d['qty_filled']?>
				</td>
				<?php if($type=='outstanding') { ?>
				<td class="center">&nbsp;
					<?php echo $d['qty']-$d['qty_filled']?>
				</td>	
				<?php } ?>
				<?php 
					if($type=='finish') {
					echo '<td>&nbsp;' ;
					echo $this->Time->format(DATE_FORMAT, $npb['Npb']['date_finish']);
					echo '</td>' ;
					}
				?>
									
			</tr>
			<?php endif ?>
			

		
		<?php endforeach;?>
		
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
