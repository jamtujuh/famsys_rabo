<div class="departmentSubs view">
<h2><?php  __('Department Sub');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departmentSub['DepartmentSub']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departmentSub['DepartmentSub']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($departmentSub['Department']['name'], array('controller' => 'departments', 'action' => 'view', $departmentSub['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('department sub'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departmentSub['DepartmentSub']['name']; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Department', true), array('action' => 'edit', $departmentSub['DepartmentSub']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Department', true), array('action' => 'delete', $departmentSub['DepartmentSub']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $departmentSub['DepartmentSub']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Department', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'department_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'department_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Department Units');?></h3>
	<?php echo $this->Form->create('DepartmentUnit') ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php if (!empty($departmentSub['DepartmentUnit'])):?>
	<?php
		$i = 0;
		foreach ($departmentSub['DepartmentUnit'] as $departmentUnit):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $departmentUnit['code'];?></td>
			<td><?php echo $departmentUnit['name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'department_units', 'action' => 'view', $departmentUnit['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'department_units', 'action' => 'delete', $departmentUnit['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $departmentUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
		<tr id="newRecord">
			<td class="newField"><?php echo $this->Form->input('id', array('type'=>'hidden')) ;?></td>
			<td class="newField"><?php echo $this->Form->input('code');?></td>
			<td class="newField"><?php echo $this->Form->input('name');?></td>
			<td class="actions">
				<?php echo $this->Form->input('department_id', array('type'=>'hidden', 'value'=>$departmentSub['DepartmentSub']['department_id'])) ;?>
				<?php echo $this->Form->input('department_sub_id', array('type'=>'hidden', 'value'=>$departmentSub['DepartmentSub']['id'] ));?>
				<?php echo $ajax->submit('Add', 
				array(
				'url'=> array('controller'=>'department_units', 'action'=>'ajax_add'), 
				'indicator'	=> 'LoadingDiv',
				'complete' => 'appendDepartmentUnit(request)')); ?>
			</td>
		</tr>	
	</table>
	<?php echo $this->Form->end() ?>
	
<?php
echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
echo $javascript->link('my_detail_add',false);
?>
