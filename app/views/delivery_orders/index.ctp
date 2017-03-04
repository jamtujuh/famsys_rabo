<?php
$group_id = $this->Session->read('Security.permissions');
$can_add_new_do = $po['Po']['v_is_done'] == 0 && $group_id == gs_group_id && $po['Po']['total_cur'] > $tot_cur;
?>
                  <?php $places = $myApp->getPlaces($po['Currency']['is_desimal']); ?>

<div class="pos view">
      <h2><?php __('PO Receive Item'); ?></h2>
      <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('No'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $this->Html->link($po['Po']['no'], array('controller' => 'pos', 'action' => 'view', $po['Po']['id'])); ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('PO Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Delivery Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Supplier'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $this->Html->link($po['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $po['Supplier']['id'])); ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('PO Status'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $po['PoStatus']['name']; ?>
                  &nbsp;
            </dd>	
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('V Is Done'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $this->Html->image($po['Po']['v_is_done'] . ".gif"); ?>
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Currency'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $po['Currency']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Total (Cur)'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                  <div id="PoTotalDiv">
<?php echo $this->Number->format($po['Po']['total_cur'], $places); ?>
                  </div>
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Down Payment (Cur)'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $this->Number->format($po['Po']['down_payment'], $places); ?>
            </dd>
      </dl>

      <div class="doc_actions">
            <ul>
				
					<?php if ($can_add_new_do) : ?>
						<li><?php echo $this->Html->link(__('New DO', true), array('controller' => 'delivery_orders', 'action' => 'add', $po_id)); ?> </li>
					<?php endif; ?>
				
                <li><?php echo $this->Html->link(__('Back', true), array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id'))); ?> </li>
            </ul>

      </div>
</div>


<div class="related">
      <h2><?php __('Delivery Orders'); ?></h2>
      <table cellpadding="0" cellspacing="0">
            <tr>
                  <th><?php echo $this->Paginator->sort('no'); ?></th>
                  <th><?php echo $this->Paginator->sort('do_number'); ?></th>
                  <th><?php echo $this->Paginator->sort('do_date'); ?></th>
                  <th><?php echo $this->Paginator->sort('total_cur'); ?></th>
                  <th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('request_type_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('delivery_order_status_id'); ?></th>
            <?php if ($po['Po']['request_type_id'] == request_type_stock_id) : ?>			
                        <th><?php echo $this->Paginator->sort('Convert Stock', 'convert_asset'); ?></th>
<?php else: ?>
                        <th><?php echo $this->Paginator->sort('convert_asset'); ?></th>
<?php endif; ?>
                  <!--th><?php echo $this->Paginator->sort('is_journal_generated'); ?></th-->
                  <th class="actions"><?php __('Actions'); ?></th>
            </tr>
<?php
$i = 0;
//var_dump($deliveryOrders);
$total = 0;
foreach ($deliveryOrders as $deliveryOrder):
      $class = null;
      if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
      }
      $total+=$deliveryOrder['DeliveryOrder']['total_cur'];
      $can_edit = $deliveryOrder['DeliveryOrder']['delivery_order_status_id'] == status_delivery_order_new_id && $this->Session->read('Security.permissions') == gs_group_id;
      ?>
                  <tr<?php echo $class; ?>>
                        <td><?php echo $i; ?>&nbsp;</td>
                        <td><?php echo $deliveryOrder['DeliveryOrder']['no']; ?>&nbsp;</td>
                        <td class="center"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrder['DeliveryOrder']['do_date']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($deliveryOrder['DeliveryOrder']['total_cur'], $places); ?>&nbsp;</td>
                        <td><?php echo $deliveryOrder['Supplier']['name']; ?></td>
                        <td><?php echo $deliveryOrder['RequestType']['name']; ?></td>
                        <td><?php echo $deliveryOrder['DeliveryOrderStatus']['name'] ?></td>
                        <td class="center"><?php echo $html->image($deliveryOrder['DeliveryOrder']['convert_asset'] . '.gif') ?></td>
                        <!--td class="center"><?php echo $html->image($deliveryOrder['DeliveryOrder']['is_journal_generated'] . '.gif') ?></td-->
                        <td class="actions">
                  <?php if ($deliveryOrder['DeliveryOrder']['convert_asset'] == 0 && $deliveryOrder['DeliveryOrder']['delivery_order_status_id'] == status_delivery_order_done_id) : ?>
                        <?php if ($group_id == stock_management_group_id && $deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_stock_id) : ?>
                  <?php echo $this->Html->link(__('Register Stock', true), array('controller' => 'inlogs', 'action' => 'add/delivery_order_id:' . $deliveryOrder['DeliveryOrder']['id'])); ?>
            <?php elseif ($group_id == fa_management_group_id && ($deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_fa_it_id || $deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_fa_general_id)) : ?>
                  <?php echo $this->Html->link(__('Register FA', true), array('controller' => 'purchases', 'action' => 'add/delivery_order_id:' . $deliveryOrder['DeliveryOrder']['id'])); ?>
            <?php endif; ?>
                        <?php endif; ?>

                  <?php echo $this->Html->link(__('View', true), array('action' => 'view', $deliveryOrder['DeliveryOrder']['id'])); ?>
                  <?php if ($can_edit) : ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $deliveryOrder['DeliveryOrder']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $deliveryOrder['DeliveryOrder']['id'])); ?>
                  <?php endif; ?>
                        </td>
                  </tr>
            <?php endforeach; ?>

            <tr>
                  <td></td>
                  <td></td>
                  <td><?php __('Total Received') ?></td>
                  <td class="number"><?php echo $this->Number->format($total, $places) ?>&nbsp;</td>
                  <td colspan="5">&nbsp;</td>		
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
