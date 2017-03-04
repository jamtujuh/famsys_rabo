<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
            <?php echo $this->Form->create('Po', array('action' => 'total_per_supplier_report')) ?>
            <legend><?php __('Total Purchase Order per Supplier Report ') ?></legend>
			<fieldset class='subfilter'>
			<legend><?php __('PO Info')?></legend>
			<?php echo $this->Form->input('supplier_id', array( 'empty' => 'all', 'value' => $this->Session->read('Po.supplier_id'))) ?>
            <?php echo $this->Form->input('currency_id', array( 'empty' => 'all', 'value' => $this->Session->read('Po.currency_id'))) ?>
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
            <li><?php echo $this->Html->link(__('List POs', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('List POs Finish', true), array('controller' => 'pos', 'action' => 'po_report/finish')); ?> </li>
            <li><?php echo $this->Html->link(__('List POs Outstanding', true), array('controller' => 'pos', 'action' => 'po_report/outstanding')); ?> </li>
      </ul>
</div>
</div>

<div class="related">
      <h2><?php __('Supplier POs'); ?></h2>

      <table cellpadding="0" cellspacing="0">
            <tr>
                  <th><?php __('No'); ?></th>
                  <th><?php __('Supplier'); ?></th>
                  <th><?php __('Currency'); ?></th>
                  <th><?php __('Total'); ?></th>
            </tr>
            <?php
            $i = 0;

            foreach ($pos as $po):
                  $class = null;
                  if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                  }
				  $places = $myApp->getPlaces($currency[$po['Po']['currency_id']]);
                  ?>
                  <tr<?php echo $class; ?>>
                        <td><?php echo $i ?>&nbsp;</td>
                        <td class="left"><?php echo $suppliers[$po['Po']['supplier_id']]; ?></td>
                        <td class="left"><?php echo $currencies[$po['Po']['currency_id']]; ?></td>
                        <td class="number"><?php echo $this->Number->format($po[0]['total'], $places); ?>&nbsp;</td>
                  </tr>
            <?php endforeach; ?>
      </table>
      <p>
<?php
?>
</div>