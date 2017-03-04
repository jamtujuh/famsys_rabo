<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('Po', array('action'=>'po_report/'.$type)) ?>
	<fieldset>
	<legend><?php __('Purchase Order Report '. ucwords($type)) ?></legend>
	<fieldset class="subfilter" style='width:50%'>
	<legend><?php __('Purchase Order Info') ?></legend>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	</fieldset>
	<?php echo $this->Form->end() ?>
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
	<h2><?php __('POs');?></h2>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('No PO');?></th>
			<th><?php echo $this->Paginator->sort('PO Date');?></th>
			<th><?php echo $this->Paginator->sort('Delivery Date');?></th>
			<th><?php echo $this->Paginator->sort('Supplier');?></th>
			<th><?php echo $this->Paginator->sort('Is Done');?></th>
			<th><?php echo $this->Paginator->sort('Item Name');?></th>
			<th><?php echo $this->Paginator->sort('Qty');?></th>
			<th><?php echo $this->Paginator->sort('Qty Received');?></th>
			<th><?php echo $this->Paginator->sort('Balance');?></th>
			
			<?php 
			if($type=='finish') :
		    echo '<th>' ;
			echo $this->Paginator->sort('Finish Date');
			echo '</th>' ;
			endif;
			?>
			
		</tr>
	<?php
	$i = 0;
	
	foreach ($pos as $po):
		$class = null;
		if($po['PoDetail'] == null)
		continue;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
	?>
	<tr<?php echo $class;?>>
	     <td><?php echo $i ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($po['Po']['no'], array('controller' => 'pos', 'action' => 'view', $po['Po']['id'])); ?>&nbsp;</td>
		
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $po['Supplier']['name']; ?></td>
		<td class="center"><?php echo $this->Html->image($po['Po']['v_is_done'] . ".gif"); ?>&nbsp;</td>
		
		<?php foreach ($po['PoDetail'] as $j=>$d) : ?>
			<?php if($j==0) :?>
			<td class="left">
				<?php echo $d['name']?>&nbsp;
			</td>
			<td class="right">
				<?php echo $d['qty']?>&nbsp;
			</td>
			<td class="right">
				<?php echo $d['qty_received']?>&nbsp;
			</td>
			<td class="right">
				<?php echo $d['qty']-$d['qty_received'];?>&nbsp;
			</td>
			
			<?php 
			if($type=='finish')
			{
				echo '<td  class="left">' ;
				echo $this->Time->format(DATE_FORMAT, $po['Po']['date_finish']);
				echo '</td>' ;
			}
			?>
						
			<?php else :?>
			<tr>
				<td colspan="6"></td>
				<td class="left">
				<?php echo $d['name']?>&nbsp;
				</td>
				<td class="right">
				<?php echo $d['qty']?>&nbsp;
				</td>
				<td class="right">
				<?php echo $d['qty_received']?>&nbsp;
				</td>
				<td class="right">
				<?php echo $d['qty']-$d['qty_received'];?>&nbsp;
				</td>
				<?php 
				if($type=='finish')
				{
					echo '<td  class="left">' ;
					echo $this->Time->format(DATE_FORMAT,$po['Po']['date_finish']);
					echo '</td>' ;
				}
				?>
			</tr>
			<?php endif ?>
			<?php endforeach; ?>
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
	 | 	<?php echo $this->Paginator->numbers();?> |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>