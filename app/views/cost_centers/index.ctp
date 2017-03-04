<div class="costCenters index">
	<h2><?php __('Cost Centers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('organization');?></th>
			<th><?php echo $this->Paginator->sort('division');?></th>
			<th><?php echo $this->Paginator->sort('division_name');?></th>
			<th><?php echo $this->Paginator->sort('sub_division');?></th>
			<th><?php echo $this->Paginator->sort('sub_division_name');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('organization_level');?></th>
			<th><?php echo $this->Paginator->sort('desc');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($costCenters as $costCenter):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['organization_Id']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['division']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['division_name']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['sub_division']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['sub_division_name']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['cost_centers']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['organization_level']; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter['CostCenter']['descr']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $costCenter['CostCenter']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $costCenter['CostCenter']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $costCenter['CostCenter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $costCenter['CostCenter']['id'])); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Cost Center', true), array('action' => 'add')); ?></li>
	</ul>
</div>