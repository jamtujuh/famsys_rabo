<div class="departments view">
      <h2><?php __('Department'); ?></h2>
      <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
            <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Business Type'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $department['BusinessType']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Department'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $department['Department']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Account Code'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $department['Department']['account_code']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Area'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $department['Department']['area']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Code'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $department['Department']['code']; ?>
                  &nbsp;
            </dd>		
      </dl>
</div>

<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>
 		<?php if($this->Session->read('Security.permissions') == gs_group_id):?>
           <li><?php echo $this->Html->link(__('New Departments', true), array('action' => 'add')); ?></li>
 		<?php endif;?>
           <li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'Departments', 'action' => 'index')); ?> </li>
      </ul>
</div>



<?php
//echo $javascript->link('prototype', false);
//echo $javascript->link('scriptaculous', false);
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
