<?php 
$total_db=0;
$total_cr=0;

?>
<div id="moduleName"><?php echo 'Journal > List Journal Transaction'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
<?php echo $this->Form->create('JournalTransaction') ?>
<div class="fieldfilter">
<fieldset>
<legend><?php __('Filter Journal Transactions'); ?></legend>
<fieldset class="subfilter">
<legend><?php __('Journal Transactions Info') ?></legend>
<?php echo $this->Form->input('department_id', array('empty'=>'all', 'value'=>$department_id)) ?>
<?php echo $this->Form->input('journal_template_id', array('empty'=>'all', 'options'=>$journalTemplates, 'value'=>$this->Session->read('JournalTransaction.journal_template_id'),  'style'=>'width:100%')) ?>
<?php echo $this->Form->input('journal_group_id', array('empty'=>'all', 'options'=>$journalGroup, 'value'=>$this->Session->read('JournalTransaction.journal_group_id'), 'style'=>'width:100%')) ?>
<?php
	$options = array(
		'url' => array('controller'=>'journal_templates','action'=>'get_journal_group', 'JournalTransaction'), 
		'update' => 'JournalTransactionJournalTemplateId',
		'indicator' 	=> 'LoadingDiv',
		);
	echo $ajax->observeField('JournalTransactionJournalGroupId', $options);	
?>
</fieldset>
<fieldset class="subfilter" style="width:40%">
<legend><?php __('Date Filter') ?></legend>
<?php echo $this->Form->input('posting_id', array('empty'=>'all', 'value'=>$posting_id)) ?>
<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
</fieldset>
<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS' /* , 'posting'=>'Posting' */),array('default'=>'Screen')) ?>
<?php echo $this->Form->submit('Refresh') ?>
<?php echo $this->Form->end() ?>
</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li> <?php echo $this->Html->link(__('Generate CSV', true), array('controller' => 'journal_transactions', 'action' => 'montly_journal')); ?> </li>
	</ul>
</div>

</div>


<div class="related">
	<h2><?php __('Journal Transactions');?></h2>
	
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th>
			<?php echo $this->Paginator->sort('journal_template_id');?><br>
			</th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('Branch');?></th>
			<th><?php echo $this->Paginator->sort('Currency');?></th>
			<th><?php echo $this->Paginator->sort('account_code');?></th>
			<th><?php echo $this->Paginator->sort('account_id');?></th>
			<th><?php echo $this->Paginator->sort('journal_position_id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('amount_db');?></th>
			<th><?php echo $this->Paginator->sort('amount_cr');?></th>
			<th><?php echo $this->Paginator->sort('posting');?></th>
			
			<th><?php echo $this->Paginator->sort('notes');?></th>
			<th><?php echo $this->Paginator->sort('source');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journalTransactions as $journalTransaction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		list($a, $b, $c) = explode('.', $journalTransaction['JournalTransaction']['account_code']);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php echo $journalTransaction['JournalTemplate']['name'] ?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$journalTransaction['JournalTransaction']['date']); ?>&nbsp;</td>
		<td class="left"><?php echo $a; ?>&nbsp;</td>
		<td class="left"><?php echo $b; ?>&nbsp;</td>
		<td class="left"><?php echo $c; ?>&nbsp;</td>
		<td class="left">
			<?php echo $journalTransaction['Account']['name'] ; ?>
		</td>
		<td class="left">
			<?php echo $journalTransaction['JournalPosition']['name'] ; ?>
		</td>
		<td class="left">
			<?php echo $journalTransaction['Department']['name'] ; ?>
		</td>
		<td class="number"><?php echo $this->Number->format($journalTransaction['JournalTransaction']['amount_db']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($journalTransaction['JournalTransaction']['amount_cr']); ?>&nbsp;</td>
		<?php if($journalTransaction['JournalTransaction']['posting'] == 1){
				$posting = 'Yes';
		}else{
				$posting = 'No';
		}
		?>
		<td><?php echo $posting ; ?>&nbsp;</td>
		<td class="left"><?php echo $journalTransaction['JournalTransaction']['notes']; ?>&nbsp;</td>
		<td class="left">
			<?php echo $journalTransaction['JournalTransaction']['source']; ?> : <?php echo $journalTransaction['JournalTransaction']['doc_id']; ?>
			<?php if($journalTransaction['JournalTransaction']['source'] == 'invoice') :?>
				<?php echo $this->Html->link (
					$myApp->showArrayValue($invoices, $journalTransaction['JournalTransaction']['doc_id'] ) ,
					array('controller'=>'invoices', 'action'=>'view', $journalTransaction['JournalTransaction']['doc_id'])
					); ?>
			<?php endif; ?>
		&nbsp;</td>
	</tr>
	<?php $total_db += $journalTransaction['JournalTransaction']['amount_db']?>
	<?php $total_cr += $journalTransaction['JournalTransaction']['amount_cr']?>	
<?php endforeach; ?>

	<tr>
		<td colspan="9"><div align="right">Total</div></td>
		<td class="number"><?php echo $this->Number->format($total_db)?></td>
		<td class="number"><?php echo $this->Number->format($total_cr)?></td>
		<td colspan="3"></td>
	</tr>
	<tr>
		<td colspan="9"><div align="right">General Total</div></td>
		<td class="number"><?php echo $this->Number->format($totalGeneral['amount_db'])?></td>
		<td class="number"><?php echo $this->Number->format($totalGeneral['amount_cr'])?></td>
		<td colspan="3"></td>
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
