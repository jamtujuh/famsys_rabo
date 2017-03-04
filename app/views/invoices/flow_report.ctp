<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('Invoice', array('action'=>'flow_report')) ?>
	<fieldset>
	<legend><?php __('Flow Invoice Filters')?></legend>
	<fieldset class="subfilter" style="width:30%">
	<legend><?php __('Info')?></legend>
	<?php echo $this->Form->input('no_inv', array('label'=>'No Invoice', 'value'=>$this->Session->read('Invoice.no'))); ?>
	<?php echo $this->Form->input('no_po', array('label'=>'No PO', 'value'=>$this->Session->read('Po.no'))); ?>
	<?php echo $this->Form->input('no_do', array('label'=>'No Delivery Order', 'value'=>$this->Session->read('DeliveryOrder.no'))); ?>
	</fieldset>
	<fieldset class="subfilter" style="width:36%">
	<legend><?php __('Date Filter')?></legend>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>	
	</fieldset>	
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>	
</div>
</div>

<div class="related">
	<h2><?php __('Invoices');?></h2>
	
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('no_po');?></th>
		<th><?php echo $this->Paginator->sort('no_do');?></th>
		<th><?php echo $this->Paginator->sort('no_inv');?></th>
		<th><?php echo $this->Paginator->sort('inv_date');?></th>
		<th><?php echo 'status';?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		$group_id = $this->Session->read('Security.permissions');
		foreach ($invoices as $invoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php if($invoice['Po'] != null){
				echo $this->Html->link($invoice['Po'][0]['no'], array('controller' => 'pos', 'action' => 'view', $invoice['Po'][0]['id']));
				echo "<br>Appr: ".$invoice['Po'][0]['approved_by']."<br>";
			};
			?>
		</td>
		<td class="left">
			<?php foreach($invoice['DeliveryOrder'] as $deliveryOrder){
				echo $this->Html->link($deliveryOrder['no'], array('controller' => 'delivery_orders', 'action' => 'view', $deliveryOrder['id']));
				echo "<br>Appr: ".$deliveryOrder['approved_by']."<br>";
				}			
			?>
		</td>
		<td class="left">
			<?php echo $this->Html->link($invoice['Invoice']['no'], array('controller' => 'invoices', 'action' => 'view', $invoice['Invoice']['id'])); ?>
			<?php echo "<br>Appr: ".$invoice['Invoice']['approved_by']."<br>";?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>&nbsp;</td>
		<td class="left">
		<?php 
			if($invoice['Po'] != null){
				echo "Po: ".$invoice['Po'][0]['status_name']."<br>";
			}	
			if($invoice['InvoiceStatus'] != null){
				echo "Inv: ".$invoice['InvoiceStatus']['name']."<br>";
			}				
		?>		
		&nbsp;		
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $invoice['Invoice']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
