<div class="process view">
	<h2><?php __("Depreciation process complete") ?></h2>
      <div class="ok">
            <?php __("Fixed Assets is depreciated monthly based on it's category. Fixed Asset Reports are now updated.") ?>
      </div>
	<div class="doc_actions">
	<ul>
		<li>
			<? echo $this->Html->link(__('Amortization Journal Posting', true), 
			array('controller'=>'journal_transactions',
			'action'=>'prepare_posting', 'asset', journal_group_amortize_id )); ?>
		</li>
	</ul>
	
	</div>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
	</ul>
</div>