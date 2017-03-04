<?php
echo $javascript->link('my_script', false);
$group_id = $this->Session->read('Security.permissions');
$can_payment = ($this->Session->read('InvoicePayment.can_payment') && $group_id == fincon_group_id);
?>

<div class="related">
      <h2><?php __('Invoice Payments'); ?></h2>
      <table cellpadding="0" cellspacing="0">
            <tr>
                  <th><?php echo $this->Paginator->sort('no'); ?></th>
                  <th><?php echo $this->Paginator->sort('term_no'); ?></th>
                  <th><?php echo $this->Paginator->sort('term_percent'); ?></th>
                  <th><?php echo $this->Paginator->sort('date_due'); ?></th>
                  <th><?php echo $this->Paginator->sort('date_paid'); ?></th>
                  <th><?php echo $this->Paginator->sort('amount_due'); ?></th>
                  <th><?php echo $this->Paginator->sort('amount_paid'); ?></th>
                  <th><?php echo $this->Paginator->sort('description'); ?></th>
                  <th><?php echo $this->Paginator->sort('bank_account_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('bank_account_type_id'); ?></th>
                  <th><?php echo $this->Paginator->sort('Status Invoice Payment'); ?></th>

                  <th class="actions"><?php __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            $total = 0;
            $total_term_percent = 0;
            foreach ($invoicePayments as $invoicePayment):
                  $class = null;
                  if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                  }
                  if ($invoicePayment['InvoicePayment']['is_posted'] == 0) {
                        $can_delete = strstr($invoicePayment['InvoicePayment']['description'], 'PO Term') ? false : true;
                  } else {
                        $can_delete = false;
                  }
                  if ($group_id == fincon_group_id && $invoicePayment['InvoicePayment']['invoice_payment_status_id'] == status_invoice_payment_draft_id) {
                        $can_edit = true;
                  } else {
                        $can_edit = false;
                  }
                  $total += $invoicePayment['InvoicePayment']['amount_paid'];
                  $total_term_percent += $invoicePayment['InvoicePayment']['term_percent'];
                  $can_posting_payment = false; //$invoicePayment['InvoicePayment']['is_posted']==0
                  ?>
                  <tr<?php echo $class; ?>>

                        <td class="center"><?php echo $invoicePayment['InvoicePayment']['no']; ?>&nbsp;</td>
                        <td><?php echo $invoicePayment['InvoicePayment']['term_no']; ?>&nbsp;</td>
                        <td class="center"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['term_percent']); ?> %&nbsp;</td>
                        <td class="left"><?php echo $this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_due']); ?>&nbsp;</td>
                        <td class="left"><?php echo $invoicePayment['InvoicePayment']['date_paid']?$this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_paid']):'0000-00-00'; ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_due']); ?>&nbsp;</td>
                        <td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_paid']); ?>&nbsp;</td>
                        <td><?php echo $invoicePayment['InvoicePayment']['description']; ?>&nbsp;</td>
                        <td><?php echo $invoicePayment['BankAccount']['name']; ?>&nbsp;</td>
                        <td><?php echo $invoicePayment['BankAccountType']['name']; ?>&nbsp;</td>
                        <td><?php echo $invoicePaymentStatus[$invoicePayment['InvoicePayment']['invoice_payment_status_id']]; ?>&nbsp;</td>

                        <td class="actions">
      <?php if ($can_posting_payment) : ?>
            <?php
            echo $this->Html->link(__('Posting Journal', true), array('controller' => 'journal_transactions',
                'action' => 'prepare_posting',
                'invoice_payment',
                journal_group_payment_id,
                $invoicePayment['InvoicePayment']['id']));
            ?>
                              <?php endif; ?>

                              <?php if ($can_edit) : ?>
                                    <?php echo $this->Html->link(__('Edit payment', true), array('action' => 'edit', $invoicePayment['InvoicePayment']['id'])); ?>
                              <?php endif; ?>

                              <?php if ($this->Session->read('Security.permissions') == fincon_group_id || $this->Session->read('Security.permissions') == fincon_supervisor_group_id) : ?>
                                    <?php echo $this->Html->link(__('View', true), array('action' => 'view_payment', $invoicePayment['InvoicePayment']['id'])); ?>
                              <?php endif; ?>

                              <?php if ($can_delete) : ?>
                                    <?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $invoicePayment['InvoicePayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoicePayment['InvoicePayment']['id'])); ?>
                              <?php endif; ?>
                        </td>
                  </tr>
                        <?php endforeach; ?>
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
