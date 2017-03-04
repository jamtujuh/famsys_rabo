<h2><div class="error-message">
<?php echo 'WARNING : if you reject this MR,  then all the items in request will be rejected even though MR is in the process of purchase or transfer. with these conditions, you sure?' ;?>            
</div></h2>
<div class="movements view">
<h2><?php  __('Movement');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['doc_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Branch'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departments[$movement['Movement']['source_department_id']]; ?>
			&nbsp;
		</dd>
		<?php if(!empty($movement['Movement']['source_business_type_id'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessTypes[$movement['Movement']['source_business_type_id']]; ?>
			&nbsp;
		<?php endif ;?>
		</dd>
		<?php if(!empty($movement['Movement']['source_cost_center_id'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $costCenters[$movement['Movement']['source_cost_center_id']]; ?> - <?php echo $costCenter[$movement['Movement']['source_cost_center_id']]; ?>
			&nbsp;
		<?php endif ;?>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dest Department Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departments[$movement['Movement']['dest_department_id']]; ?>
			&nbsp;
		</dd>
		<?php if(!empty($movement['Movement']['dest_business_type_id'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessTypes[$movement['Movement']['dest_business_type_id']]; ?>
			&nbsp;
		<?php endif ;?>
		<?php if(!empty($movement['Movement']['dest_cost_center_id'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $costCenters[$movement['Movement']['dest_cost_center_id']]; ?> - <?php echo $costCenter[$movement['Movement']['dest_cost_center_id']]; ?>
			&nbsp;
		<?php endif ;?>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['Movement']['notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Movement Status Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $movement['MovementStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<div>
	<?php echo $this->Form->create('Movement');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('reject_notes', array('style'=>'width:98%'));
			echo $this->Form->input('reject_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('reject_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true) );
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Movements', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Movement Details');?></h3>
	<?php if (!empty($movement['MovementDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('Asset Code'); ?></th>
		<th><?php __('Asset Name'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Book Value'); ?></th>
		<th><?php __('Accum Dep'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($movement['MovementDetail'] as $movementDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td class="left"><?php echo $i;?></td>
			<td class="left"><?php echo $assetCategories[$movementDetail['asset_category_id']];?></td>
			<td class="left"><?php echo $movementDetail['code'] ;?></td>
			<td class="left"><?php echo $movementDetail['name'] ;?></td>
			<td class="number"><?php echo $movementDetail['date_of_purchase'] ;?></td>
			<td class="number"><?php echo $this->Number->format($movementDetail['price']) ;?></td>
			<td class="number"><?php echo $this->Number->format($movementDetail['book_value']) ;?></td>
			<td class="number"><?php echo $this->Number->format($movementDetail['accum_dep']) ;?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Movement Detail', true), array('controller' => 'movement_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
