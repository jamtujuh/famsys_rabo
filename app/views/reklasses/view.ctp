<div class="reklasStatuses view">
<h2><?php  __('Reklas Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklas['Reklass']['doc_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklas['Asset']['code']; ?> - <?php echo $reklas['Asset']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($reklas['Reklass']['amount']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Accum Amortisasi'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($reklas['Reklass']['depthnini']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Target Asset Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklas['AssetCategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('New Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklas['Reklass']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reklass Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklas['ReklasStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Create By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklas['Reklass']['create_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Create Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $reklas['Reklass']['date']); ?>
			&nbsp;
		</dd>
	</dl>

<div class="doc_actions">
            <ul>
				<?php if($this->Session->read('Security.permissions')==fincon_group_id && $reklas['Reklass']['reklas_status_id'] == status_reklass_draft_id):?>
			   <li><?php echo $this->Html->link(__('Sent To approval', true), array('action' => 'UpdateStatus', $reklas['Reklass']['id'], status_reklass_send_to_supervisor_id)); ?> </li>
				<?php endif;?>
				<?php if($this->Session->read('Security.permissions')==fincon_supervisor_group_id && $reklas['Reklass']['reklas_status_id'] == status_reklass_send_to_supervisor_id):?>
			   <li><?php echo $this->Html->link(__('Approve', true), array('action' => 'UpdateStatus', $reklas['Reklass']['id'], status_reklass_approve_id)); ?> </li>
			   <li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'UpdateStatus', $reklas['Reklass']['id'], status_reklass_draft_id)); ?> </li>
				<?php endif;?>
				<?php if($this->Session->read('Security.permissions')==fincon_group_id && $reklas['Reklass']['reklas_status_id'] == status_reklass_approve_id):?>
			   <li><?php echo $this->Html->link(__('Posting To Journal', true), array('controller'=>'journal_transactions', 'action' => 'prepare_posting', 'reklass',  journal_group_reklas_golongan_id, $reklas['Reklass']['id'])); ?> </li>
				<?php endif;?>
			   <li><?php echo $this->Html->link(__('Back', true), array('action' => 'index')); ?> </li>
		   </ul>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($this->Session->read('Security.permissions')==fincon_group_id && $reklas['Reklass']['reklas_status_id'] == status_reklass_draft_id):?>
		<li><?php echo $this->Html->link(__('Edit Reklass', true), array('action' => 'edit', $reklas['Reklass']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Reklass', true), array('action' => 'delete', $reklas['Reklass']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $reklas['Reklass']['id'])); ?> </li>
		<?php endif;?>
		<li><?php echo $this->Html->link(__('List Reklass', true), array('action' => 'index')); ?> </li>
	</ul>
</div>

