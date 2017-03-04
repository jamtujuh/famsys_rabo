<div id="moduleName"><?php echo $moduleName?></div>
<div class="currencies index">
	<h2><?php __('Currencies');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('rp_rate');?></th>
			<th><?php echo $this->Paginator->sort('last_update_tgl');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('rp_BI_rate');?></th>
			<th><?php echo $this->Paginator->sort('is_desimal');?></th>
			<th><?php echo $this->Paginator->sort('language_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($currencies as $currency):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}if($currency['Currency']['is_desimal'] == 1){
			$uang = 'Yes';
		}else{
			$uang = 'No';
		}
		if($currency['Currency']['language_id'] == 2){
			$language = 'English';
		}elseif($currency['Currency']['language_id'] == 1){
			$language = 'Indonesia';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $currency['Currency']['name']; ?>&nbsp;</td>
		<td><div align='right'><?php echo $this->Number->format($currency['Currency']['rp_rate'], 2); ?>&nbsp;</div></td>
		<td><?php echo $currency['Currency']['last_update_tgl']?$this->Time->format(DATE_FORMAT, $currency['Currency']['last_update_tgl']):''; ?>&nbsp;</td>
		<td><?php echo $currency['Currency']['description']; ?>&nbsp;</td>
		<td><div align='right'><?php echo $currency['Currency']['rp_BI_rate']; ?>&nbsp;</div></td>
		<td><?php echo $uang; ?>&nbsp;</td>
		<td><?php echo $language; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $currency['Currency']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $currency['Currency']['id'])); ?>
			<?php if($currency['Currency']['name'] != 'Rp' || $currency['Currency']['id'] != 1):?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $currency['Currency']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $currency['Currency']['id'])); ?>
			<?php endif;?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Currency', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currency Details', true), array('controller' => 'currency_details', 'action' => 'index')); ?> </li>
	</ul>
</div>