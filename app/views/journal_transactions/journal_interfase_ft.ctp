<div class="related">
    <h3><?php __('Famsys Interface');?></h3>
	<?php if (!empty($data_ft)) : ?>

	<?php echo $this->Form->create('FamsysInterface', array('action'=>'add_ft')) ?> 
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th nowrap><?php __('No'); ?></th>
            <th nowrap><?php __('Version'); ?></th>
            <th nowrap><?php __('Branch'); ?></th>
            <th nowrap><?php __('Txn Code'); ?></th>
            <th nowrap><?php __('DR Acc'); ?></th>
            <th nowrap><?php __('DR Ccy'); ?></th>
            <th nowrap><?php __('DR Amt'); ?></th>
            <th nowrap><?php __('DR Value Date'); ?></th>
            <th nowrap><?php __('DR Ref'); ?></th>
            <th nowrap><?php __('CR Acc'); ?></th>
            <th nowrap><?php __('CR Ccy'); ?></th>
            <th nowrap><?php __('CR Amt'); ?></th>
            <th nowrap><?php __('CR Value Date'); ?></th>
            <th nowrap><?php __('CR Ref'); ?></th>
            <th nowrap><?php __('DAO'); ?></th>
            <th nowrap><?php __('Ordering Cust'); ?></th>
        </tr>
	<?php $i = 1;?>
	<?php foreach ($data_ft as $data) : ?>
        <tr>
            <td class="left">
			<?php echo $i; ?>
            </td>
            <td class="left">
			<?php echo $data['version'];?>
            </td>
            <td class="left">
			<?php echo $data['branch'];?>			
            </td>
            <td class="center">
			<?php echo $data['txn_code'];?>
            </td>
            <td class="left">
			<?php echo $data['dr_acc'];?>
            </td>
            <td class="center">
			<?php echo $data['dr_ccy'];?>
            </td>
            <td class="center">
			<?php echo $data['dr_amount'];?>
            </td>
            <td class="number">
			<?php echo $data['dr_date'];?>
            </td>
            <td class="left">
			<?php echo $data['dr_ref'];?>
            </td>
            <td class="center">
			<?php echo $data['cr_acc'];?>
            </td>
            <td class="center">
			<?php echo $data['cr_ccy'];?>
            </td>
            <td class="number">
			<?php echo $data['cr_amount'];?>
            </td>
            <td class="left">
			<?php echo $data['cr_date'];?>
            </td>
            <td class="left">
			<?php echo $data['cr_ref'];?>
            </td>
            <td class="number">
			<?php echo $data['dao'];?>
            </td>
            <td class="left">
			<?php echo $data['order_cust'];?>
            </td>
        </tr>
		<?php $i++;?>
	<?php endforeach; ?>
    </table>

	<?php echo $this->Form->end('Confirm Journal Interface') ?>
	<?php else: ?>
    <p><h2><?php __('Error: There is no journal that can be posted to the Interface') ?></h2></p>
<div class="doc_actions">
    <ul>
        <li>
            <? echo $this->Html->link(__('Back To Home', true), 
            array('controller'=>'pages',
            'action'=>'home')); ?>
        </li>
    </ul>
</div>
	<?php endif; ?>

</div>


