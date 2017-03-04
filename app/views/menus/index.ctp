<div class="menus index">
	<?php echo $this->Form->create('Menu') ?>
	<fieldset>
 		<legend><?php __('Filter Menu'); ?></legend>	
		<?php echo $this->Form->input('parent_id', array('options'=>$parentMenus, 'empty'=>'root', 'value'=>$this->Session->read('Menu.parent_id')));?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($Userinfo['group_is_admin'] == 1):?>
		<li><?php echo $this->Html->link(__('New Menu', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<?php endif;?>
	</ul>
</div>
<div class="related">
	<h2><?php __('Menus');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('help');?></th>
			<th><?php echo $this->Paginator->sort('urutan');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($menus as $menu):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left">
			<?php echo $menu['ParentMenu']['title']; ?>
		</td>
		<td><?php echo $menu['Menu']['title']; ?>&nbsp;</td>
		<td><?php echo $menu['Menu']['url']; ?>&nbsp;</td>
		<td><?php echo $menu['Menu']['help']; ?>&nbsp;</td>
		<td><?php echo $menu['Menu']['urutan']; ?>&nbsp;</td>
		<td class="actions">
			<?php if($Userinfo['group_is_admin'] == 1):?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $menu['Menu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menu['Menu']['id'])); ?>
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
