<?php 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
$can_process					=$this->Session->read('FaImport.can_process');
$can_edit						=$this->Session->read('FaImport.can_edit');
$can_send_to_supervisor			=$this->Session->read('FaImport.can_send_to_supervisor');
$can_approve					=$this->Session->read('FaImport.can_approve');
$can_generate_journal			=$this->Session->read('FaImport.can_generate_journal');
$can_upload						=$this->Session->read('FaImport.can_upload');
$total=0;
$total=0;
?>
<div class="fa_imports view">
<h2><?php  __('FaImport');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $fa_import['FaImport']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fa_import['Department']['name'], array('controller' => 'departments', 'action' => 'view', $fa_import['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('FaImport Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['ImportStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Upload File Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link(
				'/'.$fa_import['FaImport']['upload_file_path'].'/'.$fa_import['FaImport']['upload_file_name'],
				null,
				array('target'=>'_blank')
				); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Upload File Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['upload_file_size']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Upload File Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['upload_content_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Records'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['total_records']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Success'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['total_success']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Failed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['total_failed']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Duplicates'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fa_import['FaImport']['total_duplicate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duplicate Records'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $fa_import['FaImport']['duplicates']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($fa_import['FaImport']['total_price']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Book Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($fa_import['FaImport']['total_book_value']); ?>
			&nbsp;
		</dd>		
	</dl>
	<div class="doc_actions">
	<ul>
		<?php if($can_approve) : ?>
		<li><?php echo $this->Html->link(__('Approve', true), 
			array('controller'=>'fa_imports','action'=>'update_status/' .  $this->Session->read('FaImport.id'). '/' . status_fa_import_approved_id),
			null, __('This process will import into Fixed Asset data. Are you sure?',true)); ?> </li>
		<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'fa_imports','action'=>'update_status/' . $this->Session->read('FaImport.id') . '/' . status_fa_import_draft_id)); ?> </li>
		<li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'fa_imports','action'=>'update_status/' . $this->Session->read('FaImport.id') . '/' . status_fa_import_reject_id)); ?> </li>
		<?php endif; ?>

		<?php if($can_process) : ?>
		<li><?php echo $this->Html->link(__('Process FaImport', true), array('controller'=>'fa_imports','action'=>'process', $this->Session->read('FaImport.id'))); ?> </li>
		<?php endif; ?>

		<?php if($can_generate_journal) : ?>
		<!--li><?php //echo $this->Html->link(__('Generate FaImport Journal', true), array('controller'=>'journal_transactions','action'=>'prepare_posting', 'fa_import',journal_group_fa_import_id , $this->Session->read('FaImport.id'))); ?> </li-->
		<?php endif; ?>

		<?php if($can_send_to_supervisor) : ?>
		<li><?php echo $this->Html->link(__('Send to Supervisor', true), array('controller'=>'fa_imports','action'=>'update_status/' . $this->Session->read('FaImport.id') . '/' . status_fa_import_sent_to_supervisor_id)); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('View Imported Assets', true), array('controller'=>'import_asset_details', 'action' => 'index', $fa_import['FaImport']['id'])); ?> </li>

		<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'fa_imports','action'=>'index')); ?> </li>
		
	</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($this->Session->read('FaImport.can_edit')) :?>
		<li><?php echo $this->Html->link(__('Edit FaImport', true), array('action' => 'edit', $fa_import['FaImport']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete FaImport', true), array('action' => 'delete', $fa_import['FaImport']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fa_import['FaImport']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New FaImport', true), array('action' => 'add')); ?> </li>
		<?php endif?>
		<li><?php echo $this->Html->link(__('List FaImports', true), array('action' => 'index')); ?> </li>
	</ul>
</div>

<div class="related">
	<?php echo $this->Form->create('FaImport', array('action'=>'upload','type'=>'file'));?>
	<?php if($can_upload) :?>
	<fieldset>
 		<legend><?php __('Upload XLS file'); ?></legend>
		<?php echo $this->Form->input('MAX_FILE_SIZE',array('type'=>'hidden','value'=>'30000000')); ?>
		<?php echo $this->Form->file('submittedfile'); ?>
		<?php echo $this->Form->input('upload_start_row',array('value'=>8)); ?>
		<?php echo $this->Form->input('fa_import_id', array('value'=>$this->Session->read('FaImport.id'),'type'=>'hidden')); ?>
		<?php echo $this->Form->submit('Upload'); ?>
		<?php echo $this->Form->end();?>
	</fieldset>
	

	<?php endif?>
</div>
