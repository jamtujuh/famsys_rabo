<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
             <?php echo $this->Form->create('DeliveryOrderDetail') ?>
     <fieldset>
            <legend><?php __('Item Receive Filters') ?></legend>
 			<fieldset class="subfilter">
				<legend><?php __('Asset Info') ?></legend>
			<?php echo $form->input('asset_category_type_id', array('options' => $assetCategoryTypes, 'empty' => '', 'value' => $this->Session->read('DeliveryOrderDetail.asset_category_type_id'))); ?>
            <?php echo $form->input('asset_category_id', array('empty' => 'all', 'options' => $assetCategories, 'value' => $this->Session->read('DeliveryOrderDetail.asset_category_id'))); ?>
            <?php echo $this->Form->input('department_id', array('empty' => 'all', 'value' => $this->Session->read('DeliveryOrderDetail.department_id'))) ?> 
 			</fieldset>
			
			<fieldset class="subfilter" style="width:35%">
				<legend><?php __('Date Filter') ?></legend>
			<?php echo $this->Form->input('date_start', array('type' => 'date', 'value' => $date_start)) ?> 
            <?php echo $this->Form->input('date_end', array('type' => 'date', 'value' => $date_end)) ?>
			</fieldset>
            <?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
      <?php
      $options = array(
          'url' => array('controller' => 'asset_categories', 'action' => 'get_asset_categories', 'DeliveryOrderDetail'),
          'update' => 'DeliveryOrderDetailAssetCategoryId',
          'indicator' => 'LoadingDiv',
      );
      echo $ajax->observeField('DeliveryOrderDetailAssetCategoryTypeId', $options);
      ?>	
</div>

<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>
            <li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
      </ul>
</div>
</div>

<?php if (!empty($deliveryOrderDetails)): ?>
      <div class="related">
            <h2><?php __('Item Received List'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo $this->Paginator->sort('no'); ?></th>
                        <th><?php echo $this->Paginator->sort('po_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('no_do'); ?></th>
                        <th><?php echo $this->Paginator->sort('do_date'); ?></th>
                        <th><?php echo $this->Paginator->sort('department_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('asset_category_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('item_code'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('brand'); ?></th>
                        <th><?php echo $this->Paginator->sort('type'); ?></th>
                        <th><?php echo $this->Paginator->sort('color'); ?></th>
                        <th><?php echo $this->Paginator->sort('qty'); ?></th>
                        <th><?php echo $this->Paginator->sort('currency'); ?></th>
                        <th><?php echo $this->Paginator->sort('price_cur'); ?></th>
                        <th><?php echo $this->Paginator->sort('amount_cur'); ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  $total = 0;
                  foreach ($deliveryOrderDetails as $deliveryOrderDetail):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
                        $total+=$deliveryOrderDetail['DeliveryOrderDetail']['amount_cur'];
                        $places = $myApp->getPlaces($currency[$deliveryOrderDetail['Po']['currency_id']]);
                        if ($deliveryOrderDetail['DeliveryOrderDetail']['qty'] == 0)
                              continue;
                        ?>
                        <tr<?php echo $class; ?>>
                              <td><?php echo $i; ?>&nbsp;</td>
                              <td  class="left">
                                    <?php echo $this->Html->link($deliveryOrderDetail['Po']['no'], array('controller' => 'pos', 'action' => 'view', $deliveryOrderDetail['Po']['id'])); ?>
                              </td>
                              <td class="left"><?php echo $deliveryOrderDetail['DeliveryOrder']['no']; ?>&nbsp;</td>
                              <td class="left"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrderDetail['DeliveryOrder']['do_date']); ?>&nbsp;</td>
                              <td class="left"><?php echo $deliveryOrderDetail['Department']['name']; ?></td>
                              <td class="left"><?php echo $deliveryOrderDetail['AssetCategory']['name']; ?></td>
                              <td class="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['item_code']; ?></td>
                              <td class="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['name']; ?></td>
                              <td class="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['brand']; ?></td>
                              <td class="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['type']; ?></td>
                              <td class="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['color']; ?></td>
                              <td class="center"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['qty']; ?></td>
                              <td class="center"><?php echo $currencies[$deliveryOrderDetail['Po']['currency_id']]; ?></td>
                              <td class="number"><?php echo $this->Number->format($deliveryOrderDetail['DeliveryOrderDetail']['price_cur'], $places); ?></td>
                              <td class="number"><?php echo $this->Number->format($deliveryOrderDetail['DeliveryOrderDetail']['amount_cur'], $places); ?></td>

                        </tr>
                  <?php endforeach; ?>
                  <!--tr>
                        <td colspan="13"  class="number"><?php __('Total') ?></td>
                        <td class="number"><?php echo $this->Number->format($total) ?></td>
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
      </div>
<?php endif; ?>