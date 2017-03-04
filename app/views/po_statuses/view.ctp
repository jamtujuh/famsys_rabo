<div class="poStatuses view">
<h2><?php  __('Po Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poStatus['PoStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Po Status', true), array('action' => 'edit', $poStatus['PoStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Po Status', true), array('action' => 'delete', $poStatus['PoStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poStatus['PoStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Po Statuses', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
