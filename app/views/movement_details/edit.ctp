<div class="movementDetails form">
<?php echo $this->Form->create('MovementDetail');?>
	<fieldset>
 		<legend><?php __('Edit Movement Detail'); ?></legend>
	<?php
		echo $this->Form->input('movement_id', array('type'=>'hidden','value'=>$this->Session->read('Movement.id')));
		echo $this->Form->input('Movement.no', array('value'=>$mov_no, 'readonly'=>true));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>
	
	<table>
		<tr>
			<th><?php echo $this->Paginator->sort('select_detail_Asset'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_code'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_name_detail'); ?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('book_value'); ?></th>
		</tr>
		<?php
		$i = 0;
		$chk = null;
		$dsb = null;
		foreach($asset_details as $asset):
		
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		?>
			<tr<?php echo $class;?>>
				<td>
				<?php
				foreach($assetDetailSelecteds as $ad)
				{
					//echo $asset['AssetDetail']['id'] . '==' . $ad['asset_detail_id'] ."<br>";
					if($asset['AssetDetail']['id'] == $ad['asset_detail_id'])
					{
						$chk=true;
						$dsb=true;
						break;
					}
					else
						$chk=false;
						$dsb=false;
						
				}
				?>
				
				<?php echo $this->Form->checkbox('asset_detail_id', 
					array(
						'label'=>'',
						'checked'=>$chk,
						'disabled' => $dsb,
						'hiddenField'=>false,
						'type'=>'checkbox', 
						'value'=>$asset['AssetDetail']['id'],
						'name'=>'data[MovementDetail][asset_detail_id][]'
						) )
				?>
				</td>
				<td><?php echo $asset['AssetDetail']['code']?></td>
				<td><?php echo $asset['AssetDetail']['name']?></td>
				<td><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase'])?></td>
				<td><?php echo $asset['AssetDetail']['price']?></td>
				<td><?php echo $asset['AssetDetail']['book_value']?></td>
			</tr>
		<? endforeach;?>
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
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Movement Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Movements', true), array('controller' => 'movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movement', true), array('controller' => 'movements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>