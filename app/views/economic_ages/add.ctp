
<div class="economic ages form">
<?php echo $this->Form->create('EconomicAge');?>
	<fieldset>
 		<legend><?php __('Add Economic Age'); ?></legend>
	<?php
		echo $this->Form->input('year');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>




