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
                <?php echo $this->Number->format($invoice['Invoice']['rp_rate']); ?>
            &nbsp;
        </dd>		

        <dt<?php if ($i % 2 == 0)
                    echo $class; ?>><?php __('Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0)
                echo $class; ?>>
                <?php echo $invoice['InvoiceStatus']['name']; ?>
            &nbsp;
        </dd>			

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

	<div>
	<?php echo $this->Form->create('Invoice');?>
		<?php
			echo $this->Form->input('id', array('type'=>'hidden'));
			echo $this->Form->input('no', array('type'=>'hidden'));
			echo $this->Form->input('cancel_notes', array('style'=>'width:98%'));
			echo $this->Form->input('cancel_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
			echo $this->Form->input('cancel_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		?>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	<div class="doc_actions">
        <ul>
			<li><?php echo $this->Html->link('Back', array('action'=>'view', $invoice['Invoice']['id'])) ;?></li>
		</ul>
		</div>
	</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Invoice', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
    <h3><?php __('Invoice Item Details'); ?></h3>
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
            <th><?php __('Currency'); ?></th>
            <th><?php __('Price Cur'); ?></th>
            <th><?php __('Price (Rp)'); ?></th>
            <th><?php __('Amount (Rp)'); ?></th>
            <th><?php __('Discount (Rp)'); ?></th>
            <th><?php __('After Discount (Rp)'); ?></th>
            <th><?php __('Is Vat'); ?></th>
            <th><?php __('Is Wht'); ?></th>
	</tr>
	<?php
		$i = 0;
            foreach ($invoice['InvoiceDetail'] as $invoiceDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$places = $myApp->getPlaces($invoice['Currency']['is_desimal']);
		?>
		<tr<?php echo $class;?>>
                    <td class="left"><?php echo $i; ?></td>
                    <td class="left"><?php echo $departments[$invoiceDetail['department_id']]; ?></td>
                    <td class="left"><?php echo $assetCategories[$invoiceDetail['asset_category_id']]; ?></td>
                    <td class="left"><?php echo $invoiceDetail['name']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['brand']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['type']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['color']; ?></td>
                    <td class="left"><?php echo $invoiceDetail['qty']; ?></td>
                    <td class="left"><?php echo $invoice['Currency']['name']; ?></td>
                    <td class="number"><?php echo $this->Number->format($invoiceDetail['price_cur'], $places); ?></td>
                    <td class="number"><?php echo $this->Number->format($invoiceDetail['price']); ?></td>
                    <td class="number"><?php echo $this->Number->format($invoiceDetail['amount']); ?></td>
                    <td class="number"><?php echo $this->Number->format($invoiceDetail['discount']); ?></td>
                    <td class="number"><?php echo $this->Number->format($invoiceDetail['amount_after_disc']); ?></td>
                    <td class="center"><?php echo $this->Html->image($invoiceDetail['is_vat'] . ".gif"); ?></td>
                    <td class="center"><?php echo $this->Html->image($invoiceDetail['is_wht'] . ".gif") ;?></td>
		</tr>
	<?php endforeach; ?>
	</table>

</div>
