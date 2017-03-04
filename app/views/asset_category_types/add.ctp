<div class="assetCategoryTypes form">
<?php echo $this->Form->create('AssetCategoryType');?>
	<fieldset>
 		<legend><?php __('Add Asset Category Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Asset Category Types', true), array('action' => 'index'));?></li>
	</ul>
</div>