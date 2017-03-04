<?php
$can_edit 			= $this->Session->read('FaRetur.can_edit');
$can_edit_detail	 = $this->Session->read('FaRetur.can_edit_detail');

echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
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
			<?php echo $faRetur['CostCenter']['cost_centers']; ?> - <?php echo $faRetur['CostCenter']['name']; ?>
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
		</dd>
			&nbsp;
		<?php if(!empty($faRetur['FaRetur']['cancel_notes'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['cancel_notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if(!empty($faRetur['FaRetur']['approved_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['approved_by']; ?>
			&nbsp;
		</dd>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>

			&nbsp;
	

			
		<?php if(!empty($faRetur['FaRetur']['reject_notes'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['reject_notes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faRetur['FaRetur']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		</dl>
			&nbsp;
	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Fa Retur', true), array('action' => 'index')); ?> </li>
	</ul>
</div>

<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link($approveLink['label'],$approveLink['options']) ?></li>
		
		<?php if($this->Session->read('FaRetur.can_cancel')) :?>
			<li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'cancel', $faRetur['FaRetur']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('FaRetur.can_reject')) :?>
			<li><?php echo $this->Html->link(__('Reject', true), array('action' => 'reject', $faRetur['FaRetur']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('FaRetur.can_archive')) :?>
			<li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $faRetur['FaRetur']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('FaRetur.can_print')) :?>
			<li><?php echo $this->Html->link(__('Print Retur', true), array('action' => 'can_print', $faRetur['FaRetur']['id'])); ?> </li>
		<?php endif;?>

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
			<td><?php echo $assetCategory[$faReturDetail['asset_category_id']];?></td>
			<td><?php echo $faReturDetail['code'];?></td>
			<td><?php echo $faReturDetail['item_code'];?></td>
			<td><?php echo $faReturDetail['name'];?></td>
			<td class="left">
					<div id="brand.<?php echo $id ?>"><?php echo $faReturDetail['brand']?$faReturDetail['brand']:'-';?></div>
					<?php if($can_edit_detail) :?>
					<?php echo $ajax->editor('brand.'.$id,
						array('controller'=>'fa_retur_details', 'action'=>'ajax_edit', $id )
						//array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
			</td>
			<td class="left">
					<div id="type.<?php echo $id ?>"><?php echo $faReturDetail['type']?$faReturDetail['type']:'-';?></div>
					<?php if($can_edit_detail) :?>
					<?php echo $ajax->editor('type.'.$id,
						array('controller'=>'fa_retur_details', 'action'=>'ajax_edit', $id )
						//array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
			</td>
			<td class="left">
					<div id="color.<?php echo $id ?>"><?php echo $faReturDetail['color']?$faReturDetail['color']:'-';?></div>
					<?php if($can_edit_detail) :?>
					<?php echo $ajax->editor('color.'.$id,
						array('controller'=>'fa_retur_details', 'action'=>'ajax_edit', $id )
						//array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
			</td>
			<td class="left">
					<div id="serial_no.<?php echo $id ?>"><?php echo $faReturDetail['serial_no']?$faReturDetail['serial_no']:'-';?></div>
					<?php if($can_edit_detail) :?>
					<?php echo $ajax->editor('serial_no.'.$id,
						array('controller'=>'fa_retur_details', 'action'=>'ajax_edit', $id )
						//array('loaded'=>$recalcFunction)				
						) 
					?>
					<?php endif;?>
			</td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $faReturDetail['date_of_purchase']);?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<?php if($can_edit) :?>
			<li><?php echo $this->Html->link(__('New Fa Retur Detail', true), array('controller' => 'fa_retur_details', 'action' => 'add'));?> </li>
			<?php endif ;?>
		</ul>
	</div>
</div>
<div>
      <h3><?php __('Notes'); ?></h3>
      <div id="notes"><pre><?php echo $faRetur['FaRetur']['notes']; ?></pre></div>

</div>
