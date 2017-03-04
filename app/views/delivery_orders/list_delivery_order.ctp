<?php
//echo $javascript->link('prototype', false);
//echo $javascript->link('scriptaculous', false);
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
             <?php echo $this->Form->create('DeliveryOrder') ?>
		<div class="fieldfilter">
		<fieldset>
            <legend><?php __('Delivery Order Filters') ?></legend>
			<fieldset class="subfilter">
			<legend><?php __('Delivery Order Info')?></legend>
            <?php echo $this->Form->input('po_id', array('type' => 'hidden', 'empty' => 'all')) ?>
            <?php echo $this->Form->input('Po.no', array('label' => 'Po No', 'style' => 'width:100%', 'type' => 'text', 'value'=>$this->Session->read('Po.no'))); ?>
            <div id="po_choices" class="auto_complete"></div> 
            <script type="text/javascript"> 
                  //<![CDATA[
                  new Ajax.Autocompleter('PoNo', 'po_choices', '<?php echo BASE_URL ?>/pos/auto_complete', {afterUpdateElement : setDeliveryOrderPoValues});
                  //]]>
            </script>

            <?php echo $this->Form->input('delivery_order_status_id', array('options' => $deliveryOrderStatuses, 'empty' => 'all', 'value' => $this->Session->read('DeliveryOrder.delivery_order_status_id'))) ?>
            <?php echo $this->Form->input('DoNo', array('label' => 'DO No', 'value' => $this->Session->read('DeliveryOrder.DoNo'))) ?>
			</fieldset>
			<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Date Filter') ?></legend>
           <?php echo $this->Form->input('date_start', array('type' => 'date', 'value' => $date_start)) ?>
            <?php echo $this->Form->input('date_end', array('type' => 'date', 'value' => $date_end)) ?>
			</fieldset>
            <?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
</div>

<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>
            <li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
      </ul>
</div>
</div>

<?php if (!empty($deliveryOrders)): ?>
      <div class="related">
            <h2><?php __('Delivery Orders'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo __('No'); ?></th>
                        <th><?php echo __('PO No'); ?></th>
                        <th><?php echo __('Currency'); ?></th>
                        <th><?php echo __('PO Total'); ?></th>
                        <th><?php echo __('Req Delivery Date'); ?></th>
                        <th><?php echo __('DO No'); ?></th>
                        <th><?php echo __('DO Date'); ?></th>
                        <th><?php echo __('Day Diff '); ?></th>
                        
                        <th><?php echo __('Supplier'); ?></th>
                        <th><?php echo __('Delivery Order Status'); ?></th>
                        <th><?php echo __('Convert Asset'); ?></th>
                        <th class="actions"><?php __('Actions'); ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  foreach ($deliveryOrders as $deliveryOrder):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
                        $day_diff =  strtotime($deliveryOrder['Po']['delivery_date']) - strtotime($deliveryOrder['DeliveryOrder']['do_date']) ;
                        $day_diff /= 60*60*24;
                        $places = $myApp->getPlaces($currency[$deliveryOrder['Po']['currency_id']]);
                        ?>
                        <tr<?php echo $class; ?>>
                              <td><?php echo $i; ?>&nbsp;</td>
                              <td class="left">
                                    <?php echo $this->Html->link($deliveryOrder['Po']['no'], array('controller' => 'pos', 'action' => 'view', $deliveryOrder['Po']['id'])); ?>
                              </td>
                              <td class="center"><?php echo $currencies[$deliveryOrder['Po']['currency_id']]; ?>&nbsp;</td>
                              <td class="number"><?php echo $this->Number->format($deliveryOrder['Po']['total_cur'], $places); ?>&nbsp;</td>
                              <td class="left"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrder['Po']['delivery_date']); ?>&nbsp;</td>
                              <td class="left"><?php echo $deliveryOrder['DeliveryOrder']['no']; ?>&nbsp;</td>
                              <td class="left"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrder['DeliveryOrder']['do_date']); ?>&nbsp;</td>
                              <td class="center"><?php echo $day_diff  ; ?>&nbsp;</td>
                              <!--td class="number"><?php echo $deliveryOrder['Po']['daily_penalty']>0?$this->Number->format($day_diff * $deliveryOrder['Po']['total_cur'] * $deliveryOrder['Po']['daily_penalty'], $places) : '0'; ?>&nbsp;</td-->
                              <td class="left">
                                    <?php echo $deliveryOrder['Supplier']['name']; ?>
                              </td>
                              <td class="center">
                                    <?php echo $deliveryOrder['DeliveryOrderStatus']['name']; ?>
                              </td>
                              <td class="center"><?php echo $html->image($deliveryOrder['DeliveryOrder']['convert_asset'] . '.gif') ?></td>
                              <td class="actions">
                                    <?php echo $this->Html->link(__('View', true), array('action' => 'view', $deliveryOrder['DeliveryOrder']['id'])); ?>
                                    <?php echo $this->Html->link(__('View PO', true), array('controller' => 'pos', 'action' => 'view', $deliveryOrder['Po']['id'])); ?>
                              </td>
                        </tr>
                  <?php endforeach; ?>
            </table>
      </div>
<?php endif; ?>
