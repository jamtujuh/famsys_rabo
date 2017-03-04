<?php
//	echo $javascript->link('prototype',false);
//	echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
$date_end = $this->Session->read('AssetDetail.date_end');
$is_inventory = $this->Session->read('AssetReport.is_inventory');
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<? echo $form->create('AssetDetail', array('action' => 'reports/depr')); ?>
		<fieldset>
            <legend><?php __('Report Filters') ?></legend>
			<fieldset class="subfilter" style="width:40%">
				<legend><?php __('Asset Info') ?></legend>
				<?php echo $this->Form->input('date_end', array('type'=>'date', 'dateFormat'=>'MY', 'value'=>$date_end)); ?>
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
							new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetDetailCostCenterValues});
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
			
			<fieldset class="subfilter" style="width:40%">
				<legend><?php __('Asset Category') ?></legend>
				<? echo $form->input('is_inventory', array('label' => 'Below Minimum Value', 'value' => $is_inventory, 'options' => array(1 => 'Yes', 2 => 'No', 3 => 'All'))); ?>
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
          'url' => array('controller' => 'asset_categories', 'action' => 'get_asset_categories', 'AssetDetail'),
          'update' => 'AssetDetailAssetCategoryId',
          'indicator' => 'LoadingDiv',
      );
      echo $ajax->observeField('AssetDetailAssetCategoryTypeId', $options);
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
            <h2><?php __('Monthly Detail Asset Depreciation Report per ' . $this->Session->read('AssetReport.periode')); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo $this->Paginator->sort('No'); ?></th>
                        <th><?php echo $this->Paginator->sort('Branch', 'department_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('Business Type', 'business_typr_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('Cost Center','cost_centert_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('No Inventaris','code'); ?></th>
                        <th><?php echo $this->Paginator->sort('asset_category_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('Item Code','item_code'); ?></th>
                        <th><?php echo $this->Paginator->sort('Name','name'); ?></th>
                        <th><?php echo $this->Paginator->sort('Brand','brand'); ?></th>
                        <th><?php echo $this->Paginator->sort('Type','type'); ?></th>
                        <th><?php echo $this->Paginator->sort('Color','color'); ?></th>
                        <th><?php echo $this->Paginator->sort('location_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('serial_no'); ?></th>
                        <th><?php echo $this->Paginator->sort('Unit Cost', 'price'); ?></th>
                        <th><?php echo $this->Paginator->sort('Economic Age (months)','umurek'); ?></th>

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
                  $price = 0;
                  $hpthnlalu = 0;
                  $hpthnini = 0;
                  $depbln = 0;
                  $book_value_thnlalu = 0;
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
                              <td class="left"><?php echo $departments[$asset['AssetDetail']['department_id']]; ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($businessType,$asset['AssetDetail']['business_type_id']); ?>&nbsp;</td>
                              <td class="left"><?php echo $myApp->showArrayValue($costCenter,$asset['AssetDetail']['cost_center_id']); ?>-<?php echo $myApp->showArrayValue($costCenters,$asset['AssetDetail']['cost_center_id']); ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetCategory']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['item_code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['brand']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['type']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['color']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Location']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['serial_no']; ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['price']); ?>&nbsp;</td>
                              <td class="number"><?php echo $asset['AssetDetail']['umur']; ?> / <?php echo $asset['AssetDetail']['maksi'] ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['hpthnlalu']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['hpthnini']) ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depbln']); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depthnlalu']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value_thnlalu'] ); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['jan']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['feb']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['mar']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['apr']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['may']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['jun']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['jul']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['aug']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['sep']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['oct']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['nov']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['dec']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depthnini']); ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase']); ?>&nbsp;</td>
							<td class="left"><?php  if(!empty($asset['AssetDetail']['date_start'])) :
									echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_start']); 
													endif; ?>&nbsp;</td>
							<td class="left"><?php  if(!empty($asset['AssetDetail']['date_end'])) :
									echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_end']); 
													endif; ?>&nbsp;</td>
                              <td class="left"><?php echo $this->Html->link($asset['Purchase']['no'], array('controller' => 'purchases', 'action' => 'view', $asset['AssetDetail']['purchase_id'])); ?>&nbsp;</td>

                        </tr>
                        <?php $price += round($asset['AssetDetail']['price']); ?>
                        <?php $hpthnlalu += round($asset['AssetDetail']['hpthnlalu']); ?>
                        <?php $hpthnini += round($asset['AssetDetail']['hpthnini']); ?>
                        <?php $depbln += round($asset['AssetDetail']['depbln']); ?>
                        
						<?php $depthnlalu += round($asset['AssetDetail']['depthnlalu']); ?>
                        <?php $book_value_thnlalu += round($asset['AssetDetail']['book_value_thnlalu']); ?>
			
                        <?php $jan += round($asset['AssetDetail']['jan']); ?>
                        <?php $feb += round($asset['AssetDetail']['feb']); ?>
                        <?php $mar += round($asset['AssetDetail']['mar']); ?>
                        <?php $apr += round($asset['AssetDetail']['apr']); ?>
                        <?php $may += round($asset['AssetDetail']['may']); ?>
                        <?php $jun += round($asset['AssetDetail']['jun']); ?>
                        <?php $jul += round($asset['AssetDetail']['jul']); ?>
                        <?php $aug += round($asset['AssetDetail']['aug']); ?>
                        <?php $sep += round($asset['AssetDetail']['sep']); ?>
                        <?php $oct += round($asset['AssetDetail']['oct']); ?>
                        <?php $nov += round($asset['AssetDetail']['nov']); ?>
                        <?php $dec += round($asset['AssetDetail']['dec']); ?>
                        <?php $depthnini += round($asset['AssetDetail']['depthnini']); ?>
                        <?php $book_value += round($asset['AssetDetail']['book_value']); ?>
                  <?php endforeach; ?>
                  <tr>
                        <td colspan="13"><div align="right">Total</div></td>
                        <td class="number"><?php echo $this->Number->format($price); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($hpthnlalu); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($hpthnini); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($depthnlalu); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($book_value_thnlalu); ?>&nbsp;</td>

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
                        <td colspan="4">&nbsp;</td>
                  </tr>
                  <!--tr>
                        <td colspan="12"><div align="right">Total General</div></td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['price']); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['hpthnlalu']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['hpthnini']); ?>&nbsp;</td>
                        <td class="number">&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['depthnlalu']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['book_value_thnlalu']); ?>&nbsp;</td>
			
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['jan']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['feb']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['mar']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['apr']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['may']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['jun']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['jul']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['aug']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['sep']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['oct']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['nov']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['dec']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['depthnini']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['book_value']); ?>&nbsp;</td>
                        <td colspan="4">&nbsp;</td>
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

