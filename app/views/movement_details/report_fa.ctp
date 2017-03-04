<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<?php $is_inventory = $this->Session->read('MovementDetail.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
			<?php echo $this->Form->create('MovementDetail', array('action' => 'reports/fa')) ?>
     <fieldset>
        <legend><?php __('Fixed Asset Transfer Report Filters') ?></legend>
          	<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Dest Branch') ?></legend>

			<?php if ($this->Session->read('Security.permissions') == normal_user_group_id || $this->Session->read('Security.permissions') == branch_head_group_id) : ?>
                  <?php echo $this->Form->input('dest_department_id', array('options' => $departments, 'type' => 'hidden', 'value' => $Userinfo['department_id'])) ?>
                  <?php echo $this->Form->input('department_name', array('label' => 'Dest Branch', 'style' => 'width:100%', 'type' => 'text', 'readonly' => true, 'value' => $Userinfo['department_name'])) ?>
            <?php else : ?>
				<?php echo $this->Form->input('dest_department_id', array('label' => 'Dest Branch', 'options' => $departments, 'empty' => 'all', 'value' => $dest_department_id)) ?>
			 <?php endif; ?>
				<?php echo $this->Form->input('dest_business_type_id', array('options' => $businessType, 'empty' => 'all', 'value' => $dest_business_type_id)) ?>
				<?php echo $this->Form->input('dest_cost_center_id', array('empty' => 'all', 'value' => $dest_cost_center_id, 'type' => 'hidden')); ?>
				<?php echo $this->Form->input('DestCostCenter.name', array('label' => 'Dest Cost Center', 'style' => 'width:100%')); ?>
				<div id="dest_cost_center_choices" class="auto_complete"></div> 
				<script type="text/javascript"> 
					  //<![CDATA[
					  new Ajax.Autocompleter('DestCostCenterName', 'dest_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_destination', {afterUpdateElement : setDestCostCenterValues});
					  //]]>
				</script>
			
		   <br>
            <?php echo $this->Form->input('date_start', array('type' => 'date', 'value' => $date_start)) ?>
            <?php echo $this->Form->input('date_end', array('type' => 'date', 'value' => $date_end)) ?>
			<?php echo $this->Form->input('is_inventory', array('label'=>'Below Minimum Value','value'=>$is_inventory,'options'=>array('1'=>'Yes','2'=>'No', '3'=>'All'))); ?>	
			</fieldset>
			<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Source Branch') ?></legend>
			<?php echo $this->Form->input('source_department_id', array('options' => $departments, 'empty' => 'all', 'value' => $source_department_id)) ?>
			<?php echo $this->Form->input('source_business_type_id', array('options' => $businessType, 'empty' => 'all', 'value' => $source_business_type_id)) ?>
			<?php echo $this->Form->input('source_cost_center_id', array('empty' => 'all', 'value' => $source_cost_center_id, 'type' => 'hidden')); ?>
			<?php echo $this->Form->input('SourceCostCenter.name', array('label' => 'Source Cost Center', 'style' => 'width:100%')); ?>
			<div id="source_cost_center_choices" class="auto_complete"></div> 
			<script type="text/javascript"> 
				//<![CDATA[
				new Ajax.Autocompleter('SourceCostCenterName', 'source_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_source', {afterUpdateElement : setSourceCostCenterValues});
				//]]>
			</script>
            <?php //echo $form->input('source_department_sub_id', array('options'=>$departmentSub, 'empty'=>''  )); ?>
            <?php //echo $form->input('source_department_unit_id', array( 'options'=>$departmentUnit, 'empty'=>''  )); ?>
            <?php
            /* $options = array('url' => 'getSourceDepartmentSubId', 
              'indicator'=>'LoadingDiv', 'update' => 'MovementDetailSourceDepartmentSubId');
              echo $ajax->observeField('MovementDetailSourceDepartmentId', $options);

              $options = array('url' => 'getSourceDepartmentUnitId',
              'indicator'=>'LoadingDiv', 'update' => 'MovementDetailSourceDepartmentUnitId');
              echo $ajax->observeField('MovementDetailSourceDepartmentSubId', $options); */
            ?>
            
            <br>
            <?php echo $this->Form->input('asset_category_id', array('options' => $assetCategories, 'empty' => 'all', 'value' => $asset_category_id)) ?>
			<?php echo $this->Form->input('search_keyword', array('style'=>'width:100%', 'value' => $this->Session->read('MovementDetail.name'))) ?>
			</fieldset>
			
			<?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
	</div>

<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>
            <?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
      </ul>
</div>
</div>
<div class="movement related">
      <h2><?php __('Fixed Asset Transfer Report'); ?></h2>
      <table cellpadding="0" cellspacing="0">
            <tr>
                  <th><?php echo $this->Paginator->sort('no'); ?></th>
                  <th><?php echo $this->Paginator->sort('Doc No','no'); ?></th>
                  <th><?php echo $this->Paginator->sort('No Inventaris', 'code'); ?></th>
                  <th><?php echo $this->Paginator->sort('item_code'); ?></th>
                  <th><?php echo $this->Paginator->sort('name'); ?></th>
                  <th><?php echo $this->Paginator->sort('brand'); ?></th>
                  <th><?php echo $this->Paginator->sort('type'); ?></th>
                  <th><?php echo $this->Paginator->sort('color'); ?></th>
                  <th><?php echo $this->Paginator->sort('serial_no'); ?></th>
                  <th><?php echo $this->Paginator->sort('asset_category_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('source_department_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('source_business_type_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('source_cost_center_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('dest_department_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('dest_business_type_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('dest_cost_center_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('doc_date'); ?></th>
                  <th><?php echo $this->Paginator->sort('date_of_purchase'); ?></th>
                  <th><?php echo $this->Paginator->sort('price'); ?></th>
                  <th><?php echo $this->Paginator->sort('Accum. Depr'); ?></th>
                  <th><?php echo $this->Paginator->sort('Book Value'); ?></th>
                  <th><?php echo $this->Paginator->sort('notes'); ?></th>
            </tr>
            <?php
            $i = 0;
            $price = 0;
            $depthnini = 0;
            $book_value = 0;
            foreach ($movementDetails as $movementDetail):
                  $class = null;
                  if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                  }
                  ?>

                  <tr<?php echo $class; ?>>
                        <td><?php echo $i; ?>&nbsp;</td>
                        <td class="left"><?php echo $this->Html->link($movementDetail['Movement']['no'], array('controller'=>'movements', 'action'=>'view', $movementDetail['MovementDetail']['movement_id'])); ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['code']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['item_code']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['name']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['brand']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['type']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['color']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['serial_no']; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['AssetDetail']['asset_category_id']?$assetCategories[$movementDetail['AssetDetail']['asset_category_id']]:''; ?>&nbsp;</td>
                        <td class="left"><?php echo $departments[$movementDetail['Movement']['source_department_id']]; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['Movement']['source_business_type_id']?$businessType[$movementDetail['Movement']['source_business_type_id']]:''; ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['Movement']['source_cost_center_id']?$costCenter[$movementDetail['Movement']['source_cost_center_id']]:''; ?>-<?php echo $movementDetail['Movement']['source_cost_center_id']?$costCenters[$movementDetail['Movement']['source_cost_center_id']]:''; ?>&nbsp;</td>
                        <td class="left"><?php echo $departments[$movementDetail['Movement']['dest_department_id']]; ?>&nbsp;</td>
                        <td class="left"><?php echo $businessType[$movementDetail['Movement']['dest_business_type_id']]; ?>&nbsp;</td>
                        <td class="left"><?php echo $costCenter[$movementDetail['Movement']['dest_cost_center_id']]; ?>-<?php echo $costCenters[$movementDetail['Movement']['dest_cost_center_id']]; ?>&nbsp;</td>
                        <td class="left"><?php echo $this->Time->format(DATE_FORMAT,$movementDetail['Movement']['doc_date']); ?>&nbsp;</td>
                        <td class="left"><?php echo $this->Time->format(DATE_FORMAT,$movementDetail['AssetDetail']['date_start']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($movementDetail['AssetDetail']['price']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($movementDetail['AssetDetail']['depthnini']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($movementDetail['AssetDetail']['book_value']); ?>&nbsp;</td>
                        <td class="left"><?php echo $movementDetail['MovementDetail']['notes']; ?>&nbsp;</td>
                  </tr>
                  <?php $price += $movementDetail['AssetDetail']['price']; ?>
                  <?php $depthnini += $movementDetail['AssetDetail']['depthnini']; ?>
                  <?php $book_value += $movementDetail['AssetDetail']['book_value']; ?>

            <?php endforeach; ?>
            <tr>
                  <td colspan="18"><div align="right">Total</div></td>
                  <td class="number"><?php echo $this->Number->format($price); ?>&nbsp;</td>
                  <td class="number"><?php echo $this->Number->format($depthnini); ?>&nbsp;</td>
                  <td class="number"><?php echo $this->Number->format($book_value); ?>&nbsp;</td>
                  <td>&nbsp;</td>
            </tr>
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
</div>
