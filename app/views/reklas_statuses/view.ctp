<div class="reklasStatuses view">
<h2><?php  __('Reklas Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $reklasStatus['ReklasStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reklas Status', true), array('action' => 'edit', $reklasStatus['ReklasStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Reklas Status', true), array('action' => 'delete', $reklasStatus['ReklasStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $reklasStatus['ReklasStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reklas Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reklas Status', true), array('action' => 'add')); ?> </li>
	</ul>
</div>

