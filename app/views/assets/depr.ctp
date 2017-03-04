<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<?php $date_end = $this->Session->read('Asset.date_end') ?>
<?php $is_inventory = $this->Session->read('AssetReport.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<? echo $form->create('Asset', array('action' => 'reports/depr')); ?>
		<fieldset>
            <legend><?php __('Report Filters') ?></legend>
			<fieldset class="subfilter" style="width:40%">
				<legend><?php __('Asset Info') ?></legend>
				<? echo $form->input('date_end', array('type'=>'date','dateFormat' => 'MY', 'value' => $date_end, 'label'=>'As of Period', 'style'=>'width:45%')); ?>
				<?php if ($this->Session->read('Security.permissions') == normal_user_group_id || $this->Session->read('Security.permissions') == branch_head_group_id) : ?>
					  <?php echo $this->Form->input('department_id', array('options' => $departments, 'type' => 'hidden', 'value' => $Userinfo['department_id'])) ?>
					  <?php echo $this->Form->input('department_name', array('style' => 'width:100%', 'type' => 'text', 'readonly' => true, 'value' => $Userinfo['department_name'])) ?>
				<?php else : ?>
					  <? echo $form->input('department_id', array('options' => $departments, 'value' => $this->Session->read('AssetReport.department_id'), 'empty' => 'all')); ?>
				<?php endif; ?>
					 <?php echo $this->Form->input('business_type_id', array('options' => $businessType, 'empty' => 'all', 'value' => $this->Session->read('AssetReport.business_type_id'))) ?>
					  <?php echo $this->Form->input('cost_center_id', array('empty' => 'select cost center', 'type' => 'hidden')); ?>
					  <?php echo $this->Form->input('CostCenter.name', array('label' => 'Cost Center', 'style' => 'width:100%')); ?>
					  <div id="cost_center_choices" class="auto_complete"></div> 
					  <script type="text/javascript"> 
							//<![CDATA[
							new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetCostCenterValues});
							//]]>
					  </script>
				<? //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('AssetReport.department_Sub_id'),'empty'=>''  )); ?>
				<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('AssetReport.department_unit_id'), 'empty'=>''  )); ?>		
				<? /* $options = array('url' => '/departments/getDepartmentSubId/Asset', 
				  'indicator'=>'LoadingDiv', 'update' => 'AssetDepartmentSubId');
				  echo $ajax->observeField('AssetDepartmentId', $options);

				  $options = array('url' => '/department_subs/getDepartmentUnitId/Asset',
				  'indicator'=>'LoadingDiv', 'update' => 'AssetDepartmentUnitId');
				  echo $ajax->observeField('AssetDepartmentSubId', $options); */
				?>
				<?php $source_option = array( 'purchase' => 'Purchase/Register', 'mutasi' => 'Mutasi', 'import' => 'Import' ) ?>
				<?php echo $this->Form->input('source',array('options'=>$source_option,'empty'=>'all','value'=>$source)) ?>
				<?php $is_efektif = array( 'yes' => 'yes', 'no' => 'no' ) ?>
				<?php echo $this->Form->input('efektif',array('options'=>$is_efektif,'empty'=>'all','value'=>$this->Session->read('AssetReport.efektif')) )?>
			</fieldset>
			
			<fieldset class="subfilter" style="width:35%">
				<legend><?php __('Asset Category') ?></legend>
				<? echo $form->input('is_inventory', array('label' => 'Below Minimum Value', 'value' => $is_inventory, 'options' => array('1' => 'Yes', '2' => 'No', '3' => 'All'))); ?>
				<? echo $form->input('asset_category_type_id', array('options' => $assetCategoryTypes, 'empty' => '', 'value' => $this->Session->read('AssetReport.asset_category_type_id'))); ?>
				<? echo $form->input('asset_category_id', array('empty' => 'all', 'options' => $assetCategories, 'value' => $this->Session->read('AssetReport.asset_category_id'))); ?>
				<?php echo $this->Form->input('search_keyword', array('style'=>'width:100%', 'value'=>$this->Session->read('AssetReport.name')));?>
				<?php echo $this->Form->input('date_of_purchase_start', array('type'=>'date', 'value'=>$date_of_purchase_start)) ?>
				<?php echo $this->Form->input('date_of_purchase_end', array('type'=>'date', 'value'=>$date_of_purchase_end)) ?>
			</fieldset>
			
            <?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
      <?php
      $options = array(
          'url' => array('controller' => 'asset_categories', 'action' => 'get_asset_categories', 'Asset'),
          'update' => 'AssetAssetCategoryId',
          'indicator' => 'LoadingDiv',
      );
      echo $ajax->observeField('AssetAssetCategoryTypeId', $options);
      ?>
	</div>
	<div class="actions">
	  <h3><?php __('Actions'); ?></h3>
	  <ul>
			<?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
	  </ul>
	 </div>
</div>

<div class="related">
      <? if (!empty($assets)) : ?>	
            <h2><?php __('Monthly Depreciation Report per ' . $this->Session->read('AssetReport.periode')); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo $this->Paginator->sort('No'); ?></th>
                        <th><?php echo $this->Paginator->sort('department_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('business_type_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('cost_center_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('No Inventaris','code'); ?></th>
                        <th><?php echo $this->Paginator->sort('asset_category_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('item_code'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('brand'); ?></th>
                        <th><?php echo $this->Paginator->sort('type'); ?></th>
                        <th><?php echo $this->Paginator->sort('color'); ?></th>
                        <th><?php echo $this->Paginator->sort('location_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('qty'); ?></th>
                        <th><?php echo $this->Paginator->sort('Unit Cost', 'price'); ?></th>
                        <th><?php echo $this->Paginator->sort('Total Acq. Cost', 'amount'); ?></th>
                        <th><?php echo $this->Paginator->sort('Economic Age (months)', 'umurek'); ?></th>

                        <th><?php echo $this->Paginator->sort('Acq. Cost Last Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Acq. Cost This Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Monthly Depreciation', 'depbln'); ?></th>

                        <th><?php echo $this->Paginator->sort('Accum. Depr Last Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Book Value Last Year'); ?></th>

                        <th><?php echo $this->Paginator->sort('jan'); ?></th>
                        <th><?php echo $this->Paginator->sort('feb'); ?></th>
                        <th><?php echo $this->Paginator->sort('mar'); ?></th>
                        <th><?php echo $this->Paginator->sort('apr'); ?></th>
                        <th><?php echo $this->Paginator->sort('may'); ?></th>
                        <th><?php echo $this->Paginator->sort('jun'); ?></th>
                        <th><?php echo $this->Paginator->sort('jul'); ?></th>
                        <th><?php echo $this->Paginator->sort('aug'); ?></th>
                        <th><?php echo $this->Paginator->sort('sep'); ?></th>
                        <th><?php echo $this->Paginator->sort('oct'); ?></th>
                        <th><?php echo $this->Paginator->sort('nov'); ?></th>
                        <th><?php echo $this->Paginator->sort('dec'); ?></th>

                        <th><?php echo $this->Paginator->sort('Accum. Depr This Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Book Value This Year'); ?></th>

                        <th><?php echo $this->Paginator->sort('Purchase Date', 'date_of_purchase'); ?></th>
                        <th><?php echo $this->Paginator->sort('Start Date', 'date_start'); ?></th>
                        <th><?php echo $this->Paginator->sort('End Date', 'date_end'); ?></th>
                        <th><?php echo $this->Paginator->sort('purchase_id'); ?></th>

                  </tr>
                  <?php
                  $qty = 0;
                  $amount = 0;
                  $hpthnlalu = 0;
                  $hpthnini = 0;
                  $depbln = 0;
                  $ttl = 0;
                  $depthnlalu = 0;
                  $jan = 0;
                  $feb = 0;
                  $mar = 0;
                  $apr = 0;
                  $may = 0;
                  $jun = 0;
                  $jul = 0;
                  $aug = 0;
                  $sep = 0;
                  $oct = 0;
                  $nov = 0;
                  $dec = 0;
                  $depthnini = 0;
                  $book_value = 0;
                  $i = 0;
                  foreach ($assets as $asset):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
                        ?>
                        <tr<?php echo $class; ?>>
                              <td><?php echo $i; ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($departments,$asset['Asset']['department_id']); ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($businessType,$asset['Asset']['business_type_id']); ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($costCenter, $asset['Asset']['cost_center_id']) ?>-<?php echo $myApp->showArrayValue($costCenters, $asset['Asset']['cost_center_id']) ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Asset']['code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetCategory']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Asset']['item_code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Asset']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Asset']['brand']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Asset']['type']; ?></td>
                              <td class="left"><?php echo $asset['Asset']['color']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Location']['name']; ?></td>
                              <td class="center"><?php echo $asset['Asset']['qty']; ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['price']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['amount']); ?>&nbsp;</td>
                              <td class="number"><?php echo $asset['Asset']['umur']; ?> / <?php echo $asset['Asset']['maksi'] ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['Asset']['hpthnlalu']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['hpthnini']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['depbln']); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['Asset']['depthnlalu']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['book_value_thnlalu']); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['Asset']['jan']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['feb']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['mar']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['apr']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['may']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['jun']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['jul']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['aug']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['sep']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['oct']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['nov']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['dec']); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['Asset']['depthnini']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['Asset']['book_value']); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Time->format(DATE_FORMAT,$asset['Asset']['date_of_purchase']); ?>&nbsp;</td>
                              <td class="number"><?php if($asset['Asset']['date_start'] != null) : 
								echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_start']); 
								endif; ?>&nbsp;</td>
                              <td class="number"><?php if(!empty($asset['Asset']['date_end'])) : 
								echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_end']); 
								endif; ?>&nbsp;</td>
                              <td class="left"><?php echo $this->Html->link($asset['Purchase']['no'], array('controller' => 'purchases', 'action' => 'view', $asset['Asset']['purchase_id'])); ?>&nbsp;</td>

                        </tr>
                        <?php $qty += round($asset['Asset']['qty']); ?>
                        <?php $amount += round($asset['Asset']['amount']); ?>
                        <?php $hpthnlalu += round($asset['Asset']['hpthnlalu']); ?>
                        <?php $hpthnini += round($asset['Asset']['hpthnini']); ?>
                        <?php $depbln += round($asset['Asset']['depbln']); ?>
                        <?php $depthnlalu += round($asset['Asset']['depthnlalu']); ?>
                        <?php $ttl += round($asset['Asset']['book_value_thnlalu']); ?>
                        <?php $jan += round($asset['Asset']['jan']); ?>
                        <?php $feb += round($asset['Asset']['feb']); ?>
                        <?php $mar += round($asset['Asset']['mar']); ?>
                        <?php $apr += round($asset['Asset']['apr']); ?>
                        <?php $may += round($asset['Asset']['may']); ?>
                        <?php $jun += round($asset['Asset']['jun']); ?>
                        <?php $jul += round($asset['Asset']['jul']); ?>
                        <?php $aug += round($asset['Asset']['aug']); ?>
                        <?php $sep += round($asset['Asset']['sep']); ?>
                        <?php $oct += round($asset['Asset']['oct']); ?>
                        <?php $nov += round($asset['Asset']['nov']); ?>
                        <?php $dec += round($asset['Asset']['dec']); ?>
                        <?php $depthnini += round($asset['Asset']['depthnini']); ?>
                        <?php $book_value += round($asset['Asset']['book_value']); ?>
                  <?php endforeach; ?>
                  <tr>
                        <td colspan="12"><div align="right">Total</div></td>
                        <td class="center"><?php echo $this->Number->format($qty); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($amount); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($hpthnlalu); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($hpthnini); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($depthnlalu); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($ttl); ?>&nbsp;</td>
			
                        <td class="number"><?php echo $this->Number->format($jan); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($feb); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($mar); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($apr); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($may); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($jun); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($jul); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($aug); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($sep); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($oct); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($nov); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($dec); ?>&nbsp;</td>
			
                        <td class="number"><?php echo $this->Number->format($depthnini); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($book_value); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number">&nbsp;</td>
                  </tr>
                  <!--tr>
                        <td colspan="12"><div align="right">Total General</div></td>
                        <td class="center"><?php echo $this->Number->format($assetTotals['qty']); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['amount']); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['hpthnlalu']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['hpthnini']); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['depthnlalu']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['ttl']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['jan']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['feb']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['mar']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['apr']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['may']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['jun']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['jul']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['aug']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['sep']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['oct']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['nov']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['dec']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['depthnini']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetTotals['book_value']); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number">&nbsp;</td>
                  </tr-->
            </table>
            <p>
                  <?php
                  echo $this->Paginator->counter(array(
                      'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
                  ));
                  ?>	</p>

            <div class="paging">
                  <?php echo $this->Paginator->first('|< ' . __('first', true), array(), null, array('class' => 'disabled')); ?>
                  <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
                  <?php echo $this->Paginator->numbers(); ?>
                  <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
                  <?php echo $this->Paginator->last(__('last', true) . ' >|', array(), null, array('class' => 'disabled')); ?>
            </div>
      <? endif ?>
</div>

