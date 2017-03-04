<div class="economic age index">
	<fieldset>
	<legend><?php __('Economic Age Filters')?></legend>
	<?php echo $this->Form->create('EconomicAge', array('action'=>'index')) ?>
	<?php echo $this->Form->input('year',array('options'=>$options,'empty'=>'all','value'=>$this->Session->read('EconomicAge.year'))) ?>
	<?php echo $this->Form->input('layout', array('type'=>'hidden', 'value'=>'Screen')) ?>
	<?php echo $this->Form->submit('Execute') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Economic Age', true), array('action' => 'add')); ?></li>		
	</ul>
</div>

<div class="economic age related">
	<h2><?php __('Economic Ages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('year');?></th>
		<th><?php echo $this->Paginator->sort('max');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<?php
	$i = 0;
	foreach ($economicages as $ea):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $ea['EconomicAge']['year']; ?>&nbsp;</td>
		<td><?php echo $ea['EconomicAge']['max']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $ea['EconomicAge']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ea['EconomicAge']['id'])); ?>
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

