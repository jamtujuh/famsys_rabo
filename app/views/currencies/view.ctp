<?php if($currency['Currency']['is_desimal'] == 1){
	$uang = 'Yes';
}else{
	$uang = 'No';
}
?>
<div class="currencies view">
<h2><?php  __('Currency');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currency['Currency']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rp Rate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currency['Currency']['rp_rate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Update Tgl'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $currency['Currency']['last_update_tgl']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currency['Currency']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rp BI Rate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $currency['Currency']['rp_BI_rate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desimal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $uang; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Currency', true), array('action' => 'edit', $currency['Currency']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('action' => 'index')); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php __('Related Currency Details');?></h3>
	<?php if (!empty($currency['CurrencyDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Currency Id'); ?></th>
		<th><?php __('Tanggal'); ?></th>
		<th><?php __('Rp Rate'); ?></th>
		<th><?php __('Rp BI Rate'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($currency['CurrencyDetail'] as $currencyDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $currencyDetail['currency_id'];?></td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $currencyDetail['tanggal']);?></td>
			<td><?php echo $currencyDetail['rp_rate'];?></td>
			<td><?php echo $currencyDetail['rp_BI_rate'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'currency_details', 'action' => 'view', $currencyDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'currency_details', 'action' => 'edit', $currencyDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'currency_details', 'action' => 'delete', $currencyDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $currencyDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Currency Detail', true), array('controller' => 'currency_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
