<div class="movementStatuses view">
<h2><?php  __('Movement Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movementStatus['MovementStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Movement Status', true), array('action' => 'edit', $movementStatus['MovementStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Movement Status', true), array('action' => 'delete', $movementStatus['MovementStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $movementStatus['MovementStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Movement Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movement Status', true), array('action' => 'add')); ?> </li>
	</ul>
</div>