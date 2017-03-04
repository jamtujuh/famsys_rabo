<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
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
<div class="usages view">
<h2><?php  __('Usage');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $usage['Usage']['date']); ?>
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
		
		<?php if(!empty($usage['Usage']['cancel_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Note'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['cancel_notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif ;?>
		
		<?php if(!empty($usage['Usage']['reject_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Note'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['reject_notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usage['Usage']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif ;?>
	</dl>
	<div class="doc_actions">
	<ul>
		<?php if($can_approve) : ?>
		<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'usages','action'=>'update_status/' .  $this->Session->read('Usage.id'). '/' . status_usage_approved_id)); ?> </li>
		<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'usages','action'=>'cancel', $this->Session->read('Usage.id'))); ?> </li>
		<li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'usages','action'=>'reject', $this->Session->read('Usage.id'))); ?> </li>
		<?php endif; ?>

		<?php if($can_process) : ?>
		<li><?php echo $this->Html->link(__('Process Stock Usage', true), array('controller'=>'usages','action'=>'process', $this->Session->read('Usage.id'))); ?> </li>
		<?php endif; ?>

		<?php if($can_generate_journal) : ?>
		<li><?php echo $this->Html->link(__('Generate Usage Journal', true), array('controller'=>'journal_transactions','action'=>'prepare_posting', 'usage',journal_group_usage_id , $this->Session->read('Usage.id'))); ?> </li>
		<?php endif; ?>

		<?php if($can_send_to_branch_head) : ?>
		<li><?php echo $this->Html->link(__('Send to Branch Head', true), array('controller'=>'usages','action'=>'update_status/' . $this->Session->read('Usage.id') . '/' . status_usage_sent_to_branch_head_id)); ?> </li>
		<?php endif; ?>

		<?php if($this->Session->read('Usage.can_archive')) :?>
			<li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $usage['Usage']['id'])); ?> </li>
		<?php endif;?>

		<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'usages','action'=>'index')); ?> </li>
		

	</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($this->Session->read('Usage.can_edit')) :?>
		<li><?php echo $this->Html->link(__('Edit Usage', true), array('action' => 'edit', $usage['Usage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Usage', true), array('action' => 'delete', $usage['Usage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usage['Usage']['id'])); ?> </li>
		<?php endif?>
		<li><?php echo $this->Html->link(__('List Usages', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usage', true), array('action' => 'add')); ?> </li>
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
		foreach ($usage['UsageDetail'] as $usageDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			
			<td><?php echo $i;?></td>
			<td><?php echo $usageDetail['Item']['AssetCategory']['name'];?></td>
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
