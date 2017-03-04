<?php $npb_detail_session = $this->Session->read('MovementDetail.npb_detail_id'); ?>
<div class="movementDetails form">

<fieldset>
	<legend><?php __('Search Asset Detail'); ?></legend>
<?php
	echo $this->Form->create('MovementDetail', array('action'=>'add'));
	echo $this->Form->input('npb_detail_id', array('options'=>$npbItemDetail, 'label'=>'Item Name', 'value'=>$npb_detail_session));
	echo $this->Form->input('search_keyword', array('style'=>'width:40%'));
	echo $this->Form->end('Search');
?>
</fieldset>

<?php echo $this->Form->create('MovementDetail');?>
	<fieldset>
 		<legend><?php __('Add Movement Detail'); ?></legend>
	<?php
		echo $this->Form->input('movement_id', array('type'=>'hidden','value'=>$this->Session->read('Movement.id')));
		echo $this->Form->input('Movement.no', array('value'=>$mov_no, 'readonly'=>true));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>
	
	<table>
		<tr>
			<th><?php echo __('select_detail_Asset'); ?></th>
			<th><?php echo __('No Inventaris'); ?></th>
			<th><?php echo __('Code'); ?></th>
			<th><?php echo __('asset_name_detail'); ?></th>
			<th><?php echo __('Brand'); ?></th>
			<th><?php echo __('Type'); ?></th>
			<th><?php echo __('Color'); ?></th>
			<th><?php echo __('Location'); ?></th>
			<th><?php echo __('serial_number'); ?></th>
			<th><?php echo __('date_of_purchase'); ?></th>
			<th><?php echo __('price'); ?></th>
			<th><?php echo __('book_value'); ?></th>
		</tr>
		<?php
		$i = 0;
		$chk = null;
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
						//break;
					}
					else
						$chk=false;
						
				}
				?>
				
				<?php echo $this->Form->checkbox('asset_detail_id', 
					array(
						'label'=>'',
						//'checked'=>$chk,
						'hiddenField'=>false,
						'type'=>'checkbox', 
						'value'=>$asset['AssetDetail']['id'],
						'name'=>'data[MovementDetail][asset_detail_id][]'
						) )
				?>
				</td>
				<td class="left"><?php echo $asset['AssetDetail']['code']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['item_code']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['name']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['brand']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['type']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['color']?></td>
				<td class="left"><?php echo $asset['Location']['name']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['serial_no']?></td>
				<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase'])?></td>
				<td class="number"><?php echo $this->Number->format($asset['AssetDetail']['price'])?></td>
				<td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value'])?></td>
			</tr>
		<? endforeach;?>
	</table>
	<p>
	<?php
	echo '';
	?>	
	</p>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Movement Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Movements', true), array('controller' => 'movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
	</ul>
</div>