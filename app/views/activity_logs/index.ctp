<div class="it logs index">
	<fieldset>
	<legend><?php __('IT Log Filters')?></legend>
	<?php echo $this->Form->create('ActivityLog', array('action'=>'index')) ?>
	<?php echo $this->Form->input('username',array('type'=>'text', 'value'=>$this->Session->read('ActivityLog.username'))) ?>
	<?php $options = array( 'LOGIN' => 'LOGIN', 'LOGOUT' => 'LOGOUT', 'LOGIN FAILED' => 'LOGIN FAILED', 'ADD USER' => 'ADD USER', 'EDIT USER' => 'EDIT USER', 'DELETE USER' => 'DELETE USER', 'CHANGE PASSWORD' => 'CHANGE PASSWORD', 'RESET PASSWORD' => 'RESET PASSWORD', 'ENABLE USER' => 'STATUS AKTIF', 'DISABLE USER' => 'STATUS TIDAK AKTIF' ) ?>
	<?php echo $this->Form->input('process',array('options'=>$options,'empty'=>'all','value'=>$this->Session->read('ActivityLog.process'))) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$this->Session->read('ActivityLog.date_start'))) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$this->Session->read('ActivityLog.date_end'))) ?>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Execute') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="it logs related">
	<h2><?php __('IT Logs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('username');?></th>
		<th><?php echo $this->Paginator->sort('process');?></th>
		<th><?php echo $this->Paginator->sort('status');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo 'Remark';?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<?php
	foreach ($activitylogs as $activitylog):
		$class = null;
		if ($data_number++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $data_number; ?>&nbsp;</td>
		<td><?php echo $activitylog['ActivityLog']['username']; ?>&nbsp;</td>
		<td><?php echo $activitylog['ActivityLog']['process']; ?>&nbsp;</td>
		<td>
			<?php
				if ($activitylog['ActivityLog']['status'] == 'SUCCESS'){
			?>
				<font color="GREEN"><?php echo $activitylog['ActivityLog']['status']; ?>&nbsp;</font>
			<?php
				}else{
			?>
				<font color="RED"><?php echo $activitylog['ActivityLog']['status']; ?>&nbsp;</font>
			<?php };?>
			
		</td>
		<td><?php echo strftime("%H:%M:%S %d-%m-%Y" , strtotime($activitylog['ActivityLog']['created']))?>&nbsp;</td>
		<td><?php echo $activitylog['ActivityLog']['remark']; ?>&nbsp;</td>
		<td class="actions">
		<?php echo $this->Html->link(__('View', true), array('action' => 'view', $activitylog['ActivityLog']['id'])); ?>
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
		<?php echo $this->Paginator->first('|< ' . __('first', true), array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >|', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
