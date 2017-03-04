<div class="Outlog view">
<h2><?php  __('Outlog');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $outlog['Outlog']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Outlog']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Outlog']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Outlog Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['OutlogStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
	<div>
	<?php echo $this->Form->create('Outlog');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('reject_notes', array('style'=>'width:98%', 'type'=>'textarea'));
			echo $this->Form->input('reject_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('reject_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>

</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Outlog', true), array('action' => 'index')); ?> </li>
	</ul>

    </div>
	<div class="doc_actions">
    <ul>
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'view',  $outlog['Outlog']['id'])); ?> </li>
    </ul>
</div>
<div class="related">
	<h3><?php __('Related Outlog Details');?></h3>
	<?php if (!empty($outlog['OutlogDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Category'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th><?php __('Unit Price'); ?></th>
		<th><?php __('Amount'); ?></th>
	</tr>
	<?php
		$i = 0;
		$total=0;
		foreach ($outlog['OutlogDetail'] as $outlogDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>	
		<?php list($asset_category_id, $code, $unit_id) = explode ('|', $outlogDetail['item_detail'])?>

		<tr<?php echo $class;?>>
			
			<td><?php echo $i;?></td>
			<td><?php echo $assetCategories[$asset_category_id];?></td>
			<td><?php echo $code;?></td>
			<td><?php echo $outlogDetail['item_name'];?></td>
			<td><?php echo $this->Number->format($outlogDetail['qty']);?></td>
			<td><?php echo $units[$unit_id];?></td>
			<td class="number"><?php echo $this->Number->format($outlogDetail['price'], 2);?></td>
			<td class="number"><?php echo $this->Number->format($outlogDetail['amount'], 2);?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
