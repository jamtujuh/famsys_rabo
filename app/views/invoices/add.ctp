<div id="moduleName"><?php echo $moduleName?></div>
<div class="invoices form">
      <?php echo $this->Form->create('Invoice'); ?>
      <fieldset>
            <legend><?php __('Add Invoice'); ?></legend>
            <?php
            echo $this->Form->input('po_id', array('type' => 'hidden', 'value' => $po_id));
            echo $this->Form->input('select_details_from_po', array('type' => 'hidden', 'value' => 1));
            echo $this->Form->input('no');
            echo $this->Form->input('inv_date', array('value' => date("Y-m-d"), 'type' => 'text', 'readonly' => true));
            if ($supplier_id) {
                  echo $this->Form->input('supplier_name', array('readonly' => true, 'value' => $supplier_name, 'style' => 'width:50%'));
                  echo $this->Form->input('supplier_id', array('type' => 'hidden', 'value' => $supplier_id));
                  echo $this->Form->input('request_type_name', array('readonly' => true, 'value' => $request_type_name, 'style' => 'width:50%'));
                  echo $this->Form->input('request_type_id', array('type' => 'hidden', 'value' => $request_type_id));
            } else {
                  echo $this->Form->input('supplier_id', array('options' => $suppliers, 'value' => $supplier_id));
                  echo $this->Form->input('request_type_id', array('options' => $requestTypes, 'value' => $request_type_id));
            }

            echo $this->Form->input('wht_rate', array('value' => $default_wht_rate, 'type'=>'hidden'));
            echo $this->Form->input('vat_rate', array('value' => $default_vat_rate, 'readonly'=>true));
            echo $this->Form->input('description', array('style' => 'width:98%'));
            echo $this->Form->input('sub_total', array('value' => 0, 'type' => 'hidden'));
            echo $this->Form->input('discount', array('value' => 0, 'type' => 'hidden'));
            echo $this->Form->input('vat_base', array('value' => 0, 'type' => 'hidden'));
            echo $this->Form->input('wht_base', array('value' => 0, 'type' => 'hidden'));
            echo $this->Form->input('vat_total', array('value' => 0, 'type' => 'hidden'));
            echo $this->Form->input('wht_total', array('value' => 0, 'type' => 'hidden'));
            echo $this->Form->input('total', array('value' => 0, 'type' => 'hidden'));

            if ($po_id) {
					
                  echo $this->Form->input('currency_id', array('type' => 'hidden', 'value' => $currency_id));
                  echo $this->Form->input('currency_name', array('readonly' => true, 'value' => $currency_name));
                  echo $this->Form->input('rp_rate', array('value' => $rp_rate));
            } else {
                  echo $this->Form->input('currency_id');
                  echo $this->Form->input('rp_rate', array('value' => 1));
            }
            //echo $this->Form->input('Po', array('label'=>__("Create from PO")));
            //echo $this->Form->input('select_details_from_po', array('type'=>'checkbox'));		
            ?>
            <?php if ($po_id) : ?>
                  <h2 style="margin-top:20px"><?php __('Select PO') ?></h2>
                  <table border="0" cellspacing="0">
                        <tr style="margin-top:10px">
                              <!--th><?php __("Select") ?></th-->
                              <th><?php __("No") ?></th>
                              <th><?php __("PO Date") ?></th>
                              <th><?php __("Status") ?></th>			
                              <th><?php __("Currency") ?></th>
                              <th><?php __("Total (Cur)") ?></th>
                              <th><?php __("Request Type") ?></th>
                              <th><?php __("Payment Term") ?></th>			
                              <th><?php __("Supplier") ?></th>
                        </tr>
                        <?php
                        foreach ($poa as $po) :
                              $sel = ' checked="checked"';
							  $places = $myApp->getPlaces($po['Currency']['is_desimal']);
                              ?>
                              <tr>
                                    <!--td><input type="checkbox" <?php echo $sel ?> name="data[Po][Po][]" value="<?php echo $po['Po']['id']; ?>" id="PoPo" /></td-->
                                    <td class="center"><?php
                                     echo $this->Html->link($po['Po']['no'], array('controller' => 'pos', 'action' => 'view', $po['Po']['id']), array('target' => '_blank'));
                              ?>
                                    </td>
                                    <td class="center"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?></td>
                                    <td class="left"><?php echo $po['PoStatus']['name']; ?></td>
                                    <td><?php echo $po['Currency']['name']; ?></td>
                                    <td class="number"><?php echo $this->Number->format($po['Po']['total_cur'], $places) ?></td>
                                    <td class="left"><?php echo $po['RequestType']['name']; ?></td>
                                    <td>
                                          <?php echo $po['Po']['payment_term']; ?>
                                    </td>
                                    <td class="left"><?php echo $po['Supplier']['name'] ?></td>
                              </tr>
                              <tr>
                                    <td></td>
                                    <th><?php __("Select DO") ?></th>
                                    <th><?php __("DO No") ?></th>
                                    <th><?php __("DO Date") ?></th>			
                                    <th><?php __("Total (Cur)") ?></th>			
                                    <th><?php __("Request Type") ?></th>
                                    <th><?php __("Invoice No") ?></th>
                                    <th><?php __("Register Asset/Stock?") ?></th>
                              </tr>
                              <?php
                              //list all DeliveryOrders of this PO
							  //echo '<pre>';
							  //var_dump($po);
							  //echo '</pre>';die();
                              foreach ($po['DeliveryOrder'] as $do) :
                                    //DeliveryOrder already connected to any invoice?
                                    //or DO is not converted to asset and it's not stock request
                                    if (array_key_exists($do['id'], $invoiceDeliveryOrders) ||
                                            ($do['convert_asset'] == 0 && $do['request_type_id']!=request_type_stock_id) )
                                    {
                                          $sel = '';
                                          if (isset($invoiceDeliveryOrders[$do['id']])) {
                                                $invoice_no = $this->Html->link($invoiceDeliveryOrders[$do['id']]['no'], array('controller' => 'invoices', 'action' => 'view', $invoiceDeliveryOrders[$do['id']]['invoice_id']), array('target' => '_blank'));
                                          } else {
                                                $invoice_no = '';
                                          }
                                    } else {
                                          $sel = '<input type="checkbox" "selected" name="data[DeliveryOrder][DeliveryOrder][]" value="' . $do['id'] . '" id="DeliveryOrderDeliveryOrder" />';
                                          $invoice_no = '';
                                    }
                                    ?>
                                    <tr>
                                          <td></td>
                                          <td><?php echo $sel ?></td>
                                          <td class="left">
                                                <?php echo $this->Html->link($do['no'], array('controller' => 'delivery_orders', 'action' => 'view', $do['id']), array('target' => '_blank')) ?>
                                          </td>
                                          <td class="center"><?php echo $this->Time->format(DATE_FORMAT, $do['do_date']); ?></td>
                                          <td class="number"><?php echo $this->Number->format($do['total_cur'], $places) ?></td>
                                          <td class="left"><?php echo $requestTypes[$do['request_type_id']] ?></td>
                                          <td class="left"><?php echo $invoice_no ?></td>
                                          <td class="center"><?php echo $this->Html->image($do['convert_asset'] . '.gif') ?></td>
                                    </tr>
                              <?php endforeach; ?>

                        <?php endforeach; ?>
                  </table>

            <?php endif; //po_id  ?>


      </fieldset>
      <?php echo $this->Form->end(__('Submit', true)); ?>
</div>
<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>

            <li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index')); ?></li>
            <li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
      </ul>
</div>
