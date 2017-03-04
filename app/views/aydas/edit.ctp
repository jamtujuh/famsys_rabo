<div class="aydas form">
<?php echo $this->Form->create('Ayda');?>
	<fieldset>
 		<legend><?php __('Edit Ayda'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('debitor_nama');
		echo $this->Form->input('debitor_alamat');
		echo $this->Form->input('lokasi');
		echo $this->Form->input('sertifikat_nomor');
		echo $this->Form->input('sertifikat_tanggal');
		echo $this->Form->input('sertifikat_jtempo');
		echo $this->Form->input('asuransi_nomor');
		echo $this->Form->input('asuransi_jtempo');
		echo $this->Form->input('nilai_buku');
		echo $this->Form->input('tanggal');
		echo $this->Form->input('umur');
		echo $this->Form->input('ppap_pct');
		echo $this->Form->input('ppap_jumlah');
		echo $this->Form->input('appraisal_tanggal');
		echo $this->Form->input('appraisal_jtempo');
		echo $this->Form->input('appraisal_nilai_pasar');
		echo $this->Form->input('appraisal_nilai_likuidasi');
		echo $this->Form->input('pbb_stts');
		echo $this->Form->input('pbb_tahun');
		echo $this->Form->input('listrik_status');
		echo $this->Form->input('listrik_daya');
		echo $this->Form->input('telephone_status');
		echo $this->Form->input('telephone_jumlah_line');
		echo $this->Form->input('pam_status');
		echo $this->Form->input('pemegang_kunci');
		echo $this->Form->input('sold');
		echo $this->Form->input('ayda_status_id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('ayda_type_id');
		echo $this->Form->input('ayda_insurance_id');
		echo $this->Form->input('ayda_doc_id');
		echo $this->Form->input('nilai_jual');
		echo $this->Form->input('ltlb');
		echo $this->Form->input('keterangan');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Ayda.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Ayda.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Aydas', true), array('action' => 'index'));?></li>
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