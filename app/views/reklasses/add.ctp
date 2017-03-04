<div class="reklass form">
<?php 
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false); 
?>

<?php echo $this->Form->create('Reklass');?>
	<fieldset>
 		<legend><?php __('Add Reklass'); ?></legend>
		<?php echo $this->Form->input('doc_no', array('value'=>$newID, 'readonly'=>true)); ?>
		<?php echo $this->Form->input('asset_id', array('type' => 'hidden')); ?>
		<?php echo $this->Form->input('Asset.name', array('label' => 'Select Code - Name', 'style'=>'width:50%')); ?>
		<div id="asset_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			  //<![CDATA[
			  new Ajax.Autocompleter('AssetName', 'asset_choices', '<?php echo BASE_URL ?>/assets/auto_complete_reklass', {afterUpdateElement : setReklassAssetValues});
			  //]]>
		</script>
	<?php echo $this->Form->input('asset_category_id', array('options'=>$assetCategory));	?>
	<?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
	<?php echo $this->Form->input('Item.name', array('label' => 'Select Item Code - Name', 'style'=>'width:50%')); ?>
	<div id="item_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete_reklass', {afterUpdateElement : setReklassItemValues});
		//]]>
	</script>
	<?php echo $this->Form->input('date', array('value'=>date('Y-m-d'), 'type'=>'text', 'readonly'=>true));	?>
	<?php echo $this->Form->input('create_by', array('value'=>$this->Session->read('Userinfo.username'), 'type'=>'text', 'readonly'=>true));	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Reklass', true), array('action' => 'index')); ?> </li>
	</ul>
</div>