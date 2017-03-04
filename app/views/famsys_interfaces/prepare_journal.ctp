<div class="process view">
	<h2><?php __("Prosses To Interface") ?></h2>
	<div class="ok">
		<?php __("Send journal to be processed today") ?>
	</div>
	<div class="doc_actions">
		<ul>
			<!--li>
				<? echo $this->Html->link(__('Send Journal to Procces Posting', true), 
				array('controller'=>'journal_transactions',
				'action'=>'journal_interfase')); ?>
			</li-->
			
			<li>
				<? echo $this->Html->link(__('Posting Journal to T24 [FT]', true), 
				array('controller'=>'journal_transactions',
				'action'=>'journal_interfase_ft')); ?>
			</li>
			
		</ul>		
	</div>
</div>
