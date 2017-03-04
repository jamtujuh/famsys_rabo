<div class="menus view">
<h2><?php  __('Menu');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Menu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menu['ParentMenu']['title'], array('controller' => 'menus', 'action' => 'view', $menu['ParentMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Help'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['help']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Urutan'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['urutan']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu', true), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Menu', true), array('action' => 'delete', $menu['Menu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Menu', true), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Menus');?></h3>
	<?php if (!empty($menu['ChildMenu'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Help'); ?></th>
		<th><?php __('Urutan'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['ChildMenu'] as $childMenu):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childMenu['id'];?></td>
			<td><?php echo $childMenu['parent_id'];?></td>
			<td><?php echo $childMenu['title'];?></td>
			<td><?php echo $childMenu['url'];?></td>
			<td><?php echo $childMenu['help'];?></td>
			<td><?php echo $childMenu['urutan'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'menus', 'action' => 'view', $childMenu['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'menus', 'action' => 'edit', $childMenu['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'menus', 'action' => 'delete', $childMenu['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childMenu['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Menu', true), array('controller' => 'menus', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Groups');?></h3>
	<?php if (!empty($menu['Group'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Descr'); ?></th>
		<th><?php __('Auth Amount'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['Group'] as $group):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $group['id'];?></td>
			<td><?php echo $group['name'];?></td>
			<td><?php echo $group['descr'];?></td>
			<td><?php echo $group['auth_amount'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
