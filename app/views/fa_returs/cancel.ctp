<?php
$can_edit 			= $this->Session->read('FaRetur.can_edit');
$can_edit_detail	 = $this->Session->read('FaRetur.can_edit_detail');

//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
echo $javascript->link('my_detail_add',false);

/* $recalcFunction = $ajax->remoteFunction( 
    array(
        'url' => array( 'controller' => 'fa_returs', 'action' => 'ajax_view', $this->Session->read('FaRetur.id') ),
		'indicator'=>'LoadingDiv',
		'complete'=>'recalcFaRetur(request)'
    ) 
); */
?>
<div class="faReturs view">
<h2><?php  __('Fa Retur');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $faRetur['FaRetur']['doc_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['CostCenter']['cost_centers']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fa Retur Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaReturStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
	<div>
	<?php echo $this->Form->create('FaRetur');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('cancel_notes', array('style'=>'width:98%'));
			echo $this->Form->input('cancel_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('cancel_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>

</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Fa Retur', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Fa Retur Details');?></h3>
	<?php if (!empty($faRetur['FaReturDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('No Inventaris'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('name'); ?></th>
		<th><?php __('Brand'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color'); ?></th>
		<th><?php __('Serial No'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($faRetur['FaReturDetail'] as $faReturDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$id=$faReturDetail['id'];
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td class="left"><?php echo $assetCategory[$faReturDetail['asset_category_id']];?></td>
			<td class="left"><?php echo $faReturDetail['code'];?></td>
			<td class="left"><?php echo $faReturDetail['item_code'];?></td>
			<td class="left"><?php echo $faReturDetail['name'];?></td>
			<td class="left"><?php echo $faReturDetail['brand'];?></td>
			<td class="left"><?php echo $faReturDetail['type'];?></td>
			<td class="left"><?php echo $faReturDetail['color'];?></td>
			<td class="left"><?php echo $faReturDetail['serial_no'];?></td>
			<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $faReturDetail['date_of_purchase']);?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
