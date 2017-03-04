<?php
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>
<div class="outlogs form">
<?php echo $this->Form->create('Outlog');?>
	<fieldset>
 		<legend><?php __('Add Outlog'); ?></legend>
	<?php
		//echo $this->Form->input('id');
		echo $this->Form->input('outlog_status_id', array('type'=>'hidden','value'=>status_outlog_draft_id));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('date', array('type'=>'date', 'value'=>date("Y-m-d")));?>
	<?php echo $this->Form->input('retur_id', array('type'=>'hidden') ); ?>
	<?php echo $this->Form->input('Retur.no', array('label'=>'Select Retur No')); ?>
		<div id="retur_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ReturNo', 'retur_choices', '<?php echo BASE_URL ?>/returs/auto_complete', {afterUpdateElement : setOutlogReturValues});
			//]]>
		</script>
	<?php	
		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"),'type'=>'hidden'));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Outlogs', true), array('action' => 'index'));?></li>
	</ul>
</div>
