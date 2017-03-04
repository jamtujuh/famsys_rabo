<div class="currencyDetails view">
<h2><?php  __('Currency Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currencyDetail['CurrencyDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($currencyDetail['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $currencyDetail['Currency']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tanggal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currencyDetail['CurrencyDetail']['tanggal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rp Rate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currencyDetail['CurrencyDetail']['rp_rate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rp BI Rate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currencyDetail['CurrencyDetail']['rp_BI_rate']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Currency Detail', true), array('action' => 'edit', $currencyDetail['CurrencyDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Currency Detail', true), array('action' => 'delete', $currencyDetail['CurrencyDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $currencyDetail['CurrencyDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Currency Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
