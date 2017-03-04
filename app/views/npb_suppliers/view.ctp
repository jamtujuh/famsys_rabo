<div class="npbSuppliers view">
<h2><?php  __('Npb Supplier');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbSupplier['NpbSupplier']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id Npb'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbSupplier['NpbSupplier']['npb_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Npb'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($npbSupplier['Npb']['id'], array('controller' => 'npbs', 'action' => 'view', $npbSupplier['Npb']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Selected'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbSupplier['NpbSupplier']['selected']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbSupplier['NpbSupplier']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Npb Supplier', true), array('action' => 'edit', $npbSupplier['NpbSupplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Npb Supplier', true), array('action' => 'delete', $npbSupplier['NpbSupplier']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbSupplier['NpbSupplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Npb Suppliers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb Supplier', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>
