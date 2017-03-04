<?php
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo 'PO > Service Ordered List'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
	<?php echo $this->Form->create('PoDetail', array('action'=>'report_service')) ?>
	<legend><?php __('Service Ordered List Filters')?></legend>
	<fieldset class='subfilter'>
		<legend><?php __('PO Info')?></legend>
		<?php echo $this->Form->input('department_id',array('options'=>$departments, 'empty'=>'all')) ?>
		<?php echo $this->Form->input('asset_category_id',array('options'=>$assetCategories, 'empty'=>'all')) ?>
		<?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('Item.name', array('label'=>'Select Name or Code', 'style'=>'width:100%')); ?>
		<div id="item_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo request_type_service_id?>', {afterUpdateElement : setPoDetailItemValues});
			//]]>
		</script>
	</fieldset>
		<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('PO Finish', true), array('controller' => 'pos', 'action' => 'po_report/finish')); ?></li>
		<li><?php echo $this->Html->link(__('PO Outstanding', true), array('controller' => 'pos', 'action' => 'po_report/outstanding')); ?></li>		
	</ul>
</div>
</div>
<div class="related">
<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('No'); ?></th>
			<th><?php __('Department'); ?></th>
			<th><?php __('Asset Category'); ?></th>
			<th><?php __('Code'); ?></th>
			<th><?php __('Name'); ?></th>
			<th><?php __('Brand'); ?></th>
			<th><?php __('Type'); ?></th>
			<th><?php __('Color'); ?></th>
			<th><?php __('Qty'); ?></th>
			<th><?php __('Qty<br>Received'); ?></th>
			<th><?php __('Currency'); ?></th>
			<th><?php __('Price'); ?></th>
			<th><?php __('Amount'); ?></th>
			<th><?php __('Discount'); ?></th>
			<th><?php __('After Disc'); ?></th>
			<th><?php __('Ref. NPB'); ?></th>
		</tr>
		<?php if (!empty($poDetails)):?>
		<?php
			$i = 0;
			foreach ($poDetails as $poDetail):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				$places = $myApp->getPlaces($poDetail['Currency']['is_desimal']);
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $i;?></td>
				<td class="left"><?php echo $departments[$poDetail['PoDetail']['department_id']];?></td>
				<td class="left"><?php echo $assetCategories[$poDetail['PoDetail']['asset_category_id']];?></td>
				<td class="left"><?php echo $poDetail['PoDetail']['item_code'];?></td>
				<td class="left"><?php echo $poDetail['PoDetail']['name'];?></td>
				<td class="left"><?php echo $poDetail['PoDetail']['brand'];?></td>
				<td class="left"><?php echo $poDetail['PoDetail']['type'];?></td>
				<td class="left"><?php echo $poDetail['PoDetail']['color'];?></td>
				<td class="center"><?php echo $poDetail['PoDetail']['qty'];?></td>
				<td class="center"><?php echo $poDetail['PoDetail']['qty_received'];?></td>
				<td class="center"><?php echo $poDetail['Currency']['name'];?></td>
				<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['price_cur'], $places);?></td>
				<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['amount_cur'], $places);?></td>
				<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['discount_cur'], $places);?></td>
				<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['amount_after_disc_cur'], $places);?></td>
				<td class="left">
					<?php echo $poDetail['PoDetail']['npb_id']?
					$this->Html->link($npbs[$poDetail['PoDetail']['npb_id']], 
					array('controller'=>'npbs', 'action'=>'view', $poDetail['PoDetail']['npb_id'])):
					"";?>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php endif;?>
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
</div>
