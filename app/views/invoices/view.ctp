<?php
$recalcFunction = $ajax->remoteFunction(
                array(
                    'url' => array('controller' => 'invoices', 'action' => 'ajax_recalc', $this->Session->read('Invoice.id')),
                    'indicator' => 'LoadingDiv',
                    'complete' => 'recalcInvoice(request)'
                )
);
$places = $myApp->getPlaces($invoice['Currency']['is_desimal']);
?>
<div class="invoices view">
    <h2><?php __('Invoice'); ?></h2>
    <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('No'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $invoice['Invoice']['no']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Inv Date'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Supplier'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $this->Html->link($invoice['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $invoice['Supplier']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Request Type'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $invoice['RequestType']['name']; ?>
            &nbsp;
        </dd>		
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Wht Rate'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $invoice['Invoice']['wht_rate']; ?>
            &nbsp;
        </dd>		

        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('PO Currency'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $invoice['Currency']['name']; ?>
            &nbsp;
        </dd>
		
        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Rp Rate'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $this->Number->format($invoice['Invoice']['rp_rate'], $places); ?>
            &nbsp;
        </dd>		

        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $invoice['InvoiceStatus']['name']; ?>
            &nbsp;
        </dd>		
		
		<?php if ($invoice['ItemSummary']): ?>
			<dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Item Summary'); ?></dt>
			<dd<?php if ($i++ % 2 == 0)
					echo $class; ?>>
					<?php 
						foreach($invoice['ItemSummary'] as $itemSummary){
							echo $itemSummary;
						}
					?>
				&nbsp;
			</dd>
		<?php endif; ?>

        			

        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Total (Rp)'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
            <div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['total']); ?></div>
        </dd>

        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Total Paid (Rp)'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
            <div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['vtotal_paid']); ?></div>
        </dd>		

        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Payment Settled'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
            <div id="InvoiceTotalDiv"><?php echo $this->Html->image(($invoice['Invoice']['vtotal_paid'] == $invoice['Invoice']['total'] ? 1 : 0) . '.gif'); ?>
                &nbsp;
            </div>
        </dd>		

        <?php if (!empty($invoice['Invoice']['cancel_by'])) : ?>
            <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Cancel By'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <?php echo $invoice['Invoice']['cancel_by']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Cancel Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <?php echo $invoice['Invoice']['cancel_date']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Cancel Note'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <pre><?php echo $invoice['Invoice']['cancel_notes']; ?></pre>
                &nbsp;
            </dd>
        <?php endif; ?>
		
        <?php if (!empty($invoice['Invoice']['reject_by'])) : ?>
            <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Reject By'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <?php echo $invoice['Invoice']['reject_by']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Reject Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <?php echo $invoice['Invoice']['reject_date']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Reject Note'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <pre><?php echo $invoice['Invoice']['reject_notes']; ?></pre>
                &nbsp;
            </dd>
        <?php endif; ?>
		
        <?php if (!empty($invoice['Invoice']['approved_by'])) : ?>
            <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Approved By'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <?php echo $invoice['Invoice']['approved_by']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Approved Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                    <?php echo $invoice['Invoice']['approved_date']; ?>
                &nbsp;
            </dd>
        <?php endif; ?>
    </dl> 
    <div class="doc_actions">
        <ul>
            <?php if ($can_send_to_spv) : ?>
                <li><?php echo $this->Html->link(__('Send for Approval', true), array('action' => 'sentToSpv', $invoice['Invoice']['id'])); ?> </li>
            <?php endif ?>
			
            <?php if ($can_send_to_fincon) : ?>
                <li><?php echo $this->Html->link(__('Send to Fincon', true), array('action' => 'sentToFincon', $invoice['Invoice']['id'])); ?> </li>
            <?php endif ?>

            <?php if ($can_sent_to_supervisor) : ?>
                <li><?php echo $this->Html->link(__('Send for Approval', true), array('action' => 'sentToFinconSpv', $invoice['Invoice']['id'])); ?> </li>
            <?php endif ?>

            <?php if ($can_approve_by_supervisor) : ?>
                <li><?php echo $this->Html->link(__('Approve', true), array('action' => 'update_status', $invoice['Invoice']['id'], status_invoice_unpaid_id)); ?> </li>
            <?php endif ?>
			
            <?php if ($can_cancel) : ?>
                <li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'cancel', $invoice['Invoice']['id'])); ?> </li>
            <?php endif ?>
			
            <?php //if ($can_reject) : ?>
                <li><?php //echo $this->Html->link(__('Reject', true), array('action' => 'reject', $invoice['Invoice']['id'])); ?> </li>
            <?php //endif ?>
			
            <?php if ($can_archive) : ?>
                <li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $invoice['Invoice']['id'])); ?> </li>
            <?php endif ?>
			
			
            <!--
            <?php //if($can_register_fa) :  ?>
		<li><?php //echo $this->Html->link(__('Register to Assets', true), array('action' => 'register_asset', $invoice['Invoice']['id']));  ?> </li>
            <?php //endif  ?>
            <?php //if($can_inlog_stock) :  ?>
		<li><?php //echo $this->Html->link(__('Register to Stock', true), array('controller'=>'inlogs','action' => 'add', $invoice['Invoice']['id']));  ?> </li>
            <?php //endif  ?>
		-->

            <?php if ($can_payment) : ?>		
                <li><?php echo $this->Html->link(__('View / Add Payments', true), array('controller' => 'invoice_payments', 'action' => 'index', $invoice['Invoice']['id'])); ?> </li>
            <?php endif ?>


            <?php if ($can_posting_payment_journal) : ?>		
                <li>
                    <?php echo $this->Html->link(__('Payment Journal Posting', true), array('controller' => 'journal_transactions', 'action' => 'prepare_posting', 'invoice', journal_group_payment_id, $invoice['Invoice']['id'])); ?> 
                </li>
            <?php endif ?>


            <?php if ($can_posting_purchase_journal) : ?>		
                <li>
                    <?php echo $this->Html->link(__('Purchase Journal Posting', true), array('controller' => 'journal_transactions', 'action' => 'prepare_invoice_posting', $invoice['Invoice']['id'])); ?> 
                </li>
            <?php endif ?>

            <li><?php echo $this->Html->link(__('Back', true), array('action' => 'index')); ?> </li>

        </ul>
    </div>
</div>


<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <?php if ($can_edit) : ?>
            <li><?php echo $this->Html->link(__('Edit Invoice', true), array('action' => 'edit', $invoice['Invoice']['id'])); ?> </li>
        <?php endif; ?>
        <li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>

    </ul>
</div>

<div class="related">
    <h3><?php __('Invoice Item Details'); ?></h3>
    <p style="text-align:right;width:100%">
        <?php if ($can_edit) : ?>
            <?php
            echo $ajax->link(__('Re-Calculate', true), array('controller' => 'invoices', 'action' => 'ajax_recalc', $invoice['Invoice']['id']), array(
                'indicator' => 'LoadingDiv',
                'complete' => 'recalcInvoice(request)'
            ));
            ?> 
        <?php endif; ?>
    </p>

    <?php echo $this->Form->create('InvoiceDetail'); ?>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php __('No'); ?></th>
            <th><?php __('Department'); ?></th>
            <th><?php __('Asset Category'); ?></th>
            <th><?php __('Name'); ?></th>
            <th><?php __('Brand'); ?></th>
            <th><?php __('Type'); ?></th>
            <th><?php __('Color'); ?></th>
            <th><?php __('Qty'); ?></th>
            <th><?php __('Price Cur'); ?></th>
            <th><?php __('Price (Rp)'); ?></th>
            <th><?php __('Amount (Rp)'); ?></th>
            <th><?php __('Discount (Rp)'); ?></th>
            <th><?php __('After Discount (Rp)'); ?></th>
            <th><?php __('Is Vat'); ?></th>
            <th><?php //__('Is Wht'); ?></th>
            <?php if ($can_delete) : ?>
                <th class="actions"><?php __('Actions'); ?></th>
            <?php endif; ?>
            <th><?php __('Ref. Docs'); ?></th>
        </tr>
        <?php if (!empty($invoice['InvoiceDetail'])): ?>
            <?php
            $i = 0;

            foreach ($invoice['InvoiceDetail'] as $invoiceDetail):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                $id = $invoiceDetail['id'];
                ?>
                <tr<?php echo $class; ?>>
                    <td class="left"><?php echo $i; ?></td>
                    <td class="left"><?php echo $departments[$invoiceDetail['department_id']]; ?></td>
                    <td class="left"><?php echo $assetCategories[$invoiceDetail['asset_category_id']]; ?></td>
                    <td class="left"><?php echo $invoiceDetail['name']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['brand']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['type']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['color']; ?></td>
                    <td class="center">
                        <div id="qty.<?php echo $id ?>"><?php echo $invoiceDetail['qty']; ?></div>
                        <?php //if($can_edit_detail) : ?>
                        <?php
                        //echo $ajax->editor('qty.'.$id,
                        //array('controller'=>'invoice_details', 'action'=>'ajax_edit', $id )
                        //) 
                        ?>
                        <?php //endif;?>
                    </td>
                    <td class="number">
                        <div id="price_cur.<?php echo $id ?>"><?php echo $this->Number->format($invoiceDetail['price_cur'], $places); ?></div>
                        <?php if ($can_edit_detail) : ?>
                            <?php
                            echo $ajax->editor('price_cur.' . $id, array('controller' => 'invoice_details', 'action' => 'ajax_edit', $id), array('loaded' => $recalcFunction)
                            )
                            ?>
                        <?php endif; ?>
                    </td>
                    <td class="number">
                        <div id="price.<?php echo $id ?>"><?php echo $this->Number->format($invoiceDetail['price'], $places); ?></div>
                    </td>
                    <td class="number">
                        <div id="amount.<?php echo $id ?>"><?php echo $this->Number->format($invoiceDetail['amount']); ?></a>
                    </td>
                    <td class="number">
                        <div id="discount.<?php echo $id ?>"><?php echo $this->Number->format($invoiceDetail['discount']); ?></div>
                        <?php if ($can_edit_detail) : ?>
                            <?php
                            echo $ajax->editor('discount.' . $id, array('controller' => 'invoice_details', 'action' => 'ajax_edit', $id), array('loaded' => $recalcFunction)
                            )
                            ?>
                        <?php endif; ?>	
                    </td>
                    <td class="number">
                        <div id="amount_after_disc.<?php echo $id ?>"><?php echo $this->Number->format($invoiceDetail['amount_after_disc']); ?></div>
                    </td>
                    <td>
                        <?php if ($can_edit_detail) : ?>
                            <?php
                            echo $this->Html->image($invoiceDetail['is_vat'] . ".gif", array(
                                'url' => array('controller' => 'invoice_details', 'action' => 'set_vat', $invoiceDetail['id'], $invoiceDetail['is_vat'] == 1 ? 0 : 1)
                            ));
                            ?>
                        <?php else : ?>
                            <?php echo $this->Html->image($invoiceDetail['is_vat'] . ".gif") ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php //if ($can_edit_wht) : ?>
                            <?php
                            //echo $this->Html->image($invoiceDetail['is_wht'] . ".gif", array(
                             //   'url' => array('controller' => 'invoice_details', 'action' => 'set_wht', $invoiceDetail['id'], $invoiceDetail['is_wht'] == 1 ? 0 : 1)
                            //));
                            ?>
                        <?php //else : ?>
                            <?php //echo $this->Html->image($invoiceDetail['is_wht'] . ".gif") ?>
                        <?php //endif; ?>
                    </td>

                    <?php if ($can_delete) : ?>
                        <td class="actions">
                            <?php echo $this->Html->link(__('Delete', true), array('controller' => 'invoice_details', 'action' => 'delete', $invoiceDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoiceDetail['id'])); ?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <div style="white-space:nowrap"><?php echo $invoiceDetail['npb_id'] ? $this->Html->link($Npbs[$invoiceDetail['npb_id']], array('controller' => 'npbs', 'action' => 'view', $invoiceDetail['npb_id'])) : ''; ?></div>
                        <div style="white-space:nowrap"><?php echo $invoiceDetail['po_id'] ? $this->Html->link($Pos[$invoiceDetail['po_id']], array('controller' => 'pos', 'action' => 'view', $invoiceDetail['po_id'])) : ''; ?></div>
                    </td>
                </tr>

            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($can_add_detail) : ?>
            <tr id="newRecord">
                <td class="newField" colspan="2"><?php echo $this->Form->input('department_id', array('style' => 'width:110px')); ?></td>
                <td class="newField"><?php echo $this->Form->input('asset_category_id', array('style' => 'width:110px', 'empty' => 'select category')); ?></td>
                <td class="newField"><?php echo $this->Form->input('name', array('style' => 'width:110px')); ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="newField"><?php echo $this->Form->input('qty', array('style' => 'width:50px', 'value' => 1)); ?></td>
                <td class="newField"><?php echo $this->Form->input('price_cur', array('style' => 'width:80px', 'value' => 0)); ?></td>
                <td></td>
                <td></td>
                <td class="newField"><?php echo $this->Form->input('discount_cur', array('style' => 'width:80px', 'value' => 0)); ?></td>
                <td></td>
                <td class="newField"><?php echo $this->Form->input('is_vat', array('label' => false, 'checked' => true)) ?></td>
                <td class="newField"><?php echo $this->Form->input('is_wht', array('label' => false, 'checked' => true)) ?></td>
                <td class="actions">
                    <?php echo $this->Form->input('invoice_id', array('value' => $this->Session->read('Invoice.id'), 'type' => 'hidden')); ?>
                    <?php
                    echo $this->Form->input('price', array('type' => 'hidden'));
                    echo $this->Form->input('umurek', array('type' => 'hidden'));
                    echo $this->Form->input('currency_id', array('type' => 'hidden', 'value' => $invoice['Invoice']['currency_id']));
                    echo $this->Form->input('rp_rate', array('value' => $invoice['Invoice']['rp_rate'], 'type' => 'hidden'));
                    echo $this->Form->input('vat_rate', array('type' => 'hidden', 'value' => $invoice['Invoice']['vat_rate'], 'type' => 'hidden'));
                    echo $this->Form->input('wht_rate', array('type' => 'hidden', 'value' => $invoice['Invoice']['wht_rate'], 'type' => 'hidden'));
                    ?>

                    <?php
                    echo $ajax->submit('Add', array(
                        'url' => array('controller' => 'invoice_details', 'action' => 'ajax_add'),
                        'indicator' => 'LoadingDiv',
                        'complete' => 'appendInvoiceDetail(request)'));
                    ?>

                </td>
                <td></td>
                <td></td>
            </tr>
        <?php endif; ?>

        <?php $span = 11 ?>
        <?php if ($can_edit_detail) : ?>
            <?php $span_right = 5 ?>
        <?php else: ?>
            <?php $span_right = 4 ?>
        <?php endif; ?>
        <tr>
            <td style="border-top:1px solid black" colspan="<?php echo $span - 1 ?>" class="number"><?php __("Sub Total") ?></td>
            <td style="border-top:1px solid black" class="number">
                <div id="sub_total"><?php echo $this->Number->format($invoice['Invoice']['sub_total']) ?></div>
            </td>
            <td  style="border-top:1px solid black" class="number">
                <div id="discount"><?php echo $this->Number->format($invoice['Invoice']['discount']) ?></div>
            </td>
            <td  style="border-top:1px solid black" class="number">
                <div id="after_disc"><?php echo $this->Number->format($invoice['Invoice']['after_disc']) ?></div>
            </td>		
            <td style="border-top:1px solid black" colspan="<?php echo $span_right ?>">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="<?php echo ($span - 1) ?>" class="number"><?php __("Vat") ?></td>
            <td class="number">
                <?php echo $this->Number->format($invoice['Invoice']['vat_rate']) ?>% x
            </td>
            <td class="number">
                <div id="vat_base"><?php echo $this->Number->format($invoice['Invoice']['vat_base']) ?></div>
            </td>
            <td class="number">
                <div id="vat_total"><?php echo $this->Number->format($invoice['Invoice']['vat_total']) ?></div>
            </td>		
            <td colspan="<?php echo $span_right ?>">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="<?php echo ($span - 1) ?>" class="number"><?php __("Wht") ?>(%)</td>
            <td class="number">
                <div id="wht_rate"><?php echo $invoice['Invoice']['wht_rate'] ?></div>
				<?php if ($can_edit_wht): ?>
				<?php
				echo $ajax->editor('wht_rate', array('controller' => 'invoices', 'action' => 'ajax_edit', $invoice['Invoice']['id']), array('loaded' => $recalcFunction));
				?>
				<?php endif;?>
				</td>
            </td>
            <td class="number">
                <div id="wht_base"><?php echo $this->Number->format($invoice['Invoice']['wht_base']) ?></div>
 				<?php if ($can_edit_wht): ?>
                   <?php
                    echo $ajax->editor('wht_base', array('controller' => 'invoices', 'action' => 'ajax_edit', $invoice['Invoice']['id']), array('loaded' => $recalcFunction));
                    ?>
 				<?php endif;?>
           </td>
            <td class="number">
                <div id="wht_total"><?php echo $this->Number->format($invoice['Invoice']['wht_total']) ?></div>
            </td>
            <td colspan="<?php echo $span_right ?>">&nbsp;</td>
        </tr>	
        <tr>
            <td colspan="<?php echo ($span - 1) ?>" class="number"><?php __("(Other Costs)") ?></td>
            <td class="number" colspan="2">
                <div id="other_cost_notes"><?php echo $invoice['Invoice']['other_cost_notes'] ? $invoice['Invoice']['other_cost_notes'] : '-' ?></div>
                <?php if ($can_edit) : ?>
                    <?php
                    echo $ajax->editor('other_cost_notes', array('controller' => 'invoices', 'action' => 'ajax_edit', $invoice['Invoice']['id']), array('loaded' => $recalcFunction));
                    ?>
                <?php endif; ?>
            </td>
            <td class="number">
                <div id="other_cost_total"><?php echo $this->Number->format($invoice['Invoice']['other_cost_total']) ?></div>
                <?php if ($can_edit) : ?>
                    <?php
                    echo $ajax->editor('other_cost_total', array('controller' => 'invoices', 'action' => 'ajax_edit', $invoice['Invoice']['id']), array('loaded' => $recalcFunction));
                    ?>
                <?php endif; ?>
                </div>
            </td>
            <td colspan="<?php echo $span_right ?>">&nbsp;</td>
        </tr>		
        <tr>
            <td colspan="<?php echo ($span + 1) ?>" class="number"><?php __("Grand Total") ?></td>
            <td class="number">
                <div id="total"><?php echo $this->Number->format($invoice['Invoice']['total']) ?></div>
            </td>
            <td colspan="<?php echo $span_right ?>">&nbsp;</td>
        </tr>		
    </table>
    <?php echo $this->Form->end(); ?>
</div>

<div class="related">
    <?php $i = 0 ?>
    <h3><?php __('Related POs'); ?></h3>
    <?php if (!empty($invoice['Po'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php __('No'); ?></th>
                <th><?php __('PO No'); ?></th>
                <th><?php __('Po Date'); ?></th>
                <th><?php __('Delivery Date'); ?></th>
                <th><?php __('Supplier'); ?></th>
                <th><?php __('Cur'); ?></th>
                <th><?php __('Total'); ?></th>
                <th><?php __('PO Status'); ?></th>
                <th class="actions"><?php __('Actions'); ?></th>
            </tr>	
            <?php
            foreach ($invoice['Po'] as $po):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $po['no'] ?></td>
                    <td><?php echo $this->Time->format(DATE_FORMAT, $po['po_date']); ?></td>
                    <td><?php echo $this->Time->format(DATE_FORMAT, $po['delivery_date']); ?></td>
                    <td><?php echo $po['supplier_name'] ?></td>
                    <td><?php echo $currency[$po['currency_id']] ?></td>
                    <td class="number"><?php echo $this->Number->format($po['total_cur'], $places) ?></td>
                    <td><?php echo $po['status_name'] ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('controller' => 'pos', 'action' => 'view', $po['id'])); ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<div class="related">
    <?php $i = 0 ?>
    <h3><?php __('Related Delivery Orders'); ?></h3>
    <?php if (!empty($invoice['DeliveryOrder'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php __('No'); ?></th>
                <th><?php __('PO No'); ?></th>
                <th><?php __('DO No'); ?></th>
                <th><?php __('DO Date'); ?></th>
                <th class="actions"><?php __('Actions'); ?></th>
            </tr>	
            <?php
            foreach ($invoice['DeliveryOrder'] as $do):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $do['po_no'] ?></td>
                    <td><?php echo $do['no'] ?></td>
                    <td><?php echo $this->Time->format(DATE_FORMAT, $do['do_date']); ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View DO', true), array('controller' => 'delivery_orders', 'action' => 'view', $do['id'])); ?>
                    </td>		
                </tr>

            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<div>
    <h3><?php __('Description'); ?></h3>
    <pre><?php echo $invoice['Invoice']['description']; ?></pre>
</div>

<!--div class="related">
	<h3><?php __('Related PO Payments'); ?></h3>
<?php if (!empty($invoice['PoPayment'])): ?>
                
                <table cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php __('Term No'); ?></th>
                    <th><?php __('Date Due'); ?></th>
                    <th><?php __('Date Paid'); ?></th>
                    <th><?php __('Amount Due'); ?></th>
                    <th><?php __('Amount Paid'); ?></th>
                    <th><?php __('Description'); ?></th>
            	</tr>	
    <?php
    foreach ($invoice['PoPayment'] as $pay):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        ?>
                            <tr>
                                <td><?php echo $pay['term_no'] ?></td>
                                <td><?php echo $this->Time->format(DATE_FORMAT, $pay['date_due']); ?></td>
                                <td><?php echo $this->Time->format(DATE_FORMAT, $pay['date_paid'] )?></td>
                                <td class="number"><?php echo $this->Number->format($pay['amount_due']) ?></td>
                                <td class="number"><?php echo $this->Number->format($pay['amount_paid']) ?></td>
                                <td><?php echo $pay['description'] ?></td>
                        	</tr>	
    <?php endforeach; ?>
            	</table>
<?php endif; ?>
</div-->

<?php
//echo $javascript->link('prototype', false);
//echo $javascript->link('scriptaculous', false);
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
echo $javascript->event('InvoiceDetailPriceCur', 'change', 'calcRp(\'InvoiceDetail\');calcAmount(\'InvoiceDetail\')');
echo $javascript->event('InvoiceDetailQty', 'change', 'calcRp(\'InvoiceDetail\');calcAmount(\'InvoiceDetail\')');

echo $ajax->observeField('InvoiceDetailAssetCategoryId', array(
    'url' => array('controller' => 'assets', 'action' => 'get_depr_year'),
    'complete' => 'updateField("InvoiceDetailUmurek","depr_year_com",request)',
    'indicator' => 'LoadingDiv',
        )
);
?>
