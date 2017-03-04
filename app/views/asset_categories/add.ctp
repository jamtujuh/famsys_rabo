<div class="assetCategories form">
<?php echo $this->Form->create('AssetCategory');?>
	<fieldset>
 		<legend><?php __('Add Asset Category'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('asset_category_type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('depr_year_com');
		echo $this->Form->input('depr_rate_com');
		echo $this->Form->input('depr_year_fis');
		echo $this->Form->input('depr_rate_fis');
		echo $this->Form->input('account_id',array('options'=>$accounts,'empty'=>''));
		echo $this->Form->input('account_depr_accumulated_id',array('options'=>$accountDeprAccumulateds,'empty'=>''));
		echo $this->Form->input('account_depr_cost_id',array('options'=>$accountDeprCosts,'empty'=>''));
		echo $this->Form->input('descr', array('style'=>'width:50%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
	</ul>
</div>