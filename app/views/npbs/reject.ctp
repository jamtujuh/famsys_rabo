<div class="npbs view">
<h2><?php  __('Npb');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($npb['Npb']['no'], array('action'=>'view', $npb['Npb']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($npb['Department']['name'], array('controller' => 'departments', 'action' => 'view', $npb['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Req Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['req_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['NpbStatus']['name']; ?>
			&nbsp;
		</dd>
		</dd>		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Done'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($npb['Npb']['v_is_done'].".gif"); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['Npb']['created_by']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<div>
	<?php echo $this->Form->create('Npb');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('reject_notes', array('style'=>'width:98%'));
			echo $this->Form->input('reject_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('reject_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	
	<div class="doc_actions">
    <ul>
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'view', $npb['Npb']['id'])); ?> </li>
    </ul>
    </div>

</div>

<div class="related">
	<h3><?php __('NPB Item Details');?></h3>
	<?php if (!empty($npb['NpbDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Code'); ?></th>
        <th><?php __('Name'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Qty Filled'); ?></th>
		<!--th class="number"><?php __('Price (Rp)'); ?></th>
		<th class="number"><?php __('Amount (Rp)'); ?></th-->
		<th><?php __('Descr'); ?></th>
		<th><?php __('Ref PO'); ?></th>
	</tr>
	<?php
		$i = 0;
		$total_amount = 0;
		foreach ($npb['NpbDetail'] as $npbDetail):
			
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $npbDetail['item_code']; ?></td>
            <td><?php echo $npbDetail['item_name']; ?></td>
			<td><?php echo $npbDetail['qty'];?></td>
			<td><?php echo $npbDetail['qty_filled'];?></td>
			<!--td class="number"><?php echo $this->Number->format($npbDetail['price']);?></td>
			<td class="number"><?php echo $this->Number->format($npbDetail['amount']);?></td-->
			<td><?php echo $npbDetail['descr'];?></td>
			<td class="left">
				<?php echo empty($npbDetail['po_id'])?"":
				$this->Html->link($pos[$npbDetail['po_id']],array('controller'=>'pos','action'=>'view', $npbDetail['po_id']));?>
			</td>
		</tr>
		<?php $total_amount +=$npbDetail['amount_cur'];?>
	<?php endforeach; ?>
	
	</table>
<?php endif; ?>

</div>