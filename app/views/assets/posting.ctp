
<div class="related">
	<h3><?php __('Journal Details');?></h3>
	<?php if (!empty($journalLines)) : ?>
	
	<?php echo $this->Form->create('JournalTransaction', array('action'=>'posting_asset')) ?> 
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Date'); ?></th>
		<th><?php __('Account'); ?></th>
		<th><?php __('Journal Position'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Amount Db'); ?></th>
		<th><?php __('Amount Cr'); ?></th>
		<th><?php __('Account Code'); ?></th>
		<th><?php __('Journal Template Id'); ?></th>
	</tr>
	<?php foreach ($journalLines as $i=>$journalLine) : 	
	?>
	<tr>
		<td class="left">
			<?php echo $this->Form->input('date',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][date]','value'=>$journalLine['date']))?>
			<?php echo $this->Time->format(DATE_FORMAT,$journalLine['date']);?>
		</td>
		<td>
			<?php echo $this->Form->input('account_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][account_id]','value'=>$journalLine['account_id'])) ?>
			<?php echo $journalLine['account_name'];?>
		</td>	
		<td>
			<?php echo $this->Form->input('journal_position_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][journal_position_id]','value'=>$journalLine['journal_position_id'])) ?>
			<?php echo $journalLine['journal_position_name'];?>
		</td>	
		<td>
			<?php echo $this->Form->input('department_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][department_id]','value'=>$journalLine['department_id'])) ?>
			<?php if($journalLine['department_id']) echo $departments[$journalLine['department_id']]?>
		</td>
		<td class="number">
			<?php echo $this->Form->input('amount_db',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][amount_db]','value'=>$journalLine['amount_db']?$journalLine['amount_db']:0)) ?>
			<?php echo $this->Number->format($journalLine['amount_db']) ?>
		</td>			
		<td class="number">
			<?php echo $this->Form->input('amount_cr',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][amount_cr]','value'=>$journalLine['amount_cr']?$journalLine['amount_cr']:0)) ?>
			<?php echo $this->Number->format($journalLine['amount_cr']) ?>
		</td>			
		<td class="left">
			<?php echo $this->Form->input('account_code',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][account_code]','value'=>$journalLine['account_code'])) ?>
			<?php echo $journalLine['account_code'] ?>
		</td>			
		<td>
			<?php echo $this->Form->input('journal_template_detail_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][journal_template_id]','value'=>$journalLine['journal_template_detail_id'])) ?>
			<?php echo $this->Form->input('journal_template_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][journal_template_id]','value'=>$journalLine['journal_template_id'])) ?>
			<?php echo $journalTemplates[$journalLine['journal_template_id']] ?>
		</td>	
	</tr>
	<?php endforeach; ?>
	
	</table>
	
	<?php echo $this->Form->end('Confirm Journal Posting') ?>
	<?php else: ?>
	<p><?php __('Error: cannot file journal lines. Make sure you have configured Journal Template for every Asset Categories') ?></p>
	<?php endif; ?>
	
</div>


