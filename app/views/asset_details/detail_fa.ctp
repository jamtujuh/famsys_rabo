<?php
//	echo $javascript->link('prototype',false);
//	echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
$date_end = $this->Session->read('AssetDetail.date_end');
$is_inventory = $this->Session->read('AssetReport.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<? echo $form->create('AssetDetail', array('action' => 'reports/detail_fa')); ?>
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
            <h2><?php __('Fixed Asset Details Report per ' . $this->Session->read('AssetReport.periode')); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo $this->Paginator->sort('No'); ?></th>
                        <th><?php echo $this->Paginator->sort('department_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('business_type_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('cost_center_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('No Invetaris','code'); ?></th>
                        <th><?php echo $this->Paginator->sort('item_code'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('brand'); ?></th>
                        <th><?php echo $this->Paginator->sort('type'); ?></th>
                        <th><?php echo $this->Paginator->sort('color'); ?></th>
                        <th><?php echo $this->Paginator->sort('location_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('serial_no'); ?></th>
                        <th><?php echo $this->Paginator->sort('Start Date', 'date_start'); ?></th>
                        <th><?php echo $this->Paginator->sort('End Date', 'date_end'); ?></th>
                        <th><?php echo $this->Paginator->sort('Monthly Depr','depbln'); ?></th>
                        <th><?php echo $this->Paginator->sort('Unit Cost', 'price'); ?></th>
			
                        <th><?php echo $this->Paginator->sort('Accum. Depr Last Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Book Value Last Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Accum. Depr This Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('Book Value This Year'); ?></th>
                  </tr>
                  <?php
                  $a = 0;
                  $b = 0;
                  $c = 0;
                  $d = 0;
                  $e = 0;
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
                              <td class="left"><?php echo $asset['AssetDetail']['item_code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['brand']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['type']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['color']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Location']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['serial_no']; ?>&nbsp;</td>
							<td class="left"><?php  if(!empty($asset['AssetDetail']['date_start'])) :
									echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_start']); 
													endif; ?>&nbsp;</td>
							<td class="left"><?php  if(!empty($asset['AssetDetail']['date_end'])) :
									echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_end']); 
													endif; ?>&nbsp;</td>

                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depbln']); ?>&nbsp;</td>
			      
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['price']); ?>&nbsp;</td>					      
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depthnlalu']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value_thnlalu']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depthnini']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value']); ?>&nbsp;</td>

                        </tr>
                        <?php $a += round($asset['AssetDetail']['price']); ?>
                        <?php $b += round($asset['AssetDetail']['depthnlalu']); ?>
                        <?php $c += round($asset['AssetDetail']['book_value_thnlalu']); ?>
                        <?php $d += round($asset['AssetDetail']['depthnini']); ?>
                        <?php $e += round($asset['AssetDetail']['book_value']); ?>
                  <?php endforeach; ?>
                  <tr>
                        <td colspan="15"><div align="right">Total</div></td>
                        <td class="number"><?php echo $this->Number->format($a); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($b); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($c); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($d); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($e); ?>&nbsp;</td>
                  </tr>
                  <!--tr>
                        <td colspan="15"><div align="right">Total General</div></td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['price']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['depthnlalu']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['book_value_thnlalu']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['depthnini']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($assetDetailTotal['book_value']); ?>&nbsp;</td>
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

