<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('Supplier', array('action'=>'index')) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Supplier Filters')?></legend>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('action' => 'add')); ?></li>
	</ul>
</div>
</div>
<div class="related">
	<h2><?php __('Suppliers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('telp/HP');?></th>
			<th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('contact_person');?></th>
			<th><?php echo $this->Paginator->sort('default_wht_rate');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($suppliers as $supplier):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $supplier['Supplier']['no']; ?>&nbsp;</td>
		<td><?php echo $supplier['Supplier']['name']; ?>&nbsp;</td>
		<td>
		<?php echo $supplier['Supplier']['address']; ?>&nbsp;<br>
		<?php echo $supplier['Supplier']['city']; ?>&nbsp;<br>
		<?php echo $supplier['Supplier']['province']; ?>&nbsp;
		</td>
		<td>
		<?php echo $supplier['Supplier']['email']; ?>&nbsp;<br>
		</td>
		<td>
		Tel: <?php echo $supplier['Supplier']['telephone']; ?>&nbsp;<br>
		HP:<?php echo $supplier['Supplier']['hp']; ?>&nbsp;
		</td>		
		<td>
		Fax:<?php echo $supplier['Supplier']['fax']; ?>&nbsp;
		</td>
		<td><?php echo $supplier['Supplier']['contact_person']; ?>&nbsp;</td>
		<td><?php echo $supplier['Supplier']['default_wht_rate']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $supplier['Supplier']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $supplier['Supplier']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $supplier['Supplier']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier['Supplier']['id'])); ?>
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
