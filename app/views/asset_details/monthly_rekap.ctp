<?php
	echo $javascript->link('my_script',false);
	echo $javascript->link('my_detail_add',false);
?>
<?php $date_end = $this->Session->read('Asset.date_end') ?>
<?php $is_inventory = $this->Session->read('AssetReport.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>

<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<? echo $form->create('AssetDetail', array('action' => 'reports/monthly_rekap'));?>
	<fieldset>
		<legend><?php __('Report Filters') ?></legend>
		<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Asset Info') ?></legend>
			<?php //echo $form->input('date_end', array('type'=>'date','dateFormat' => 'MY', 'value' => $date_end)); ?>
			<?php if ($this->Session->read('Security.permissions') == normal_user_group_id || $this->Session->read('Security.permissions') == branch_head_group_id) : ?>
			  <?php echo $this->Form->input('department_id', array('options' => $departments, 'type' => 'hidden', 'value' => $Userinfo['department_id'])) ?>
			  <?php echo $this->Form->input('department_name', array('style' => 'width:100%', 'type' => 'text', 'readonly' => true, 'value' => $Userinfo['department_name'])) ?>
			<?php else : ?>
			  <?php echo $form->input('department_id', array('options' => $departments, 'value' => $this->Session->read('AssetReport.department_id'), 'empty' => 'all')); ?>
			<?php endif; ?>
			 <?php echo $this->Form->input('business_type_id', array('options' => $businessType, 'empty' => 'all', 'value' => $this->Session->read('AssetReport.business_type_id'))) ?>
			  <?php echo $this->Form->input('cost_center_id', array('empty' => 'select cost center', 'type' => 'hidden')); ?>
			  <?php echo $this->Form->input('CostCenter.name', array('label' => 'Cost Center', 'style' => 'width:100%')); ?>
			  <div id="cost_center_choices" class="auto_complete"></div> 
			  <script type="text/javascript"> 
				//<![CDATA[
				new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetDetailCostCenterValues});
				//]]>
			  </script>
			  </fieldset>
			<? //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('AssetReport.department_Sub_id'),'empty'=>''  )); ?>
			<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('AssetReport.department_unit_id'), 'empty'=>''  )); ?>		
			<? /* $options = array('url' => '/departments/getDepartmentSubId/AssetDetail', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentSubId');
			echo $ajax->observeField('AssetDetailDepartmentId', $options);

			$options = array('url' => '/department_subs/getDepartmentUnitId/AssetDetail',
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentUnitId');
			echo $ajax->observeField('AssetDetailDepartmentSubId', $options); */
			?>	
			<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Asset Category') ?></legend>
			<?php echo $this->Form->input('is_inventory', array('label'=>'Below Minimum Value','value'=>$is_inventory,'options'=>array('1'=>'Yes','2'=>'No', '3'=>'All'))); ?>
		    <?php echo $form->input('asset_category_type_id', array('options' => $assetCategoryTypes, 'empty' => '', 'value' => $this->Session->read('AssetReport.asset_category_type_id'))); ?>
		    <?php echo $form->input('asset_category_id', array('options' => $assetCategories, 'value' => $this->Session->read('AssetReport.asset_category_id'), 'empty' => 'all')); ?>
		</fieldset>

		<?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>

		<?php echo $this->Form->submit('Refresh') ?>
	</fieldset>
	<?php echo $this->Form->end() ?>
	</div>
	<div class="actions">
	      <h3><?php __('Actions'); ?></h3>
	      <ul>
		    <?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
	      </ul>
	</div>
    
</div>
	

<div class="related">
<h2><?php __('Fixed Asset Monthly Recap per ' . $this->Session->read('AssetReport.periode'));?></h2>

<? if (!empty($assets)) : ?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('No');?></th>
		<th><?php __('Asset Category');?></th>
		<th><?php __('Acquisition Cost' );?></th>
		<th><?php __('Accum. Depr. Cost Last Year');?></th>
		<th><?php __('Book Value Last Year');?></th>
		<th><?php __('Book Value');?></th>
		<th><?php __('Accum . Depr. This Year');?></th>
		<th><?php __('Jan');?></th>
		<th><?php __('Feb');?></th>
		<th><?php __('Mar');?></th>
		<th><?php __('Apr');?></th>
		<th><?php __('May');?></th>
		<th><?php __('Jun');?></th>
		<th><?php __('Jul');?></th>
		<th><?php __('Aug');?></th>
		<th><?php __('Sep');?></th>
		<th><?php __('Oct');?></th>
		<th><?php __('Nov');?></th>
		<th><?php __('Dec');?></th>
	</tr>
	<?php
	$a = 0;
	$b = 0;
	$c = 0;
	$d = 0;
	$f = 0;
	$g = 0;
	$h = 0;
	$z = 0;
	$x = 0;
	$j = 0;
	$k = 0;
	$l = 0;
	$m = 0;
	$n = 0;
	$o = 0;
	$p = 0;
	$q = 0;
	$i = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
	?>
	<tr<?php echo $class;?>>
		<td><?php echo ($i ); ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategories[ $asset['AssetDetail']['asset_category_id'] ]; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['price'] ); ?>&nbsp;</td>		
		<td class="number"><?php echo $this->Number->format( $asset['0']['depthnlalu'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['price'] - $asset['0']['depthnlalu']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['book_value'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['depthnini'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['jan'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['feb'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['mar'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['apr'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['may'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['jun'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['jul'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['aug'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['sep'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['oct'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['nov'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['dec'] ); ?>&nbsp;</td>
	</tr>
	<?php $a += round($asset['0']['price']);?>
	<?php $b += round($asset['0']['depthnlalu']);?>
	<?php $c += round($asset['0']['price'] - $asset['0']['depthnlalu']);?>
	<?php $x += round($asset['0']['book_value']);?>
	<?php $d += round($asset['0']['depthnini']);?>
	<?php $f += round($asset['0']['jan']);?>
	<?php $g += round($asset['0']['feb']);?>
	<?php $h += round($asset['0']['mar']);?>
	<?php $z += round($asset['0']['apr']);?>
	<?php $j += round($asset['0']['may']);?>
	<?php $k += round($asset['0']['jun']);?>
	<?php $l += round($asset['0']['jul']);?>
	<?php $m += round($asset['0']['aug']);?>
	<?php $n += round($asset['0']['sep']);?>
	<?php $o += round($asset['0']['oct']);?>
	<?php $p += round($asset['0']['nov']);?>
	<?php $q += round($asset['0']['dec']);?>
	<?php endforeach; ?>
	<tr>
		<td colspan="2"><div align="right">Total  General</div></td>
		<td class="number"><?php echo $this->Number->format($a); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($b); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($c); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($x); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($d); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($f); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($g); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($h); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($z); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($j); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($k); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($l); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($m); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($n); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($o); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($p); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($q); ?>&nbsp;</td>
	</tr>
	</table>
<? endif ?>
</div>
