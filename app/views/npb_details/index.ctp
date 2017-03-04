<?php
//	echo $javascript->link('prototype',false);
//	echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>

<div id="filter">
	<div class="fieldfilter">
		<fieldset>
			<?php echo $this->Form->create('Npb_detail', array('action'=>'index')) ?>
			<legend><?php __('NPB Filters')?></legend>	
			<fieldset class="subfilter">
				<legend><?php __('MR Status Info')?></legend>
				<?php echo $this->Form->input('no',array('value'=>$this->Session->read('Npb.no'))) ?>
			</fieldset>
			<?php echo $this->Form->submit('Refresh') ?>
			<?php echo $this->Form->end() ?>
		</fieldset>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="npbDetails index">
	<h2><?php __('Npb Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('npb_id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('qty_filled');?></th>
			<th><?php echo $this->Paginator->sort('process_type_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($npbDetails as $npbDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($npbDetail['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $npbDetail['Npb']['id'])); ?>
		</td>
		<td class="left"><?php echo $departments[$npbDetail['Npb']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $npbDetail['Item']['name']; ?></td>
		<td class="center"><?php echo $npbDetail['NpbDetail']['qty']; ?>&nbsp;</td>
		<td class="center"><?php echo $npbDetail['NpbDetail']['qty_filled']; ?>&nbsp;</td>
		<td><?php echo $npbDetail['ProcessType']['name']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View MR', true), array('controller' => 'npbs', 'action' => 'view', $npbDetail['Npb']['id'])); ?>
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
		<?php echo $this->Paginator->first('|< ' . __('first', true), array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >|', array(), null, array('class' => 'disabled'));?>
	</div>
</div>