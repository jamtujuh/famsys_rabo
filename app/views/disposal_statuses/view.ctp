<div class="disposalStatuses view">
<h2><?php  __('Disposal Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalStatus['DisposalStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Disposal Status', true), array('action' => 'edit', $disposalStatus['DisposalStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Disposal Status', true), array('action' => 'delete', $disposalStatus['DisposalStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $disposalStatus['DisposalStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Disposal Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal Status', true), array('action' => 'add')); ?> </li>
	</ul>
</div>