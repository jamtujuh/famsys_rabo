<div class="groups view">
<h2><?php  __('IT Log');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activitylog['ActivityLog']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Process'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activitylog['ActivityLog']['process']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				if ($activitylog['ActivityLog']['status'] == 'SUCCESS'){
			?>
				<font color="GREEN"><?php echo $activitylog['ActivityLog']['status']; ?>&nbsp;</font>
			<?php
				}else{
			?>
				<font color="RED"><?php echo $activitylog['ActivityLog']['status']; ?>&nbsp;</font>
			<?php };?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				$strtime = $activitylog['ActivityLog']['created'];
				echo strftime("%H:%M:%S %d-%m-%Y" , strtotime($activitylog['ActivityLog']['created']));
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remark'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activitylog['ActivityLog']['remark']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Index', true), array('action' => 'index')); ?> </li>
	</ul>
</div>