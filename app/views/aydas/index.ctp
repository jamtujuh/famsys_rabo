<div class="aydas index">
	<h2><?php __('Aydas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('debitor_nama');?></th>
			<th><?php echo $this->Paginator->sort('debitor_alamat');?></th>
			<th><?php echo $this->Paginator->sort('lokasi');?></th>
			<th><?php echo $this->Paginator->sort('sertifikat_nomor');?></th>
			<th><?php echo $this->Paginator->sort('sertifikat_tanggal');?></th>
			<th><?php echo $this->Paginator->sort('sertifikat_jtempo');?></th>
			<th><?php echo $this->Paginator->sort('asuransi_nomor');?></th>
			<th><?php echo $this->Paginator->sort('asuransi_jtempo');?></th>
			<th><?php echo $this->Paginator->sort('nilai_buku');?></th>
			<th><?php echo $this->Paginator->sort('tanggal');?></th>
			<th><?php echo $this->Paginator->sort('umur');?></th>
			<th><?php echo $this->Paginator->sort('ppap_pct');?></th>
			<th><?php echo $this->Paginator->sort('ppap_jumlah');?></th>
			<th><?php echo $this->Paginator->sort('appraisal_tanggal');?></th>
			<th><?php echo $this->Paginator->sort('appraisal_jtempo');?></th>
			<th><?php echo $this->Paginator->sort('appraisal_nilai_pasar');?></th>
			<th><?php echo $this->Paginator->sort('appraisal_nilai_likuidasi');?></th>
			<th><?php echo $this->Paginator->sort('pbb_stts');?></th>
			<th><?php echo $this->Paginator->sort('pbb_tahun');?></th>
			<th><?php echo $this->Paginator->sort('listrik_status');?></th>
			<th><?php echo $this->Paginator->sort('listrik_daya');?></th>
			<th><?php echo $this->Paginator->sort('telephone_status');?></th>
			<th><?php echo $this->Paginator->sort('telephone_jumlah_line');?></th>
			<th><?php echo $this->Paginator->sort('pam_status');?></th>
			<th><?php echo $this->Paginator->sort('pemegang_kunci');?></th>
			<th><?php echo $this->Paginator->sort('sold');?></th>
			<th><?php echo $this->Paginator->sort('ayda_status_id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('ayda_type_id');?></th>
			<th><?php echo $this->Paginator->sort('ayda_insurance_id');?></th>
			<th><?php echo $this->Paginator->sort('ayda_doc_id');?></th>
			<th><?php echo $this->Paginator->sort('nilai_jual');?></th>
			<th><?php echo $this->Paginator->sort('ltlb');?></th>
			<th><?php echo $this->Paginator->sort('keterangan');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($aydas as $ayda):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ayda['Ayda']['id']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['debitor_nama']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['debitor_alamat']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['lokasi']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['sertifikat_nomor']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['sertifikat_tanggal']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['sertifikat_jtempo']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['asuransi_nomor']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['asuransi_jtempo']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['nilai_buku']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['tanggal']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['umur']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['ppap_pct']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['ppap_jumlah']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['appraisal_tanggal']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['appraisal_jtempo']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['appraisal_nilai_pasar']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['appraisal_nilai_likuidasi']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['pbb_stts']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['pbb_tahun']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['listrik_status']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['listrik_daya']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['telephone_status']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['telephone_jumlah_line']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['pam_status']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['pemegang_kunci']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['sold']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ayda['AydaStatus']['nama'], array('controller' => 'ayda_statuses', 'action' => 'view', $ayda['AydaStatus']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ayda['Department']['name'], array('controller' => 'departments', 'action' => 'view', $ayda['Department']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ayda['AydaType']['nama'], array('controller' => 'ayda_types', 'action' => 'view', $ayda['AydaType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ayda['AydaInsurance']['nama'], array('controller' => 'ayda_insurances', 'action' => 'view', $ayda['AydaInsurance']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ayda['AydaDoc']['nama'], array('controller' => 'ayda_docs', 'action' => 'view', $ayda['AydaDoc']['id'])); ?>
		</td>
		<td><?php echo $ayda['Ayda']['nilai_jual']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['ltlb']; ?>&nbsp;</td>
		<td><?php echo $ayda['Ayda']['keterangan']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $ayda['Ayda']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $ayda['Ayda']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ayda['Ayda']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ayda['Ayda']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ayda', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Ayda Statuses', true), array('controller' => 'ayda_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda Status', true), array('controller' => 'ayda_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ayda Types', true), array('controller' => 'ayda_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda Type', true), array('controller' => 'ayda_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ayda Insurances', true), array('controller' => 'ayda_insurances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda Insurance', true), array('controller' => 'ayda_insurances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ayda Docs', true), array('controller' => 'ayda_docs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda Doc', true), array('controller' => 'ayda_docs', 'action' => 'add')); ?> </li>
	</ul>
</div>