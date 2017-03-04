<div class="logs index">
	<fieldset>
	<legend><?php __('Log Filters')?></legend>	
	<?php echo $this->Form->create('Log', array('action'=>'index')) ?>
	<?php $models = array( 'user' => 'user', 'npb' => 'npb'
							, 'po' => 'po'
							) ?>
	<?php echo $this->Form->input('model',array('options'=>$models,'empty'=>'all','value'=>$model)) ?>
	<?php echo $this->Form->input('user_id',array('options'=>$uses,'empty'=>'all','value'=>$user_id)) ?>
	<?php $actions = array( 'add' => 'add', 'edit' => 'edit', 'delete' => 'delete' ) ?>
	<?php echo $this->Form->input('action',array('options'=>$actions,'empty'=>'all','value'=>$model)) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>


<div class="logs related">
	<h2><?php __('Logs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('model');?></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('change');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($logs as $log):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $log['Log']['title']; ?>&nbsp;</td>
		<td class="left"><?php echo strftime("%Y-%m-%d %H:%M:%S" , strtotime($log['Log']['created']))?></td>
		<td class="left"><?php echo $log['Log']['description']; ?>&nbsp;</td>
		<td class="left"><?php echo $log['Log']['model']; ?>&nbsp;</td>
		<td class="left"><?php echo $log['Log']['action']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($log['User']['name'], array('controller' => 'users', 'action' => 'view', $log['User']['id'])); ?>
		</td>
		<td class="left"><?php echo $log['Log']['change']; ?>&nbsp;</td>
		<td class="actions">
			<?php if($Userinfo['group_is_admin'] == 1):?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $log['Log']['id'])); ?>
			<?php endif;?>
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