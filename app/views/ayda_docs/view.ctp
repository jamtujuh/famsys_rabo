<div class="aydaDocs view">
<h2><?php  __('Ayda Doc');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aydaDoc['AydaDoc']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nama'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aydaDoc['AydaDoc']['nama']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Heading'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aydaDoc['AydaDoc']['heading']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Kode'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aydaDoc['AydaDoc']['kode']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ayda Doc', true), array('action' => 'edit', $aydaDoc['AydaDoc']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ayda Doc', true), array('action' => 'delete', $aydaDoc['AydaDoc']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $aydaDoc['AydaDoc']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ayda Docs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda Doc', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Aydas', true), array('controller' => 'aydas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda', true), array('controller' => 'aydas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Aydas');?></h3>
	<?php if (!empty($aydaDoc['Ayda'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Debitor Nama'); ?></th>
		<th><?php __('Debitor Alamat'); ?></th>
		<th><?php __('Lokasi'); ?></th>
		<th><?php __('Sertifikat Nomor'); ?></th>
		<th><?php __('Sertifikat Tanggal'); ?></th>
		<th><?php __('Sertifikat Jtempo'); ?></th>
		<th><?php __('Asuransi Nomor'); ?></th>
		<th><?php __('Asuransi Jtempo'); ?></th>
		<th><?php __('Nilai Buku'); ?></th>
		<th><?php __('Tanggal'); ?></th>
		<th><?php __('Umur'); ?></th>
		<th><?php __('Ppap Pct'); ?></th>
		<th><?php __('Ppap Jumlah'); ?></th>
		<th><?php __('Appraisal Tanggal'); ?></th>
		<th><?php __('Appraisal Jtempo'); ?></th>
		<th><?php __('Appraisal Nilai Pasar'); ?></th>
		<th><?php __('Appraisal Nilai Likuidasi'); ?></th>
		<th><?php __('Pbb Stts'); ?></th>
		<th><?php __('Pbb Tahun'); ?></th>
		<th><?php __('Listrik Status'); ?></th>
		<th><?php __('Listrik Daya'); ?></th>
		<th><?php __('Telephone Status'); ?></th>
		<th><?php __('Telephone Jumlah Line'); ?></th>
		<th><?php __('Pam Status'); ?></th>
		<th><?php __('Pemegang Kunci'); ?></th>
		<th><?php __('Sold'); ?></th>
		<th><?php __('Ayda Status Id'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Ayda Type Id'); ?></th>
		<th><?php __('Ayda Insurance Id'); ?></th>
		<th><?php __('Ayda Doc Id'); ?></th>
		<th><?php __('Nilai Jual'); ?></th>
		<th><?php __('Ltlb'); ?></th>
		<th><?php __('Keterangan'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($aydaDoc['Ayda'] as $ayda):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ayda['id'];?></td>
			<td><?php echo $ayda['debitor_nama'];?></td>
			<td><?php echo $ayda['debitor_alamat'];?></td>
			<td><?php echo $ayda['lokasi'];?></td>
			<td><?php echo $ayda['sertifikat_nomor'];?></td>
			<td><?php echo $ayda['sertifikat_tanggal'];?></td>
			<td><?php echo $ayda['sertifikat_jtempo'];?></td>
			<td><?php echo $ayda['asuransi_nomor'];?></td>
			<td><?php echo $ayda['asuransi_jtempo'];?></td>
			<td><?php echo $ayda['nilai_buku'];?></td>
			<td><?php echo $ayda['tanggal'];?></td>
			<td><?php echo $ayda['umur'];?></td>
			<td><?php echo $ayda['ppap_pct'];?></td>
			<td><?php echo $ayda['ppap_jumlah'];?></td>
			<td><?php echo $ayda['appraisal_tanggal'];?></td>
			<td><?php echo $ayda['appraisal_jtempo'];?></td>
			<td><?php echo $ayda['appraisal_nilai_pasar'];?></td>
			<td><?php echo $ayda['appraisal_nilai_likuidasi'];?></td>
			<td><?php echo $ayda['pbb_stts'];?></td>
			<td><?php echo $ayda['pbb_tahun'];?></td>
			<td><?php echo $ayda['listrik_status'];?></td>
			<td><?php echo $ayda['listrik_daya'];?></td>
			<td><?php echo $ayda['telephone_status'];?></td>
			<td><?php echo $ayda['telephone_jumlah_line'];?></td>
			<td><?php echo $ayda['pam_status'];?></td>
			<td><?php echo $ayda['pemegang_kunci'];?></td>
			<td><?php echo $ayda['sold'];?></td>
			<td><?php echo $ayda['ayda_status_id'];?></td>
			<td><?php echo $ayda['department_id'];?></td>
			<td><?php echo $ayda['ayda_type_id'];?></td>
			<td><?php echo $ayda['ayda_insurance_id'];?></td>
			<td><?php echo $ayda['ayda_doc_id'];?></td>
			<td><?php echo $ayda['nilai_jual'];?></td>
			<td><?php echo $ayda['ltlb'];?></td>
			<td><?php echo $ayda['keterangan'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'aydas', 'action' => 'view', $ayda['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'aydas', 'action' => 'edit', $ayda['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'aydas', 'action' => 'delete', $ayda['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ayda['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ayda', true), array('controller' => 'aydas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
