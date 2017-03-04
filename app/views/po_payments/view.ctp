<div class="poPayments view">
<h2><?php  __('Po Payment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poPayment['PoPayment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($poPayment['Po']['no'], array('controller' => 'pos', 'action' => 'view', $poPayment['Po']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Term'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poPayment['PoPayment']['term']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poPayment['PoPayment']['payment_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $poPayment['PoPayment']['amount']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Po Payment', true), array('action' => 'edit', $poPayment['PoPayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Po Payment', true), array('action' => 'delete', $poPayment['PoPayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poPayment['PoPayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Po Payments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po Payment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
	</ul>
</div>
