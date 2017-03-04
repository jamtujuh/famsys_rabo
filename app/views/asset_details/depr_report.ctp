
<div class="assets index">
	<h2><?php __('Asset Details Depreciation Report per ' . $this->Session->read('AssetReport.periode'));?></h2>
	<? echo $form->create('AssetDetail', array('action' => 'depr_report'));?>
	<fieldset>
		<? echo $form->input('department_id', array( 'options'=>$departments , 'value'=>$this->Session->read('AssetReport.department_id'), 'empty'=>'all'  )); ?>
		<? echo $form->input('asset_category_id', array( 'options'=>$assetCategories, 'value'=>$this->Session->read('AssetReport.asset_category_id'),  'empty'=>'all'  )); ?>
		<? echo $form->end('Reload'); ?>
	</fieldset>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Home', true), '/pages/home' ); ?> </li>
		<li><?php echo $this->Html->link(__('Calculate Depreciation', true), array('controller'=>'assets', 'action'=>'process_depr') ); ?> </li>
		<li><?php echo $this->Html->link(__('Assets Depr.', true), array('controller'=>'assets', 'action'=>'depr_report') ); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller'=>'purchases', 'action'=>'index') ); ?> </li>
	</ul>
</div>

<div class="related">
<? if (!empty($assets)) : ?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Code');?></th>
			<th>
			<?php echo $this->Paginator->sort('Name/ Brand/ Type');?> 
			</th>
			<th><?php echo $this->Paginator->sort('Unit Cost','price');?></th>
			<th><?php echo $this->Paginator->sort('Economic Age (months)');?></th>
			<th><?php echo $this->Paginator->sort('Age (months)');?></th>
			<th><?php echo $this->Paginator->sort('Monthly Depreciation','depbln');?></th>
			
			<th><?php echo $this->Paginator->sort('Book Value Last Year');?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr Last Year');?></th>

			<th><?php echo $this->Paginator->sort('jan');?></th>
			<th><?php echo $this->Paginator->sort('feb');?></th>
			<th><?php echo $this->Paginator->sort('mar');?></th>
			<th><?php echo $this->Paginator->sort('apr');?></th>
			<th><?php echo $this->Paginator->sort('may');?></th>
			<th><?php echo $this->Paginator->sort('jun');?></th>
			<th><?php echo $this->Paginator->sort('jul');?></th>
			<th><?php echo $this->Paginator->sort('aug');?></th>
			<th><?php echo $this->Paginator->sort('sep');?></th>
			<th><?php echo $this->Paginator->sort('oct');?></th>
			<th><?php echo $this->Paginator->sort('nov');?></th>
			<th><?php echo $this->Paginator->sort('dec');?></th>
			
			<th><?php echo $this->Paginator->sort('Book Value This Year');?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr This Year');?></th>
			<th><?php echo $this->Paginator->sort('Purchase Date','date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('Start Date','date_start');?></th>
			<th><?php echo $this->Paginator->sort('End Date','date_end');?></th>
			<th><?php echo $this->Paginator->sort('purchase_id');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $asset['AssetDetail']['id']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['AssetDetail']['code']; ?>&nbsp;</td>
		<td>
			<?php echo $asset['AssetDetail']['name']; ?>&nbsp;<br>
			<?php echo $asset['AssetDetail']['brand']; ?>&nbsp;<?php echo $asset['AssetDetail']['type']; ?>
		</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['price'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['maksi'] ); ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format( $asset['AssetDetail']['thnlalu']+$asset['AssetDetail']['blnlalu']+$asset['AssetDetail']['blnini'] ) ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['depbln'] ); ?>&nbsp;</td>
		
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['hpthnlalu']-$asset['AssetDetail']['depthnlalu'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['depthnlalu'] ); ?>&nbsp;</td>

		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['jan'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['feb'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['mar'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['apr'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['may'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['jun'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['jul'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['aug'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['sep'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['oct'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['nov'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['dec'] ); ?>&nbsp;</td>

		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['book_value'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['AssetDetail']['depthnini'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase']); ?>&nbsp;</td>
							<td class="left"><?php  if(!empty($asset['AssetDetail']['date_start'])) :
									echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_start']); 
													endif; ?>&nbsp;</td>
							<td class="left"><?php  if(!empty($asset['AssetDetail']['date_end'])) :
									echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_end']); 
													endif; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($asset['Purchase']['no'], array('controller'=>'purchases', 'action'=>'view', $asset['AssetDetail']['purchase_id']) ); ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->first('|< ' . __('first', true), array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >|', array(), null, array('class' => 'disabled'));?>
	</div>
<? endif ?>
</div>

