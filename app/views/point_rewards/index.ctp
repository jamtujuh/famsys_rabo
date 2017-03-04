<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
            <?php echo $this->Form->create('PointReward', array('action'=>'index')) ?>
			<legend><?php __('List Point Reward Filters') ?></legend>
			
			<fieldset class='subfilter' style='width:40%'>
			<legend><?php __('Point Reward Info')?></legend>			
			<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all')) ?>	
			<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all')) ?>
			<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
			<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
			<div id="cost_center_choices" class="auto_complete"></div> 
			<script type="text/javascript"> 
				//<![CDATA[
				new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setNpbCostCenterValues});
				//]]>
			</script>
			<?php echo $this->Form->input('mr_no', array('value' => $this->Session->read('PointReward.no'))) ?> 
			</fieldset>
			
			<fieldset class='subfilter' style='width:40%'>
			<legend><?php __('Point Reward Date')?></legend>
			<?php echo $this->Form->input('date_start', array('type' => 'date', 'value' => $date_start)) ?> 
            <?php echo $this->Form->input('date_end', array('type' => 'date', 'value' => $date_end)) ?>
			</fieldset>
			
			<!--?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?-->
            <?php echo $this->Form->submit('Submit') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Point Rewards', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List MRs', true), array('controller'=>'npbs','action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h2><?php __('Point Rewards');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>No</th>
			<th><?php echo $this->Paginator->sort('mr_no');?></th>
			<th><?php echo $this->Paginator->sort('MR Date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pointRewards as $pR):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>

	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($pR['PointReward']['no'], array('controller' => 'npbs', 'action' => 'view', $pR['PointReward']['npb_id'])); ?>
			&nbsp;
			</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$pR['PointReward']['created_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $pR['Department']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $pR['PointReward']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('controller' => 'npbs', 'action' => 'view', $pR['PointReward']['npb_id'])); ?>
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
