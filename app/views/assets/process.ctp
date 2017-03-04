<div id="moduleName"><?php echo $moduleName?></div>
<div class="process view">
	<h2><?php __('WARNING :');?></h2>
      <div class="error-message">
		<?php echo $depreciation_warning ;?>            
      </div>
      
	<div class="doc_actions">
	<ul>
		<li>
			<? echo $this->Html->link(__('Proses Depreciation', true), 
			array('controller'=>'assets',
			'action'=>'process_depr')); ?>
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