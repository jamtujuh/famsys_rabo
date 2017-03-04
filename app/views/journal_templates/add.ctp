<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
?>
<div class="journalTemplates form">
<?php echo $this->Form->create('JournalTemplate');?>
	<fieldset>
 		<legend><?php __('Add Journal Template'); ?></legend>
	<?php
		echo $this->Form->input('journal_group_id', array('value'=>$this->Session->read('JournalTemplate.journal_group_id')));
		echo $this->Form->input('asset_category_type_id', array('empty'=>'select asset category'));
		echo $this->Form->input('asset_category_id');
		echo $this->Form->input('name', array('style'=>'width:50%'));
		
		$options = array('url' => array('controller'=>'asset_categories', 'action'=>'get_asset_categories', 'JournalTemplate'),
			'indicator'=>'LoadingDiv', 
			'update' => 'JournalTemplateAssetCategoryId');
		echo $ajax->observeField('JournalTemplateAssetCategoryTypeId', $options);		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Journal Template', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Template', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Groups', true), array('controller' => 'journal_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Group', true), array('controller' => 'journal_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>