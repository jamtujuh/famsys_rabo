<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
	$group_id = $this->Session->read('Security.permissions');
?>
<div id="moduleName"><?php echo 'SYS ADMIN > User Management'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('User', array('action'=>'index')) ?>
	<fieldset>
	<legend><?php __('User Filters')?></legend>
	<fieldset class="subfilter" style="width:60%">
	<legend><?php __('User Info') ?></legend>
	<?php echo $this->Form->input('department_id', array('options'=>$departments, 'empty'=>'all', 'value'=>$this->Session->read('User.department_id'))) ?>
	<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$this->Session->read('User.business_type_id'))) ?>
	<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
	<?php echo $this->Form->input('aktif', array('value'=>$this->Session->read('User.aktif'), 'options'=>array(1=>'ENABLED', 2=>'DISABLED'), 'empty'=>'All')) ?>
	<?php echo $this->Form->input('search', array('style'=>'width:100%', 'value'=>$this->Session->read('User.name'), 'label'=>'Search Name Or Username')) ?>
	<div id="cost_center_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setUserCostCenterValues});
		//]]>
	</script>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($Userinfo['group_is_admin'] == 1): ?>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?></li>
		<?php endif;?>
	</ul>
</div>
</div>
<div class="related">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('group_id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<?php //echo $this->Paginator->sort('department_sub_id');?>
			<?php //echo $this->Paginator->sort('department_unit_id');?>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('last_password_change');?></th>
			<th><?php echo $this->Paginator->sort('aktif');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		//enable or disabled user
		$status = ($user['User']['aktif']==1)?'ENABLED':'DISABLED';
		
		if($status == 'ENABLED') {
			$class = ' style="color:green;font-weight:bold"';
		}
		else if ($status == 'DISABLED') {
			$class = ' style="color:red;font-weight:bold"';
		}
		
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td class="left"><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td class="left"><?php echo $user['User']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $user['Group']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $user['Department']['name']; ?>&nbsp;</td>
		<?php //echo $user['DepartmentSub']['name']; ?>
		<?php //echo $user['DepartmentUnit']['name']; ?>
		<td class="left"><?php echo $user['BusinessType']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $user['CostCenter']['cost_centers']; ?> - <?php echo $user['CostCenter']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $user['User']['last_password_change']; ?>&nbsp;</td>
		<td class="left"><?php echo $status; ?>&nbsp;</td>
		<td class="actions">

		<?php if($Userinfo['group_is_admin'] == 1): ?>
		<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
		<?php 
			if ($status == 'ENABLED'){
		?>
			<?php echo $this->Html->link(__('Disable', true), array('action' => 'change_active', $user['User']['id'])); ?>
		<?php
			}else{
		?>
			<?php echo $this->Html->link(__('Enable', true), array('action' => 'change_active', $user['User']['id'])); ?>
		<?php
			}
		?>
		<?php $username = $Userinfo['username'];
				if($username!=$user['User']['username']):?>
		<!--?php echo $this->Html->link(__('Set Password', true), array('action' => 'set_password', $user['User']['id'])); ?-->
		<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
		<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
				<?php endif;?>
		<?php endif;?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
