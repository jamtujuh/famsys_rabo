<div class="economic ages form">
<?php echo $this->Form->create('EconomicAge');?>
	<fieldset>
 		<legend><?php __('Edit Economic Age'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('year');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update', true));?>
</div>



