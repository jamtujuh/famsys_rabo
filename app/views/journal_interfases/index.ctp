<div class="journalInterfases index">
	<h2><?php __('Journal Interfases');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('source_id');?></th>
			<th><?php echo $this->Paginator->sort('source_dt');?></th>
			<th><?php echo $this->Paginator->sort('source_no');?></th>
			<th><?php echo $this->Paginator->sort('source_tm');?></th>
			<th><?php echo $this->Paginator->sort('kdtran');?></th>
			<th><?php echo $this->Paginator->sort('noref');?></th>
			<th><?php echo $this->Paginator->sort('norek1');?></th>
			<th><?php echo $this->Paginator->sort('kdcab1');?></th>
			<th><?php echo $this->Paginator->sort('ccy1');?></th>
			<th><?php echo $this->Paginator->sort('nilai1');?></th>
			<th><?php echo $this->Paginator->sort('norek2');?></th>
			<th><?php echo $this->Paginator->sort('kdcab2');?></th>
			<th><?php echo $this->Paginator->sort('ccy2');?></th>
			<th><?php echo $this->Paginator->sort('nilai2');?></th>
			<th><?php echo $this->Paginator->sort('costc1');?></th>
			<th><?php echo $this->Paginator->sort('costc2');?></th>
			<th><?php echo $this->Paginator->sort('costdept1');?></th>
			<th><?php echo $this->Paginator->sort('costdept2');?></th>
			<th><?php echo $this->Paginator->sort('kurs');?></th>
			<th><?php echo $this->Paginator->sort('ket1');?></th>
			<th><?php echo $this->Paginator->sort('ket2');?></th>
			<th><?php echo $this->Paginator->sort('ket3');?></th>
			<th><?php echo $this->Paginator->sort('rc');?></th>
			<th><?php echo $this->Paginator->sort('st');?></th>
			<th><?php echo $this->Paginator->sort('trs_id');?></th>
			<th><?php echo $this->Paginator->sort('trs_dt');?></th>
			<th><?php echo $this->Paginator->sort('trs_tm');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journalInterfases as $journalInterfase):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $journalInterfase['JournalInterfase']['id']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['source_id']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['source_dt']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['source_no']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['source_tm']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['kdtran']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['noref']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['norek1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['kdcab1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['ccy1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['nilai1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['norek2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['kdcab2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['ccy2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['nilai2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['costc1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['costc2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['costdept1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['costdept2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['kurs']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['ket1']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['ket2']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['ket3']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['rc']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['st']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['trs_id']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['trs_dt']; ?>&nbsp;</td>
		<td><?php echo $journalInterfase['JournalInterfase']['trs_tm']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $journalInterfase['JournalInterfase']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $journalInterfase['JournalInterfase']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $journalInterfase['JournalInterfase']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalInterfase['JournalInterfase']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Journal Interfase', true), array('action' => 'add')); ?></li>
	</ul>
</div>