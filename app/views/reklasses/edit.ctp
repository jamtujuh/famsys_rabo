<div class="faReturStatuses form">
<?php 
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false); 
?>
<?php echo $this->Form->create('Reklass');?>
	<fieldset>
 		<legend><?php __('Edit Reklass'); ?></legend>
		<?php echo $this->Form->input('id'); ?>
		<?php echo $this->Form->input('doc_no', array('value'=>$this->data['Reklass']['doc_no'], 'readonly'=>true)); ?>
		<?php echo $this->Form->input('asset_id', array('type' => 'hidden')); ?>
		<?php echo $this->Form->input('Asset.name', array('label' => 'Select Code - Name', 'style'=>'width:50%')); ?>
		<div id="asset_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			  //<![CDATA[
			  new Ajax.Autocompleter('AssetName', 'asset_choices', '<?php echo BASE_URL ?>/assets/auto_complete_reklass', {afterUpdateElement : setReklassAssetValues});
			  //]]>
		</script>
	<?php echo $this->Form->input('asset_category_id', array('options'=>$assetCategory));	?>
	<?php echo $this->Form->input('date', array('value'=>date('Y-m-d'), 'type'=>'text', 'readonly'=>true));	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
