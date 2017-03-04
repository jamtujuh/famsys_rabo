<div class="journalTemplateDetails view">
<h2><?php  __('Journal Template Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTemplateDetail['JournalTemplateDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Journal Template'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTemplateDetail['JournalTemplate']['name'], array('controller' => 'journal_templates', 'action' => 'view', $journalTemplateDetail['JournalTemplate']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTemplateDetail['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $journalTemplateDetail['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Journal Position'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTemplateDetail['JournalPosition']['name'], array('controller' => 'journal_positions', 'action' => 'view', $journalTemplateDetail['JournalPosition']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('For Destination Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTemplateDetail['JournalTemplateDetail']['for_destination_branch']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('For Profit Sales'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTemplateDetail['JournalTemplateDetail']['for_profit_sales']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contra'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTemplateDetail['JournalTemplateDetail']['contra_account']; ?>
			&nbsp;
		</dd>			
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Journal Template Detail', true), array('action' => 'edit', $journalTemplateDetail['JournalTemplateDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Journal Template Detail', true), array('action' => 'delete', $journalTemplateDetail['JournalTemplateDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTemplateDetail['JournalTemplateDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Templates', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
	</ul>
</div>
