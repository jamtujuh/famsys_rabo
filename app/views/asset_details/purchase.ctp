<?php
//echo $javascript->link('prototype', false);
//echo $javascript->link('scriptaculous', false);
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<?php $date_start = $this->Session->read('Asset.date_start') ?>
<?php $date_end = $this->Session->read('Asset.date_end') ?>
<?php $is_inventory = $this->Session->read('AssetReport.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
      <? echo $form->create('AssetDetail', array('action' => 'reports/purchase')); ?>
      <fieldset>
            <legend><?php __('Report Filters') ?></legend>
	      <fieldset class="subfilter" style="width:40%">
		    <legend><?php __('Asset Info') ?></legend>
			<?php echo $form->input('date_of_purchase_start', array('type'=>'date', 'value' => $date_of_purchase_start)); ?>
			<?php echo $form->input('date_of_purchase_end', array('type'=>'date', 'value' => $date_of_purchase_end)); ?>
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
			<? //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('AssetReport.department_sub_id'), 'empty'=>''  )); ?>
			<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('AssetReport.department_unit_id'),  'empty'=>''  )); ?>		
			<? /* $options = array('url' => '/departments/getDepartmentSubId/AssetDetail', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentSubId');
			echo $ajax->observeField('AssetDetailDepartmentId', $options);

			$options = array('url' => '/department_subs/getDepartmentUnitId/AssetDetail',
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentUnitId');
			echo $ajax->observeField('AssetDetailDepartmentSubId', $options); */
			?>
			<?php $source_option = array( 'purchase' => 'Purchase/Register', 'mutasi' => 'Mutasi', 'import' => 'Import' ) ?>
			<?php echo $this->Form->input('source',array('options'=>$source_option,'empty'=>'all','value'=>$source)) ?>
		</fieldset>
	      <fieldset class="subfilter" style="width:40%">
		    <legend><?php __('Asset Category') ?></legend>
			<?php echo $this->Form->input('is_inventory', array('label' => 'Below Minimum Value', 'value' => $is_inventory, 'options' => array('1' => 'Yes', '2' => 'No', '3' => 'All'))); ?>
			<? echo $form->input('asset_category_type_id', array('options' => $assetCategoryTypes, 'empty' => '', 'value' => $this->Session->read('AssetReport.asset_category_type_id'))); ?>
			<? echo $form->input('asset_category_id', array('options' => $assetCategories, 'value' => $this->Session->read('AssetReport.asset_category_id'), 'empty' => 'all')); ?>
			<? echo $form->input('search_keyword', array('style' => 'width:100%', 'value' => $this->Session->read('AssetReport.name'))); ?>
			<?php $is_efektif = array( 'yes' => 'yes', 'no' => 'no' ) ?>
			<?php echo $this->Form->input('efektif',array('options'=>$is_efektif,'empty'=>'all','value'=>$this->Session->read('AssetReport.efektif'))) ?>
		</fieldset>
            <?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
      </fieldset>
    <?php echo $this->Form->end() ?>
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
            <h2><?php __('Fixed Asset Purchase Report'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo $this->Paginator->sort('no'); ?></th>
                        <th><?php echo $this->Paginator->sort('doc_no'); ?></th>
                        <th><?php echo $this->Paginator->sort('department_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('business_type_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('cost_center_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('No Inventaris','code'); ?></th>
                        <th><?php echo $this->Paginator->sort('item_code'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('brand'); ?></th>
                        <th><?php echo $this->Paginator->sort('type'); ?></th>
                        <th><?php echo $this->Paginator->sort('color'); ?></th>
                        <th><?php echo $this->Paginator->sort('location_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('serial_no'); ?></th>
                        <th><?php echo $this->Paginator->sort('asset_category_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('date_of_purchase'); ?></th>
                        <th><?php echo $this->Paginator->sort('date_of_start'); ?></th>
                        <th><?php echo $this->Paginator->sort('date_of_end'); ?></th>
                        <th><?php echo $this->Paginator->sort('Acquisition Cost', 'price'); ?></th>
                        <th><?php echo $this->Paginator->sort('Accum. Depr.'); ?></th>
                        <th><?php echo $this->Paginator->sort('Book Of Value'); ?></th>
                  </tr>
                  <?php
                  $price = 0;
                  $depthnini = 0;
                  $book_value = 0;
                  $i = 0;
                  foreach ($assets as $asset):
                        //if($department_id && $assetDetail['department_id']!=$department_id) break;
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
                        ?>
                        <tr<?php echo $class; ?>>
                              <td class="number"><?php echo $i; ?>&nbsp;</td>
                              <td class="number"><?php echo $asset['Purchase']['no']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Department']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['BusinessType']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['CostCenter']['cost_centers']; ?>-<?php echo $asset['CostCenter']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['item_code']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['brand']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['type']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['color']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['Location']['name']; ?>&nbsp;</td>
                              <td class="left"><?php echo $asset['AssetDetail']['serial_no']; ?>&nbsp;</td>
                              <td class="left"><?php echo $assetCategories[$asset['AssetDetail']['asset_category_id']]; ?>&nbsp;</td>
                              <td class="left"><?php echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_of_purchase']); ?>&nbsp;</td>
								<td class="left"><?php  if(!empty($asset['AssetDetail']['date_start'])) :
										echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_start']); 
														endif; ?>&nbsp;</td>
								<td class="left"><?php  if(!empty($asset['AssetDetail']['date_end'])) :
										echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_end']); 
														endif; ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['price']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['depthnini']); ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($asset['AssetDetail']['book_value']); ?>&nbsp;</td>
                        </tr>
                        <?php $price +=round($asset['AssetDetail']['price']); ?>
                        <?php $depthnini +=round($asset['AssetDetail']['depthnini']); ?>
                        <?php $book_value +=round($asset['AssetDetail']['book_value']); ?>
                  <?php endforeach; ?>


                  <tr>
                        <td colspan="16">&nbsp;</td>
                        <td><div align="right">Total</div></td>
                        <td><div align="right"><?php echo $this->Number->format($price); ?>&nbsp;</div></td>
                        <td><div align="right"><?php echo $this->Number->format($depthnini); ?>&nbsp;</div></td>
                        <td><div align="right"><?php echo $this->Number->format($book_value); ?>&nbsp;</div></td>
                        <td>&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                  </tr>
                  <!--tr>
                        <td colspan="17"><div align="right">Total General</div></td>
                        <td><div align="right"><?php echo $this->Number->format($assetDetailTotal['price']); ?>&nbsp;</div></td>
                        <td><div align="right"><?php echo $this->Number->format($assetDetailTotal['depthnini']); ?>&nbsp;</div></td>
                        <td><div align="right"><?php echo $this->Number->format($assetDetailTotal['book_value']); ?>&nbsp;</div></td>
                        <td>&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                  </tr-->
            </table>
            <p>
                  <?php
                  echo $this->Paginator->counter(array(
                      'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
                  ));
                  ?>	</p>

            <div class="paging">
                  <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
      	 | 	<?php echo $this->Paginator->numbers(); ?>
                  |
                  <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
            </div>
      <?php endif; ?>
</div>