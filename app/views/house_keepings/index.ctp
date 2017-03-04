<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
            <?php echo $this->Form->create('HouseKeeping', array('action'=>'index')) ?>
			<legend><?php __('House Keeping Filters') ?></legend>
			
			<fieldset class='subfilter' style='width:40%'>
			<legend><?php __('House Keeping Info')?></legend>			
			<?php echo $this->Form->input('name', array('options'=>$tableOptions,'empty'=>'-select table-','value' => $this->Session->read('HouseKeeping.name'))) ?> 
			<?php echo $this->Form->input('status',array('options'=>$statusOptions,'empty'=>'all')) ?>				
			<?php echo $this->Form->input('user',array('options'=>$options,'empty'=>'all','value' => $this->Session->read('HouseKeeping.created_by'))) ?>				
			</fieldset>
			
			<fieldset class='subfilter' style='width:40%'>
			<legend><?php __('House Keeping Date')?></legend>
			<?php echo $this->Form->input('date_start', array('type' => 'date', 'value' => $date_start)) ?> 
            <?php echo $this->Form->input('date_end', array('type' => 'date', 'value' => $date_end)) ?>
			</fieldset>
			
			<!--?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?-->
            <?php echo $this->Form->submit('Submit') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Create House Keepings', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h2><?php __('House Keepings Log');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>No</th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('date_start');?></th>
			<th><?php echo $this->Paginator->sort('date_end');?></th>			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($HouseKeepings as $hK):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>

	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php
				if($hK['HouseKeeping']['name'] == 'npbs'){
					echo 'Memo Request';
				}else if($hK['HouseKeeping']['name'] == 'pos'){
					echo 'Purchase Order';
				}else if($hK['HouseKeeping']['name'] == 'delivery_orders'){
					echo 'Delivery Order';
				}else if($hK['HouseKeeping']['name'] == 'inlogs'){
					echo 'Inlog';
				}else if($hK['HouseKeeping']['name'] == 'outlogs'){
					echo 'Outlog';
				}else if($hK['HouseKeeping']['name'] == 'invoices'){
					echo 'Invoice';
				}else if($hK['HouseKeeping']['name'] == 'all'){
					echo 'ALL';
				}
			?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$hK['HouseKeeping']['date']); ?>&nbsp;</td>
		<td class="left"><?php echo $hK['User']['username']; ?>&nbsp;</td>
		<td class="left">
			<?php
				if($hK['HouseKeeping']['status'] == 1){
					echo '<font color=GREEN>SUCCESS</font>';
				}else{
					echo '<font color=RED>FAILED</font>';
				}
			?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$hK['HouseKeeping']['date_start']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$hK['HouseKeeping']['date_end']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('action' => 'view', $hK['HouseKeeping']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
