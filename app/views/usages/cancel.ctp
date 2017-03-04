<?php 
echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
$can_process					=$this->Session->read('Usage.can_process');
$can_edit						=$this->Session->read('Usage.can_edit');
$can_send_to_branch_head		=$this->Session->read('Usage.can_send_to_branch_head');
$can_approve					=$this->Session->read('Usage.can_approve');
$can_generate_journal			=$this->Session->read('Usage.can_generate_journal');
$total=0;
$total=0;
?>

<div class="faReturs view">
<h2><?php  __('Usage');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($usage['Department']['name'], array('controller' => 'departments', 'action' => 'view', $usage['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usage Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['UsageStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['created_by']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($usage['Usage']['approved_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['approved_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif ;?>
	</dl>
	<div>
	<?php echo $this->Form->create('Usage');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('cancel_notes', array('style'=>'width:98%', 'type'=>'textarea'));
			echo $this->Form->input('cancel_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('cancel_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>

</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Usage', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Usage Details');?></h3>
	<?php echo $this->Form->create('UsageDetail', array('action'=>'ajax_add'));?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Category'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Descr'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th><?php __('Unit Price'); ?></th>
		<th><?php __('Amount'); ?></th>
		<?php if($this->Session->read('Usage.can_edit')) :?>
		<th class="actions"><?php __('Actions');?></th>
		<?php endif; ?>
	</tr>
	<?php if (!empty($usage['UsageDetail'])):?>
	<?php
		$i = 0;
		$total = 0;
		foreach ($usage['UsageDetail'] as $usageDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			
			<td><?php echo $i;?></td>
			<td><?php echo $item[$usageDetail['item_id']];?></td>
			<td>
			<?php echo $usageDetail['Item']['code'];?> - 
			<?php echo $usageDetail['Item']['name'];?>
			</td>
			<td><?php echo $this->Number->format($usageDetail['qty']);?></td>
			<td><?php echo $usageDetail['descr'];?></td>
			<td><?php echo $usageDetail['Item']['Unit']['name'];?></td>
			<td class="number"><?php echo $this->Number->format($usageDetail['price']);?></td>
			<td class="number"><?php echo $this->Number->format($usageDetail['amount']);?></td>
			<?php if($this->Session->read('Usage.can_edit')) :?>
			<td class="actions">
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'usage_details', 'action' => 'delete', $usageDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usageDetail['id'])); ?>
			</td>
			<?php endif; ?>
		</tr>
		<?php $total	+=$usageDetail['amount'] ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php if($this->Session->read('Usage.can_edit')) :?>
	<tr id="newRecord">
		<td></td>
		<td></td>
		<td>
		<?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('Item.name'); ?>
		<div id="item_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo request_type_stock_id?>', {afterUpdateElement : setUsageItemValues});
			//]]>
		</script>
		</td>
		<td><?php echo $this->Form->input('qty', array('style'=>'width:50px')); ?></td>
		<td><?php echo $this->Form->input('descr'); ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="actions">
			<?php echo $this->Form->input('usage_id', array('value'=>$this->Session->read('Usage.id'),'type'=>'hidden')); ?>
			<?php echo $this->Form->input('price', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $this->Form->input('price_cur', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $ajax->submit('Add', 
			array('url'=> array('controller'=>'usage_details', 'action'=>'ajax_add'), 
			'indicator'	=> 'LoadingDiv',
			'complete' => 'appendUsageDetail(request)')); ?>
		</td>
	</tr>
	<?php endif;?>	
	
	<tr>
		<td style="border-top:1px solid black" colspan="7" class="number"><?php __("Total") ?></td>
		<td class="number" style="border-top:1px solid black">
			<?php 
				echo $this->Number->format($total);
			?>
		</td>
		<td style="border-top:1px solid black" colspan="1">&nbsp;</td>
	</tr>	
	</table>
	<?php echo $this->Form->end(); ?>

</div>
