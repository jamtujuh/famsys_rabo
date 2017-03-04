<div class="npbStatuses view">
<h2><?php  __('Npb Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbStatus['NpbStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Npb Status', true), array('action' => 'edit', $npbStatus['NpbStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Npb Status', true), array('action' => 'delete', $npbStatus['NpbStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbStatus['NpbStatus']['id'])); ?> </li>
	</ul>
</div>