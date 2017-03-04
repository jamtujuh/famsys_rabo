<div class="disposalDetails form">
<fieldset>
	<legend><?php __('Search Asset Detail'); ?></legend>
<?php
	echo $this->Form->create('DisposalDetail', array('action'=>'add'));
	echo $this->Form->input('search_keyword', array('style'=>'width:40%'));
	echo $this->Form->end('Search');
?>
</fieldset>

<?php echo $this->Form->create('DisposalDetail');?>
	<fieldset>
 		<legend><?php __('Add Disposal Detail'); ?></legend>
	<?php
		echo $this->Form->input('disposal_id', array('type'=>'hidden','value'=>$this->Session->read('Disposal.id')));
		echo $this->Form->input('Disposal.no', array('value'=>$dis_no, 'readonly'=>true));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('select_detail_Asset'); ?></th>
			<th><?php echo $this->Paginator->sort('branch'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_code'); ?></th>
			<th><?php echo $this->Paginator->sort('item_code'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_name_detail'); ?></th>
			<th><?php echo $this->Paginator->sort('brand'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('serial_no'); ?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('book_value'); ?></th>
			<th><?php echo $this->Paginator->sort('sales_amount'); ?></th>
		</tr>
		<?php
		$sales_amounts=null;
		foreach($assetDetailSelecteds as $ad)
		{
			$sales_amounts[$ad['asset_detail_id']] = $ad['sales_amount'];
		}
		
		//var_dump($sales_amounts);
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
					$sales_amount[$asset['AssetDetail']['id']] = $ad['sales_amount'];
					if($asset['AssetDetail']['id'] == $ad['asset_detail_id'])
					{
						$chk=true;
						break;
					}
					else
						$chk=false;
						
				}
				?>
				
				<?php echo $this->Form->checkbox('asset_detail_id', 
					array(
						'label'=>'',
						'checked'=>$chk,
						'hiddenField'=>false,
						'type'=>'checkbox', 
						'value'=>$asset['AssetDetail']['id'],
						'name'=>'data[DisposalDetail][asset_detail_id]['.$i.']'
						) )
				?>
				</td>
				<td class="left"><?php echo $asset['Department']['name']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['code']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['item_code']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['name']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['brand']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['type']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['color']?></td>
				<td class="left"><?php echo $asset['AssetDetail']['serial_no']?></td>
				<td><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase'])?></td>
				<td class="number"><?php echo $this->Number->format($asset['AssetDetail']['price'])?></td>
				<td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value'])?></td>
				<td>
				<?php 
					$s='';
					if(isset($sales_amounts))
					{
						foreach ($sales_amounts as $key=>$value)
						{
							if($asset['AssetDetail']['id'] == $key)
								$s=$value;
						}
					}
					if($this->Session->read('Disposal.type')==1)
					$s=0;
					echo $this->Form->input('sales_amount',
					array(
						'label'=>'',
						'value'=>$s,
						'readonly'=>$this->Session->read('Disposal.type')==1?true:false,
						'name'=>'data[DisposalDetail][sales_amount]['.$i.']'
					)
				)
				?>
				</td>
			</tr>
		<?php endforeach;?>
	</table>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>