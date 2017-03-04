<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$group_id = $this->Session->read('Security.permissions');
$can_payment	= ($this->Session->read('InvoicePayment.can_payment') && $group_id==fincon_group_id);
?>
<div class="invoices view">
<h2><?php  __('Invoice');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $this->Html->link($invoice['Invoice']['no'], array('controller' => 'invoices', 'action' => 'view', $invoice['Invoice']['id']) ); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inv Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($invoice['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $invoice['Supplier']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['InvoiceStatus']['name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['total'], 2); ?></div>
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Paid (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['vtotal_paid'], 2); ?></div>
		</dd>		

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Settled'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="InvoiceTotalDiv"><?php echo $this->Html->image(($invoice['Invoice']['vtotal_paid']==$invoice['Invoice']['total']?1:0). '.gif'); ?>
			&nbsp;
			</div>
		</dd>		

	</dl>
	<div class="doc_actions">
	<ul>
		<?php if($can_payment): ?>
		<li><?php echo $this->Html->link(__('New Payment', true), array('action' => 'add', $invoice['Invoice']['id'])); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'invoices','action' => 'view',$invoice['Invoice']['id'])); ?> </li>
	</ul>
	</div>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
	</ul>
</div>

<div class="related">
	<h2><?php __('Invoice Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('term_no');?></th>
			<th><?php echo $this->Paginator->sort('term_percent');?></th>
			<th><?php echo $this->Paginator->sort('date_due');?></th>
			<th><?php echo $this->Paginator->sort('date_paid');?></th>
			<th><?php echo $this->Paginator->sort('amount_due');?></th>
			<th><?php echo $this->Paginator->sort('amount_paid');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_id');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_type_id');?></th>
			<th><?php echo $this->Paginator->sort('Status Invoice Payment');?></th>

			<th class="actions"><?php __('Actions');?></th>
	</tr>
	  <?php if($this->Number->format($percen_total) != $this->Number->format($invoice['Invoice']['total']) && $group_id==fincon_group_id):?>
	  <div class="error-message">
		<?php echo 'WARNING : Termin Percent Must equal with 100%, if not it can not be proccesing' ;?>            
      </div>
	  <?php endif ;?>
	<?php
	$i = 0;
	$total=0;
	$total_term_percent=0;
	$total_amount_due=0;
	foreach ($invoicePayments as $invoicePayment):
		$class = null;
            $can_delete = false;
            $can_edit = false;
            $can_input_payment = false;
      
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
            
            /*
             * hanya bisa edit/delete/input payment ketika invoice sudah Unpaid status
             * dan group fincon
             * 
             * 
             * Invoice : UNPAID
             * invoice payment :
             * - 0 
             * - send to supervisor
             * - draft
             * - send to supervisor
             * - approved
             * - finish
             */
            
            if($group_id == fincon_group_id  && $invoice['Invoice']['status_invoice_id'] == status_invoice_unpaid_id || $invoice['Invoice']['status_invoice_id'] == status_invoice_processing_id)
            {
                  /*
                   * kalau status payment 0 atau draft , bisa diedit dan delete 
                  */
                  
                  if(
                     $invoicePayment['InvoicePayment']['invoice_payment_status_id'] ==  status_invoice_payment_draft_id||
                     $invoicePayment['InvoicePayment']['invoice_payment_status_id'] ==  0)
                  {
                        $can_edit         = true;
                        $can_delete 	= strstr($invoicePayment['InvoicePayment']['description'],'PO')  ? false : true;
                        //$can_input_payment      = true;
                }
                  
            }
            
		$total += $invoicePayment['InvoicePayment']['amount_paid'];
		$total_amount_due += $invoicePayment['InvoicePayment']['amount_due'];
		$total_term_percent += $invoicePayment['InvoicePayment']['term_percent'];
		$can_posting_payment = false; //$invoicePayment['InvoicePayment']['is_posted']==0
	?>
	  
	<tr<?php echo $class;?>>

		<td class="center"><?php echo $invoicePayment['InvoicePayment']['no']; ?>&nbsp;</td>
		<td><?php echo $invoicePayment['InvoicePayment']['term_no']; ?>&nbsp;</td>
		<td class="center"><?php echo $invoicePayment['InvoicePayment']['term_percent']; ?> %&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_due']); ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['InvoicePayment']['date_paid']?$this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_paid']):''; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_due'], 2); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_paid'], 2); ?>&nbsp;</td>
		<td><?php echo $invoicePayment['InvoicePayment']['description']; ?>&nbsp;</td>
		<td><?php echo $myApp->showArrayValue($bankAccounts, $invoicePayment['InvoicePayment']['bank_account_id'] ); ?>&nbsp;</td>
		<td><?php echo $myApp->showArrayValue($bankAccountTypes, $invoicePayment['InvoicePayment']['bank_account_type_id']); ?>&nbsp;</td>
		<td><?php echo $myApp->showArrayValue($invoicePaymentStatus,$invoicePayment['InvoicePayment']['invoice_payment_status_id']); ?>&nbsp;</td>

		<td class="actions">
			<?php if($can_posting_payment) : ?>
			<?php echo $this->Html->link(__('Posting Journal', true), 
				array('controller'=>'journal_transactions',
					'action' => 'prepare_posting', 
					'invoice_payment',
					journal_group_payment_id,
					$invoicePayment['InvoicePayment']['id'])); 
				?>
			<?php endif;?>

			<?php if($can_edit) : ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $invoicePayment['InvoicePayment']['id'])); ?>
			<?php endif;?>

			<?php if($can_input_payment) : ?>
				<?php echo $this->Html->link(__('Input Payment', true), array('action' => 'input_payment', $invoicePayment['InvoicePayment']['id'])); ?>
			<?php endif;?>
			
			<?php if($this->Session->read('Security.permissions') == fincon_group_id || $this->Session->read('Security.permissions') == fincon_supervisor_group_id ) :?>
				<?php echo $this->Html->link(__('View', true), array('action' => 'view_payment', $invoicePayment['InvoicePayment']['id'])); ?>
			<?php endif;?>
			
			<?php if($can_delete) : ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $invoicePayment['InvoicePayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoicePayment['InvoicePayment']['id'])); ?>
			<?php endif;?>
		</td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<?php if($this->Number->format($percen_total) == $this->Number->format($invoice['Invoice']['total'])) {?>
		<td class="center"><?php echo '100';?> %&nbsp;</td>
		<?php }else{ ?>
		<td class="center"><?php echo $total_term_percent?> %&nbsp;</td>
		<?php } ?>
		<td>&nbsp;</td>
		<td class="number"><?php __('Total')?>&nbsp;</td>		
		<td class="number"><?php echo $this->Number->format($total_amount_due, 2)?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($total, 2)?>&nbsp;</td>
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
	</tr>
	<tr>
		<td colspan="6" class="number"><?php __('Balance Due')?>&nbsp;</td>		
		<td class="number"><?php echo $this->Number->format(abs($invoice['Invoice']['total']-$invoice['Invoice']['vtotal_paid']), 2)?>&nbsp;</td>
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>		
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
