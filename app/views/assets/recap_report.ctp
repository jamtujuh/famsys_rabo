
<div class="assets index">
	<h2><?php __('Assets Recapitulation Report');?></h2>
<? echo $form->create('Asset', array('action' => 'depr_report'));?>
<fieldset>
	<? echo $form->input('year', array( 'label' => 'Acquisition Year', 'value'=>$this->Session->read('AssetReport.year'), 'style'=>'width:50px')); ?>
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
		<li><?php echo $this->Html->link(__('Asset Details Depr.', true), array('controller'=>'asset_details', 'action'=>'depr_report') ); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller'=>'purchases', 'action'=>'index') ); ?> </li>
	</ul>
</div>

<div class="related">
<? if (!empty($assetCategories)) : ?>	
	<?php $class="" ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Html->link('Category','name');?></th>
		<?php foreach ($assetCategories as $id=>$name):?>
		<th><?php echo $this->Html->link($name,$id);?>&nbsp;</th>
		<?php endforeach; ?>
	</tr>

	<tr<?php echo $class;?>>
		<td class="left"><strong>Beginning Balance</strong>&nbsp;</td>
		<?php for ($i=0; $i<count($assetCategories); $i++):?>
		<td class="number">0.00&nbsp;</td>
		<?php endfor; ?>
	</tr>

	<tr<?php echo $class;?>>
		<td class="left">Additions&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>

	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Purchases&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Transfer Inter-branch&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Reklass from Group&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Reclassification&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Fixed Asset Revaluation&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left" colspan="<?=count($assetCategories)+1?>">&nbsp;</td>
	</tr>
	<tr<?php echo $class;?>>
		<td class="left">Deductions&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Purchases&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Transfer Inter-branch&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Reklass from Group&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Reclassification&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left">Fixed Asset Revaluation&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	<tr<?php echo $class;?>>
		<td style="padding-left:40px" class="left" colspan="<?=count($assetCategories)+1?>">&nbsp;</td>
	</tr>
	
	<tr<?php echo $class;?>>
		<td class="left"><strong>Ending Balance</strong>&nbsp;</td>
		<?php foreach ($assetCategories as $id=>$name):?>
		<td class="number">0.00&nbsp;</td>
		<?php endforeach; ?>
	</tr>
	</table>

<? endif ?>
</div>

