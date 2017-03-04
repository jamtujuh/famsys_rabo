<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<?php $date_end = $this->Session->read('AssetDetail.date_end') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $form->create('AssetDetail', array('action' => 'reports/movement')); ?>
	<fieldset>
		<legend><?php __('Report Filters') ?></legend>
		<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Asset Info') ?></legend>
			<?php echo $form->input('date_end', array('type'=>'date','dateFormat' => 'MY', 'value' => $date_end)); ?>
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
			<? //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('AssetReport.department_Sub_id'),'empty'=>''  )); ?>
			<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('AssetReport.department_unit_id'), 'empty'=>''  )); ?>		
			<? /* $options = array('url' => '/departments/getDepartmentSubId/AssetDetail', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentSubId');
			echo $ajax->observeField('AssetDetailDepartmentId', $options);

			$options = array('url' => '/department_subs/getDepartmentUnitId/AssetDetail',
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentUnitId');
			echo $ajax->observeField('AssetDetailDepartmentSubId', $options); */
			?>	
		    <?php echo $form->input('asset_category_type_id', array('options' => $assetCategoryTypes, 'empty' => '', 'value' => $this->Session->read('AssetReport.asset_category_type_id'), 'type' => 'hidden')); ?>
		    <?php echo $form->input('asset_category_id', array('options' => $assetCategories, 'value' => $this->Session->read('AssetReport.asset_category_id'), 'empty' => 'all', 'type' => 'hidden')); ?>
		    <?php echo $this->Form->input('is_inventory', array('value'=>'0','type'=>'hidden') ); ?>
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
	<h2><?php __('Fixed Asset Movement Report per ' . $this->Session->read('AssetReport.periode')); ?></h2>
	<h3><?php echo __('Cost'); ?></h3>
      <? if (!empty($costs)) : ?>	

            <table cellpadding=0  cellspacing=0 >
                  <tr >
                        <th rowspan=2 ><?php __('No'); ?></th>
                        <th rowspan=2 ><?php __('Asset Category'); ?></th>
                        <th rowspan=2 ><?php __('Saldo Awal Tahun Lalu') ?></th>
                        <th colspan=5 ><?php __('Penambahan Tahun Ini') ?></th>
                        <th rowspan=2 ><?php __('Total Penambahan') ?></th>
                        <th colspan=6 ><?php __('Pengurang Tahun Ini') ?></th>
                        <th rowspan=2 ><?php __('Total Pengurangan') ?></th>
                        <th rowspan=2 ><?php __('Ending Balance') ?></th>
                  </tr>
                  <tr>
                        <th ><?php __('Pembelian') ?></th>
                        <th ><?php __('Mutasi Masuk') ?></th>
                        <th ><?php __('Reklas dari gol ke gol') ?></th>
                        <th ><?php __('Reklas') ?></th>
                        <th ><?php __('Revaluasi') ?></th>

                        <th ><?php __('Mutasi Keluar') ?></th>
                        <th ><?php __('Penjualan') ?></th>
                        <th ><?php __('Scrapt') ?></th>
                        <th ><?php __('Revaluasi') ?></th>
                        <th ><?php __('Recalss') ?></th>
                        <th ><?php __('Reklas dari gol ke gol') ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  foreach ($costs as $asset_category_id => $cost):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              //$class = ' class="altrow"';
                        }

                        ?>	
                        <tr<?php echo $class; ?>>
                              <td><?php echo ($i); ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($assetCategories,$asset_category_id); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['begin_balance']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['add_purchase']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['add_mutasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['add_reclass_gol']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['add_reclass']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['add_revaluasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['add_total']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_mutasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_sales']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_scrapt']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_revaluasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_reclass']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_reclass_gol']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['deduct_total']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($cost['ending_balance']) ?>&nbsp;</td>
                        </tr>
                  <?php endforeach; ?>

            </table>
      <? endif ?>
</div>


<div class="related">
      <h3><?php echo __('Accumulated Depreciation'); ?></h3>
      <? if (!empty($deprs)) : ?>	

            <table cellpadding=0  cellspacing=0 >
                  <tr >
                        <th rowspan=2 ><?php __('No'); ?></th>
                        <th rowspan=2 ><?php __('Asset Category'); ?></th>
                        <th rowspan=2 ><?php __('Saldo Awal Tahun Lalu') ?></th>
                        <th colspan=5 ><?php __('Penambahan Tahun Ini') ?></th>
                        <th rowspan=2 ><?php __('Total Penambahan') ?></th>
                        <th colspan=6 ><?php __('Pengurang Tahun Ini') ?></th>
                        <th rowspan=2 ><?php __('Total Pengurangan') ?></th>
                        <th rowspan=2 ><?php __('Ending Balance') ?></th>
                  </tr>
                  <tr>
                        <th ><?php __('Pembelian') ?></th>
                        <th ><?php __('Mutasi Masuk') ?></th>
                        <th ><?php __('Reklas dari gol ke gol') ?></th>
                        <th ><?php __('Reklas') ?></th>
                        <th ><?php __('Revaluasi') ?></th>

                        <th ><?php __('Mutasi Keluar') ?></th>
                        <th ><?php __('Penjualan') ?></th>
                        <th ><?php __('Scrapt') ?></th>
                        <th ><?php __('Revaluasi') ?></th>
                        <th ><?php __('Recalss') ?></th>
                        <th ><?php __('Reklas dari gol ke gol') ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  foreach ($deprs as $asset_category_id => $depr):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              //$class = ' class="altrow"';
                        }
                        ?>	
                        <tr<?php echo $class; ?>>
                              <td><?php echo ($i); ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($assetCategories,$asset_category_id); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['begin_balance']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['add_purchase']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['add_mutasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['add_reclass_gol']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['add_reclass']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['add_revaluasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['add_total']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_mutasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_sales']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_scrapt']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_revaluasi']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_reclass']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_reclass_gol']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['deduct_total']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($depr['ending_balance']) ?>&nbsp;</td>
                        </tr>
                  <?php endforeach; ?>

            </table>
      <? endif ?>
</div>

<div class="related">
      <h3><?php echo __('Book Value'); ?></h3>
      <? if (!empty($books)) : ?>	

            <table cellpadding=0  cellspacing=0 >
                  <tr >
                        <th ><?php __('No'); ?></th>
                        <th ><?php __('Asset Category'); ?></th>
                        <th ><?php __('Cost') ?></th>
                        <th ><?php __('Accum. Depreciation') ?></th>
                        <th ><?php __('Book Value') ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  foreach ($books as $asset_category_id => $book):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              //$class = ' class="altrow"';
                        }
                        ?>	
                        <tr<?php echo $class; ?>>
                              <td><?php echo ($i); ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($assetCategories,$asset_category_id); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($book['cost']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($book['depr']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($book['book']) ?>&nbsp;</td>
                        </tr>
                  <?php endforeach; ?>

            </table>
      <? endif ?>
</div>